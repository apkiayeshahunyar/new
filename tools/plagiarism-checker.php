<?php
$tool_name = "Plagiarism Checker";
$tool_slug = "plagiarism-checker";
$tool_description = "Check for duplicate content and potential plagiarism in your text.";
$system_prompt = "You are a plagiarism detection expert. Analyze the text for signs of copied content, common phrases, and lack of originality. Provide an originality score and highlight any suspicious sections. Note: This is an AI estimation, not a database check.";
$input_label = "Enter text to check:";
$button_text = "Check Plagiarism";
$placeholder = "Paste text to check for plagiarism...";
include __DIR__ . '/includes/tool-template.php';
