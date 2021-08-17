<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-7">
            <h3>List Registration</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
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
                                <td><?= $registration['address'] ?></td>
                                <td><?= $registration['complaint'] ?></td>
                                <td><?= $registration['description'] ?></td>
                                <td>
                                    <?php if ($registration['action'] == '1') : ?>
                                        <a href="#" class="badge bg-warning">Waiting Response</a>
                                    <?php else : ?>
                                        <?php if ($registration['is_pay'] == null) : ?>
                                            <a href="#" class="badge bg-success" data-toggle="modal" data-target="#totalModal" data-id="<?= $registration['id_reg'] ?>">Checkout</a>
                                        <?php elseif ($registration['is_pay'] != null) : ?>
                                            <a href="#" class="badge bg-primary" data-id="<?= $registration['id_reg'] ?>">Download Recipe</a>
                                        <?php endif ?>
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
        <div class="col-md-4">
            <h3>Registration</h3>
            <?= Flasher::flash() ?>
            <form action="<?= BASE_URL ?>/user/registrationstore" method="POST">
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input name="address" id="address" type="text" class="form-control" placeholder="Jl. Blambangan Rt.01/Rw.05 Dampit, Kab.Malang" required>
                    <div class="message text-danger"></div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="complaint" class="form-label">Keluhan</label>
                    <input name="complaint" type="text" class="form-control" id="complaint" aria-describedby="emailHelp" placeholder="Pusing, Mual, dll" required>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <label for="floatingTextarea2">Description</label>
                        <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>
                </div>
                <input name="id_registration" type="hidden" value="<?= $data['user']['id'] ?>">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure to registration?')">Submit</button>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="totalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL ?>/user/payment" method="POST">
                <input name="id" id="id" type="hidden">
                    <div class="form-group">
                        <label for="comp">Complaint</label>
                        <input type="text" class="form-control" id="comp" disabled>
                    </div>
                    <div class="form-group">
                        <label for="total">Total Price</label>
                        <input type="text" class="form-control" id="total" disabled>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">BUY</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('a.bg-success').on('click', function() {
            let id = $(this).data('id');
            $.ajax({
                url: 'http://localhost/kliniku/public/user/gettotalprice',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id_reg);
                    $('#comp').val(data.complaint);
                    $('#total').val(data.total_price);
                }
            })
        })

        $('.badge.bg-primary').on('click', function() {
            let id = $(this).data('id');
            
            $.ajax({
                url: 'http://localhost/kliniku/public/user/gettotalprice',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    window.location.replace(`http://localhost/kliniku/public/${data.tgl_create_recipe}.pdf`)
                }
            })
        })
    })
</script>