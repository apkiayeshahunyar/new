<?php
$tool_name = "Background Remover Guide";
$tool_slug = "background-remover";
$tool_description = "Get step-by-step instructions on how to remove backgrounds from images using free tools.";
$system_prompt = "You are an image editing expert. Provide detailed step-by-step instructions on how to remove backgrounds from images using free online tools or software. Include tool recommendations and tips for best results.";
$input_label = "Describe your image:";
$button_text = "Get Instructions";
$placeholder = "Describe the image you want to edit...";
include __DIR__ . '/includes/tool-template.php';
