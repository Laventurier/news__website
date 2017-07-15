<?php 
    session_start(); 
    if(isset($_SESSION['sent'])){
        unset($_SESSION['sent']);
        unset($_POST);
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dyplom</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/rwdgrid.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?ver=166">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/parallax.min.js"></script>
</head>

<body>

    <div class="header">
        <div class="row-header">
            <div class="container">
                <div class="grid-d-4 grid-t-4 grid-m-12">
                </div>
                <div class="search grid-d-8 grid-t-8 m-hide">
                    <form action="refresh.php" class="clearfix" method="get">
                        <input type="image" name="submit" src="img/search.svg" class="search_icon" border="0" alt="Submit" />
                        <input type="text" name="search" value="" placeholder="Пошук...">
                    </form>
                </div>
            </div>
        </div>
        <?php if(isset($table['categories'])): ?>
        <div id="navigation">
            <div class="container">
                <div class="grid-d-12">
                    <nav class="header-nav">
                        <ul>
                            <li <?php if(!isset($_GET[ 'id'])){echo "class='active'";} ?>><a href="index.php">новини</a></li>
                            <?php foreach($table['categories'] as $val): ?>
                            <li <?php if($_GET[ 'id']==$val[ 'id_category']){echo "class='active'";} ?> >
                                <a href="?option=category&id=<?php echo $val['id_category']; ?>">
                                    <?php echo $val['name_category']; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="wrapper">
