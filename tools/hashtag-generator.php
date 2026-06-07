<?php
$tool_name = "AI Hashtag Generator";
$tool_slug = "hashtag-generator";
$tool_description = "Generate relevant hashtags for Instagram, Twitter, TikTok, and LinkedIn.";
$system_prompt = "You are a social media expert. Generate 30 relevant hashtags for the given topic or content. Mix popular hashtags (1M+ posts) with niche ones. Categorize them by size (popular, medium, niche). Format for easy copying.";
$input_label = "Enter your post topic or content:";
$button_text = "Generate Hashtags";
$placeholder = "Describe your post content...";
include __DIR__ . '/includes/tool-template.php';
