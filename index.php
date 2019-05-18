<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Simple blog</title>
</head>
<body class="bg-light">

<div class="container py-4 mt-5">
    <form action="file.php" method="post" enctype="multipart/form-data">
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
                            <textarea class="form-control" name="post_description"id="postDescription" rows="6" placeholder="სიახლის აღწერა"></textarea>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>