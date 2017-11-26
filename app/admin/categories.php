<div class="container">
    <?php
     if(isset($_GET['del'])){ 
 $content->news_sql_query('delete from news_category where id_category='.$_GET['del']); }
    try{
        $categories = $content->news_sql_query('Select * FROM news_category');
        
        if($categories->rowCount()>0){
            $tab = array();
            while($row = $categories->fetch(PDO::FETCH_ASSOC)){
                $tab['category'][]= $row;
            }
        }
    }catch(Exception $err){

   print('<div class="container"><p class="error-msg">'.$err->getMessage().'</p></div>');
    }
    

    if(isset($_POST['add'])){
        if(!empty($_POST['name_category'])){
            $check = $content::validate($_POST['name_category']);
            $content->news_sql_query('INSERT INTO news_category(name_category) values ("'.$check.'")');
            echo '<span class="success">Your data <strong>'.$check.'</strong> has been successfully added! </span>';
        }else{
            echo '<span class="error">please don\'t leave this field empty</span>';
        }
    }
    ?>
        <div>
            <?php if(isset($_GET['add'])): ?>
            <form method="POST">
                <input type="text" name="name_category" placeholder="name category">
                <button name="add" type="submit">
                    add category
                </button>
            </form>
            <?php 
            elseif(($_GET['edit'])): 
                $categories = $content->news_sql_query('Select * FROM news_category where id_category='.$_GET['edit']);
        
                if($categories->rowCount()>0){
                    $tab = array();
                    while($row = $categories->fetch(PDO::FETCH_ASSOC)){
                        $tab['category']= $row;
                    }
                }
                $list = $content->news_sql_query('Select * FROM news_category');
        
                if($list->rowCount()>0){
                    $list_ = array();
                    while($row_ = $list->fetch(PDO::FETCH_ASSOC)){
                        $list_['list'][]= $row_;
                    }
                }
                if(isset($_POST['submit_edit'])){
                    if(!empty($_POST['name_category']) && !empty($_POST['position']) && ($_POST['hidden']==0 || $_POST['hidden'] == 1)){
                        $name = $content::validate($_POST['name_category']);
                        $new = $content::validate($_POST['position']);
                        $hidden = $content::validate($_POST['hidden']);
                        $old = $tab['category']['position'];
                        foreach($list_['list'] as $value){
                            
                            if($new <= $value['position'] && $old > $value['position']){
                                $curr = $value['position']+1;
                               $content->news_sql_query('update news_category set position='.$curr.' where id_category = '.$value['id_category']);
                            }elseif($new >= $value['position'] && $old < $value['position']){
                                $curr = $value['position']-1;
                               $content->news_sql_query('update news_category set position='.$curr.' where id_category='.$value['position']);
                            }
                        }
                        
                       $content->news_sql_query('update news_category set position='.$new.', hidden='.$hidden.', name_category="'.$name.'"  where id_category = '.$tab["category"]["id_category"].' ');
                    }else{
                        echo 'please check if your fields not empty*';
                    }
                }
                $categories = $content->news_sql_query('Select * FROM news_category where id_category='.$_GET['edit']);
        
                if($categories->rowCount()>0){
                    $tab = array();
                    while($row = $categories->fetch(PDO::FETCH_ASSOC)){
                        $tab['category']= $row;
                    }
                }
                $list = $content->news_sql_query('Select * FROM news_category');
        
                if($list->rowCount()>0){
                    $list_ = array();
                    while($row_ = $list->fetch(PDO::FETCH_ASSOC)){
                        $list_['list'][]= $row_;
                    }
                }
            ?>
            <form id="categorychange" method="POST">
                <p>
                    <span>Category Name: </span>
                    <input type="text" name="name_category" value="<?php echo $tab['category']['name_category']; ?>" placeholder="name_category">
                </p>
                <p> <span>Position: </span>
                    <select name="position">
                        <?php foreach($list_['list'] as $value): ?>
                        <option value="<?php echo $value['position'];?>" <?php if($value['id_category']==$_GET['edit']){ echo 'selected';} ?> >
                         <?php echo  $value['position'];?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p>
                    <span>Hidden: </span>
                    <input type="number" name="hidden" value="<?php echo $tab['category']['hidden']; ?>" placeholder="hidden">
                </p>
                <p>
                    <button name="submit_edit" type="submit">save data</button>
                </p>
            </form>
            <?php else: ?>
            <div class="category__add ">
                <a href="<?php echo '?side='.$_GET[ 'side']. '&add'; ?>">add category</a>
            </div>
            <table>
                <tr>
                    <th>id</th>
                    <th>category name</th>
                    <th>position</th>
                    <th>hidden</th>
                    <th>
                        editing
                    </th>
                    <th>
                        removing
                    </th>
                </tr>
                <?php foreach($tab["category"] as $val): ?>
                <tr>
                    <td>
                        <?php echo $val["id_category"]; ?>
                    </td>
                    <td>
                        <?php echo $val["name_category"]; ?>
                    </td>
                    <td>
                        <?php echo $val["position"]; ?>
                    </td>
                    <td>
                        <?php echo $val ["hidden"]; ?>
                    </td>

                    <td>
                        <a href="<?php echo '?side='.$_GET['side'].'&edit='.$val['id_category'].';' ?>">edit</a>
                    </td>
                    <td>
                        <a href="<?php echo '?side='.$_GET['side'].'&del='.$val['id_category'].';' ?>" onclick="return confirm('Are you sure want to delete  category?')" data-text="<?php echo $val['name_category']; ?>">remove</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>

</div>
