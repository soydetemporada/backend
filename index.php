<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/helpers.php';

Toro::serve([
  'mail'=>"\Handlers\MailHandler"
]);
