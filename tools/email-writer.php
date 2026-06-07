<?php
$tool_name = "Email Writer";
$tool_slug = "email-writer";
$tool_description = "Draft professional emails for any situation - business, personal, or formal.";
$system_prompt = "You are a professional email writer. Draft a clear, professional email based on the user's request. Include appropriate greeting, body, and sign-off. Adjust tone based on context. Output only the email.";
$input_label = "Describe what you want to say in the email:";
$button_text = "Write Email";
$placeholder = "Describe the purpose and key points of your email...";
include __DIR__ . '/includes/tool-template.php';
