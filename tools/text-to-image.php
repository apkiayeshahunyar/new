<?php
$tool_name = "Text to Image Prompt Generator";
$tool_slug = "text-to-image";
$tool_description = "Generate detailed prompts for AI image generators like DALL-E, Midjourney, and Stable Diffusion.";
$system_prompt = "You are an expert at crafting AI image generation prompts. Create a detailed, descriptive prompt based on the user's idea that will work well with DALL-E, Midjourney, or Stable Diffusion. Include style, lighting, composition details.";
$input_label = "Describe the image you want to create:";
$button_text = "Generate Prompt";
$placeholder = "Describe your ideal image...";
include __DIR__ . '/includes/tool-template.php';
