<?php

  session_start();
  include("template/header.php");
?>
<div class="p-5 bg-light">
  <div class="container">
    <h1 class="display-3">Huertos Urbanos</h1>
    <h2 class="py-3">Cultiva tus propios alimentos</h2>
    <?php 
      include("includes/slide.php");
    ?>
    <div class="card bg-transparent border-0 text-justify">
      <div class="card-body">
        <div class="px-3">
          <h3>¿Qué es un huerto urbano?</h3>
          <p class="card-text" style="text: justify;text-indent: 40px;">
              Los huertos urbanos son espacios al aire libre o de interior
            (balcones,azoteas, terrazas) destinados al cultivo de verduras,
            hortalizas, frutas, legumbres, plantas aromáticas o hierbas medicinales,
            entre otras, a escala doméstica.
          </p>
          <h3>Un poco de historia</h3>
          <p class="card-text">
              Los primeros huertos urbanos aparecen en el siglo XIX durante la
            revolución industrial para ofrecer a los trabajadores de las fabrican
            alternativas para mejorar la calidad de vida de estos.Fomentados por
            asociaciones benéficas, por la iglesia y por humanistas.
          </p>
          <p class="card-text">
              Posteriormente, en el siglo XX, durante la Primera y Segunda Guerra
            Mundial, ante la escasez de alimentos se sembraban huertos pequeños de
            autoconsumo con los que poder acceder a los alimentos. Se ofertaban por
            parte de las autoridades espacios como parques, jardines, grandes
            espacios naturales y hasta campos de fútbol para poder realzar estos
            pequeños huertos conocidos como Dig for Victory en Gran Bretaña, o
            Victory Gardens en Estados Unidos.
          </p>
          <p class="card-text">
              A partir de los años 70, vuelve a aparecer esta idea local, de integración social y educación ambiental, con la aparición de asociaciones ecologistas y comunitarias. En el momento actual es un instrumento de mejora ambiental y social, colaborando en la sostenibilidad urbana, la contaminación , la lucha contra el cambio climático y la calidad de vida.
          </p>
          <h3>¿Qué alimentos podríamos plantar?</h3>
          <p class="card-text">
              Dependiendo de la época del año y la temperatura anual del lugar donde
            tengamos nuestros huertos urbanos, tenemos los siguientes alimentos:
          </p>
        </div>
      <div class="p-5">
        <?php
                include("includes/alimentos.php");
              ?>
      </div>     
      </div>
    </div>
    
  </div>
</div>
<?php
  include("template/footer.php");
?>
