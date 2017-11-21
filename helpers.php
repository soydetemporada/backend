<?php

/**
* Helper function to load a template 
*/
function get_template($template){
  $path = __DIR__."/templates/{$template}.html";
  if(file_exists($path)){
    return file_get_contents($path);
  }
  return '';
}
