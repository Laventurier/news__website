<?php
class category extends Engine{
    
    public function news_get_content(){
        if(isset($_GET['option']) && isset($_GET['id']) && $_GET['id'] != null && is_numeric($_GET['id'])){
            $sql = "SELECT * FROM news_posts where post_category=".$_GET['id'];
            $result = $this->news_sql_query($sql);
            if($result){
               if($result->rowCount()>0){
                   $tmp_arr = array();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $tmp_arr[$row['id']] = $row;
                }
                   $current_page = 1;
                   include_once('category-template.php');
               }else{
                include_once('template-parts/404.php');
            }
          }
            
        }else{
            include_once('template-parts/404.php');
        }
    }
}
?>
