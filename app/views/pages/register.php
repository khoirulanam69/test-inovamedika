<div class="login-wrapper d-flex justify-content-center align-items-center">
    <div class="registration">
        <?= Flasher::flash() ?>
        <form action="<?= BASE_URL ?>/auth/registrationstore" method="POST">
            <h1 class="text-center font-weight-bold">Registration</h1>
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Full name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" id="password" type="password" class="form-control" placeholder="Enter password" required>
                <div class="message text-danger"></div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary" onclick="verifyPassword()">Register</button>
                <a href="<?= BASE_URL; ?>/auth" class="">Back</a>
            </div>
        </form>
    </div>
</div>
<script>
    function verifyPassword() {
        const password = document.querySelector('.registration #password').value;
        if (password.length < 8) {
            document.querySelector(".message").innerHTML = "Password length must be atleast 8 characters";
        } else {
            document.querySelector('button').setAttribute('type', 'submit');
        }
    }
</script>