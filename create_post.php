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
    $fileStatus   = $_FILES['post_image']['error'];
    $nameWithExt  = getUniqueName($requestTime, $fileName);

    if (empty($postTitle)) {
        $redirect->where('გთხოვთ მიუთითოთ სიახლის სათაური', '/create.php', 400);
    }

    if (empty($postDesc)) {
        $redirect->where('გთხოვთ მიუთითოთ სიახლის აღწერა', '/create.php', 400);
    }

    if ($fileStatus == 4) {
        $redirect->where('სურათი არარის არჩეული', '/create.php', 400);
    }

    if ($fileStatus == 0) {

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
            $redirect->where($e->getMessage(), '/create.php', 400);
        }

        move_uploaded_file($fileTmp, "uploads/images/" . $nameWithExt);

        $redirect->where('სიახლე წარმატებით დაემატა', '/create.php', 200);
    } else {
        $redirect->where('ფაილის ზომა უნდა იყოს 2მბ ან ნაკლები', '/create.php', 400);
    }

}

function getUniqueName($requestTime, $fileName)
{
    $redirect     = new Redirect();

    $fileName = strtolower($fileName);
    $explodeFile = explode('.', $fileName);
    $fileExt = end($explodeFile);

    if ($fileExt === 'jpg' || $fileExt === 'jpeg' || $fileExt === 'png') {
        return md5(uniqid( $requestTime, true)) . "." . $fileExt;
    } else {
        return $redirect->where( 'ფაილის გაფართოება უნდა იყოს jpg, jpeg ან png.', '/create.php', 400);
    }
}