<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>In the media small</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php') ?>
<div class="wpx-name-module">
    <div class="container">
        <div class="row" id="in-the-media">
            <div class="col-lg-12">
                <h4><?php echo $pageContent['in_the_media_header'] ?></h4>
            </div>
                <div class="col-lg-3 image-container">
                    <img class="media-image img-fluid" id="media1" src="img/logo_microsoft.svg">
                </div>
                <div class="col-lg-3 image-container">
                    <img class="media-image img-fluid" id="media2" src="img/logo_yahoo.svg">
                </div>
                <div class="col-lg-3 image-container">
                    <img class="media-image img-fluid" id="media3" src="img/logo_google.svg">
                </div>
                <div class="col-lg-3 image-container">
                    <img class="media-image img-fluid" id="media4" src="img/logo_amazon.svg">
                </div>
        </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
