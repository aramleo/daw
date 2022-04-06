<?php
session_start();
include 'template/header.php';
require_once 'config/funcionesBlog.php';

$llamada = new FuncionesBlog;

?>
<div class="header text-center my-5">
  <h2>Blog Huertos Urbanos</h2>
</div>

<div class="row">
  <div class="mx-3 vw-100">
    <div class="card-title">
      <?php
      $posts = $llamada->getPosts();
      require 'blog/lista.php';
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
include('template/footer.php');
?>