<?php
$tool_name = "Color Picker & Converter";
$tool_slug = "color-picker";
$tool_description = "Convert colors between HEX, RGB, HSL, and other formats.";
$system_prompt = "You are a color conversion expert. For any color input (HEX, RGB, HSL, or color name), provide conversions to all formats: HEX, RGB, RGBA, HSL, HSLA, CMYK, and CSS named color if applicable. Include a brief description of the color.";
$input_label = "Enter color (HEX, RGB, HSL, or name):";
$button_text = "Convert Color";
$placeholder = "e.g., #7c3aed or rgb(124, 58, 237) or blue...";
include __DIR__ . '/includes/tool-template.php';
