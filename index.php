<?php
// Database connection
$host = 'localhost';
$dbname = 'aitoolspro';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // If DB not installed yet, redirect to installer
    header('Location: install/install.php');
    exit;
}

// Fetch all tools grouped by category
$stmt = $pdo->query("SELECT * FROM tools WHERE status = 1 ORDER BY category, name");
$all_tools = $stmt->fetchAll();

// Group tools by category
$grouped_tools = [];
foreach ($all_tools as $tool) {
    $category = $tool['category'];
    if (!isset($grouped_tools[$category])) {
        $grouped_tools[$category] = [];
    }
    $grouped_tools[$category][] = $tool;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AiToolsPro - 42 Free AI Tools for Daily Use</title>
    <meta name="description" content="Access 42 free AI tools for writing, SEO, images, code and more. No signup required.">
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
            background: linear-gradient(135deg, var(--darker), var(--dark));
            color: var(--light);
            line-height: 1.6;
        }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        
        header {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo { font-size: 1.5rem; font-weight: 700; color: white; text-decoration: none; }
        .logo span { color: var(--primary); }
        
        .nav-links { display: flex; list-style: none; gap: 2rem; }
        .nav-links a { color: var(--gray); text-decoration: none; transition: color 0.3s ease; }
        .nav-links a:hover { color: white; }
        
        .hero { text-align: center; padding: 4rem 0 2rem; }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p { font-size: 1.25rem; color: var(--gray); max-width: 600px; margin: 0 auto 2rem; }
        
        .categories { padding: 3rem 0; }
        .section-title { text-align: center; font-size: 2rem; margin-bottom: 3rem; color: white; }
        
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .category-card {
            background: linear-gradient(135deg, var(--darker), var(--dark));
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            transition: transform 0.3s ease;
        }
        .category-card:hover { transform: translateY(-5px); }
        
        .category-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .tools-list { list-style: none; }
        .tools-list li { padding: 0.75rem 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .tools-list li:last-child { border-bottom: none; }
        .tools-list a {
            color: var(--light);
            text-decoration: none;
            display: block;
            transition: color 0.3s ease;
            padding: 5px 0;
        }
        .tools-list a:hover { color: var(--primary); }
        .tools-list i { margin-right: 8px; font-size: 0.8rem; }
        
        .features { padding: 4rem 0; background: rgba(15, 23, 42, 0.3); }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        .feature-card { text-align: center; padding: 2rem; }
        .feature-icon { font-size: 3rem; color: var(--primary); margin-bottom: 1rem; }
        .feature-card h3 { margin-bottom: 1rem; color: white; }
        
        footer {
            background: var(--darker);
            padding: 3rem 0 1rem;
            border-top: 1px solid var(--border);
        }
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .footer-section h4 { color: white; margin-bottom: 1rem; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 0.5rem; }
        .footer-links a { color: var(--gray); text-decoration: none; transition: color 0.3s ease; }
        .footer-links a:hover { color: var(--primary); }
        .copyright { text-align: center; padding-top: 2rem; border-top: 1px solid var(--border); color: var(--gray); }
        
        @media (max-width: 768px) {
            .header-content { flex-direction: column; gap: 1rem; }
            .nav-links { gap: 1rem; flex-wrap: wrap; justify-content: center; }
            .hero h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo">Ai<span>Tools</span>Pro</a>
                <ul class="nav-links">
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#tools"><i class="fas fa-tools"></i> Tools</a></li>
                    <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>42 Powerful AI Tools for Daily Productivity</h1>
            <p>Access the best collection of free AI tools designed to boost your productivity, creativity, and efficiency. No signup required - just use and go!</p>
        </div>
    </section>

    <section class="categories" id="tools">
        <div class="container">
            <h2 class="section-title">Our AI Tools Collection</h2>
            <div class="category-grid">
                <?php foreach ($grouped_tools as $category => $tools): ?>
                <div class="category-card">
                    <h3>
                        <i class="fas fa-<?php 
                            $icon_map = [
                                'Writing & Text' => 'pen',
                                'AI Detection' => 'eye',
                                'AI Image' => 'image',
                                'AI SEO' => 'chart-line',
                                'Text Utility' => 'font',
                                'AI Code' => 'code',
                                'Social & Creative' => 'hashtag'
                            ];
                            echo $icon_map[$category] ?? 'tools';
                        ?>"></i> 
                        <?php echo htmlspecialchars($category); ?>
                    </h3>
                    <ul class="tools-list">
                        <?php foreach ($tools as $tool): ?>
                        <li>
                            <a href="tools/<?php echo $tool['slug']; ?>.php">
                                <i class="fas fa-arrow-right"></i> <?php echo htmlspecialchars($tool['name']); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose Our Platform</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                    <h3>Lightning Fast</h3>
                    <p>Get results in seconds with our optimized AI processing</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-lock-open"></i></div>
                    <h3>No Signup Required</h3>
                    <p>Use all tools instantly without creating an account</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-coins"></i></div>
                    <h3>Completely Free</h3>
                    <p>All tools are available at no cost, forever</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Secure & Private</h3>
                    <p>Your data is processed securely with no storage</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>AiToolsPro</h4>
                    <p>The ultimate collection of free AI tools for everyday use.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#tools">All Tools</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Categories</h4>
                    <ul class="footer-links">
                        <li><a href="#">Writing Tools</a></li>
                        <li><a href="#">Image Tools</a></li>
                        <li><a href="#">SEO Tools</a></li>
                        <li><a href="#">Code Tools</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 AiToolsPro. All rights reserved. | Free AI Tools Platform</p>
            </div>
        </div>
    </footer>
</body>
</html>
