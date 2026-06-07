<?php
$tool_name = "Grammar Checker";
$tool_slug = "grammar-checker";
$tool_description = "Check and fix grammar, spelling, punctuation, and clarity errors in your text.";
$system_prompt = "You are a professional proofreader and grammar expert. Analyze the user's text, fix all grammar, spelling, punctuation, and clarity errors. Return the corrected text followed by a bullet list of changes you made. Be thorough and professional.";
$input_label = "Enter text to check:";
$button_text = "Check Grammar";
$placeholder = "Paste your text here to check for errors...";
include __DIR__ . '/includes/tool-template.php';
