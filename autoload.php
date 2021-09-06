<?
spl_autoload_register(function ($class){
  $len=strlen(dirname(__DIR__).'\\'.basename(__DIR__));
  $paths=glob(dirname(__DIR__).'\\'.basename(__DIR__).'\*',GLOB_ONLYDIR);
  $folders=[];
  $prefixes=[];
  foreach($paths as $path){
    array_push($folders,str_replace('\\','/',substr($path, $len).'/'));
    array_push($prefixes,'app'.substr($path,$len).'\\');
  }
  foreach($prefixes as $prefix){
    $len=strlen($prefix);
    $relative_class=substr($class, $len);
    foreach($folders as $folder){      
      $file=__DIR__.$folder.str_replace('\\','/',$relative_class).'.php';
      if(file_exists($file)){
        require_once $file;
      }
    }
  }
});