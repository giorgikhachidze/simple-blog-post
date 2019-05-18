<?php

session_start();

$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Tbilisi'));

require_once "database/database.php";
require_once "helper/redirect.php";
$config = require_once "database/config.php";

if (isset($_POST['upload'])) {
    $redirect     = new Redirect();
    $database     = new Database($config);
    $postTitle    = $_POST['post_title'];
    $postDesc     = $_POST['post_description'];
    $requestTime  = $_SERVER['REQUEST_TIME'];
    $fileName     = $_FILES['post_image']['name'];
    $fileSize     = $_FILES['post_image']['size'];
    $fileTmp      = $_FILES['post_image']['tmp_name'];
    $fileType     = $_FILES['post_image']['type'];
    $fileStatus    = $_FILES['post_image']['error'];
    $nameWithExt  = getUniqueName($requestTime, $fileName);

    if (empty($postTitle)) {
        $redirect->where('გთხოვთ მიუთითოთ სიახლის სათაური', '/', 400);
    }

    if (empty($postDesc)) {
        $redirect->where('გთხოვთ მიუთითოთ სიახლის აღწერა', '/', 400);
    }

    if ($fileStatus === 4) {
        $redirect->where('სურათი არარის არჩეული', '/', 400);
    }

    if ($_FILES['post_image']['error'] === UPLOAD_ERR_OK) {

        try {
            $data = [
                'title' => $postTitle,
                'description' => $postDesc,
                'image' => $nameWithExt,
                'created_at' => $date->format('Y-m-d H:i:s')
            ];

            $sql = "INSERT INTO posts (title, description, image, created_at) VALUES (:title, :description, :image, :created_at)";
            $prepare = $database->pdo->prepare($sql);
            $prepare->execute($data);
            $database->closeConnect();
        } catch (PDOException $e) {
            $redirect->where($e->getMessage(), '/', 400);
        }

        move_uploaded_file($fileTmp, "uploads/images/" . $nameWithExt);

        $redirect->where('სიახლე წარმატებით დაემატა', '/', 200);
    } else {
        $redirect->where('ფაილი ზომა უნდა იყოს 2მბ ან ნაკლები', '/', 400);
    }

}

function getUniqueName($requestTime, $fileName)
{
    $fileName = strtolower($fileName);
    $explodeFile = explode('.', $fileName);
    $fileExt = end($explodeFile);

    return md5(uniqid( $requestTime, true)) . "." .$fileExt;
}