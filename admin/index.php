<?php
session_start();

// Simple login check (in production, use proper authentication)
if (!isset($_SESSION['admin_logged_in'])) {
    // For demo purposes, auto-login. In production, show login form.
    $_SESSION['admin_logged_in'] = true;
}

$host = 'localhost';
$dbname = 'aitoolspro';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed. Please run the installer first.");
}

// Handle API key update
if (isset($_POST['update_api_key'])) {
    $api_key = trim($_POST['api_key']);
    if (!empty($api_key)) {
        file_put_contents(__DIR__ . '/config/api_key.txt', $api_key);
        $message = "API Key updated successfully!";
    }
}

// Get current API key
$api_key = '';
if (file_exists(__DIR__ . '/config/api_key.txt')) {
    $api_key = file_get_contents(__DIR__ . '/config/api_key.txt');
}

// Fetch stats
$stmt = $pdo->query("SELECT COUNT(*) as total FROM tools");
$total_tools = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as active FROM tools WHERE status = 1");
$active_tools = $stmt->fetch()['active'];

// Fetch all tools
$stmt = $pdo->query("SELECT * FROM tools ORDER BY category, name");
$tools = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AiToolsPro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #7c3aed;
            --primary-dark: #6d28d9;
            --secondary: #10b981;
            --dark: #0f172a;
            --darker: #0b1120;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #334155;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            color: var(--light);
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--darker), var(--dark));
            padding: 2rem 1rem;
            border-right: 1px solid var(--border);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .logo { text-align: center; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border); }
        .logo h1 { color: white; font-size: 1.5rem; }
        .logo span { color: var(--primary); }
        
        .nav-links { list-style: none; }
        .nav-links li { margin-bottom: 0.5rem; }
        .nav-links a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--gray);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-links a:hover, .nav-links a.active { background: rgba(124, 58, 237, 0.1); color: white; }
        .nav-links i { margin-right: 0.75rem; width: 20px; text-align: center; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 2rem; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .header h2 { font-size: 1.75rem; }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--darker), var(--dark));
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
        }
        .stat-card h3 { font-size: 2rem; color: var(--primary); margin-bottom: 0.5rem; }
        .stat-card p { color: var(--gray); font-size: 0.875rem; }
        
        .card {
            background: linear-gradient(135deg, var(--darker), var(--dark));
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card-title { font-size: 1.25rem; margin-bottom: 1rem; color: white; }
        
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; color: var(--light); }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3); }
        
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--border); }
        .table th { color: var(--primary); font-weight: 600; }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-active { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .status-inactive { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }
        
        .tool-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
        }
        .tool-card h4 { margin-bottom: 0.5rem; color: white; }
        .tool-card p { color: var(--gray); font-size: 0.875rem; margin-bottom: 1rem; }
        .category-tag {
            display: inline-block;
            background: rgba(124, 58, 237, 0.1);
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            margin-right: 0.5rem;
        }
        .btn-success { background: var(--secondary); color: white; }
        .btn-danger { background: #ef4444; color: white; }
        
        .message {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; padding: 1rem; }
            .main-content { margin-left: 0; padding: 1rem; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Ai<span>Tools</span>Pro</h1>
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-tools"></i> Tools Management</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="../index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Admin Dashboard</h2>
            <div>Welcome, Admin</div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3><?php echo $total_tools; ?></h3>
                <p>Total Tools</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $active_tools; ?></h3>
                <p>Active Tools</p>
            </div>
            <div class="stat-card">
                <h3>0</h3>
                <p>API Calls Today</p>
            </div>
            <div class="stat-card">
                <h3>Free</h3>
                <p>Plan</p>
            </div>
        </div>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="card">
            <h3 class="card-title">API Configuration</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="api_key">Google AI Studio (Gemini) API Key</label>
                    <input type="password" id="api_key" name="api_key" value="<?php echo htmlspecialchars($api_key); ?>" placeholder="Enter your Gemini API key">
                </div>
                <button type="submit" name="update_api_key" class="btn">Save API Key</button>
                <a href="https://aistudio.google.com/app/apikey" target="_blank" class="btn" style="background: transparent; border: 1px solid var(--primary); margin-left: 10px;">Get API Key</a>
            </form>
        </div>

        <div class="card">
            <h3 class="card-title">All Tools (<?php echo $total_tools; ?>)</h3>
            <div class="tools-grid">
                <?php foreach ($tools as $tool): ?>
                <div class="tool-card">
                    <span class="category-tag"><?php echo htmlspecialchars($tool['category']); ?></span>
                    <h4><?php echo htmlspecialchars($tool['name']); ?></h4>
                    <p><?php echo htmlspecialchars($tool['description']); ?></p>
                    <div>
                        <?php if ($tool['status']): ?>
                            <a href="?deactivate=<?php echo $tool['id']; ?>" class="action-btn btn-danger">Deactivate</a>
                        <?php else: ?>
                            <a href="?activate=<?php echo $tool['id']; ?>" class="action-btn btn-success">Activate</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
// Handle activate/deactivate
if (isset($_GET['activate'])) {
    $id = (int)$_GET['activate'];
    $pdo->exec("UPDATE tools SET status = 1 WHERE id = $id");
    header("Location: index.php");
    exit;
}
if (isset($_GET['deactivate'])) {
    $id = (int)$_GET['deactivate'];
    $pdo->exec("UPDATE tools SET status = 0 WHERE id = $id");
    header("Location: index.php");
    exit;
}
?>
