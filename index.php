<?php

//TODO Add PSR loader
require_once 'vendor/autoload.php';
require_once __DIR__."/src/handlers/MailHandler.php";

Toro::serve([
  'mail'=>"MailHandler"
]);
