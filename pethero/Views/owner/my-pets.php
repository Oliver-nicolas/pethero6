<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4"><strong>Mi mascota</strong></h2>

            <div class="bg-light-alpha p-5">
                <table class="table">
                    <thead>
                        <th>Imagen</th>
                        <th>Animal</th>
                        <th>Raza</th>
                        <th>Tamaño</th>
                        <th>Observaciones</th>
                        <th>Plan de vacunación</th>
                        <th>Video</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pet as $item) {
                        ?>
                            <tr>
                                <td><img src="<?= FRONT_ROOT . UPLOADS_PATH . $item->getImage() ?>" alt="" width="100"></td>
                                <td><?= $item->descriptionAnimal() ?></td>
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
                    <div class="container" align="center">             
                         <a class="btn btn-dark " href="<?= FRONT_ROOT ?>owner/ShowNewPet">Nueva mascota</a>                
                           
                         <a class="btn btn-dark " href="<?= FRONT_ROOT ?>owner/ShowPerfil">Volver a perfil</a>
                    </div>
            </div>
        </div>
    </section>
</main>