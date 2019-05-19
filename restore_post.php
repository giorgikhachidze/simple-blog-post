<?php
session_start();

require_once "database/database.php";
require_once "helper/redirect.php";
$config = require_once "database/config.php";

if (isset($_POST['restore'])) {
    $redirect = new Redirect();
    $database = new Database($config);

    $postId = $_POST['id'];

    $sql = "UPDATE posts SET deleted=:deleted WHERE id=:id";

    $deleteData = $database->pdo->prepare($sql);
    $deleteData->execute([
        ':id' => $postId,
        ':deleted' => 0
    ]);

    $redirect->where('სიახლე აღდგენილია წარმატებით', '/', 200);
}