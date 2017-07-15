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

        }
        

        if(!$_GET['post']){
            exit('Не правильний id новини!');
        }else{
            $post = (int)$_GET['post'];
        }
        $result = $this->news_sql_query("SELECT id, post_title, post_content, post_date, post_image, post_author,
        post_category FROM news_posts WHERE id=".$post);
        echo '<div id="page-view">
        ';
        if($result->rowCount()>0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                printf('
                
                <div class="parallax-window" data-parallax="scroll" data-image-src="%s"></div>
                <script>$(".parallax-window").parallax({imageSrc: "%s"})</script>
                <div class="container">
                <div id="post-%s">
                <h1 class="category-title-%s">
                %s
                <small>%s</small>
                </h1>

                <div class="post-content">
                %s
                <p class="post-info">
                <span class="post-date">%s</span>
                <span class="post-author">Автор: <b>%s</b></span>
                </p>
                </div>
                </div>',$row['post_image'],$row['post_image'],$row['id'],$row['id'],$row['post_title'],$row['post_date'],$row['post_content'],$row['post_date'],$row['post_author']);

            echo '
                <div class="clearfix commentary-form commentary-'.$row['id'].'">
                <h2>Коментувати:</h2>
                <div class="form">
                <form action="" method="POST"><p>';
                if(isset($_SESSION['author_error'])){
                    echo '<span>'.$_SESSION['author_error'].'</span>';
                    unset($_SESSION['author_error']);
                }
                  
            echo  '<input name="author" type="text"></p><p>';

                if(isset($_SESSION['email_error'])){
                    echo '<span>'.$_SESSION['email_error'].'</span>';
                    unset($_SESSION['email_error']);
                }

            echo  '<input name="email" type="text"></p><p>';

                if(isset($_SESSION['commentary_error'])){
                    echo '<span>'.$_SESSION['commentary_error'].'</span>';
                    unset($_SESSION['commentary_error']);

                }

            echo '<textarea name="comment"></textarea></p><input name="submit_comm" type="submit" value="Прокоментувати"></form></div>';

            }
            echo '<div class="comments">';
            $sql = 'SELECT * FROM news_commentary where post_id='.$post;
            $comments_res = $this->news_sql_query($sql);
            
            if($comments_res->rowCount()>0){
                while($row = $comments_res->fetch(PDO::FETCH_ASSOC)){
                    printf('<div class="user_comm"><div><img src="img/user.svg" alt="user"><span>%s</span><span>%s</span></div><p>%s</p></div>',$row['comm_author'],$row['time_'] ,$row['comm_text']);
                }
            }
            echo '</div></div>';    
        }else{
            exit('<p>Немає інформації про цю новину!</p>');
        }      
        echo '
        </div>
        </div>';
            


	}
    
    public function html_tag_check($text){
        return strip_tags(trim(html_entity_decode($text)));
    }
    
}
