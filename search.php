<?php
    $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $query = "SELECT movie.id, movie.title, movie.releaseDate, 
                            GROUP_CONCAT(genre.name SEPARATOR ', ') AS genres 
                            FROM movie JOIN movie_genre ON movie.id = movie_genre.movie_id 
                            JOIN genre ON genre.id = movie_genre.genre_id 
                            WHERE movie.title LIKE :title GROUP BY movie.id, movie.title";
        $datas = $db->prepare($query);
        $datas->bindValue(':title', '%' . $search . '%');
        $datas->execute();
        $movies = $datas->fetchAll();
    }
?>

<section class="search">
    <div class="search__container">
        <?php if(!empty($movies)) { ?>
            <?php foreach ($movies as $movie) { ?>
                <img src="assets/images/poster/<?= str_replace(' ', '-', strtolower($movie['title'])) ?>.jpg"
                     alt="<?= $movie['title'] ?>"
                     class="search__poster">
                <div class="search__infos">
                    <a href="movie.php?id=<?= $movie['id'] ?>" class="search__infos-title">
                        <h1 class="search__infos-title--link"><?= $movie['title'] ?></h1>
                    </a>
                    <span class="search__infos-gender"><?= $movie['genres'] ?></span>
                    <p class="search__infos-description"><?= $movie['description'] ?></p>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>Aucun résultat trouvé pour votre recherche</p>
        <?php } ?>
    </div>
</section>

<?php include ('templates/footer.php') ?>
