<?php 
    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");

    //dao dos filmes
    $movieDAO = new MovieDAO($conn, $BASE_URL);

    $lastesMovies = $movieDAO->getLatestMovies();

    $actionMovies = $movieDAO->getMoviesByCategory("Ação");

    $ficMovies = $movieDAO->getMoviesByCategory("Ficção");
    $comedyMovies = $movieDAO->getMoviesByCategory("Comédia");



?>
    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Filmes Novos</h2>
        <p class="section-desciption">
            Veja as críticas dos últimos filmes adicionados
        </p>
        <div class="movies-container">

            <?php foreach($lastesMovies as $movie):?>
                <?php require('templates/movie_card.php');?>
            <?php endforeach;?>
            <?php if(count($lastesMovies) == 0):?>
                <p class="empty-list">Não há filmes cadastrados</p>
            <?php endif;?>
        </div>

        <h2 class="section-title">Ação</h2>
        <p class="section-desciption">
            Veja os melhores filmes de ação
        </p>
        <div class="movies-container">
            <?php foreach($actionMovies as $movie):?>
                <?php require('templates/movie_card.php');?>
            <?php endforeach;?>
            <?php if(count($actionMovies) == 0):?>
                <p class="empty-list">Não há filmes de ação cadastrados</p>
            <?php endif;?>
        </div>

        <h2 class="section-title">Ficção</h2>
        <p class="section-desciption">
            Veja os melhores filmes de ficção
        </p>
        <div class="movies-container">
            <?php foreach($ficMovies as $movie):?>
                <?php require('templates/movie_card.php');?>
            <?php endforeach;?>
            <?php if(count($ficMovies) == 0):?>
                <p class="empty-list">Não há filmes de ficção cadastrados</p>
            <?php endif;?>
        </div>

        <h2 class="section-title">Comédia</h2>
        <p class="section-desciption">
            Veja os melhores filmes de comédia
        </p>
        <div class="movies-container">
            <?php foreach($comedyMovies as $movie):?>
                <?php require('templates/movie_card.php');?>
            <?php endforeach;?>
            <?php if(count($comedyMovies) == 0):?>
                <p class="empty-list">Não há filmes de comédia cadastrados</p>
            <?php endif;?>
        </div>
    </div>


<?php 
    require_once("templates/footer.php");
?>