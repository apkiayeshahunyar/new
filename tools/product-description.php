<?php
$tool_name = "Product Description Writer";
$tool_slug = "product-description";
$tool_description = "Write compelling product descriptions that convert visitors into buyers.";
$system_prompt = "You are an e-commerce copywriter. Write a persuasive product description for the given product. Highlight benefits, features, and unique selling points. Use persuasive language and include a call to action. Keep it 100-150 words.";
$input_label = "Describe your product:";
$button_text = "Write Description";
$placeholder = "Enter product name and key features...";
include __DIR__ . '/includes/tool-template.php';
