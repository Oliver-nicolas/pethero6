<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Owner Perfil</h2>
            <form action="<?= FRONT_ROOT ?>User/Register" method="post" class="bg-light-alpha p-5">
            
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
                            <label for="">Name <strong class="text-danger">*</strong></label>
                            <input type="text" name="name" value="<?= $owner->getName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Lastname <strong class="text-danger">*</strong></label>
                            <input type="text" name="lastname" value="<?= $owner->getLastname() ?>" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Address <strong class="text-danger">*</strong></label>
                            <input type="text" name="address" value="<?= $owner->getAddress() ?>" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Email <strong class="text-danger">*</strong></label>
                            <input type="email" name="email" value="<?= $owner->getEmail() ?>" class="form-control" required>
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
                <button type="submit" class="btn btn-dark ml-auto d-block">Update</button>

            </form>

            
        </div>
    </section>
</main>