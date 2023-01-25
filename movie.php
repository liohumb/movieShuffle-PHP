<?php
    function convertTime($duration): string
    {
        $hours = floor($duration / 60);
        $minutes = $duration % 60;
        return "{$hours} h {$minutes} min";
    }

    $id = false;
    $data = array('title' => 'Film Introuvable');

    if (isset($_GET['id'])) {
        $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');
        $query = "SELECT movie.id, movie.title, movie.description, movie.releaseDate, movie.duration, movie.video, GROUP_CONCAT(genre.name SEPARATOR ', ') AS genres FROM movie
                      JOIN movie_genre ON movie.id = movie_genre.movie_id
                      JOIN genre ON genre.id = movie_genre.genre_id
                      WHERE movie.id = :id
                      GROUP BY movie.id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $data = $stmt->fetch();

        if(!empty($data)){
            $data['duration'] = convertTime($data['duration']);
            $id = true;
        }else{
            $data = array('title' => 'Film Introuvable');
        }
    }
?>

<?php include('templates/header.php') ?>

<section class="movie">
    <div class="movie__container">
        <img src="assets/images/poster/<?= str_replace(' ', '-', $data['title']) ?>.jpg"
             alt="<?= $data['title'] ?>" class="movie__poster">
        <div class="movie__content">
            <div class="movie__content-infos">
                <span class="movie__content-year"><?= substr($data['releaseDate'], 0, 4) ?></span>
                <h1 class="movie__content-title"><?= $data['title'] ?></h1>
            </div>
            <p class="movie__content-description"><?= $data['description'] ?></p>
            <div class="movie__content-infos">
                <span class="movie__content-gender"><?= $data['genres'] ?></span>
                <span class="movie__content-info">
                    <?= $data['duration'] ?>
                    -
                    <?= date('d/m/Y', strtotime($data['releaseDate'])) ?>
                </span>
            </div>
            <a href="<?= $data['video'] ?>" target="_blank" class="movie__content-button">Bande annonce</a>
        </div>
    </div>
</section>