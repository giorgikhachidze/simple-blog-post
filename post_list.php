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
    <?php foreach ( $posts as $post ) : ?>
        <?php if ($post['deleted'] == 0) : ?>
            <div class="col-md-9 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5><?php echo $post['title']; ?></h5>
                        <small class="mb-2">გამოქვეყნდა: <?php echo $post['created_at']; ?></small>
                        <?php if (!empty($post['updated_at'])) : ?>
                        <div class="float-xl-right float-md-right"><small>განახლდა: <?php echo $post['updated_at']; ?></small></div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <img class="w-100 rounded" src="/uploads/images/<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
                            </div>
                            <div class="col-md-7">
                                <?php echo $post['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="edit.php?id=<?php echo $post['id'] ?>" method="get">
                            <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm btn-block shadow-sm">რედაქტირება</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>