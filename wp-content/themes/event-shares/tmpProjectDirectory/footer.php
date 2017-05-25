<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php'); ?>
<div class="container">
    <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-21">EV-21</a>
    <div class="row" id="footer">
        <div class="col-lg-3 col-sm-12" id="left-column"><?php echo $pageContent['footer_left_text']; ?></div>
        <div class="col-lg-6 col-sm-12" id="right-column"><?php echo $pageContent['footer_right_text']; ?></div>
    </div>
    <div class="row" id="footer-nav">
        <div class="col-lg-3" id="social-wrapper">
            <img src="img/Facebook%20Green%20Icon-01-01.svg">
            <img src="img/Twitter%20Green%20Icon-01-01.svg">
            <img src="img/Linkedin%20Green%20Icon-01-01.svg">
        </div>
        <nav class="col-lg-9" id="menu-items" >
                <ul class="nav">
                    <li class="nav-item" id="about-us">
                        <a class="nav-link " href="#"><?php echo $pageContent['footer_menu_item1']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo $pageContent['footer_menu_item2']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo $pageContent['footer_menu_item3']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><?php echo $pageContent['footer_menu_item4']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><?php echo $pageContent['footer_menu_item5']; ?></a>
                    </li>
                </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-3" id="copyright"><?php echo $pageContent['copyright']; ?></div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
