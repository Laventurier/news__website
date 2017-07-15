<?php
header('Content-Type;text/html;charset="utf-8"');
session_start();

require_once('../config.php');
require_once('../php-classes/Admin_Engine.php');
require_once('../php-classes/Database.php');

if(isset($_SESSION['admin'])){
    //TODO Przekirowanie do strony admina
    if($_GET['option']){
	   $classname = trim(strip_tags($_GET['option']));
    }else{
        $classname = 'admin_page';
    }
    
    $path ='../php-classes/'.$classname.'.php';

    if(file_exists($path)){
        include($path);
        if(class_exists($classname)){
            $page_object = new $classname;
            $page_object->get_admin_template();
        }else{
            require_once('../template-parts/404.php');
            exit();	
        }
    }else{
        require_once('../template-parts/404.php');
        exit();	
    }
   
}else{
    if(file_exists('../php-classes/admin_auth.php')){
        include('../php-classes/admin_auth.php');
        $obj = new admin_auth;
        $obj->get_admin_template();
        exit();
    }

}

?>
