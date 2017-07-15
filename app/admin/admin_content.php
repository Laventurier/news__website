<div id="admin-content">
    <div class="admin-content-wrapper">
        <?php 
        $content = new admin_page;
        switch($_GET['side']):  
            case 'posts': 
                require_once('posts.php'); 
                break; 
            case 'categories': 
                require_once('categories.php'); 
                break;
            case 'comments': 
                require_once('comments.php'); 
                break;
            case 'settings': 
                require_once('settings.php'); 
                break;
            case 'new_post': 
                require_once('new_post.php'); 
                break;
            case '': 
                require_once('main.php'); 
                break;
            default:  
                require_once('../template-parts/404.php'); 
                break;
            endswitch; 
        ?>
    </div>
</div>
