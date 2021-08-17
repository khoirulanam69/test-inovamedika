<div class="login-wrapper d-flex justify-content-center align-items-center">
    <div class="login">
        <?= Flasher::flash() ?>
        <form action="<?= BASE_URL; ?>/auth/store" method="POST">
            <h1 class="text-center font-weight-bold">Welcome Back</h1>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="<?= BASE_URL; ?>/auth/registration">Registration</a>
            </div>
        </form>
    </div>
</div>