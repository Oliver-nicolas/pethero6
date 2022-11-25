<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">New Cupon</h2>
            <div class="bg-light-alpha p-5">
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Error!</strong> <?= $_SESSION['error'] ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Success!</strong> <?= $_SESSION['success'] ?>
                    </div>
                <?php } ?>

                <?php if ($nroCupon == null) { ?>

                    <form action="<?= FRONT_ROOT ?>Keeper/GenerateCupon" method="post">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">CBU / CVU <strong class="text-danger">*</strong></label>
                                    <input type="text" name="credit_card" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary ml-auto d-block">Create Cupon</button>

                    </form>
                <?php } else { ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Cupon Number <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" value="<?= $cupon->getNroCupon() ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Date <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" value="<?= $cupon->getDate() ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Price <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" value="<?= $cupon->getPrice() ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">CBU / CVU <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" value="<?= $cupon->getCredit_card() ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Owner email <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" value="<?= $cupon->getOwnerEmail() ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <form action="<?= FRONT_ROOT ?>Keeper/AddReserveToCupon" method="post">

                        <input type="number" name="cuponId" value="<?= $cupon->getId() ?>" hidden>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Reserve <strong class="text-danger">*</strong></label>
                                    <select name="reserveId" class="form-control" required>
                                        <?php foreach ($reserves as $item) { ?>
                                            <option value="<?= $item->getId() ?>"><?= $item ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary ml-auto d-block">Add reserve to cupon</button>

                    </form>
                <?php } ?>

                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead>
                            <th>Reserves</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($details as $item) {
                            ?>
                                <tr>
                                    <td><?= $item->getReserve() ?></td>
                                    <td class="text-right">
                                        <form action="<?= FRONT_ROOT ?>Keeper/DeleteReserveToCupon" method="post">
                                            <input type="number" name="cuponDetailId" value="<?= $item->getId() ?>" hidden>
                                            <input class="btn btn-danger" type="submit" value="Remove">
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>