<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php') ?>
<div class="wpx-name-module">
    <div class="container" style="background-color: gray">
        <div class="col-lg-4" id="single-article">
            <img class="article-icon" src="img/ES%20Piggy%20Bank%20Icon-01-01.svg">
            <div class="publication-info col-lg-12">
                <?php echo $pageContent['article_date'] . ' | ' . $pageContent['article_author']; ?>
            </div>
            <div class="col-lg-12"><h4><?php echo $pageContent['article_title']; ?></h4></div>
            <div class="col-lg-12"><p><?php echo $pageContent['article_paragraph']; ?></p></div>
            <div class="col-lg-12" style="text-align: left"><a href="#">READ NOW</a></div>
        </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
