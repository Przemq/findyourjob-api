<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top page with text</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php')?>
<div class="wpx-name-module">
    <div class="container">
        <div class="row" id="top-page-image-with-text">
            <div class="col-lg-12">
                <img class="img-fluid" id="firm-icon" src="img/Event%20Shares%20Icon-01-01.svg">
            </div>
            <div class="col-lg-6 offset-lg-3"><p><?php echo $pageContent['paragraph'] ?></p> </div>
        </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
