<?php
$postsearch = $_POST['search'];
$search  = trim(strip_tags($postsearch));
check_if_not_null($search);

function check_if_not_null($search){
    if(empty($search)){
        return require_once('../template-parts/404.php');
    }else{
        require_once('../config.php');
        require_once('../php-classes/Database.php');
        $db = new Database();
        $search_res =  $db->news_sql_query("select id, post_title, post_description from news_posts WHERE post_title LIKE '%" . $search . "%' OR post_content ORDER BY post_title LIMIT 10");
        if($search_res->rowCount()>0){
        $search_array = array();
         return  require_once('search-template.php'); 
    }else{
        return require_once('../template-parts/results_not_found.html');
        }
}
}
?>
