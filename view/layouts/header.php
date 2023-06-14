<header class="border-bottom lh-1 py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1 d-flex">
                <a href="/" class="link-primary pe-3">Home</a>
            <?php if($_SESSION['user_id']): ?>
                <a href="/admin" class="link-secondary">Admin panel</a>
            <?php endif; ?>
        </div>
        <div class="col-4 text-center">
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <?php if($_SESSION['user_id']): ?>
                <a class="btn btn-sm btn-outline-secondary" href="/logout">Logout</a>
            <?php else : ?>
                <a class="btn btn-sm btn-outline-primary" href="/login">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>