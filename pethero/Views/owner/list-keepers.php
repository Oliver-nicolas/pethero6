<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">Lista de Guardianes</h2>

            <div class="bg-light-alpha p-5">
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
                        foreach ($keepers as $item) {
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
        </div>
    </section>
</main>