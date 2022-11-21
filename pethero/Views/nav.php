<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Framework</strong>
     </span>
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
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Keeper/ShowPerfil">@<?= $user->getUsername() ?></a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Keeper/ShowPerfil">Home</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Keeper/ShowMyReserves">My Reserves</a>
                    </li>
               <?php
               } elseif ($user->isOwner()) {
               ?>
                    <li class="nav-item">
                         <a class="nav-link" href="#">@<?= $user->getUsername() ?></a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Owner/ShowPerfil">Home</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Owner/ShowMyPets">My Pets</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Owner/ShowNewPet">New Pet</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?= FRONT_ROOT ?>Owner/ShowListKeepers">Booking</a>
                    </li>
               <?php
               }
               ?>
               <li class="btn-outline-danger">
                    <a class="nav-link" href="<?= FRONT_ROOT ?>User/Logout">Log Out</a>
               </li>
          <?php
          } else {
          ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?= FRONT_ROOT ?>User/ShowLogin">Log In</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?= FRONT_ROOT ?>User/ShowRegister">Register</a>
               </li>

          <?php } ?>
     </ul>
</nav>