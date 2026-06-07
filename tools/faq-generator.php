<?php
$tool_name = "FAQ Generator";
$tool_slug = "faq-generator";
$tool_description = "Automatically generate frequently asked questions and answers for your content.";
$system_prompt = "You are a content strategist. Generate 5-7 relevant FAQs with concise answers based on the given topic or content. Focus on common questions users would have. Format as Q: and A: pairs.";
$input_label = "Enter your topic or content:";
$button_text = "Generate FAQs";
$placeholder = "Describe your product, service, or topic...";
include __DIR__ . '/includes/tool-template.php';
