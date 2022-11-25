<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
            <h2 class="mb-4">My Chats</h2>

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

                <section style="background-color: #eee;">
                    <div class="py-5">

                        <div class="row pl-2 pr-3">

                            <div class="col-md-3 col-lg-3 col-xl-3 mb-4 mb-md-0">

                                <h5 class="font-weight-bold mb-3 text-center text-lg-start">Keepers</h5>

                                <div class="card">
                                    <div class="card-body">

                                        <form action="<?= FRONT_ROOT ?>Owner/NewChat" method="post">
                                            <div class="form-group">
                                                <select class="form-control" name="keeperId">
                                                    <?php
                                                    foreach ($keepers as $keeper) {
                                                    ?>
                                                        <option value="<?= $keeper->getId() ?>"><?= $keeper ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group text-right">
                                                <input class="btn btn-primary" type="submit" value="Create Chat">
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">

                                        <ul class="list-unstyled mb-0">
                                            <?php foreach ($chats as $chat) { ?>
                                                <li class="p-2 border-bottom" <?= $chatId == $chat->getId() ? 'style="background-color: #eee;"' : '' ?>>
                                                    <a href="<?= FRONT_ROOT ?>Owner/ShowMyChats/<?= $chat->getId() ?>" class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row">
                                                            <img src="<?= FRONT_ROOT ?>views/img/user1.png" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                                            <div class="p-1 ">
                                                                <p class="fw-bold mb-0"><?= $chat->getKeeper() ?></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php }  ?>
                                        </ul>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-9 col-lg-9 col-xl-9">

                                <?php if ($chatId != null) { ?>
                                    <div class="mb-5">
                                        <form action="<?= FRONT_ROOT ?>Owner/SendMessage/<?= $chatId ?>" method="post">
                                            <div class="form-outline">
                                                <input type="number" name="chatId" value="<?= $chatId ?>" hidden>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="text">Message</label>
                                                <textarea class="form-control" id="text" name="text" rows="4"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-rounded float-right">Send</button>
                                        </form>
                                    </div>
                                <?php } ?>
                                <ul class="list-unstyled">
                                    <?php
                                    foreach ($messages as $message) {
                                        if ($message->getAutor() == 'Owner') {
                                    ?>
                                            <li class="d-flex justify-content-between mb-4">
                                                <div class="card w-100">
                                                    <div class="card-header d-flex justify-content-between p-3">
                                                        <p class="fw-bold mb-0"><?= $message->getChat()->getOwner() ?></p>
                                                        <p class="text-muted small mb-0"><i class="far fa-clock"></i> <?= $message->getDate() ?></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-0">
                                                            <?= $message->getText() ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <img src="<?= FRONT_ROOT ?>views/img/user2.png" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                            </li>
                                        <?php
                                        } else { ?>
                                            <li class="d-flex justify-content-between mb-4">
                                                <img src="<?= FRONT_ROOT ?>views/img/user1.png" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                                <div class="card w-100">
                                                    <div class="card-header d-flex justify-content-between p-3">
                                                        <p class="fw-bold mb-0"><?= $message->getChat()->getKeeper() ?></p>
                                                        <p class="text-muted small mb-0"><i class="far fa-clock"></i> <?= $message->getDate() ?></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-0">
                                                            <?= $message->getText() ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                    <?php
                                        }
                                    } ?>

                                </ul>

                            </div>

                        </div>

                    </div>
                </section>

            </div>
        </div>
    </section>
</main>