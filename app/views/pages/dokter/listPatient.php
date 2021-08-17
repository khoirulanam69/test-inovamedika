<div class="container">
    <?=Flasher::flash()?>
    <h3>List Patient</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Complaint</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['registration'])) : ?>
                <?php foreach ($data['registration'] as $index => $registration) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $registration['name'] ?></td>
                        <td><?= $registration['address'] ?></td>
                        <td><?= $registration['complaint'] ?></td>
                        <td><?= $registration['description'] ?></td>
                        <td>
                            <?php if ($registration['action'] == '1') : ?>
                                <a href="<?= BASE_URL ?>/dokter/setprice/<?= $registration['id'] ?>" class="badge bg-warning" data-toggle="modal" data-target="#makeRecipe" data-id="<?=$registration['id_reg']?>">Make Recipe</a>
                            <?php else : ?>
                                <a href="#" class="badge bg-success">Completed</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <h5>There is no data</h5>
            <?php endif ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="makeRecipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make Recipe</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL ?>/dokter/makerecipe" method="POST">
                    <input name="id_registration" id="idRegistration" type="hidden">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <input name="totalPrice" class="totalPrice" type="hidden">
                                <select name="recipe[]" class="multi_select form-control" multiple data-live-search="true" data-width="100%" required>
                                    <?php foreach ($data['medicines'] as $index => $medicine) : ?>
                                        <option value="<?= $medicine['id'] ?>"><?= $medicine['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
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

<script>
    $(function() {
        $('.bg-warning').on('click', function() {
            const id = $(this).data('id');
            $('#idRegistration').val(id);

            let total = 0;
            $('select').change(function(){
                let id = $(this).val()
                $.ajax({
                    url: 'http://localhost/kliniku/public/dokter/getprice',
                    data: {id : id},
                    method: 'post',
                    dataType: 'json',
                    success: function (data) {
                        let price = parseInt(data.price);
                        total += price;
                        $('.totalPrice').val(total);
                    }
                })
            })
        })
    })
</script>