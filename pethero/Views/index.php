<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="inicio">
          <div class="container text-center bg-light-alpha">
               <h1><strong> BIENVENIDO A LA GUARDERIA ANIMAL</strong></h1>
               <br><br>
               <img src="Views\img\logo.png" style= " border-radius: 10px;" class="w-50" alt="logo">
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
          
               <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                         <div class="carousel-item active">
                              <img src="Views\img\pyg1.png" style= " border-radius: 10px;" class=" w-80" alt="...">
                         </div>
                         <div class="carousel-item">
                              <img src="Views\img\pyg2.png" style= " border-radius: 10px;" class="w-80" alt="...">
                         </div>
                         <div class="carousel-item">
                              <img src="Views\img\pyg3.png" style= " border-radius: 10px;" class=" w-80" alt="...">
                         </div>
                    </div>
               </div>     
               <br><br>
          
          <div class="bg-light-alpha">
                <h1 class=" p-8 text-black">Si desea contratar nuestros servicios, registre sus datos a continuacion o ingrese como usuario</h1>
          
               <br>
                    <a class="btn btn-dark" href="<?php echo FRONT_ROOT . "User/ShowLogin"?>">Ingreso usuario</a>
            
                    <a class="btn btn-dark" href="<?php echo FRONT_ROOT . "User/ShowRegister"?>">Registro</a> 
          </div>       
     </section>
</main>