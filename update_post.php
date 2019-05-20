<?php

session_start();

$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Tbilisi'));

require_once "database/database.php";
require_once "helper/redirect.php";
$config = require_once "database/config.php";

if (isset($_POST['update'])) {
    $redirect     = new Redirect();
    $database     = new Database($config);

    $postId       = $_POST['id'];
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
        $redirect->where('გთხოვთ მიუთითოთ სიახლის სათაური', '/edit.php?id=' . $postId, 400);
    }

    if (empty($postDesc)) {
        $redirect->where('გთხოვთ მიუთითოთ სიახლის აღწერა', '/edit.php?id=' . $postId, 400);
    }

    if ($fileStatus == 1) {
        $redirect->where('ფაილის ზომა უნდა იყოს 2მბ ან ნაკლები', '/edit.php?id=' . $postId, 400);
    }

    if ($fileStatus == 0 || $fileStatus == 4) {

        try {
            if ($fileStatus == 4) {
                $data = [
                    'id' => $postId,
                    'title' => $postTitle,
                    'description' => $postDesc,
                    'updated_at' => $date->format('Y-m-d H:i:s')
                ];

                $sql = "UPDATE posts SET title=:title, description=:description, updated_at=:updated_at WHERE id=:id";
            } else {
                $sql = "SELECT image FROM posts WHERE id = :id";
                $prepare = $database->pdo->prepare($sql);
                $prepare->execute([
                    'id' => $postId
                ]);

                $curretValues = $prepare->fetch();

                $data = [
                    'id' => $postId,
                    'title' => $postTitle,
                    'description' => $postDesc,
                    'image' => $nameWithExt,
                    'updated_at' => $date->format('Y-m-d H:i:s')
                ];

                unlink('uploads/images/' . $curretValues['image']);

                $sql = "UPDATE posts SET title=:title, description=:description, image=:image, updated_at=:updated_at WHERE id=:id";
            }

            if ($fileStatus == 0) {
                move_uploaded_file($fileTmp, "uploads/images/" . $nameWithExt);
            }

            $prepare = $database->pdo->prepare($sql);
            $prepare->execute($data);

            $database->closeConnect();
        } catch (PDOException $e) {
            $redirect->where($e->getMessage(), '/edit.php?id=' . $postId, 400);
        }

        $redirect->where('სიახლე წარმატებით განახლდა', '/edit.php?id=' . $postId, 200);
    }  else {
        $redirect->where('ფაილის ატვირთვისას მოხდა შეცდომა', '/edit.php?id=' . $postId, 400);
    }

}

function getUniqueName($requestTime, $fileName)
{
    $fileName = strtolower($fileName);
    $explodeFile = explode('.', $fileName);
    $fileExt = end($explodeFile);

    return md5(uniqid( $requestTime, true)) . "." .$fileExt;
}