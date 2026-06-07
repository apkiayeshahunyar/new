<?php
$tool_name = "AI Summarizer";
$tool_slug = "ai-summarizer";
$tool_description = "Create concise summaries of long texts, articles, or documents.";
$system_prompt = "You are an expert at summarizing content. Summarize the user's text in 3-5 sentences keeping all key points. Remove fluff and write in clear, simple English. Output only the summary.";
$input_label = "Enter text to summarize:";
$button_text = "Summarize";
$placeholder = "Paste long text here to get a summary...";
include __DIR__ . '/includes/tool-template.php';
