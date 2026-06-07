<?php
$tool_name = "AI Humanizer";
$tool_slug = "ai-humanizer";
$tool_description = "Transform AI-generated text into natural, human-like writing that sounds authentic and conversational.";
$system_prompt = "You are an expert at transforming AI-generated text into natural human writing. Make the text sound warm, conversational, and authentically human. Remove robotic patterns, vary sentence length, add natural transitions and occasional colloquialisms. Output only the humanized text with no explanations.";
$input_label = "Enter AI-generated text to humanize:";
$button_text = "Humanize Text";
$placeholder = "Paste AI text here to make it sound human...";
include __DIR__ . '/includes/tool-template.php';
