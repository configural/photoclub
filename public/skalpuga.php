<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*

$host = "localhost";
$user = "root";
$password = "";
$database="photoclub";
$port = "3306";
$socket = "";

$db = mysqli_connect($host, $user, $password, $database, $port, $socket);

$res = $db->query("select `id`, `url`, `user_id` from `photos` where `id` ");
var_dump($res);

echo "<pre>";

while ($row = $res->fetch_object()) {
    echo $row->id . ' -> ' . $row->url;
    echo "\r\n";
    
    if (!file_exists('photos/' . $row->user_id )) {
        mkdir ('photos/' . $row->user_id);
    }
    
    rename( 'photos/' . $row->url, 'photos/' . $row->user_id     . '/' .$row->url );


    
    
    
}

echo "</pre>";
 * 
 */