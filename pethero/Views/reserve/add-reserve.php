<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Nueva Reserva</h2>
            <form action="<?php echo FRONT_ROOT ?>reserve/Update" method="post" class="bg-light-alpha p-5" enctype="multipart/form-data">

                <?php if (isset($_SESSION['error'])) { ?>
                   
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Error!</strong> <?= $_SESSION['error'] ?>
                    </div>

                <?php } ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <h4 class="mb-4">Lista de Guardianes</h4>

                                <div >
                                    <table class="table">
                                        <thead>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Direccion</th>
                                            <th>Tamaño de mascota</th>
                                            <th>Precio por dia</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($keeperList as $item) {
                                            ?>
                                                <tr>
                                                    <td><?= $item->getName() ?></td>
                                                    <td><?= $item->getLastName() ?></td>
                                                    <td><?= $item->getAddress() ?></td>
                                                    <td><?= $item->descriptionSizePet() ?></td>
                                                    <td><?= $item->getPrice() ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <label for="">Ingrese guardian <strong class="text-danger">*</strong></label>
                            <input type="text" name="selKeeper" value="" class="form-control" required>
                        
                    
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Ingrese mascota <strong class="text-danger">*</strong></label>
                                    <input type="text" name="selPet" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!--<div class="container px-1 px-sm-5 mx-auto">
                                        <form autocomplete="off">
                                            <div class="flex-row d-flex justify-content-center">
                                            <div class="col-lg-6 col-11 px-1">
                                                <div class="input-group input-daterange">
                                                <input type="text" id="start" class="form-control text-left mr-2">
                                                <label class="ml-3 form-control-placeholder" id="start-p" for="start">Start Date</label>
                                                <span class="fa fa-calendar" id="fa-1"></span>
                                                <input type="text" id="end" class="form-control text-left ml-2">
                                                <label class="ml-3 form-control-placeholder" id="end-p" for="end">End Date</label>
                                                <span class="fa fa-calendar" id="fa-2"></span>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                    </div>-->
                                    <label for="">Fecha de inicio <strong class="text-danger">*</strong></label>
                                    <input type="date" name="startDate" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Fecha final <strong class="text-danger">*</strong></label>
                                    <input type="date" name="endDate" value="" class="form-control" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark ml-auto d-block">Validar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>