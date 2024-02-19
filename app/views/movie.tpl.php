    <?php  
    
    $movieChoosen = $viewData['movieChoosen'];
    $directorChoosen = $viewData['directorChoosen'];
    $composerChoosen = $viewData['composerChoosen'];
    $actorChoosen = $viewData['actorChoosen'];
    $year = date('Y', strtotime($movieChoosen->getRelease_date()));
   
    ?>
    
    <main>
        <div class="container">
            <div class="movie-wrapper">

                <section class="poster">
                    <img src='https://image.tmdb.org/t/p/original/<?= $movieChoosen->getPoster_url(); ?>' alt="<?=  $movieChoosen->getTitle(); ?>">
                    <i class="fa-regular fa-circle-play"></i>
                </section>
                <section class="details">
                    <h1 class="movie-title"><?=  $movieChoosen->getTitle(); ?></h1>
                    <div class="movie-meta">
                        <div class="date"><?=  $year; ?></div>
                        <div class="rating"><i class="fa-solid fa-star"></i> <span><?=  $movieChoosen->getRating(); ?></span> / 10</div>
                    </div>
                    <div class="movie-synopsis">
                    <?=  $movieChoosen->getSynopsis(); ?>
                    </div>
                    <div class="crew">
                        <div class="real">
                            <h2><i class="fa-solid fa-film"></i> Réalisateur</h2>
                                <a href="<?= $router->generate('other', ['id' => $directorChoosen->getId()]); ?>">
                                    <img src="https://image.tmdb.org/t/p/original/<?=  $directorChoosen->getPicture_url(); ?>" alt="<?=  $directorChoosen->getName(); ?>">
                                </a>
                                <a href="<?= $router->generate('other', ['id' => $directorChoosen->getId()]); ?>">
                                    <h3><?=  $directorChoosen->getName(); ?></h3>
                                </a>
                        </div>
                        <div class="composer">
                            <h2><i class="fa-solid fa-music"></i> Compositeur</h2>
                            <?php if (!($composerChoosen == false)) : ?>
                                <a href="<?= $router->generate('other', ['id' => $composerChoosen->getId()]); ?>">
                                    <img src="https://image.tmdb.org/t/p/original/<?=  $composerChoosen->getPicture_url(); ?>" alt="<?=  $composerChoosen->getName(); ?>">
                                </a>
                                <a href="<?= $router->generate('other', ['id' => $composerChoosen->getId()]); ?>">
                                    <h3><?=  $composerChoosen->getName(); ?></h3>
                                </a>
                                
                            <?php else : ?>
                                <h3>Pas de compositeur</h3>
                            <?php endif ; ?>
                        </div>
                    </div>
                    <div class="actors">
                        <h2><i class="fa-solid fa-clapperboard"></i> Acteurs</h2>
                        <ul>
                            <?php foreach($actorChoosen as $actor) : ?>
                                <?php if ($actor->getPicture_url() == NULL) : ?>
                                    <li>
                                        <h3><?=  $actor->getName(); ?></h3>
                                    </li>
                                    <?php else: ?>
                                    <li>
                                        <a href="<?= $router->generate('other', ['id' => $actor->getId()]); ?>">
                                            <img src="https://image.tmdb.org/t/p/original/<?=  $actor->getPicture_url(); ?>" alt="<?=  $actor->getName(); ?>">
                                        </a>
                                        <h3><?=  $actor->getName(); ?></h3>
                                    </li>
                                    <?php endif; ?>
                             <?php endforeach  ?>
                        </ul>
                    </div>
                </section>
            </div>
        </div>


