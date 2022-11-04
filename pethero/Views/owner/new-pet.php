<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Nueva mascota</h2>
            <form action="<?php echo FRONT_ROOT ?>Owner/AddPet" method="post" class="bg-light-alpha p-5" enctype="multipart/form-data">
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
                            <label for="">Raza <strong class="text-danger">*</strong></label>
                            <input type="text" name="race" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Tamaño <strong class="text-danger">*</strong></label>
                            <select name="size" class="form-control">
                                <option value="Small">Pequeño</option>
                                <option value="Medium">Mediano</option>
                                <option value="Big">Grande</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Observaciones <strong class="text-danger">*</strong></label>
                            <textarea name="observations" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Imagen <strong class="text-danger">*</strong></label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Plan de vacunación <strong class="text-danger">*</strong></label>
                            <input type="file" name="vaccination_plan" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Video</label>
                            <input type="file" name="video" class="form-control">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark ml-auto d-block">Ingresar Mascota</button>

            </form>


        </div>
    </section>
</main>