<?php

/* 
 * Чистка базы данных
 */

$link = mysqli_connect("127.0.0.1", "artemka7_club", "Tamboti2014", "artemka7_club");

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "<pre>";
// непривязанные к пользователям фотографии
$query = "select * from `photos` where `photos`.`user_id` NOT IN (select `id` from `users`) ";
$res = $link->query($query);
echo "userless photos - $res->num_rows\r\n";
while($row = $res->fetch_object()) {
    
    echo "$row->id, $row->user_id, $row->url\r\n";
    @unlink("../public/photos/$row->user_id/_$row->url");
    @unlink("../public/photos/$row->user_id/$row->url");
}
$link->query("delete from `photos` where `photos`.`user_id` NOT IN (select `id` from `users`) ");


// непривязанные к пользователям комментарии
$query = "select `comments`.`id` from `comments` where `comments`.`user_id` NOT IN (select `id` from `users`) ";
$res = $link->query($query);
echo "userless comments - $res->num_rows\r\n";
$link->query("delete from `comments` where `comments`.`user_id` NOT IN (select `id` from `users`) ");


// непривязанные к фотографиям комментарии
$query = "select `comments`.`id` from `comments` where `comments`.`photo_id` NOT IN (select `id` from `photos`) ";
$res = $link->query($query);
echo "lost comments - $res->num_rows\r\n";
$link->query("delete from `comments` where `comments`.`photo_id` NOT IN (select `id` from `photos`) ");


echo "</pre>";
mysqli_close($link);
?>