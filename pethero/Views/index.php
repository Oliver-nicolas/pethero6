<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5 ">
          <div class="container text-center">
               <h1 class="bg-light-alpha p-8 text-black">BIENVENIDO A LA GUARDERIA ANIMAL</h1>
               <br><br>
               <img src="Views\img\logo.png" class="w-50" alt="logo">
               <br><br>
          </div>
          <div class="container text-center bg-light-alpha">
               <h3>¿Qué Ofrecemos?</h3>    
               <p> En Pet Hero tenemos un solo objetivo: hacer las cosas bien.
               Nos esforzamos para brindar un servicio de alta calidad y a la medida de sus necesidades.
               Queremos ser su aliado en la educación y el cuidado de su mascota, ofreciéndole una amplia 
               gama de servicios a domicilio y en nuestro exclusivo campo en Mar del Plata.</p>
               <h3>Nuestros Valores</h3>   
               <ul>           
               <li> Creemos en la ética como elemento esencial de la vida, en todos sus ámbitos.</li>
               <li> Creemos en la dignidad y en el respeto a las personas.</li>
               <li> Creemos en el cuidado y amor a los animales.</li>
               </ul> 
               <br><br>
          </div>
          <div class="container text-center">
               <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                         <img src="Views\img\pyg1.png" class=" w-80" alt="...">
                    </div>
                    <div class="carousel-item">
                         <img src="Views\img\pyg2.png" class="w-80" alt="...">
                    </div>
                    <div class="carousel-item">
                         <img src="Views\img\pyg3.png" class=" w-80" alt="...">
                    </div>
               </div>
          </div>
                <h1 class="m-4 bg-light-alpha p-8 text-black">Si desea contratar nuestros servicios, registre sus datos a continuacion o ingrese como usuario</h1>
          <div>
               <br>
                    <a class="btn btn-dark ml-auto d-block" href="<?php echo FRONT_ROOT . "User/ShowLogin"?>">Ingreso usuario</a>
              
               <br>
                    <a class="btn btn-dark ml-auto d-block" href="<?php echo FRONT_ROOT . "User/ShowRegister"?>">Registro</a>
               
          </div>    
         
     </section>
</main>