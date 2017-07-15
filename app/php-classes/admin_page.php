<?php
class admin_page extends Admin_Engine{
    
    
    public function get_admin_content()
    {
        require_once('../admin/admin_header.php');
        require_once('../admin/admin_content.php');
    }
    
    public function get_admin_sidebar()
    {
        require_once('../admin/admin_sidebar.php');
    }
    
}

?>
