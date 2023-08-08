<?php 
    require_once("globals.php");
    require_once("db.php");
    $flassMesage = [];
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieStar</title>
    <link rel="shortcut icon" href="<?=$BASE_URL?>img/moviestar.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.css" integrity="sha512-azoUtNAvw/SpLTPr7Z7M+5BPWGOxXOqn3/pMnCxyDqOiQd4wLVEp0+AqV8HcoUaH02Lt+9/vyDxwxHojJOsYNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Font-Awnsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS -->
    <link rel="stylesheet" href="<?=$BASE_URL?>css/styles.css">
</head>
<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?=$BASE_URL?>" class="navbar-brand">
                <img src="<?=$BASE_URL?>img/logo.svg" alt="MovieStar Logo" id="logo">
                <span id="moviestar-title">MovieStar</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <form action="" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
                <div class="input-group"> <!-- Adicionando um elemento de grupo para melhor alinhamento -->
                    <input type="text" name="q" id="search" class="form-control" placeholder="Buscar filmes" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $BASE_URL ?>auth.php">Entrar / Cadastrar</a>
                    </li>
                </ul>
            </div>
        </nav>  
    </header>

    <?php if(!empty($flassMesage["msg"])): ?>
        <div class="msg-container">
            <p class="msg success <?=$flassMesage["type"]?>"><?=$flassMesage["msg"]?></p>
        </div>
    <?php endif;?>
    