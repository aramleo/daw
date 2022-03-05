<?php

include('../template/header.php');
require_once 'bFuncion.php'; 
include ('../admin/config/conexion.php');

?>
<div class="header">
  <h2>Blog Name</h2>
</div>

<div class="row">
  <div class="mx-3 vw-100">
    <div class="card">
    <?php
        $posts = getPosts($conn);
        require 'templates/list.php';
    ?>
    </div>
  </div>
</div>
<div class="container mt-3">
  <h2>Paginación</h2>                  
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</div>
<?php
include('../template/footer.php');

?>