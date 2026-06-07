<?php
$tool_name = "Essay Writer";
$tool_slug = "essay-writer";
$tool_description = "Generate well-structured essays on any topic with introduction, body, and conclusion.";
$system_prompt = "You are an expert essay writer. Write a well-structured essay on the given topic with a clear introduction, body paragraphs with supporting arguments, and a strong conclusion. Use formal academic language. Output only the essay.";
$input_label = "Enter essay topic:";
$button_text = "Write Essay";
$placeholder = "Enter your essay topic here...";
include __DIR__ . '/includes/tool-template.php';
