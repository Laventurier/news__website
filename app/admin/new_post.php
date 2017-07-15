<div class="add__post_container">

    <?php 
$db = new Database();
if(isset($_POST['submit'])){
    
    $target_file = '../files/'.basename($_FILES["photo"]["name"]);
    $imageFileType = pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION);

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
    if(empty($_FILES["photo"]["name"])){
       $errors['photo_error']='*Please upload the Photo file! ';
    }else{
        if($imageFileType=='jpg' || $imageFileType=='png'){
            if($_FILES['photo']['size']>5000000){
                $errors['file_size_error'] = "*Sorry but the file is larger than 5 mb and cannot be uploaded!";
            }
        }else{
            $errors['file_format_error'] = "*Sorry but there are only PNG and JPEG files can be uploaded!";
        }
    }
    if(empty($_POST['category'])){
       $errors['category_error'] = '*Please Select one category! ';
    }
    
    if(empty($errors)){
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);
        $db::news_sql_query("INSERT INTO news_posts (post_title,post_author,post_description,post_content,post_date,post_image,post_category) VALUES". "('".$_POST['title']."','".$_POST['author']."','".$_POST['editor']."','".$_POST['editor']."',".$_POST['timepicker'].",'files/".$_FILES["photo"]["name"]."',".$_POST['category'].")");
        echo '<div class="success">Your files has been successfully uploaded to server!</div>';
        unset($_POST);
    }
    
    function validate($data)
    {
      htmlspecialchars(stripslashes(trim($data)));
      return $data;
    }
}
?>
    <?php if(!empty($errors)): ?>
    <div class="static_erros">
        <ul>
            <?php foreach($errors as $val): ?>
            <li>
                <?php echo $val; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="form__container">
        <h1>Add new Post</h1>

        <form class="form__add__post" method="POST" enctype="multipart/form-data">
            <p>
                <label for="title">title: <span></span></label>
                <input class="title_input" type="text" name="title" value="<?php if(!isset($errors[ 'title_error'])){ echo $_POST[ 'title']; } ?>">
            </p>
            <p>
                <label for="author">author:</label>
                <input type="text" name="author" value="<?php if(!isset($errors[ 'author_error'])){ echo $_POST[ 'author'];} ?>">
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
                    <option disabled selected value> -- select an option -- </option>
                    <?php foreach($cat_arr as $val): ?>
                    <option value="<?php echo $val['id_category'];  ?>" <?php if($val['id_category']==$_POST['category']){ echo 'selected="selected"';} ?>><?php echo $val['name_category'];  ?></option>
                    <?php endforeach; ?>
                    </select>
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
                <input class="picker" placeholder="Select published date..." type="text" name="timepicker" readonly="readonly" value="<?php if(!isset($errors[ 'time_error'])){ echo $_POST['timepicker'];} ?>"></p>
            <p>

                <button type="submit" name="submit" class="publish">publish</button>
                <span class="reset-form"> reset form </span>
            </p>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {

        CKEDITOR.replace('editor');
        $('.title_input').keyup(function() {
            $('label[for="title"] span').text($(this).val());
        });
        $('.title_input').focus(function() {
            $('label[for="title"] span').text($(this).val());
        });

        $('.reset-form').click(function() {
            $('.form__add__post label[for="title"] span').text('');
            $('.form__add__post').find('input').val('');
            $('.form__add__post').find('select').val('');
            CKEDITOR.instances.editor.setData('', function() {
                this.updateElement();
            });
        });
        $('.picker').flatpickr();
        <?php if(isset($_POST)): ?>
        CKEDITOR.instances.editor.setData('', function() {
            this.updateElement();
        });
        <?php endif; ?>
        <?php if(!isset($errors[ 'editor_error'])): ?>
        CKEDITOR.instances.editor.setData(<?php echo json_encode($text); ?>, function() {
            this.updateElement();
        });
        <?php endif; ?>
    });

</script>
