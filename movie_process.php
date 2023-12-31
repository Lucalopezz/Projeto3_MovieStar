<?php

require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");
require_once("globals.php");
require_once("db.php");

$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);
$movieDAO = new MovieDAO($conn, $BASE_URL);


$type = filter_input(INPUT_POST, "type"); // tipo do form

//Resgata dados do usuário, vendo se ele está logado
$userData = $userDAO->verifyToken();

if ($type == 'create') {

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");



    $movie = new Movie();

    //Validação minima de dados
    if (!empty($title) && !empty($description) && !empty($category)) {
        $movie->title = $title;
        $movie->description = $description;
        $movie->trailer = $trailer;
        $movie->category = $category;
        $movie->length = $length;
        $movie->users_id = $userData->id;

        //upload de imagem de filme

        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $image = $_FILES['image'];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpg", "image/jpeg"];

            // Checagem de tipo de imagem
            if (in_array($image["type"], $imageTypes)) {

                // Checar se jpg
                if (in_array($image['type'], $jpgArray)) {

                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                    // Imagem é png
                } else {

                    $imageFile = imagecreatefrompng($image["tmp_name"]);

                }
                $imageName = $movie->imageGenerateName();

                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->image = $imageName;

            } else {
                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

            }

        }
        //print_r($_POST); print_r($_FILES); exit;
        $movieDAO->create($movie);

    } else {
        $message->setMessage("Informações faltando, preencha novamente!", "error", "back");
    }


} else if ($type == 'delete') {

    $id = filter_input(INPUT_POST, "id");

    $movie = $movieDAO->findById($id);
    if ($movie) {
        //verifica se o filme é do usuario
        if ($movie->users_id === $userData->id) {
            $movieDAO->destroy($movie->id);
        } else {
            $message->setMessage("Informações Inválidas", "error", "index.php");

        }
    } else {
        $message->setMessage("Informações Inválidas", "error", "index.php");
    }

} else if ($type == 'update') {
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    $movieData = $movieDAO->findById($id);

    //Verifica se encontrou o filme
    if ($movieData) {
        if ($movieData->users_id === $userData->id) {
            //Validação minima de dados
            if (!empty($title) && !empty($description) && !empty($category)) {
                //edição do filme
                $movieData->title = $title;
                $movieData->description = $description;
                $movieData->trailer = $trailer;
                $movieData->category = $category;
                $movieData->length = $length;

                //upload de imagem de filme
                if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                    $image = $_FILES['image'];
                    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                    $jpgArray = ["image/jpg", "image/jpeg"];

                    // Checagem de tipo de imagem
                    if (in_array($image["type"], $imageTypes)) {

                        // Checar se jpg
                        if (in_array($image['type'], $jpgArray)) {

                            $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                            // Imagem é png
                        } else {

                            $imageFile = imagecreatefrompng($image["tmp_name"]);

                        }
                        $movie = new Movie();
                        $imageName = $movie->imageGenerateName();

                        imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                        $movieData->image = $imageName;

                    } else {
                        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

                    }

                }

                $movieDAO->update($movieData);

            } else {
                $message->setMessage("Informações faltando, preencha novamente!", "error", "back");
            }

        } else {
            $message->setMessage("Informações Inválidas", "error", "index.php");

        }

    } else {
        $message->setMessage("Informações Inválidas", "error", "index.php");
    }

} else {
    $message->setMessage("Informações Inválidas", "error", "index.php");

}