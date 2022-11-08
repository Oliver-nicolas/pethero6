<?php
require_once(VIEWS_PATH . 'nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">PERFIL DE DUEÑO</h2>

            <table class="table">

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
                
                    <thead>
                        <th>Nombre:</th>
                        <th>Apellido:</th>
                        <th>Dirección:</th>
                    </thead>
                    <tbody>
                        <?php     
                        
                         if (isset($_SESSION['user'])) {
                              $user = $_SESSION['user'];
                              
                              foreach ($ownerList as $item) 
                                    if($item->getUser()==$user)
                        ?>
                            <tr>        
                                <td><?= $item->getName() ?></td>
                                <td><?= $item->getLastname() ?></td>
                                <td><?= $item->getAddress() ?></td> 
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                    <br>  
                    <div class="container" align="center">   
                         <a class="btn btn-dark " href="<?= FRONT_ROOT ?>owner/ShowModifyPerfil">Modificar perfil</a>                  
                                 
                         <a class="btn btn-dark " href="<?= FRONT_ROOT ?>owner/ShowNewPet">Nueva mascota</a>                   
                                    
                         <a class="btn btn-dark " href="<?= FRONT_ROOT ?>owner/ShowMyPets">Ver mascota</a>                
                          
                         <a class="btn btn-dark " href="<?= FRONT_ROOT ?>reserve/ShowNewReserve">Crear reserva</a>
                    </div> 
        </div>
    </section>
</main>
