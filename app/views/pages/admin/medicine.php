<div class="container">
    <?= Flasher::flash() ?>
    <!-- Button trigger modal -->
    <div class="medicine mt-3">
        <a href="#" class="btn btn-primary addMedicine" data-toggle="modal" data-target="#medicineAddModal">
            Add Medicine
        </a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <td scope="col">Id</td>
                    <td scope="col">Name</td>
                    <td scope="col">Description</td>
                    <td scope="col">Price</td>
                    <td scope="col">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['medicines'] as $index => $medicine) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $medicine['name'] ?></td>
                        <td><?= $medicine['description'] ?></td>
                        <td><?= $medicine['price'] ?></td>
                        <td>
                            <a href="#" class="badge bg-warning text-white editMedicine" data-toggle="modal" data-target="#medicineAddModal" data-id="<?= $medicine['id'] ?>">Edit</a>
                            <a href="<?= BASE_URL . '/admin/deletemedicine/' . $medicine['id'] ?>" class="badge bg-danger text-white" onclick="return confirm('Delete this medicine?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="medicineAddModal" tabindex="-1" aria-labelledby="medicineAddModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="medicineAddModalLabel">Add Medicine</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASE_URL ?>/admin/addmedicine" method="POST">
                        <input name="id" type="hidden" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input name="description" type="text" class="form-control" id="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input name="price" type="text" class="form-control" id="price" required>
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

        $('.addMedicine').on('click', function() {
            $('#medicineAddModalLabel').html('Add Medicine');
        })
        $('.editMedicine').on('click', function() {
            $('#medicineAddModalLabel').html('Edit Medicine');
            $('#medicineAddModal form').attr('action', 'http://localhost/kliniku/public/admin/updatemedicine')

            const id = $(this).data('id');

            $.ajax({
                url: 'http://localhost/kliniku/public/admin/editmedicine',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#description').val(data.description);
                    $('#price').val(data.price);
                }
            })
        })
    })
</script>