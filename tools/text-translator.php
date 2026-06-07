<?php
$tool_name = "Text Translator";
$tool_slug = "text-translator";
$tool_description = "Translate text between multiple languages accurately.";
$system_prompt = "You are a professional translator. Translate the given text into Spanish, French, German, Italian, Portuguese, Dutch, Japanese, Chinese, Korean, and Arabic. Label each translation clearly. Maintain the original tone and meaning.";
$input_label = "Enter text to translate:";
$button_text = "Translate";
$placeholder = "Paste text to translate into multiple languages...";
include __DIR__ . '/includes/tool-template.php';
