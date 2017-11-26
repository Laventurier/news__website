<div class="container">
    <h1 class="page-name">
        Commentaries to accept
    </h1>
    <?php
        $accepted_comments = $db->news_sql_query('select * from news_commentary where id='.$_GET['edit']);
            if($accepted_comments->rowCount()==1){
                $curr_arr = array();
                while($row = $accepted_comments->fetch(PDO::FETCH_ASSOC)){
                    $curr_arr = $row;
                }
            }
        ?>
    ?>
    <form action="" method="post">
        <table>
            <tr>
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
                    Date
                </th>
                <th>
                    Accept?
                </th>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td><input type="checkbox" name="comm-post-<?php echo 1 ; ?>"></td>
            </tr>
        </table>
        <input type="submit" value="Accept comments">
    </form>
</div>
