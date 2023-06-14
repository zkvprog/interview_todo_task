<?php ob_start(); ?>
<div class="container py-3">
    <?php require_once './view/layouts/header.php' ?>

    <main>
        <div class="py-5 text-center">
            <h2>Task form</h2>
        </div>

        <div class="row g-5">
            <div class="col-md-7 col-lg-8 order-md-last">
                <div class="row">
                    <h4 class="col-auto me-auto">
                        <span class="text-primary">Your tasks</span>
                    </h4>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a class="<?= $sort === 'name' ? 'link-secondary' : '' ?>"
                               href="/?sort=name_<?= $sort === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc'?>"
                            >Name</a>
                        </th>
                        <th scope="col">
                            <a class="<?= $sort === 'email' ? 'link-secondary' : '' ?>"
                               href="/?sort=email_<?= $sort === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc'?>"
                            >Email</a>
                        </th>
                        <th scope="col">
                            Title
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?=$task->name?></td>
                            <td><?=$task->email?></td>
                            <td><?=$task->title?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-auto me-auto">
                        <?php if ($paginator->getPrevPageLink()): ?>
                            <a  href="<?=$paginator->getPrevPageLink() ?>">Пред...</a>
                        <?php endif; ?>
                    </div>

                    <div class="col-auto">
                        <?php if ($paginator->getNextPageLink()): ?>
                            <a class="col-auto" href="<?=$paginator->getNextPageLink() ?>">След...</a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col-md-5 col-lg-4">
                <h4 class="mb-3">Create new task</h4>
                <form method="POST" action="" enctype="multipart/form-data" class="needs-validation">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Your name" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="you@example.com" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="title" class="form-label">Task</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Your task" required>
                            <div class="invalid-feedback">
                                Please enter task description.
                            </div>
                        </div>

                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Create</button>
                </form>
            </div>
        </div>
    </main>

    <?php require_once './view/layouts/footer.php' ?>
</div>

<?php $content = ob_get_clean() ?>
<?php require_once './view/layouts/main.php' ?>