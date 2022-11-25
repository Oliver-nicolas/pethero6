<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Send Payment</h2>
            <div class="bg-light-alpha p-5">

                <?php if (isset($_SESSION['error_pay'])) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Error!</strong> <?= $_SESSION['error_pay'] ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION['success_pay'])) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Success!</strong> <?= $_SESSION['success_pay'] ?>
                    </div>
                <?php } ?>

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
                <?php if (!$paid) { ?>
                    <form action="<?= FRONT_ROOT ?>Home/SendPayment" method="post">
                        <input type="number" name="cuponId" value="<?= $cupon->getId() ?>" hidden>

                        <button type="submit" class="btn btn-danger ml-auto d-block">Send Payment</button>
                    </form>
                <?php } ?>
            </div>



        </div>
    </section>
</main>