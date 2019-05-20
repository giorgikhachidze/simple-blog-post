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