<?php 
    $db = new Database();
    $access_true = 0;
    $error = '';    
    if(isset($_POST['submit'])){
            $access  = $db->news_sql_query('SELECT * FROM admin where `id` = 1 AND `password` = "'.$_POST['pass'].'" AND `username` = "'.$_POST['name'].'"' );

            if($access->rowCount()>0){
                
                $access_true = 1;
            }else{
                $error ='Invalid name or password!';
            }
      
    }
    
    if(isset($_POST['access_change'])){
        $access_true=1;
        if(isset($_POST["access_name"]) && strlen($_POST["access_name"])>= 4){
            if(isset($_POST["access_pass"]) && strlen($_POST["access_pass"])>= 6){
               $access  = $db->news_sql_query('UPDATE admin SET username ="'.$_POST["access_name"].'",password ="'.$_POST["access_pass"].'" WHERE id = 1'); 
                echo '<div class="success"> Your data has been successfully changed!</div>';
                $access_true = 0;
            }
        }
        
    }
?>
<div>
    <div class="configure">
        <?php if($access_true==0): ?>

        <?php if(strlen($error)>0): ?>
        <span class="red"><?php    echo $error; ?></span>
        <?php endif; $error='' ?>
        <h1>Change your admin data</h1>
        <form method="POST">
            <p>Confirm your previous data!</p>
            <input type="text" name="name" placeholder="Enter name...">
            <input type="password" name="pass" placeholder="Enter password...">
            <button type="submit" name="submit"> Change</button>
        </form>

        <?php else: ?>

        <h1>
            Type new login and password!
        </h1>
        <form method="POST">
            <div class="access-name">
                <?php if(isset($_POST["access_name"]) && strlen($_POST["access_name"])< 4): ?>
                <p class="error-red">Please ensure that your name at least contains 4 symbols*</p>
                <?php endif;?>
                <input type="text" name="access_name" placeholder="New name..." value="<?php if(isset($_POST["access_name"])){echo $_POST["access_name"];} ?>">
            </div>
            <div class="access_pass">
                <?php if(isset($_POST["access_pass"]) && strlen($_POST["access_pass"])< 6): ?>
                <p class="error-red">Please ensure that your password at least contains 6 symbols*</p>
                <?php endif;?>
                <input type="password" name="access_pass" placeholder="New password..." value="<?php if(isset($_POST["access_pass"])){echo $_POST["access_name"];} ?>">
            </div>
            <button type="submit" name="access_change"> Save</button>
        </form>

        <?php endif; ?>
    </div>
</div>
