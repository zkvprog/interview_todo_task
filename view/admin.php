<?php ob_start(); ?>
<div class="container py-3">

    <?php require_once './view/layouts/header.php' ?>

    <main>
        <div class="mt-3">
            <div class="row">
                <h4 class="col-auto me-auto">
                    <span class="text-primary">All tasks</span>
                </h4>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        <a class="<?= $sort === 'name' ? 'link-secondary' : '' ?>"
                           href="/admin?sort=name_<?= $sort === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc'?>"
                        >Name</a>
                    </th>
                    <th scope="col">
                        <a class="<?= $sort === 'email' ? 'link-secondary' : '' ?>"
                           href="/admin?sort=email_<?= $sort === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc'?>"
                        >Email</a>
                    </th>
                    <th scope="col">
                        <a class="<?= $sort === 'completed' ? 'link-secondary' : '' ?>"
                           href="/admin?sort=completed_<?= $sort === 'completed' && $sortDirection === 'asc' ? 'desc' : 'asc'?>"
                        >Completed</a>
                    </th>
                    <th scope="col">
                        Title
                    </th>
                    <th scope="col">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?=$task->id?></td>
                        <td><?=$task->name?></td>
                        <td><?=$task->email?></td>
                        <td>
                            <?php if($task->completed): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            <?php endif; ?>
                        </td>
                        <td><?=$task->title?></td>
                        <td><a class="btn btn-sm btn-primary" href="/task/edit?id=<?=$task->id?>">Edit</a></td>
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
    </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require_once './view/layouts/main.php' ?>