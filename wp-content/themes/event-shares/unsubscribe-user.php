<?php
$hash = $_GET['hash'];
global $wpdb;
$tableName = $wpdb->base_prefix . 'wpx_' . 'subscriptions';
$results = $wpdb->query("DELETE FROM" . $tableName . "WHERE hash=" . $hash, ARRAY_A);

if($results){
    echo 'usunięto';
}
else {
    echo 'error';
}