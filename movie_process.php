<?php 

require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");
require_once("globals.php");
require_once("db.php");

$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);


$type = filter_input(INPUT_POST, "type"); // tipo do form

//Resgata dados do usuário, vendo se ele está logado
$userData = $userDAO->verifyToken();

if($type == 'create'){

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    


    $movie = new Movie();

    //Validação minima de dados
    if(!empty($title) && !empty($description)){
        $movie->title = $title;
        $movie->description = $description;
        $movie->trailer = $trailer;
        $movie->category = $category;
        $movie->length = $length;

        //upload de imagem de filme

        if(isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])){
            $image = $_FILES['image'];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpg", "image/jpeg"];
            
            // Checagem de tipo de imagem
            if(in_array($image["type"], $imageTypes)) {
    
                // Checar se jpg
                if(in_array($image['type'], $jpgArray)) {
        
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
        
                // Imagem é png
                } else {
        
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
        
                }
                $imageName = $movie->imageGenerateName();
  
                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
        
                $movie->image = $imageName;

            }else{
                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
      
            }

        }
        //print_r($_POST); print_r($_FILES); exit;
        $movieDAO->create($movie);

    }else{
        $message->setMessage("Informações faltando, preencha novamente!", "error", "back");
    }
    

}else{
    $message->setMessage("Informações Inválidas", "error", "index.php");

}
