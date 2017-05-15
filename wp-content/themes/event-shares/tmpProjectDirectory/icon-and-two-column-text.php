<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home ETFS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include_once('data/pageContent.php') ?>
<div class="wpx-name-module">
    <div class="container">
        <div class="row" id="home-page-our-etfs">
            <div class="col-lg-2 offset-lg-2 col-sm-12">
                <img src="img/Event%20Shares%20Icon-01-01.svg" id="home-firm-icon">
            </div>
            <div class="col-lg-4">
                <h4><?php echo $pageContent['home_our_etfs_header']; ?></h4>
                <p><?php echo $pageContent['home_our_etfs_paragraph']; ?></p>
            </div>
            <div class="col-lg-4">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>ABXD</th>
                        <td>EVENTSHARES EMERGING ETFS</td>
                    </tr>
                    <tr>
                        <th>ADCX</th>
                        <td>EVENTSHARES EMERGING MARKETING</td>
                    </tr>
                    <tr>
                        <th>GSDR</th>
                        <td>EVENTSHARES EQULITY MARKETS</td>
                    </tr>
                    <tr>
                        <th>SFRW</th>
                        <td>EVENTSHARES EMERGING MARKETS</td>
                    </tr>
                    <tr>
                        <th>DDFT</th>
                        <td>EVENTSHARES EQULITY MARKETS</td>
                    </tr>
                    <tr>
                        <th>JHGT</th>
                        <td>EVENTSHARES SHORT MARKETS</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="js/libs/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/functions.js"></script>
</body>
</html>
