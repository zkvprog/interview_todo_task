<?php ob_start(); ?>
<div class="container py-3">

    <?php require_once './view/layouts/header.php' ?>

    <main class="mt-2 d-flex align-items">
        <div class="form-task w-100 m-auto">
            <h4 class="mb-3">Edit task</h4>
            <form method="POST" action="" enctype="multipart/form-data" class="needs-validation">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="title" class="form-label">Task</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Your task" value="<?= $task->title ?>" required>
                        <div class="invalid-feedback">
                            Please enter task description.
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="form-check">
                    <input name="completed" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" <?= $task->completed ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Completed
                    </label>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">Edit</button>
            </form>
        </div>
    </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require_once './view/layouts/main.php' ?>
