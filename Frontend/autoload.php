<?php
spl_autoload_register(function ($class) {
  $folders=[];
  $prefixes=[];
  $root = dirname(__DIR__).'/'.basename(__DIR__);
  $length = strlen($root);
  $paths = glob("$root/*",GLOB_ONLYDIR);

  foreach($paths as $path)
  {
    array_push($folders, substr($path, $length).'/');
    array_push($prefixes,'app'.substr($path,$length).'/');
  }

  foreach($prefixes as $prefix)
  {
    $length = strlen($prefix);
    $relative_class = substr($class, $length);

    foreach($folders as $folder)
    {      
      $file = __DIR__.$folder.$relative_class.'.php';

      if(file_exists($file)){
        require_once $file;
      }
    }
  }
});
?>