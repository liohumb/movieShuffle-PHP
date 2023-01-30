<?php
    if (!empty($_POST)) {
        $title = trim(strip_tags($_POST['title']));
        $description = trim(strip_tags($_POST['description']));
        $video = trim(strip_tags($_POST['video']));
        $releaseDate = trim(strip_tags($_POST['releaseDate']));
        $duration = trim(strip_tags($_POST['duration']));
    
        $errors = [];
    
        if (empty($title)) {
            $errors['title'] = "Merci de saisir le titre du film";
        }

        if (isset($_FILES["poster"]) && $_FILES["poster"]["error"] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES["poster"]["tmp_name"];
            $fileName = $_FILES["poster"]["name"];
            $fileType = $_FILES["poster"]["type"];

            $fileNameArray = explode(".", $fileName);
            $fileExtension = end($fileNameArray);

            $newFileName = md5($fileName . time()) . "." . $fileExtension;
            $fileDestPath = "./assets/images/poster/{$newFileName}";

            $allowedTypes = array("image/jpeg", "image/png", "image/webp");

            if ($_FILES['poster']['size']) {
                $errors['poster'] = 'La taille du fichier est trop grande';
            }

            if (in_array($fileType, $allowedTypes)) {
                move_uploaded_file($fileTmpPath, $fileDestPath);
            } else {
                $errors["poster"] = "Le type de fichier est incorrect.";
            }
        }

        if (empty($description)) {
            $errors['description'] = 'Merci de saisir un synopsis';
        }

        if ($duration < 0) {
            $errors['duration'] = 'Merci de saisir une durée de film supérieur à 0.';
        }
    
        if (empty($errors)) {
            $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');
            $query = "INSERT INTO movie (title, description, releaseDate, duration, video, poster) 
                                VALUES (:title, :description, :releaseDate, :duration, :video, :poster)";
            $datas = $db->prepare($query);
            $datas->bindParam(':title', $title);
            $datas->bindParam(':description', $description);
            $datas->bindParam(':releaseDate', $releaseDate);
            $datas->bindParam(':duration', $duration, PDO::PARAM_INT);
            $datas->bindParam(':video', $video);
            $datas->bindParam(':poster', $newFileName);

            if ($datas->execute()) {
                header('Location:index.php');
            }
        }
    }
?>

<?php include('templates/header.php') ?>

    <section class="add">
        <div class="add__container">
            <h1 class="add__title">Ajouter un film</h1>
            <form action="" class="add__form" method="POST" enctype="multipart/form-data">
                <div class="add__form-contents">
                    <div class="add__form-content">
                        <label for="title" class="add__form-label">Titre du Film</label>
                        <input type="text" name="title" id="title" class="add__form-input">
                        <span class="add__form-error"><?= $errors['title'] ?? '' ?></span>
                    </div>
                    <div class="add__form-content">
                        <label for="poster" class="add__form-label">Poster du film</label>
                        <input type="file" name="poster" id="poster" class="add__form-input">
                        <span class="add__form-error"><?= $errors['poster'] ?? '' ?></span>
                    </div>
                </div>
                <div class="add__form-content">
                    <label for="description" class="add__form-label">Synopsis fu Film</label>
                    <textarea name="description" id="description" class="add__form-text"></textarea>
                    <span class="add__form-error"><?= $errors['description'] ?? '' ?></span>
                </div>
                <div class="add__form-content">
                    <label for="video" class="add__form-label">Url de la bande annonce</label>
                    <input type="text" name="video" id="video" class="add__form-input">
                </div>
                <div class="add__form-contents">
                    <div class="add__form-content">
                        <label for="releaseDate" class="add__form-label">Date de sortie</label>
                        <input type="date" name="releaseDate" id="releaseDate" class="add__form-input">
                    </div>
                    <div class="add__form-content">
                        <label for="duration" class="add__form-label">Durée du film (en minutes)</label>
                        <input type="number" name="duration" id="duration" class="add__form-input">
                        <span class="add__form-error"><?= $errors['duration'] ?? '' ?></span>
                    </div>
                </div>
                <input type="submit" value="Ajouter le film" class="add__form-submit">
            </form>
        </div>
    </section>

<?php include('templates/footer.php') ?>