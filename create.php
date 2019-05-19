<?php session_start(); ?>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="/create.php">სიახლის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4 mt-4">

        <?php if(!empty($_SESSION['errorMessage'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>დაფიქსირდა შეცდომა!</strong> <?=$_SESSION['errorMessage']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif(!empty($_SESSION['successMessage'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>გილოცავთ!</strong> <?=$_SESSION['successMessage']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form action="create_post.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="postTitle">სათაური</label>
                                <input type="text" name="post_title" class="form-control" id="postTitle" placeholder="სიახლის სათაური">
                            </div>
                            <div class="form-group">
                                <label for="postDescription">აღწერა</label>
                                <textarea class="form-control" name="post_description" id="postDescription" rows="6" placeholder="სიახლის აღწერა"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="postFile">სურათის ატვირთვა</label>
                                <div class="custom-file" id="postFile">
                                    <input type="file" name="post_image" class="custom-file-input" id="postFile">
                                    <label class="custom-file-label" for="FileLangHTML" data-browse="არჩევა">აირჩიეთ
                                        სურათი...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="submit" name="upload" class="btn btn-success btn-sm btn-block shadow-sm">დამატება</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $('.alert').alert();
    </script>
    </body>
    </html>
<?php session_destroy(); ?>