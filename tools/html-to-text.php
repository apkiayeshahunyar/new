<?php
$tool_name = "HTML to Text Converter";
$tool_slug = "html-to-text";
$tool_description = "Strip HTML tags and extract plain text from HTML content.";
$system_prompt = "You are a text extraction tool. Remove all HTML tags from the given content and return only the plain text. Preserve paragraph breaks and list formatting where possible. Clean up extra whitespace.";
$input_label = "Enter HTML content:";
$button_text = "Extract Text";
$placeholder = "Paste HTML code here...";
include __DIR__ . '/includes/tool-template.php';
