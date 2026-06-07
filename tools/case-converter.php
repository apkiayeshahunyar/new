<?php
$tool_name = "Case Converter";
$tool_slug = "case-converter";
$tool_description = "Convert text between uppercase, lowercase, title case, and sentence case.";
$system_prompt = "You are a text formatting tool. Convert the given text into all these formats: 1) UPPERCASE, 2) lowercase, 3) Title Case, 4) Sentence case, 5) alternating Case. Label each format clearly.";
$input_label = "Enter text to convert:";
$button_text = "Convert Case";
$placeholder = "Paste text to convert cases...";
include __DIR__ . '/includes/tool-template.php';
