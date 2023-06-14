<?php ob_start(); ?>
<div class="container py-3">
    <?php require_once './view/layouts/header.php' ?>

    <main class="d-flex justify-content-center pt-5">
        <h1><?=$title?></h1>
    </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require_once './view/layouts/main.php' ?>
