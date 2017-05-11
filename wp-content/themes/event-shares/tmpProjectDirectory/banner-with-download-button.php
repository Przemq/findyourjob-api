<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download..</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php') ?>
<div class="wpx-name-module">
    <div class="container">
        <div class="row" id="banner-with-download-button">
            <div class="col-lg-8 offset-2">
                <div class="mx-auto" id="magnifier-icon"><img src="img/ES%20Magnifyglass-Graph%20Icon-01-01.svg"></div>
                <h4 class=""><?php echo $pageContent['header1'] ?></h4>
                <p class=""><?php echo $pageContent['paragraph1'] ?></p>
                <a href="#" class="btn btn-primary" id="download-button">
                    <span><img id="download-icon" src="img/Download%20icon-01-01.svg"></span>
                    <span class="align-middle"><?php echo $pageContent['download_button'] ?></span>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
