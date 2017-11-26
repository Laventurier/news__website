<div class="container">
    <h1 class="page-name">
        Commentaries to accept
    </h1>
    <?php
        $db = new Database();
        foreach($_POST as $key){
            $comm_id =  preg_replace('/[^0-9]/', '', key($_POST));
            $db->news_sql_query('UPDATE news_commentary set accepted = 1 where id ='.$comm_id);
            next($_POST);
        }
        unset($_POST);
        
        $accepted_comments = $db->news_sql_query('select * from news_commentary where accepted = 0');
            if($accepted_comments->rowCount()>0){
                $acc_arr = array();
                while($row = $accepted_comments->fetch(PDO::FETCH_ASSOC)){
                    $acc_arr[] = $row;
                }
            }else{
                echo "<p>There is no commentaries to accept :)</p>";
            }
    ?>
          <?php if(isset($acc_arr)): ?>
        <form id="commentaries" action="" method="post">
            <table>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Commentary content
                    </th>
                    <th>
                        Author
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Post id
                    </th>
                    <th>
                        Accepted?
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Check to accept
                    </th>
                </tr>
             
                <?php foreach($acc_arr as $key=>$val): ?>
                <tr>
                    <?php foreach($val as $key): ?>
                    <td>
                        <?php echo $key; ?>
                    </td>
                    <?php endforeach; ?>

                    <td>
                        <input type="checkbox" name="comm-post-<?php echo $val["id"]; ?>">
                    </td>
                </tr>
                <?php endforeach; ?>
              
            </table>
            <input type="submit" value="Accept comments">
              <?php endif; ?>
        </form>
</div>
