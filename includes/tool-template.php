<?php
/**
 * Master Tool Template for AiToolsPro
 * All 42 tools include this file with their specific variables set
 */

// Get API key
$api_key = '';
if (file_exists(__DIR__ . '/../admin/config/api_key.txt')) {
    $api_key = trim(file_get_contents(__DIR__ . '/../admin/config/api_key.txt'));
}

$result = "";
$error = "";
$user_input = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_input = trim($_POST["user_input"] ?? "");

    if (empty($user_input)) {
        $error = "Please enter some content before submitting.";
    } elseif (empty($api_key)) {
        $error = "API key not configured. Please contact the administrator to set up the Gemini API key.";
    } else {
        // Call Google Gemini API
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . urlencode($api_key);
        
        $data = [
            'contents' => [
                'parts' => [
                    ['text' => $system_prompt . "\n\nUser input: " . $user_input]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 2048
            ]
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);
        
        if ($curl_error) {
            $error = "Connection error: " . htmlspecialchars($curl_error);
        } elseif ($http_code !== 200) {
            $error = "API Error: Received HTTP {$http_code}. Please check your API key.";
        } else {
            $response_data = json_decode($response, true);
            if (isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
                $result = $response_data['candidates'][0]['content']['parts'][0]['text'];
            } elseif (isset($response_data['error']['message'])) {
                $error = "API Error: " . htmlspecialchars($response_data['error']['message']);
            } else {
                $error = "Unexpected API response. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tool_name); ?> — Free AI Tool | AiToolsPro</title>
    <meta name="description" content="<?php echo htmlspecialchars($tool_description); ?> - Free online tool. No signup required.">
    <meta name="keywords" content="<?php echo strtolower(str_replace(' ', ', ', $tool_name)); ?>, free ai tool, online tool">
    <meta property="og:title" content="<?php echo htmlspecialchars($tool_name); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($tool_description); ?>">
    <meta property="og:type" content="website">
    <link rel="canonical" href="https://yourdomain.com/tools/<?php echo $tool_slug; ?>.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #7c3aed;
            --primary-dark: #6d28d9;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #334155;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: var(--light);
            line-height: 1.6;
            min-height: 100vh;
        }
        
        .container { max-width: 860px; margin: 0 auto; padding: 0 1rem; }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
        }
        
        .logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        .logo span { color: var(--primary); }
        
        .tool-name-header { color: var(--primary); font-size: 1.1rem; }
        
        .hero { text-align: center; padding: 3rem 0 2rem; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 1rem; color: white; }
        .hero p { color: var(--gray); font-size: 1.1rem; max-width: 600px; margin: 0 auto; }
        
        .adsense-placeholder {
            background: #f1f5f9;
            border: 2px dashed #cbd5e1;
            color: #64748b;
            text-align: center;
            padding: 2rem;
            margin: 2rem 0;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .card {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: white;
            font-weight: 500;
        }
        
        textarea {
            width: 100%;
            padding: 1rem;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            font-family: inherit;
            resize: vertical;
            min-height: 150px;
        }
        
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
        }
        
        .char-count {
            color: var(--gray);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            text-align: right;
        }
        
        .btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }
        
        .btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        
        .btn-secondary {
            background: rgba(100, 116, 139, 0.2);
            margin-left: 0.5rem;
        }
        
        .result-container { display: none; margin-top: 2rem; }
        .result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .result-actions { display: flex; gap: 0.5rem; align-items: center; }
        
        .result-content {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.5rem;
            white-space: pre-wrap;
            word-wrap: break-word;
            line-height: 1.8;
        }
        
        .error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #f87171;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
        }
        
        .step-card {
            text-align: center;
            padding: 1.5rem;
            background: rgba(15, 23, 42, 0.5);
            border-radius: 8px;
        }
        
        .step-number {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            line-height: 40px;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .step-card h3 { color: white; margin-bottom: 0.5rem; }
        .step-card p { color: var(--gray); font-size: 0.9rem; }
        
        .faq { margin: 3rem 0; }
        .faq h2 { color: white; margin-bottom: 1.5rem; }
        .faq-item {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1.5rem;
        }
        
        .faq-question {
            color: white;
            font-weight: 600;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }
        
        .faq-answer { color: var(--gray); }
        
        footer {
            text-align: center;
            padding: 2rem 0;
            color: var(--gray);
            border-top: 1px solid var(--border);
            margin-top: 3rem;
        }
        
        .loading {
            display: none;
            text-align: center;
            padding: 1rem;
            color: var(--gray);
        }
        
        .spinner {
            border: 3px solid rgba(255,255,255,0.3);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 0.5rem;
            vertical-align: middle;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .top-bar { flex-direction: column; gap: 0.5rem; text-align: center; }
            .result-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <a href="../index.php" class="logo">Ai<span>Tools</span>Pro</a>
            <div class="tool-name-header"><?php echo htmlspecialchars($tool_name); ?></div>
        </div>
        
        <section class="hero">
            <h1><?php echo htmlspecialchars($tool_name); ?></h1>
            <p><?php echo htmlspecialchars($tool_description); ?> No signup required - just use and get results instantly!</p>
        </section>
        
        <!-- ADSENSE TOP BANNER -->
        <div class="adsense-placeholder">Advertisement</div>
        
        <section class="card">
            <form method="POST" id="toolForm">
                <div class="form-group">
                    <label for="user_input"><?php echo htmlspecialchars($input_label); ?></label>
                    <textarea id="user_input" name="user_input" placeholder="<?php echo htmlspecialchars($placeholder); ?>"><?php echo htmlspecialchars($user_input); ?></textarea>
                    <div class="char-count">Characters: <span id="charCount">0</span> | Words: <span id="wordCount">0</span></div>
                </div>
                
                <div class="loading" id="loading">
                    <div class="spinner"></div> Processing with AI...
                </div>
                
                <button type="submit" class="btn" id="submitBtn">
                    <i class="fas fa-magic"></i> <?php echo htmlspecialchars($button_text); ?>
                </button>
                <button type="button" class="btn btn-secondary" onclick="clearForm()">
                    <i class="fas fa-eraser"></i> Clear
                </button>
            </form>
            
            <?php if ($error): ?>
                <div class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="result-container" id="resultContainer" style="<?php if($result) echo 'display:block;'; ?>">
                <div class="result-header">
                    <h3><i class="fas fa-check-circle" style="color: #10b981;"></i> Result</h3>
                    <div class="result-actions">
                        <button class="btn btn-secondary" onclick="copyResult()">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                        <span id="copyMessage" style="color: #10b981; font-size: 0.875rem;"></span>
                    </div>
                </div>
                <div class="result-content" id="resultContent"><?php echo nl2br(htmlspecialchars($result)); ?></div>
                <div class="char-count">Output: <span id="resultCharCount"><?php echo strlen($result); ?></span> chars | <span id="resultWordCount"><?php echo str_word_count($result); ?></span> words</div>
            </div>
        </section>
        
        <!-- ADSENSE MID CONTENT -->
        <div class="adsense-placeholder">Advertisement</div>
        
        <section class="steps">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Enter Content</h3>
                <p><?php echo htmlspecialchars($placeholder); ?></p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>AI Processes</h3>
                <p>Our AI analyzes and processes your request</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Get Result</h3>
                <p>Receive your result instantly</p>
            </div>
        </section>
        
        <section class="faq">
            <h2>Frequently Asked Questions</h2>
            
            <div class="faq-item">
                <div class="faq-question">Is this tool really free?</div>
                <div class="faq-answer">Yes! This tool is completely free to use with no hidden costs or signup requirements.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">Do I need to create an account?</div>
                <div class="faq-answer">No account needed. Just visit the page and start using the tool immediately.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">Is my data stored?</div>
                <div class="faq-answer">No, we don't store any of your input or results. Everything is processed in real-time and discarded immediately.</div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">How accurate are the results?</div>
                <div class="faq-answer">Our AI uses advanced models to provide high-quality results. However, always review the output for your specific needs.</div>
            </div>
        </section>
        
        <footer>
            <p>&copy; 2025 AiToolsPro. All rights reserved. | Free AI Tools Platform</p>
        </footer>
    </div>

    <script>
        const textarea = document.getElementById('user_input');
        const charCount = document.getElementById('charCount');
        const wordCount = document.getElementById('wordCount');
        
        function updateCounts() {
            const text = textarea.value;
            charCount.textContent = text.length;
            wordCount.textContent = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
        }
        
        textarea.addEventListener('input', updateCounts);
        updateCounts();
        
        document.getElementById('toolForm').addEventListener('submit', function() {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('submitBtn').disabled = true;
        });
        
        function copyResult() {
            const resultDiv = document.getElementById('resultContent');
            const range = document.createRange();
            range.selectNode(resultDiv);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            
            const copyMessage = document.getElementById('copyMessage');
            copyMessage.textContent = 'Copied!';
            
            setTimeout(() => { copyMessage.textContent = ''; }, 2000);
        }
        
        function clearForm() {
            textarea.value = '';
            document.getElementById('resultContainer').style.display = 'none';
            updateCounts();
        }
        
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 400) + 'px';
        });
        
        if (<?php echo $result ? 'true' : 'false'; ?>) {
            document.getElementById('resultContainer').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>
