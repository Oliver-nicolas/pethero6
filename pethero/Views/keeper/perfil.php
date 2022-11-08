<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">PERFIL DE GUARDIAN</h2>
            <form action="<?php echo FRONT_ROOT ?>keeper/Update" method="post" class="bg-light-alpha p-5">
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Nombre <strong class="text-danger">*</strong></label>
                            <input type="text" name="name" value="<?= $keeper->getName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Apellido <strong class="text-danger">*</strong></label>
                            <input type="text" name="lastname" value="<?= $keeper->getLastname() ?>" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Dirección <strong class="text-danger">*</strong></label>
                            <input type="text" name="address" value="<?= $keeper->getAddress() ?>" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!--<div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Start Date <strong class="text-danger">*</strong></label>
                            <input type="date" name="startDate" max="<?= $keeper->getEndDate()?>" min="<?php echo date('Y-m-d') ?>" value="<?= $keeper->getStartdate() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">End Date <strong class="text-danger">*</strong></label>
                                <?php
                                if ($keeper->getStartDate()!=null) {
                                ?>
                                    <input type="date" name="endDate" min="<?=$keeper->getStartdate()?>" value="<?= $keeper->getEndDate() ?>" class="form-control" required>
                                <?php
                                } else {
                                ?>
                                    <input type="date" name="endDate" min="<?php echo date('Y-m-d') ?>" value="<?= $keeper->getEndDate() ?>" class="form-control" required>
                                <?php
                                }
                                ?>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Days (Optional)</label>
                            <input type="text" name="days" value="<?= $keeper->getDays() ?>" class="form-control">
                        </div>
                    </div>
                </div>-->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Precio por dia <strong class="text-danger">*</strong></label>
                            <input type="number" name="price" step="0.01" min="0" value="<?= $keeper->getPrice() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Tamaño de mascota</label><br>
                            <div class="form-control">
                                <?php
                                if ($keeper->checkSizePet('Pequeña')) {
                                ?>
                                    <input class="ml-2" type="checkbox" name="Pequeña" value="Pequeña" checked> Pequeña
                                <?php
                                } else {
                                ?>
                                    <input class="ml-2" type="checkbox" name="Pequeña" value="Pequeña"> Pequeña
                                <?php
                                }
                                ?>

                                <?php
                                if ($keeper->checkSizePet('Media')) {
                                ?>
                                    <input class="ml-2" type="checkbox" name="Media" checked> Media
                                <?php
                                } else {
                                ?>
                                    <input class="ml-2" type="checkbox" name="Media"> Media
                                <?php
                                }
                                ?>

                                <?php
                                if ($keeper->checkSizePet('Grande')) {
                                ?>
                                    <input class="ml-2" type="checkbox" name="Grande" checked> Grande
                                <?php
                                } else {
                                ?>
                                    <input class="ml-2" type="checkbox" name="Grande"> Grande
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                /*
                               $date1=date_create($keeper->getStartDate());
                                $date2=date_create($keeper->getEndDate());
                                if ($diff=date_diff($date1,$date2)==false) {
                                    $keeper->setEndDate($keeper->getStartDate());
                                }
                                */
                                ?>
                <button type="submit" class="btn btn-dark ml-auto d-block">Actualizar</button>

            </form>
                              
            
        </div>
    </section>
</main>