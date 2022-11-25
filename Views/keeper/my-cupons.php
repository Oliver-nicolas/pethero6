<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">My Cupons</h2>

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

                <div class="text-right">
                    <a class="btn btn-primary" href="<?= FRONT_ROOT ?>Keeper/ShowNewCupon">Generate Cupon</a>
                </div>

                <table class="table mt-3">
                    <thead>
                        <th>Cupon Number</th>
                        <th>CBU / CVU</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Owner Email</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cupons as $item) {
                        ?>
                            <tr>
                                <td><?= $item->getNroCupon() ?></td>
                                <td><?= $item->getCredit_card() ?></td>
                                <td><?= $item->getDate() ?></td>
                                <td><?= $item->getPrice() ?></td>
                                <td><?= $item->getOwnerEmail() ?></td>
                                <td class="text-right">
                                    <div class="row ml-3">
                                    <form action="<?= FRONT_ROOT ?>Keeper/DeleteCupon" method="post">
                                        <input type="number" name="cuponId" value="<?= $item->getId() ?>" hidden>
                                        <input class="btn btn-danger mr-1" type="submit" value="Delete">
                                    </form>
                                    <form action="<?= FRONT_ROOT ?>Keeper/SendCuponByEmail" method="post">
                                        <input type="number" name="cuponId" value="<?= $item->getId() ?>" hidden>
                                        <input class="btn btn-warning" type="submit" value="Send by email">
                                    </form>
                                    </div>
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