<div class="add__post_container">

    <?php 
    $db = new Database();
    
    if(isset($_POST['submit'])){
        var_dump($_POST);
        $errors = array();
        if(empty($_POST['title'])){
            $errors['tite_error']='*Please don\'t leave Title field empty! ';
        }
        if(empty($_POST['author'])){
            $errors['author_error']='*Please don\'t leave Author field empty! ';
        }
        if(empty($_POST['editor'])){
            $errors['editor_error']='*Please don\'t leave Content area empty! ';
        }else{
            $text = $_POST['editor'];
        }
        if(empty($_POST['timepicker'])){
            $errors['time_error']='*Please don\'t leave Date area empty! ';
        }
        if(empty($_POST['short_descr'])){
            $errors['short_descr_error'] = '*Please enter short description! ';
        }
        if(empty($_POST['category'])){
           $errors['category_error'] = '*Please Select one category! ';
        }
    }
    
    $current_post = $db->news_sql_query('select * from news_posts where id='.$_GET['edit']);
        if($current_post->rowCount()==1){
            $curr_arr = array();
            while($row = $current_post->fetch(PDO::FETCH_ASSOC)){
                $curr_arr = $row;
            }
        }
    ?>
    <div class="form__container">
        <h1>Edit Post</h1>

        <form class="form__add__post" method="POST" enctype="multipart/form-data">
            <p>
                <label for="title">title: <span></span></label>
                <input class="title_input" type="text" name="title" value="<?php echo $curr_arr['post_title']; ?>">
            </p>
            <p>
                <label for="author">author:</label>
                <input type="text" name="author" value="<?php echo $curr_arr['post_author']; ?>">
            </p>
            <p>
                <label for="category">category:</label>
                <?php
                    $category = $db::news_sql_query("SELECT * FROM news_category");
                    if($category->rowCount()>0){
                        $cat_arr = array();
                        while($row = $category->fetch(PDO::FETCH_ASSOC)){
                            $cat_arr[] = $row;
                        }
                    }
                ?>
                    <select name="category">
                    <?php foreach($cat_arr as $val): ?>
                    <option value="<?php echo $val['id_category'];  ?>" <?php if($val['id_category']==$curr_arr['category']){ echo 'selected="selected"';} ?>><?php echo $val['name_category'];  ?></option>
                    <?php endforeach; ?>
                    </select>
            </p>
            <p>
                <label for="short_descr">Short Description:</label>
                <textarea id="short_descr" name="short_descr" maxlength="300" value="<?php  echo $curr_arr['post_description']; ?>"><?php  echo $curr_arr['post_description']; ?></textarea>
            </p>
            <p>
                <label for="editor">content:</label>
                <textarea id="editor" name="editor"></textarea>
            </p>
            <p><label for="photo">image: <br> </label>

                <label>
                <input id="photo" type="file" name="photo" value="photo" value="<?php if(!isset($errors[ 'photo_error'])){ echo $_FILES["photo"]["name"];} ?>">
                <img src="../img/cloud-computing.svg" alt="cloud-computing">
                </label>
            </p>
            <p><label for="timepicker">time:</label>
                <input class="picker" placeholder="Select published date..." type="text" name="timepicker" readonly="readonly" value="<?php echo $curr_arr['post_date']; ?>"></p>
            <p>

                <button type="submit" name="submit" class="publish">publish</button>
            </p>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        var text;
        text = <?php echo json_encode($curr_arr["post_content"]); ?>;
        CKEDITOR.replace('editor');
        CKEDITOR.instances.editor.setData(text,
            function() {
                this.updateElement();
            });

    });

</script>
