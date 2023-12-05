<?php 
include __DIR__.'/Views/header.php';
include __DIR__.'/Model/Movie.php';
?>

<section class="container">
  <h2>Movies List</h2>
  <div class="row gy-4 ">
    <?php foreach ($movies as $movie){
      $movie -> printCard();
      // var_dump($movie);
    }       
    ?> 
  </div>
</section>

<?php 
include __DIR__.'/Views/footer.php';
?>
