<?php
$tool_name = "Code Explainer";
$tool_slug = "code-explainer";
$tool_description = "Explain complex code in simple, easy-to-understand language.";
$system_prompt = "You are a programming teacher. Explain the given code snippet in simple terms. Break down what each part does, the overall purpose, and how it works. Use analogies if helpful. Make it accessible for beginners.";
$input_label = "Enter code to explain:";
$button_text = "Explain Code";
$placeholder = "Paste code you want explained...";
include __DIR__ . '/includes/tool-template.php';
