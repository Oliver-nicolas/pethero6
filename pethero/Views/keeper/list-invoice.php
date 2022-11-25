<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">My Invoices</h2>

            <div class="bg-light-alpha p-5">

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
                        <th>ID Invoice</th>
                        <th>Owner</th>
                        <th>Keeper</th>
                        <th>Pet Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>ID Reserve</th>
                        <th class="text-right">State</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($invoices as $item) {
                        ?>
                            <tr>
                                <td><?= $item->getId() ?></td>
                                <td><?= $item->getOwner()->getLastname() ?></td>
                                <td><?= $item->getKeeper()->getLastname() ?></td>
                                <td><?= $item->getPet()->getName() ?></td>
                                <td><?= $item->getReserve()->getStartDate() ?></td>
                                <td><?= $item->getReserve()->getEndDate() ?></td>
                                <td><?= $item->getReserve()->Cupon_generated() ?></td>
                                
                                       
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>