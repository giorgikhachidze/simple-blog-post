<?php
session_start();

require_once "database/database.php";
require_once "helper/redirect.php";
$config = require_once "database/config.php";

if (isset($_POST['softDelete'])) {
    $redirect = new Redirect();
    $database = new Database($config);

    $postId = $_POST['id'];

    $sql = "SELECT image FROM posts WHERE id = :id";
    $prepare = $database->pdo->prepare($sql);
    $prepare->execute([
        'id' => $postId
    ]);

    $curretValues = $prepare->fetch();

    unlink('uploads/images/' . $curretValues['image']);

    $sql = "DELETE FROM posts WHERE id = :id";

    $deleteData = $database->pdo->prepare($sql);

    $deleteData->execute([':id' => $postId]);

    $redirect->where('სიახლე წაიშალა სამუდამოდ', '/trash.php', 200);
}