<?php 
    require_once("templates/header.php");

    require_once("dao/UserDAO.php");
    require_once("models/User.php");

    $userDAO = new UserDAO($conn, $BASE_URL);

    $userData = $userDAO->verifyToken(True);
?>
    <div id="main-container" class="container-fluid">
        
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Adicionar Filme</h1>
            <p class="page-description">
                Adicione sua crítica e compatilhe para o mundo!
            </p>
            <form action="<?= $BASE_URL ?>movie_process.php" method="post" id="add-movie-form" enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">

                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control" id="title" placeholder="Digite o Título do seu Filme" name="title">
                </div>
                
                <div class="form-group">
                    <label for="image" class="bold">Imagem:</label>
                    <br>
                    <input type="file" class="form-control-file" name="image" id="image" >
                </div>  
                
                <div class="form-group">
                    <label for="length">Duração:</label>
                    <input type="text" class="form-control" id="length" placeholder="Digite a Duração do seu Filme" name="length">
                </div>

                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Selecione</option>
                        <option value="Ação">Ação</option>
                        <option value="Drama">Drama</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Terror">Terror</option>
                        <option value="Ficção">Ficção</option>
                        <option value="Romance">Romance</option>
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="trailer">Trailer:</label>
                    <input type="text" class="form-control" id="trailer" placeholder="Insira o link do trailer" name="trailer">
                </div>

                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" id="description" placeholder="Descreva o Filme" rows="3" class="form-control"></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Adicionar Filme">
        
            </form>
            
        </div>



    </div>


<?php 
    require_once("templates/footer.php");
?>