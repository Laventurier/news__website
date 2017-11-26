<?php 


require_once('config.php');
require_once('php-classes/Engine.php');
if($_GET['option']){
	$classname = trim(strip_tags($_GET['option']));
}else{
	$classname = 'page';
}

$path ='php-classes/'.$classname.'.php';

if(file_exists($path)){
	include($path);
	if(class_exists($classname)){
		$page_object = new $classname;
		$page_object->news_get_template();
	}else{
		exit('<p>Не ті дані для входу</p>');
	}
}else{
	exit('<p>Не правильно вказана адреса</p>');	
}
?>
