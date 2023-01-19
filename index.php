<?php
    $datas = file_get_contents('data/movies.json');
    $movies = json_decode($datas, true);
?>

<?php include('templates/header.php') ?>

<section class="home">
    <div class="home__container">
        <?php foreach ($movies as $movie) { ?>
            <div class="home__movie">
                <a href="movie.php?id=<?= $movie['id'] ?>" class="home__movie-link">
                    <img src="assets/images/poster/<?= str_replace(' ', '-', $movie['title']) ?>.jpg"
                         alt="<?= $movie['title'] ?>"
                         class="home__movie-poster">
                </a>
            </div>
        <?php } ?>
    </div>
</section>

<?php include('templates/footer.php') ?>