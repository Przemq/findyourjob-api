<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image boxes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php')?>
<div class="wpx-name-module">
    <div class="container">
       <div class="row" id="three-column-boxes">
           <div class="col-lg-12"><h4 id="top-header"><?php echo $pageContent['header2']; ?></h4></div>
           <div class="col-lg-4">
               <div style="margin-bottom: 20px; height: 105px"><img src="img/ES%20Nav%20Icon-01-01.svg" id="icon1"></div>
               <h4 class="sub-header"><?php echo $pageContent['three_column_sub_header1']; ?></h4>
               <p><?php echo $pageContent['three_column_sub_paragraph1']; ?></p>
           </div>
           <div class="col-lg-4">
               <div style="margin-bottom: 20px;  height: 105px"><img src="img/ES%20Magnifyglass-Graph%20Icon-01-01.svg" id="icon2"></div>
               <h4 class="sub-header"><?php echo $pageContent['three_column_sub_header2']; ?></h4>
               <p><?php echo $pageContent['three_column_sub_paragraph2']; ?></p>
           </div>
           <div class="col-lg-4">
               <div style="margin-bottom: 20px;  height: 105px"><img src="img/ES%20Pie%20Graph%20Icon-01-01.svg" id="icon3"></div>
               <h4 class="sub-header"><?php echo $pageContent['three_column_sub_header3']; ?></h4>
               <p><?php echo $pageContent['three_column_sub_paragraph3']; ?></p>
           </div>
       </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
