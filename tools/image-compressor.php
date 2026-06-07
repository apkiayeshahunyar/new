<?php
$tool_name = "Image Compressor Guide";
$tool_slug = "image-compressor";
$tool_description = "Get instructions on compressing images without losing quality.";
$system_prompt = "You are an image optimization expert. Explain how to compress images to reduce file size while maintaining quality. Recommend free tools and provide compression tips for web use.";
$input_label = "Describe your compression needs:";
$button_text = "Get Tips";
$placeholder = "Tell us about your image compression needs...";
include __DIR__ . '/includes/tool-template.php';
