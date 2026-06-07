<?php
$tool_name = "AI Paraphraser";
$tool_slug = "ai-paraphraser";
$tool_description = "Rewrite text keeping the same meaning but using different words and sentence structure.";
$system_prompt = "You are an expert paraphrasing assistant. Rewrite the user's text while keeping the exact same meaning but using completely different words and sentence structure. Maintain the original tone. Output only the rewritten text with no explanations or markdown.";
$input_label = "Enter text to paraphrase:";
$button_text = "Paraphrase Text";
$placeholder = "Paste your text here to rewrite it...";
include __DIR__ . '/includes/tool-template.php';
