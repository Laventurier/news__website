<?php 
class page_view extends Engine{

    	public function news_get_content(){
        if(isset($_POST['submit_comm'])){  

            $valid = true;

            if(empty($_POST['author'])){
                $_SESSION['author_error'] = 'Введіть будь ласка своє ім\'я*';
                $valid  = false;
            }else{
                if(strlen($this->html_tag_check($_POST['author'])) < 4){
                    $_SESSION['author_error'] = 'Ім\'я повинно містити щонайменш 4 символи*';
                    $valid  = false;
                }
            }

            if(empty($_POST['email'])){
                $_SESSION['email_error'] = 'Вкажіть будь ласка свою пошту*';
                $valid  = false; 
            }else{
                if(!filter_var($this->html_tag_check($_POST['email']), FILTER_VALIDATE_EMAIL)){
                    $_SESSION['email_error'] = 'Перевірте правильність пошти*';
                    $valid  = false;
                }
            }


            if(empty($_POST['comment'])){
                $_SESSION['commentary_error'] = 'Не залишайте поле для відповіді пустим*';
                $valid = false;
            }else{
                if (strlen($this->html_tag_check($_POST['comment'])) < 30) {
                    $_SESSION['commentary_error']  = 'Введіть щонайменш 30 символів*';
                    $valid  = false;
                }
            }

            if($valid == true){
                $sql = 'INSERT INTO news_commentary (comm_text,comm_email,comm_author,post_id, time_ ) VALUES ("'.$this->html_tag_check($_POST['comment']).'","'.$this->html_tag_check($_POST['email']).'","'.$this->html_tag_check($_POST['author']).'",'.(int)$_GET['post'].', now() )';
                $this->news_sql_execution($sql);
                $_SESSION['sent'] = 1;
            }
            echo '<br>'.$valid;
        }
        if($_SESSION['sent'] == 1){
            unset($_POST);
        }

        if(!$_GET['post']){
            exit('Не правильний id новини!');
        }else{
            $post = (int)$_GET['post'];
        }
        $result = $this->news_sql_query("SELECT id, post_title, post_content, post_date, post_image, post_author,
        post_category FROM news_posts WHERE id=".$post);
        if($result->rowCount()>0){
            $post_content = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $post_content = $row;
            }
            
            $sql = 'SELECT * FROM news_commentary where post_id='.$post;
            $comments_res = $this->news_sql_query($sql);
            
            if($comments_res->rowCount()>0){
                $post_comments = array();
                while($row = $comments_res->fetch(PDO::FETCH_ASSOC)){
                    $post_comments[] = $row;
                }
            }            
            require_once('view_all.php');
        }else{
            exit('<p>Немає інформації про цю новину!</p>');
        }      
	}
    
    public function html_tag_check($text){
        return strip_tags(trim(html_entity_decode($text)));
    }
    
}
