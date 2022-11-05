<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">Mi mascota</h2>

            <div class="bg-light-alpha p-5">
                <table class="table">
                    <thead>
                        <th>Imagen</th>
                        <th>Raza</th>
                        <th>Tamaño</th>
                        <th>Observaciones</th>
                        <th>Plan de vacunación</th>
                        <th>Video</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pets as $item) {
                        ?>
                            <tr>
                                <td><img src="<?= FRONT_ROOT . UPLOADS_PATH . $item->getImage() ?>" alt="" width="100"></td>
                                <td><?= $item->getRace() ?></td>
                                <td><?= $item->getSize() ?></td>
                                <td><?= $item->getObservations() ?></td>
                                <td><img src="<?= FRONT_ROOT . UPLOADS_PATH . $item->getVaccination_plan() ?>" alt="" width="100"></td>
                                <td>
                                    <?php
                                    if ($item->getVideo() == null) {
                                    ?>
                                        Sin Video
                                    <?php
                                    } else {
                                    ?>
                                        <a href="<?= FRONT_ROOT . UPLOADS_PATH . $item->getVideo() ?>">Mirar Video</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
                    <br>
                    <li class="nav-item">
                         <a class="btn btn-dark ml-auto d-block" href="<?= FRONT_ROOT ?>owner/ShowNewPet">Nueva mascota</a>
                    </li>
                    <br>
                    <li class="nav-item">
                         <a class="btn btn-dark ml-auto d-block" href="<?= FRONT_ROOT ?>owner/ShowPerfil">Volver a perfil</a>
                    </li>
            </div>
        </div>
    </section>
</main>