<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4"><strong> Ingreso de usuario</strong></h2>
            <form action="<?php echo FRONT_ROOT ?>User/Login" method="post" class="bg-light-alpha p-5">
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Error!</strong> <?= $_SESSION['error'] ?>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Nombre de usuario</label>
                            <input type="text" name="username" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" name="password" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Ingreso</button>
                    <br>
            </form>
                    <button class="btn btn-warning  d-block" href="<?= FRONT_ROOT ?>User/ShowRegister">Nuevo registro</button>

        </div>
    </section>
</main>