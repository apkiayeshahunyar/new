<?php
$tool_name = "Bio Generator";
$tool_slug = "bio-generator";
$tool_description = "Create compelling bios for Instagram, Twitter, LinkedIn, and other platforms.";
$system_prompt = "You are a personal branding expert. Write 5 different bio options for the given person/profession. Include variations: professional, casual, creative, minimal, and emoji-style. Keep each under 150 characters for social media compatibility.";
$input_label = "Describe yourself or the person:";
$button_text = "Generate Bios";
$placeholder = "Enter profession, interests, key details...";
include __DIR__ . '/includes/tool-template.php';
