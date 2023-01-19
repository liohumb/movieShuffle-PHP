<?php
    $datas = file_get_contents('data/movies.json');
    $movies = json_decode($datas, true);
?>

<?php include('templates/header.php') ?>

<section class="home">
    <div class="home__container">
        <?php foreach ($movies as $movie) { ?>
            <div class="home__movie">
                <img src="assets/images/poster/<?= str_replace(' ', '-', $movie['title']) ?>.jpg"
                     alt="<?= $movie['title'] ?>"
                     class="home__movie-poster">
                <div class="home__movie-infos">
                    <a href="movie.php?id=<?= $movie['id'] ?>" class="home__movie-link">
                        <h1 class="home__movie-infos--title"><?= $movie['title'] ?></h1>
                    </a>
                    <span class="home__movie-infos--gender"><?= implode(", ", $movie['genres']) ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php include('templates/footer.php') ?>