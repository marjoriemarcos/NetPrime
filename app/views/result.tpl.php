<?php    
$listFilm = $viewData['listFilm'];
$idFilmChosen = $viewData['idMoviesChosen'];

?>

<h1 class="result-title">Résultats de la recherche : <span><?= $idFilmChosen ?></span></h1>
<section class="results">
    <?php foreach ($listFilm as $movie) :  ?>
    <a href="<?= $router->generate('movie', ['id' => $movie->getId()]); ?>" class="movie-result">
        <img src='https://image.tmdb.org/t/p/original/<?= $movie->getPoster_url(); ?>' alt="<?=  $movie->getTitle();   ?>">
        <h3>
    <?=  $movie->getTitle();   ?>	
        </h3>
    </a>
    <?php endforeach;  ?>
</section>