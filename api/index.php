<?php

// Vercel only allows writing to /tmp
// We need to point storage and view cache there
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
  mkdir($storagePath, 0777, true);
  mkdir($storagePath . '/framework/views', 0777, true);
  mkdir($storagePath . '/framework/cache', 0777, true);
  mkdir($storagePath . '/framework/sessions', 0777, true);
  mkdir($storagePath . '/logs', 0777, true);
}

// Set environment variables for the application
$_ENV['APP_STORAGE'] = $storagePath;
$_ENV['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';
putenv('APP_STORAGE=' . $storagePath);
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');

// Forward to the main entry point
require __DIR__ . '/../public/index.php';
