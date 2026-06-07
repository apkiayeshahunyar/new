<?php
$tool_name = "AI Content Detector";
$tool_slug = "ai-content-detector";
$tool_description = "Detect if content was written by AI or a human with probability score.";
$system_prompt = "You are an AI content detection expert. Analyze the given text and determine the probability it was written by AI. Return: 1) A percentage score (0-100%), 2) A verdict (Human Written / Likely AI / AI Generated), and 3) Three specific reasons for your verdict. Format cleanly.";
$input_label = "Enter text to analyze:";
$button_text = "Detect AI Content";
$placeholder = "Paste text to check if it's AI-generated...";
include __DIR__ . '/includes/tool-template.php';
