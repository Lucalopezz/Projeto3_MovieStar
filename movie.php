<?php 
    require_once("templates/header.php");

    require_once("dao/MovieDAO.php");
    require_once("models/Movie.php");

    //pegar o id do filme

    $id = filter_input(INPUT_GET, "id");
    $movie;

    $movieDAO = new MovieDAO($conn, $BASE_URL);

    if (empty($id)) {
        $message->setMessage("Filme não encontrado!", "error", "index.php");
        
    }else{
        $movie = $movieDAO->findById($id);

        // verifica se o filme existe
        if (!$movie) {
            $message->setMessage("Filme não encontrado!", "error", "index.php");
            
        }
    }
    //checar se o filme tem imagem
    if($movie->image == ""){
        $movie->image = "movie_cover.jpg";
    }

    //checar se o usuario é dono do filme

    $userOwnsMovie = false;
    if(empty($userData)){
        if($userData->id === $movie->users_id){
            $userOwnsMovie = true;

        }
    }

    //resgatar as reviews do filme


?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title"><?=$movie->title?></h1>
            <p class="movie-datails">
                <span>Duração: <?=$movie->length?></span>
                <span class="pipe"><?=$movie->category?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"   ></i>9</span>
            </p>
            <iframe src="<?=$movie->trailer?>" width="560" height="315" frameboarder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p><?=$movie->description?></p>
            
        </div>
        <div class="col-md-4">
            <div class="movie-image-container" style="background-image: url(<?=$BASE_URL?>img/movies/<?=$movie->image?>);"></div>       
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Avaliações</h3>
            <!-- Verifica se habilita a review para o usuario logado -->
            <div class="col-md-12" id="form-container">
                <h4>Envie sua avaliação:</h4>
                <p class="page-description">Preencha o form com a nota e comentário sobre o filme</p>
                <form action="<?=$BASE_URL?>review_process.php" method="post" id="review-form-id">
                    <input type="hidden" name="type" value="create" >
                    <input type="hidden" name="movies_id" value="<?=$movie->id?>" >
                    <div class="form-group">
                        <label for="rating">Nota do filme:</label>
                        <select class="form-control" name="rating" id="rating">
                            <option value="">Selecione</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Seu comentário:</label>
                        <textarea name="review" id="review"  rows="3" placeholder="Deixe seu comentário" class="form-control"></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Enviar comentário">

                </form>
            </div>
            <div class="col-md-12 review">
                <div class="row">
                    <div class="col-md-1">
                        <div class="profile-image-container review-image" style="background-image: url('img/users/user.png"></div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="author-name"><a href="#">Lucas</a></h4>
                        <p><i class="fas fa-star"></i>9</p>
                    </div>
                    <div class="col-md-12">
                        <p class="comment-title">Comentário:</p>
                        <p>Teste</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once("templates/footer.php");