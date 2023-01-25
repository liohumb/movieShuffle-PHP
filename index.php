<?php
    $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');

    $query = "SELECT movie.id, movie.title, 
                GROUP_CONCAT(genre.name SEPARATOR ', ') AS genres 
                FROM movie JOIN movie_genre ON movie.id = movie_genre.movie_id 
                    JOIN genre ON genre.id = movie_genre.genre_id 
                    GROUP BY movie.id, movie.title 
                    ORDER BY movie.id DESC LIMIT 10";

    $datas = $db->prepare($query);
    $datas->execute();
    $movies = $datas->fetchAll();
?>

<?php include('templates/header.php') ?>

    <section class="home">
        <div class="home__container">
            <?php if(isset($movies)){
                foreach ($movies as $movie) { ?>
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
                <?php }
            }else{
                echo "Aucun film trouvé";
            }?>
        </div>
    </section>

<?php include('templates/footer.php') ?>