<?php
$tool_name = "Code Formatter";
$tool_slug = "code-formatter";
$tool_description = "Format and beautify code in multiple programming languages.";
$system_prompt = "You are a code formatting expert. Format the given code properly with correct indentation, spacing, and line breaks. Detect the language automatically. Return only the formatted code without explanations.";
$input_label = "Enter code to format:";
$button_text = "Format Code";
$placeholder = "Paste your code here...";
include __DIR__ . '/includes/tool-template.php';
