<?php
class admin_auth extends Admin_Engine{
    
    public function get_admin_content()
    {
        $login =$this->admin_login();
ECHO <<< END

    <div>
        <a href="../index.php">Home</a>
        <form method="post">
        $login
        <span>Username:</span></br>
        <input type="text" name="name" placeholder="Enter username..."></br>
        <span>Password:</span></br>
        <input type="password" name="pass" placeholder="Enter password..."></br>
        <input type="submit" name="login" value="submit" >
        </form>
    </div>

END;
    }
    
    public function get_admin_sidebar()
    {
        //Theres is no sidebar on this page
    }
    
    public function admin_login()
    {   
        if(isset($_POST['login']))
        {
            $username = $this->validate($_POST['name']);
            $pass = $this->validate($_POST['pass']);
            $sql = 'SELECT * FROM admin WHERE username = "'.$username.'" AND password = "'.$pass.'"';
            $result = $this->news_sql_query($sql);
            if($result)
            {
                if($result->rowCount()==1)
                {
                    $_SESSION['admin'] = true;
                    unset($_POST);
                    header('Location: index.php');
                    exit();
                }else{
                    $_SESSION['user_error']='Невірно введений пароль або ім\'я*';

                }
            }
            if(isset($_SESSION['user_error']))
            {
                echo $_SESSION['user_error'];
                unset($_SESSION['user_error']); 
            }
        }
    }
    
    public function validate($data)
    {
      htmlspecialchars(stripslashes(trim($data)));
      return $data;
    }
}