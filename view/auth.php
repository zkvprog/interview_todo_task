<?php ob_start(); ?>
<div class="h-100 d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form method="POST">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input name="login" type="text" class="form-control" id="floatingInput" placeholder="login" required>
                <label for="floatingInput">Login</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>
    </main>
</div>

<?php $content = ob_get_clean() ?>
<?php require_once './view/layouts/main.php' ?>