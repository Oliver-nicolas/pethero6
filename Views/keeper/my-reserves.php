<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">My Reserves</h2>

            <div class="table-responsive bg-light-alpha p-5">

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

                <table class="table mt-3">
                    <thead>
                        <th>Image</th>
                        <th>Race</th>
                        <th>Pet Type</th>
                        <th>Size</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Video</th>
                        <th>State</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reserves as $item) {
                        ?>
                            <tr>
                                <td><img src="<?= FRONT_ROOT . UPLOADS_PATH . $item->getPet()->getImage() ?>" alt="" width="100"></td>
                                <td><?= $item->getPet()->getRace() ?></td>
                                <td><?= $item->getPet()->getPetType() ?></td>
                                <td><?= $item->getPet()->getSize() ?></td>
                                <td><?= $item->getStartDate() ?></td>
                                <td><?= $item->getEndDate() ?></td>
                                <td>
                                    <?php
                                    if ($item->getPet()->getVideo() == null) {
                                    ?>
                                        Without Video
                                    <?php
                                    } else {
                                    ?>
                                        <a href="<?= FRONT_ROOT . UPLOADS_PATH . $item->getPet()->getVideo() ?>">Watch Video</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($item->getState() != 'Waiting') {
                                        echo $item->getState();
                                    } else {
                                    ?>
                                        <div class="row pl-3">
                                            <form action="<?= FRONT_ROOT ?>Keeper/AcceptReserve" method="post">
                                                <input type="number" name="reserveId" value="<?= $item->getId() ?>" hidden>
                                                <input class="btn btn-warning mr-1" type="submit" value="Accept">
                                            </form>
                                            <form action="<?= FRONT_ROOT ?>Keeper/DeclineReserve" method="post">
                                                <input type="number" name="reserveId" value="<?= $item->getId() ?>" hidden>
                                                <input class="btn btn-danger" type="submit" value="Decline">
                                            </form>
                                        </div>
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