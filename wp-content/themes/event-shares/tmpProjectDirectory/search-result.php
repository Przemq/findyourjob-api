<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search results</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php') ?>
<div class="wpx-name-module">
    <div class="container">
        <div id="search-results">
            <div class="row" id="page-results">
                <div id="single-result">
                    <div class="col-lg-12"><h4 id="search-top-header"><?php echo $pageContent['page_results']; ?></h4>
                    </div>
                    <div class="single-result col-lg-9">
                        <h4><?php echo $pageContent['result_header']; ?></h4>
                        <p><?php echo $pageContent['result_paragraph']; ?><a
                                    id="read-more"><?php echo $pageContent['read_more']; ?></a></p>
                    </div>
                </div>
                <div id="single-result">
                    <div class="single-result col-lg-9">
                        <h4><?php echo $pageContent['result_header']; ?></h4>
                        <p><?php echo $pageContent['result_paragraph']; ?><a
                                    id="read-more"><?php echo $pageContent['read_more']; ?></a></p>
                    </div>
                </div>
                <div id="single-result">
                    <div class="single-result col-lg-9">
                        <h4><?php echo $pageContent['result_header']; ?></h4>
                        <p><?php echo $pageContent['result_paragraph']; ?><a
                                    id="read-more"><?php echo $pageContent['read_more']; ?></a></p>
                    </div>
                </div>
            </div>
            <div class="row" id="article-results">
                <div class="col-lg-12"><h4 id="search-top-header"><?php echo $pageContent['page_results']; ?></h4></div>
                <?php include('modules/article-tile.php')?>
                <?php include('modules/article-tile.php')?>
                <?php include('modules/article-tile.php')?>
                <?php include('modules/article-tile.php')?>
                <?php include('modules/article-tile.php')?>
                <?php include('modules/article-tile.php')?>
            </div>
        </div>
    </div>
    <script src="js/libs/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script>
</body>
</html>
