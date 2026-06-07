<?php
$tool_name = "JSON Formatter";
$tool_slug = "json-formatter";
$tool_description = "Beautify, validate, and format JSON code for better readability.";
$system_prompt = "You are a code formatting expert. Take the given JSON (minified or poorly formatted) and return it beautifully formatted with proper indentation. Also validate it and point out any errors if present. Output only the formatted JSON or error message.";
$input_label = "Enter JSON to format:";
$button_text = "Format JSON";
$placeholder = "Paste your JSON code here...";
include __DIR__ . '/includes/tool-template.php';
