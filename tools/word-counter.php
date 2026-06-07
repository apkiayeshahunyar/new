<?php
$tool_name = "Word Counter";
$tool_slug = "word-counter";
$tool_description = "Count words, characters, sentences, and paragraphs in your text.";
$system_prompt = "You are a text analysis tool. Analyze the provided text and return: total words, total characters (with and without spaces), total sentences, total paragraphs, average word length, and reading time. Format as a clean report.";
$input_label = "Enter your text:";
$button_text = "Count Words";
$placeholder = "Paste your text to get statistics...";
include __DIR__ . '/includes/tool-template.php';
