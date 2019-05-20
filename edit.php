<?php

session_start();

require_once "database/database.php";
$config = require_once "database/config.php";

$database     = new Database($config);

$sql = "SELECT id, title, description, image, created_at FROM posts WHERE id=:id";
$result = $database->pdo->prepare($sql);
$result->execute([
        'id' => $_GET['id']
]);

$post = $result->fetch();

$database->closeConnect();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <title>Simple blog</title>
    </head>
    <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SIMPLE-BLOG</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">მთავარი</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/create.php">სიახლის დამატება</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/trash.php">სანაგვე</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4 mt-4">

        <?php require_once 'message.php'; ?>

        <form action="update_post.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="postTitle">სათაური</label>
                                <input type="text" name="post_title" class="form-control" id="postTitle" value="<?=$post['title']?>">
                            </div>
                            <div class="form-group">
                                <label for="postDescription">აღწერა</label>
                                <textarea class="form-control" name="post_description" id="postDescription" rows="6"><?=$post['description']?></textarea>
                            </div>
                            <div class="form-group">
                                <img class="w-25 rounded" src="/uploads/images/<?=$post['image']?>" alt="<?=$post['title']?>">
                            </div>
                            <div class="form-group">
                                <label for="postFile">სურათის ატვირთვა</label>
                                <div class="custom-file" id="postFile">
                                    <input type="file" name="post_image" class="custom-file-input" id="postFile">
                                    <label class="custom-file-label" for="FileLangHTML" data-browse="არჩევა"><?=$post['image']?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?=$_GET['id']?>">
                            <button type="submit" name="update" class="btn btn-success btn-sm btn-block shadow-sm mb-2">განახლება</button>
                            </form>
                            <form action="delete_post.php" method="post">
                                <input type="hidden" name="id" value="<?=$_GET['id']?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm btn-block shadow-sm">წაშლა</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init()
        });

        $('.alert').alert();
    </script>
    </body>
    </html>
<?php session_destroy(); ?>