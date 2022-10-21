<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">Keepers</h2>

            <div class="bg-light-alpha p-5">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Address</th>
                        <th>Size Pet</th>
                        <th>Price</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Days</th>
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
                                <td><?= $item->getStartDate() ?></td>
                                <td><?= $item->getEndDate() ?></td>
                                <td><?= empty($item->getDays()) ? '-' : $item->getDays() ?></td>
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