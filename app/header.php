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
    <title>News Today</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/rwdgrid.min.css">
    <link rel="stylesheet" href="css/style.css?ver=155">
    <link rel="stylesheet" href="css/croppie.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/parallax.min.js"></script>
</head>
<body>
    <div class="nav-mobile">
                            <?php if(isset($table['categories'])): ?>
                    <div class="navigation" class="clearfix">

                        <div class="grid-d-12">
                            <nav class="header-nav">
                                <ul>
                                    <li <?php if(!isset($_GET[ 'id'])){echo "class='active'";} ?>><a href="/d/app/">Головна Сторінка</a></li>
                                    <?php foreach($table['categories'] as $val): ?>
                                    <li <?php if($_GET[ 'id']==$val[ 'id_category']){echo "class='active'";} ?> >
                                        <a href="?option=category&id=<?php echo $val['id_category']; ?>">
                                            <?php echo $val['name_category']; ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>
                            <form id="search-head-mobile" class="clearfix" method="get">
                                <input type="image" name="submit" src="img/search.svg" class="search_icon" border="0" alt="Submit" />
                                <input type="text" name="search" value="" placeholder="Пошук...">
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
    </div>
    <div class="header">
        <div class="row-header">
            <div class="container">
                <div class="btn-nav">
                    <div class="btn-inner">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="grid-d-3 grid-t-3 grid-m-12">
                    <div class="logo"><a href="/d/app/" title="News - Today"><span> News - Today</span></a></div>
                </div>
                <div class="search grid-d-9 grid-t-9 m-hide">
                    <?php if(isset($table['categories'])): ?>
                    <div id="navigation" class="clearfix">

                        <div class="grid-d-12">
                            <nav class="header-nav">
                                <ul>
                                    <li <?php if(!isset($_GET[ 'id'])){echo "class='active'";} ?>><a href="/d/app/">Головна Сторінка</a></li>
                                    <?php foreach($table['categories'] as $val): ?>
                                    <li <?php if($_GET[ 'id']==$val[ 'id_category']){echo "class='active'";} ?> >
                                        <a href="?option=category&id=<?php echo $val['id_category']; ?>">
                                            <?php echo $val['name_category']; ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>
                            <form id="search-head" class="clearfix" method="get">
                                <input type="image" name="submit" src="img/search.svg" class="search_icon" border="0" alt="Submit" />
                                <input type="text" name="search" value="" placeholder="Пошук...">
                            </form>
                        </div>
                    </div>

                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="wrapper">
