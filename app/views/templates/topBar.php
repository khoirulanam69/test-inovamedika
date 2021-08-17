<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid container">
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>/admin">Home</a>
                </li>
                <?php if ($_SESSION['role'] == '1') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/admin/alluser">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/admin/medicine">Medicine Management</a>
                    </li>
                <?php elseif ($_SESSION['role'] == '2') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/dokter/listpatients">List Patients</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/user/registration">Registration</a>
                    </li>
                <?php endif ?>
            </ul>
            <a href="<?= BASE_URL ?>/auth/logout" class="btn btn-outline-primary">Logout</a>
        </div>
    </div>
</nav>