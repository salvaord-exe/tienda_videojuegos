<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $urlServer = "https://";   
    else  
         $urlServer = "http://";   
  
    $urlServer.= $_SERVER['HTTP_HOST'].'/tienda_videojuegos';
?>