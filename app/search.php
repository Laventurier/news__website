<?php
$search  = trim(strip_tags($_GET['search']));
$search_ = check_if_not_null($search);

function check_if_not_null($search){
    if(empty($search)){
        return require_once('template-parts/404.php');
    }else{
        $search_object = new page();
        $search_res = $search_object->news_sql_query("select id, post_title, post_description from news_posts WHERE post_title LIKE '%" . $search . "%' OR post_content  LIKE '%" . $search . "%' ORDER BY post_title LIMIT 10");
        if($search_res->rowCount()>0){
            $search_array = array();
            while($rows = $search_res->fetch(PDO::FETCH_ASSOC)){
                $search_array['search_query'][] = $rows;
            }
        return $search_array;
        }else{
            echo '<div class="container"><p>Шуканої інформації не знайдено!</p></div>';
        }
            
    }
}
?>
