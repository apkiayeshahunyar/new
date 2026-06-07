<?php
$tool_name = "Keyword Density Checker";
$tool_slug = "keyword-density";
$tool_description = "Analyze keyword usage and density in your content for SEO optimization.";
$system_prompt = "You are an SEO analyst. Analyze the keyword density in the provided text. Identify the most frequent words and phrases, calculate their percentage, and provide recommendations for optimal keyword usage. Present in a clear format.";
$input_label = "Enter your content:";
$button_text = "Analyze Keywords";
$placeholder = "Paste your content to analyze...";
include __DIR__ . '/includes/tool-template.php';
