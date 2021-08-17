<div class="container">
    <?php Flasher::flash() ?>
    <h3>List User</h3>
    <table class="table mt-3">
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">Name</td>
                <td scope="col">Email</td>
                <td scope="col">Password</td>
                <td scope="col">Role</td>
                <td scope="col">Action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $index => $user) : ?>
                <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td style="max-width:150px; text-overflow:ellipsis; overflow:hidden"><?= $user['password'] ?></td>
                    <?php if ($user['role'] == '1') : ?>
                        <td>Admin</td>
                    <?php elseif ($user['role'] == '2') : ?>
                        <td>Dokter</td>
                    <?php else : ?>
                        <td>User</td>
                    <?php endif ?>
                    <td>
                        <a href="#" class="editUserModal badge bg-warning text-white" data-toggle="modal" data-target="#editUserModal" data-id="<?= $user['id'] ?>">Edit</a>
                        <a href="<?= BASE_URL . '/admin/deleteuser/' . $user['id'] ?>" class="badge bg-danger text-white" onclick="return confirm('Delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASE_URL ?>/admin/edituserstore" method="POST">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Full name</label>
                            <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" id="password" type="password" class="form-control" placeholder="Enter old password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password2" class="form-label">New Password</label>
                                    <input name="password2" id="password2" type="password" class="form-control" placeholder="Enter new password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control" aria-label="Default select example">
                                <option value="1">Admin</option>
                                <option value="2">Dokter</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $('.editUserModal').on('click', function() {
            const id = $(this).data('id');

            $.ajax({
                url: 'http://localhost/kliniku/public/admin/edituser',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#role').val(data.role);
                }
            })
        });
    })
</script>