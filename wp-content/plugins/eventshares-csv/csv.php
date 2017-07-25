<?php

/**
 * Plugin Name: Event shares subscribers
 * Description: CSV user export & SFTP upload
 * Version: 0.5
 */

defined('ABSPATH') or die('No script kiddies please!');

// SFTP settings
define('CSV_USER', 'wpgeeksdev');
define('CSV_PWD', 'fr6gtr5muh4u');
define('CSV_PORT', '22909');
define('CSV_HOST', 'horse.wpgeeks.uk');
define('CSV_PATH', '/home/wpgeeksdev/quilteruploader/');
define('CSV_FILENAME', 'subscribers');

// Text for strtotime. "Monday This Week" will return always monday date from current week
define('CSV_DAILY_FROM_DATE', 'Monday This Week');

define('CRON_TIME', '8:00');
global $wpdb;
$tableName = $wpdb->base_prefix . 'wpx_' . 'subscriptions';

################

// Wordpress action etc..
add_action('admin_menu', 'csv_create_menu');

function csv_create_menu() {
    add_menu_page('Subscribers', 'Subscribers', 'list_users', 'csv', 'csv_function');
}

function generate_csv_string() {
    global $wpdb;
    global $tableName;

    $results = $wpdb->get_results("SELECT email, investor FROM " . $tableName, ARRAY_A);

    $stringData = 'email;investor' . "\r\n";

    foreach ($results as $single) {

        @$stringData .=  $single['email'] . ';' . $single['investor'] . "\r\n";
    }

    return $stringData;
}


function generate_csv() {
    $fileName = CSV_FILENAME . '_' . date('Ymd') . '.csv';
    header('Content-Type: text/html');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    global $wpdb;
    global $tableName;

    $results = $wpdb->get_results("SELECT email, investor FROM " . $tableName, ARRAY_A);

    $stringData = 'email;investor' . "\r\n";

    foreach ($results as $single) {

        @$stringData .=  $single['email'] . ';' . $single['investor'] . "\r\n";
    }


    $fp = fopen('php://output', 'w');
    fwrite($fp, $stringData);
    fclose($fp);
    die();
}


function displayLog() {
    $log = get_option('csvUploaderLog');

    if (!empty($log) && count($log) > 0) {
        $log = array_reverse($log);
        foreach ($log as $key => $value) {
            echo (Int)($key + 1);
            echo '. ' . $value;

            echo '<br />';
        }
    }
}

function addLog($status, $fileName = '', $complexLog, $cron) {
    $currentLog = get_option('csvUploaderLog', []);
    if (count($currentLog) > 60) {
        $currentLog = array_slice($currentLog, -60, 60, true);
    }

    $person = $cron ? 'daily-cron' : wp_get_current_user()->user_login;


    if ($status) {
        $currentLog[] = date(DATE_RFC2822) . ' [' . $person . '] ' . $fileName . ' was uploaded successfully';
    } else {
        $currentLog[] = date(DATE_RFC2822) . ' [' . $person . '] ' . ' <b>' . $fileName . ' was not uploaded successfully</b><br>Network dump:<br>' . $complexLog;
    }

    update_option('csvUploaderLog', $currentLog);
}

function clearLog() {
    update_option('csvUploaderLog', []);
}

function csv_function() {
    ?>
    <h1>Quilter subscriber list</h1>

    <hr>
    <div class="theme-options-wrapper">

    <form method="post" action="options.php">
    <?php settings_fields('quilter-settings-group'); ?>
    <?php do_settings_sections('quilter-settings-group'); ?>
    <ul class="tab">
        <li><a href="#" class="tablinks active" onclick="openTab(event, 'log')">CSV generator</a></li>
        <li><a href="#" class="tablinks" onclick="openTab(event, 'list')">Subscriber list</a></li>
    </ul>


    <div id="log" class="tabcontent" style="display: block">
        <br>
        <a href="/wp-admin/admin.php?page=csv&download_csv=1" class="button">Click here to <b>DOWNLOAD</b> .csv with users</a>
        <a href="/wp-admin/admin.php?page=csv&transfer_csv=2" class="button">Click here to <b>UPLOAD</b> .csv with users</a>
        <a href="/wp-admin/admin.php?page=csv&flush_log" class="button">Click here to <b>CLEAR</b> log</a>
        <h3>SFTP uploader log:</h3>
        <?php
        displayLog();
        ?>
    </div>

    <div id="list" class="tabcontent">
        <?php
        global $wpdb;
        global $tableName;

        $results = $wpdb->get_results("SELECT email, investor FROM " . $tableName . " GROUP BY  investor", ARRAY_A);

        $stringData = '<table>';
        $stringData .= '<tr>';
        $stringData .= '<th>No.</th>';
        $stringData .= '<th>Email</th>';
        $stringData .= '<th>Investor</th>';
        $stringData .= '</tr>';
        $i = 1;
        foreach ($results as $single) {

            @$stringData .= '<tr><td>' . $i . '</td><td>' . $single['email'] . '</td><td>' . $single['investor'] . '</td></tr>';

            $i++;
        }

        $stringData .= '</table>';

        echo $stringData;
        ?>
    </div>
    <?php
}

add_action('init', 'download_csv');

function download_csv($cron = false)
{
    // download file
    if (is_admin() AND current_user_can('list_users') AND isset($_GET['download_csv']) AND $_GET['download_csv'] == '1') {
        generate_csv();
    }

    // generate csv string and upload to sftp
    if ((isset($_GET['transfer_csv']) AND is_admin() AND current_user_can('list_users')) || $cron) {

        $csvString = '';
        $fileName = '';

        if ($_GET['transfer_csv'] == 1 || $cron) {
            $csvString = generate_csv_string();
            $fileName = CSV_FILENAME . '_' . date('Ymd') . '.csv';
        }
        if ($_GET['transfer_csv'] == 2) {
            $csvString = generate_csv_string();
            $fileName = CSV_FILENAME . '_' . date('Ymd') . '.csv';
        }

        if (!empty($csvString)) {
            include('vendor/autoload.php');
            $sftp = new \phpseclib\Net\SFTP(CSV_HOST . ':' . CSV_PORT);

            define('NET_SFTP_LOGGING', NET_SFTP_LOG_COMPLEX);

            if (!$sftp->login(CSV_USER, CSV_PWD)) {
                $status = false;
            } else {
                $status = $sftp->put(CSV_PATH . $fileName, $csvString);
            }

            addLog($status, $fileName, $sftp->getSFTPLog(), $cron);
        }
    }

}

register_activation_hook(__FILE__, 'csv_plugin_activation');

function csv_plugin_activation() {
    global $wpdb;

    if (!wp_next_scheduled('users_submit_daily_event')) {
        wp_schedule_event(date('U', strtotime(CRON_TIME)), 'daily', 'users_submit_daily_event');
    }

    $tableName = $wpdb->base_prefix . 'wpx_' . 'subscriptions';

    $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(255) NOT NULL,
            `investor` varchar(255) NOT NULL,
             PRIMARY KEY (`id`)
             ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);

}

add_action('users_submit_daily_event', 'daily_event');

function daily_event()
{
    download_csv(true);
}

register_deactivation_hook(__FILE__, 'csv_plu`gin_deactivation');

function csv_plugin_deactivation()
{
    wp_clear_scheduled_hook('users_submit_daily_event');
}

if (isset($_GET['flush_log'])) {
    clearLog();
}

if (isset($_GET['delete'])) {
    $sql = "DELETE FROM `" . $tableName . "`;";

    $wpdb->query($sql);
}