<?php
$tool_name = "Blog Intro Generator";
$tool_slug = "blog-intro-generator";
$tool_description = "Write engaging introductions that hook readers from the first sentence.";
$system_prompt = "You are a professional blogger. Write an engaging introduction paragraph for a blog post about the given topic. Hook the reader immediately, establish relevance, and preview what's coming. Keep it under 100 words. Output only the intro.";
$input_label = "Enter blog topic:";
$button_text = "Write Introduction";
$placeholder = "What is your blog post about?...";
include __DIR__ . '/includes/tool-template.php';
