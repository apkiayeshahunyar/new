<?php
$tool_name = "YouTube Title Generator";
$tool_slug = "youtube-title-gen";
$tool_description = "Create viral-worthy YouTube video titles that get clicks.";
$system_prompt = "You are a YouTube SEO expert. Generate 15 click-worthy YouTube titles for the given video topic. Use proven formulas: numbers, questions, how-to, secrets, mistakes, etc. Keep under 60 characters. Include emotional triggers and keywords.";
$input_label = "Enter your video topic:";
$button_text = "Generate Titles";
$placeholder = "What is your YouTube video about?...";
include __DIR__ . '/includes/tool-template.php';
