<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top-menu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php') ?>
<div class="container">
<div class="wpx-name-module">
    <div class="row" id="top-menu">
        <div class="col-lg-2"><img src="img/logo.jpg"></div>
        <nav class="nav offset-4">
            <ul class="nav">
                <li class="nav-item" id="about-us">
                    <a class="nav-link " href="#"><?php echo $pageContent['tom_menu_item1']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $pageContent['tom_menu_item2']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $pageContent['tom_menu_item3']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#"><?php echo $pageContent['tom_menu_item4']; ?></a>
                </li>
            </ul>
            <a href="#"><img id="search-icon" src="img/Magnifying%20Glass-01-01.svg"></a>
        </nav>
    </div>
    <div class="row noDisplay" id="about-sub-menu">
        <div class="col-lg-4 col-sm-12">
            <h4><?php echo $pageContent['about-us-sub1']; ?></h4>
            <p><?php echo $pageContent['lorem']; ?></p>
            <a href=""><?php echo $pageContent['learn-more']; ?></a>
        </div>
        <div class="col-lg-4 col-sm-12">
            <h4><?php echo $pageContent['about-us-sub2']; ?></h4>
            <p><?php echo $pageContent['lorem']; ?></p>
            <a href=""><?php echo $pageContent['learn-more']; ?></a>

        </div>
        <div class="col-lg-4 col-sm-12">
            <h4><?php echo $pageContent['about-us-sub3']; ?></h4>
            <p><?php echo $pageContent['lorem']; ?></p>
            <a href=""><?php echo $pageContent['learn-more']; ?></a>
        </div>
    </div>
</div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
