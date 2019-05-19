<?php

require_once "database/database.php";
require_once "helper/redirect.php";
$config = require_once "database/config.php";
$database = new Database($config);

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $database->pdo->prepare($sql);
$values = $result->execute();
$posts  = $result->fetchAll();

$database->closeConnect();
?>

<div class="row">
    <?php foreach ( $posts as $key => $value ) : ?>
        <div class="col-md-9 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5><?php echo $value['title']; ?></h5>
                    <small><?php echo $value['created_at']; ?></small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <img class="w-100 rounded" src="/uploads/images/<?php echo $value['image']; ?>" alt="<?php echo $value['title']; ?>">
                        </div>
                        <div class="col-md-7">
                            <?php echo $value['description']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <button type="submit" name="upload" class="btn btn-danger btn-sm btn-block shadow-sm">წაშლა</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>