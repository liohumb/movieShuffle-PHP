<?php
    $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');

    $query = "SELECT movie.id, movie.title, GROUP_CONCAT(genre.name SEPARATOR ', ') AS genres FROM movie
              JOIN movie_genre ON movie.id = movie_genre.movie_id
              JOIN genre ON genre.id = movie_genre.genre_id
              GROUP BY movie.id";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $movies = $stmt->fetchAll();
?>

<?php include('templates/header.php') ?>

    <section class="home">
        <div class="home__container">
            <?php foreach ($movies as $movie) { ?>
                <div class="home__movie">
                    <img src="assets/images/poster/<?= str_replace(' ', '-', strtolower($movie['title'])) ?>.jpg"
                         alt="<?= $movie['title'] ?>"
                         class="home__movie-poster">
                    <div class="home__movie-infos">
                        <a href="movie.php?id=<?= $movie['id'] ?>" class="home__movie-link">
                            <h1 class="home__movie-infos--title"><?= $movie['title'] ?></h1>
                        </a>
                        <span class="home__movie-infos--gender"><?= $movie['genres'] ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

<?php include('templates/footer.php') ?>