<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">PERFIL DE GUARDIAN</h2>

            <table class="table">

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
                
                    <thead>
                        <th>Nombre:</th>
                        <th>Apellido:</th>
                        <th>Dirección:</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($keeperList as $item) {
                        ?>
                            <tr>
                                
                                <td><?= $item->getName() ?></td>
                                <td><?= $item->getLastname() ?></td>
                                <td><?= $item->getAddress() ?></td>
                               
                                
                            </tr>
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
                <li class="nav-item">
                         <a class="btn btn-dark ml-auto d-block" href="<?= FRONT_ROOT ?>Owner/ShowNewPet">Modificar perfil</a>
                </li>  
            
                <li class="nav-item">
                         <a class="btn btn-dark ml-auto d-block" href="<?= FRONT_ROOT ?>Owner/ShowNewPet">Consultar reservas</a>
                </li>  
            
        </div>
    </section>
</main>
