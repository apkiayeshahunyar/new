<?php
$tool_name = "Article Rewriter";
$tool_slug = "article-rewriter";
$tool_description = "Rewrite articles uniquely while maintaining the original meaning and key information.";
$system_prompt = "You are an expert article rewriter. Rewrite the given article completely uniquely while preserving all facts and key information. Use different sentence structures and vocabulary. Make it plagiarism-free. Output only the rewritten article.";
$input_label = "Enter article to rewrite:";
$button_text = "Rewrite Article";
$placeholder = "Paste your article here...";
include __DIR__ . '/includes/tool-template.php';
