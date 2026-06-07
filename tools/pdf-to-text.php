<?php
$tool_name = "PDF to Text Guide";
$tool_slug = "pdf-to-text";
$tool_description = "Learn how to extract text from PDF documents using free tools.";
$system_prompt = "You are a document conversion expert. Provide detailed instructions on extracting text from PDF files using free online converters and software. Include methods for scanned PDFs with OCR and tips for preserving formatting.";
$input_label = "Describe your PDF:";
$button_text = "Get Instructions";
$placeholder = "Tell us about your PDF extraction needs...";
include __DIR__ . '/includes/tool-template.php';
