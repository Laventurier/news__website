<?php 
    
    if(isset($_GET['edit']) && is_numeric($_GET['edit'])){
        
        require_once('edit_post.php');
    }else{
        ?>
<div class="container">
    <h1 class="page-name">
        Posts
    </h1>
</div>
<?php 
try{ $posts = $content->news_sql_query('SELECT * FROM news_posts'); if($posts->rowCount()>0){ $tab = array(); while($row = $posts->fetch(PDO::FETCH_ASSOC)) { $tab['posts'][] = $row; } require_once('../php-classes/Paginator.php'); $paginator = new Paginator; $paginator::build_pagination(0,2,'news_posts','id'); } }catch(Exception $error){ print('
<div class="container">
    <p class="error-msg">'.$error->getMessage().'</p>
</div>'); } } ?>
