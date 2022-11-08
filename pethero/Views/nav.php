<nav class="navbar navbar-expand-lg sticky-lg-top navbar-dark bg-dark" >
     <li class="nav-item">
          <a class="nav-link" href="<?= FRONT_ROOT ?>user/Logout">Guarderia Animal Pet Hero</a>
     </li>
     <ul class="navbar-nav ml-auto">
          <?php
          $user = null;
          if (isset($_SESSION['user'])) {
               $user = $_SESSION['user'];
          }

          if ($user != null) {
               if ($user->isAdmin()) {
               } elseif ($user->isKeeper()) {
               ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>keeper/ShowPerfil">@<?= $user->getUsername() ?></a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Keeper/ShowMyReserves">My Reserves</a>
                    </li>
               <?php
               } elseif ($user->isOwner()) {
               ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>owner/ShowPerfil">@<?= $user->getUsername() ?></a>
                    </li>
                    <!--<li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Owner/ShowMyPets">Mis mascotas</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Owner/ShowNewPet">New Pet</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Owner/ShowListKeepers">List Keepers</a>
                    </li>-->
               <?php
               }
               ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?= FRONT_ROOT ?>user/Logout">Cerrar Sesión</a>
               </li>
          <?php
          } else {
          ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "User/ShowLogin"?>">Ingreso</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT . "User/ShowRegister"?>">Registro</a>
               </li>

          <?php } ?>
     </ul>
</nav>