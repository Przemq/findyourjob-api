<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Header banner</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php')?>
<div class="wpx-name-module">
    <div class="container">
        <div class="row" id="header-banner">
            <div class="col-lg-5">
                <h2><?php echo $pageContent['header_banner']; ?></h2>
                <p><?php echo $pageContent['header_paragraph']; ?></p>
            </div>
        </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
