<?php
class admin_auth extends Admin_Engine{
    
    public function get_admin_content()
    {
        $login =$this->admin_login();
        require_once('../template-parts/admin-form.php');
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
                    header('Location:?side=posts&id=1');
                    exit();
                }else{
                    $_SESSION['user_error']='Incorrect login or password*';

                }
            }
        }
    }
    
    public function validate($data)
    {
      htmlspecialchars(stripslashes(trim($data)));
      return $data;
    }
}
