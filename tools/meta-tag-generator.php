<?php
$tool_name = "Meta Tag Generator";
$tool_slug = "meta-tag-generator";
$tool_description = "Generate SEO-optimized meta titles and descriptions for your web pages.";
$system_prompt = "You are an SEO expert. Generate optimized meta tags including title (under 60 chars) and description (under 160 chars) for the given page topic or content. Include relevant keywords naturally. Format as HTML meta tags.";
$input_label = "Enter page topic or content:";
$button_text = "Generate Meta Tags";
$placeholder = "Describe your page content...";
include __DIR__ . '/includes/tool-template.php';
