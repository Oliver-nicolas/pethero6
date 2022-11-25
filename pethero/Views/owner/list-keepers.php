<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">Keepers</h2>

            <div class="bg-light-alpha p-5">

                <form action="<?= FRONT_ROOT ?>Owner/ShowListKeepers" method="get">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <div class="col-auto">
                                <input class="form-control" type="date" name="startDate" value="<?= $startDate ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <div class="col-auto">
                                <input class="form-control" type="date" name="endDate" value="<?= $endDate ?>">
                            </div>
                        </div>
                        <input class="btn btn-dark" type="submit" value="Search">
                    </div>
                </form>

                <table class="table mt-5">
                    <thead>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Address</th>
                        <th>Size Pet</th>
                        <th>Price</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Days</th>
                        
                        <th></th>
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
                                <td><?= $item->getDays() ?></td>
                              
                                <td class="text-right">
                                    
                                    <a class="btn btn-warning" href="<?= FRONT_ROOT ?>Owner/ShowNewReserve/<?= $item->getId() ?>">Reserve</a>
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