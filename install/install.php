<?php
/**
 * AiToolsPro Automatic Installer
 * Visit: yourdomain.com/install/install.php
 */
session_start();
$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_host = $_POST['db_host'] ?? 'localhost';
    $db_name = $_POST['db_name'] ?? 'aitoolspro';
    $db_user = $_POST['db_user'] ?? 'root';
    $db_pass = $_POST['db_pass'] ?? '';
    
    try {
        // Connect without DB first
        $pdo = new PDO("mysql:host=$db_host", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create Database
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$db_name`");
        
        // Create Tables
        $sql = "
        CREATE TABLE IF NOT EXISTS settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            setting_key VARCHAR(50) UNIQUE,
            setting_value TEXT
        );
        
        CREATE TABLE IF NOT EXISTS tools (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100),
            slug VARCHAR(100) UNIQUE,
            description TEXT,
            category VARCHAR(50),
            status TINYINT DEFAULT 1
        );
        
        CREATE TABLE IF NOT EXISTS api_logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            tool_name VARCHAR(100),
            tokens_used INT,
            status VARCHAR(20),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        ";
        $pdo->exec($sql);
        
        // Insert Settings
        $pdo->exec("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES ('site_name', 'AiToolsPro'), ('registration_enabled', '0')");
        
        // Insert All 42 Tools
        $tools = [
            ['AI Paraphraser', 'ai-paraphraser', 'Rewrite text keeping meaning', 'Writing & Text'],
            ['AI Humanizer', 'ai-humanizer', 'Make AI text sound human', 'Writing & Text'],
            ['Grammar Checker', 'grammar-checker', 'Fix grammar errors', 'Writing & Text'],
            ['AI Summarizer', 'ai-summarizer', 'Summarize long texts', 'Writing & Text'],
            ['Article Rewriter', 'article-rewriter', 'Rewrite articles uniquely', 'Writing & Text'],
            ['Essay Writer', 'essay-writer', 'Generate structured essays', 'Writing & Text'],
            ['Conclusion Generator', 'conclusion-generator', 'Write strong conclusions', 'Writing & Text'],
            ['Paragraph Writer', 'paragraph-writer', 'Expand ideas into paragraphs', 'Writing & Text'],
            ['Story Generator', 'story-generator', 'Create creative stories', 'Writing & Text'],
            ['Email Writer', 'email-writer', 'Draft professional emails', 'Writing & Text'],
            ['AI Content Detector', 'ai-content-detector', 'Detect AI written content', 'AI Detection'],
            ['ChatGPT Detector', 'chatgpt-detector', 'Identify ChatGPT text', 'AI Detection'],
            ['Plagiarism Checker', 'plagiarism-checker', 'Check for duplicate content', 'AI Detection'],
            ['Originality Checker', 'originality-checker', 'Verify content uniqueness', 'AI Detection'],
            ['Background Remover', 'background-remover', 'Remove image backgrounds', 'AI Image'],
            ['Image Upscaler', 'image-upscaler', 'Enhance image resolution', 'AI Image'],
            ['Image Compressor', 'image-compressor', 'Reduce image file size', 'AI Image'],
            ['Text to Image', 'text-to-image', 'Generate images from text', 'AI Image'],
            ['Photo to Cartoon', 'photo-to-cartoon', 'Turn photos into cartoons', 'AI Image'],
            ['Image to Text OCR', 'image-to-text-ocr', 'Extract text from images', 'AI Image'],
            ['Meta Tag Generator', 'meta-tag-generator', 'Create SEO meta tags', 'AI SEO'],
            ['AI Title Generator', 'ai-title-generator', 'Write catchy titles', 'AI SEO'],
            ['Keyword Density', 'keyword-density', 'Analyze keyword usage', 'AI SEO'],
            ['Blog Intro Generator', 'blog-intro-generator', 'Write engaging intros', 'AI SEO'],
            ['FAQ Generator', 'faq-generator', 'Generate FAQs for content', 'AI SEO'],
            ['Product Description', 'product-description', 'Write sales descriptions', 'AI SEO'],
            ['Word Counter', 'word-counter', 'Count words and characters', 'Text Utility'],
            ['Case Converter', 'case-converter', 'Change text case', 'Text Utility'],
            ['Text Translator', 'text-translator', 'Translate between languages', 'Text Utility'],
            ['Text to Speech', 'text-to-speech', 'Convert text to audio', 'Text Utility'],
            ['Speech to Text', 'speech-to-text', 'Transcribe audio to text', 'Text Utility'],
            ['Fancy Text Generator', 'fancy-text-generator', 'Create stylish fonts', 'Text Utility'],
            ['PDF to Text', 'pdf-to-text', 'Extract text from PDFs', 'Text Utility'],
            ['JSON Formatter', 'json-formatter', 'Beautify JSON code', 'AI Code'],
            ['Code Formatter', 'code-formatter', 'Format programming code', 'AI Code'],
            ['Code Explainer', 'code-explainer', 'Explain code logic', 'AI Code'],
            ['HTML to Text', 'html-to-text', 'Strip HTML tags', 'AI Code'],
            ['Color Picker', 'color-picker', 'Convert color codes', 'AI Code'],
            ['Hashtag Generator', 'hashtag-generator', 'Generate social hashtags', 'Social & Creative'],
            ['Bio Generator', 'bio-generator', 'Write social media bios', 'Social & Creative'],
            ['Caption Generator', 'caption-generator', 'Write post captions', 'Social & Creative'],
            ['YouTube Title Gen', 'youtube-title-gen', 'Create viral video titles', 'Social & Creative'],
        ];
        
        $stmt = $pdo->prepare("INSERT IGNORE INTO tools (name, slug, description, category) VALUES (?, ?, ?, ?)");
        foreach ($tools as $t) {
            $stmt->execute($t);
        }
        
        $_SESSION['installed'] = true;
        header('Location: ?step=4');
        exit;
        
    } catch (PDOException $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AiToolsPro Installer</title>
    <style>
        body { font-family: sans-serif; background: #0f172a; color: white; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: #1e293b; padding: 2rem; border-radius: 12px; width: 100%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
        h1 { color: #7c3aed; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #334155; border: 1px solid #475569; color: white; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #7c3aed; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 1rem; }
        button:hover { background: #6d28d9; }
        .step { text-align: center; margin-bottom: 1rem; color: #94a3b8; }
        .error { color: #ef4444; background: rgba(239,68,68,0.1); padding: 10px; border-radius: 6px; margin-bottom: 1rem; }
        .success { color: #10b981; text-align: center; }
        a { color: #7c3aed; }
    </style>
</head>
<body>
    <div class="card">
        <?php if ($step == 1): ?>
            <h1>Installation</h1>
            <p class="step">Step 1 of 1</p>
            <?php if ($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
            <form method="POST">
                <label>Database Host</label>
                <input type="text" name="db_host" value="localhost" required>
                <label>Database Name</label>
                <input type="text" name="db_name" value="aitoolspro" required>
                <label>Database User</label>
                <input type="text" name="db_user" value="root" required>
                <label>Database Password</label>
                <input type="password" name="db_pass" placeholder="Leave empty if no password">
                <button type="submit">Install Now</button>
            </form>
        <?php elseif ($step == 4): ?>
            <h1>Success!</h1>
            <div class="success">
                <p>AiToolsPro has been installed successfully.</p>
                <p>All 42 tools are ready.</p>
                <br>
                <a href="../admin/index.php">Go to Admin Panel</a> | 
                <a href="../index.php">Go to Homepage</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
