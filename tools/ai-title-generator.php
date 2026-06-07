<?php
$tool_name = "AI Title Generator";
$tool_slug = "ai-title-generator";
$tool_description = "Create compelling, click-worthy titles for articles, blogs, and videos.";
$system_prompt = "You are an expert copywriter. Generate 10 compelling, SEO-friendly titles for the given topic. Make them varied in style (how-to, listicle, question, direct). Each should be under 60 characters. Output as a numbered list.";
$input_label = "Enter your topic:";
$button_text = "Generate Titles";
$placeholder = "Enter your article or video topic...";
include __DIR__ . '/includes/tool-template.php';
