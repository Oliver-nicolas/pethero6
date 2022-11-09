<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">New Reserve</h2>
            <form action="<?= FRONT_ROOT ?>Owner/AddReserve" method="post" class="bg-light-alpha p-5" enctype="multipart/form-data">
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

                <div class="row">
                    <input type="number" name="keeperId" value="<?= $keeperId ?>" hidden required>
                </div>  

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Pet <strong class="text-danger">*</strong></label>
                            <select name="petId" class="form-control" required>
                                <?php foreach ($pets as $item) { ?>
                                    <option value="<?= $item->getId() ?>"><?= $item ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Start Date <strong class="text-danger">*</strong></label>
                            <input class="form-control" type="date" name="startDate" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">End Date <strong class="text-danger">*</strong></label>
                            <input class="form-control" type="date" name="endDate" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark ml-auto d-block">Add Reserve</button>

            </form>


        </div>
    </section>
</main>