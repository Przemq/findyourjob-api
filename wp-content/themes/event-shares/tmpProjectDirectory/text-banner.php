<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Large Text Banner</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php') ?>
<div class="wpx-name-module">
    <div class="container">
        <div class="row large-text-banner">
            <div class="col-lg-8 offset-lg-2">
           <?php echo $pageContent['lorem_short']; ?>
            </div>
        </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
