<?php
session_start();

require_once "database/database.php";
require_once "helper/redirect.php";
$config = require_once "database/config.php";

if (isset($_POST['delete'])) {
    $redirect = new Redirect();
    $database = new Database($config);

    $postId = $_POST['id'];

    $sql = "UPDATE posts SET isDelete=:isDelete WHERE id=:id";

    $deleteData = $database->pdo->prepare($sql);
    $deleteData->execute([
        ':id' => $postId,
        ':isDelete' => 1
    ]);

    $redirect->where('სიახლე წაიშალა წარმატებით', '/', 200);
}