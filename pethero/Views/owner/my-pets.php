<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">My Pets</h2>

            <div class="bg-light-alpha p-5">
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Race</th>
                        <th>Pet Type</th>
                        <th>Size</th>
                        <th>Observations</th>
                        <th>Vaccination plan</th>
                        <th>Video</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pets as $item) {
                        ?>
                            <tr>
                                <td><img src="<?= FRONT_ROOT . UPLOADS_PATH . $item->getImage() ?>" alt="" width="100"></td>
                                <td><?= $item->getRace() ?></td>
                                <td><?= $item->getPetType() ?></td>
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
                                        <a href="<?= FRONT_ROOT . UPLOADS_PATH . $item->getVideo() ?>">Watch Video</a>
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
            </div>
        </div>
    </section>
</main>