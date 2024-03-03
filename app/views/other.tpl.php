<?php    
$listFilmByActor = $viewData['listFilmByActor'];
$actorChoosen = $viewData['actorChoosen'];

?>

<h1 class="result-title">Les films de : <span><?= $actorChoosen->getName() ?></span></h1>
<section class="results">
    <?php foreach ($listFilmByActor as $movie) :  ?>
    <a href="<?= $router->generate('movie', ['id' => $movie->getId()]); ?>" class="movie-result">
        <img src='https://image.tmdb.org/t/p/original/<?= $movie->getPoster_url(); ?>' alt="<?=  $movie->getTitle();   ?>">
        <h3>
    <?=  $movie->getTitle();   ?>	
        </h3>
    </a>
    <?php endforeach;  ?>
</section>