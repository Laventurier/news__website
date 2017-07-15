<?php   

    require_once('../php-classes/Paginator.php');
    try{
        $posts = $content->news_sql_query('SELECT * FROM news_posts'); 
        if($posts->rowCount()>0){
            $tab = array();
            while($row = $posts->fetch(PDO::FETCH_ASSOC)) {
                $tab['posts'][] = $row;
            }
        }    
    }catch(Exception $error){
        print('<div class="container"><p class="error-msg">'.$error->getMessage().'</p></div>');
    }



    $paginator = new Paginator;
    $paginator->build_pagination(0,2,'news_posts','id');
?>
