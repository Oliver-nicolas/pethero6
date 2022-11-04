<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">RESERVAS</h2>

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
                        <tr>
                            <th>Guardian:</th>
                            <th>Mascota:</th>
                            <th>Fecha de inicio:</th>
                            <th>Fecha final:</th>
                            <th>Estado de operacion:</th>
                            <th>Cupon:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reserveList as $item) {
                        ?>
                            <tr>
                                
                                <td><?= $item->getKeeper() ?></td>
                                <td><?= $item->getPet() ?></td>
                                <td><?= $item->getStartDate() ?></td>
                                <td><?= $item->getEndDate() ?></td>
                                <td><?= $item->getAccepted() ?></td>
                                <td><?= $item->getCupon_generated() ?></td>
        
                            </tr>
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
                <br>
                <li class="nav-item">
                         <a class="btn btn-dark ml-auto d-block" href="<?= FRONT_ROOT ?>keeper/ShowModifyReserve">Modificar reserva</a>
                </li>  
            
        </div>
    </section>
</main>
