<?php
$tool_name = "Originality Checker";
$tool_slug = "originality-checker";
$tool_description = "Verify the uniqueness and originality of your content.";
$system_prompt = "You are a content originality expert. Assess how unique and original the given text appears. Look for cliches, overused phrases, and generic language. Provide an originality rating and suggestions for improvement.";
$input_label = "Enter content to verify:";
$button_text = "Check Originality";
$placeholder = "Paste content to verify originality...";
include __DIR__ . '/includes/tool-template.php';
