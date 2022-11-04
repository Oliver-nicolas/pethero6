<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Nueva Reserva</h2>
            <form action="<?php echo FRONT_ROOT ?>reserve/Register" method="post" class="bg-light-alpha p-5">

                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Error!</strong> <?= $_SESSION['error'] ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Ingrese guardian <strong class="text-danger">*</strong></label>
                            <input type="text" name="selKeeper" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Ingrese mascota <strong class="text-danger">*</strong></label>
                            <input type="text" name="selPet" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Fecha de inicio <strong class="text-danger">*</strong></label>
                            <input type="date" name="startDate" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Fecha final <strong class="text-danger">*</strong></label>
                            <input type="date" name="endDate" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Validar</button>
            </form>
        </div>
    </section>
</main>