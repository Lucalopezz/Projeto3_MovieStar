<?php 

    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $userDAO = new UserDAO($conn, $BASE_URL);


    //verifica o tipo do formulario (login ou registrar)
    $type = filter_input(INPUT_POST, "type");
    //echo $type;

    //verificar tipo de formular
    if($type === "register"){

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");


    //verificaçõa de dados mínimos

    if($name && $lastname && $email && $password){
        //verificar se as senhas batem
        if($password === $confirmpassword){
            //verificar se o email é unico no sistema
            if($userDAO->findByEmail($email) === false){
                //echo"nenhum usuario com esse email";
            }else{
                $message->setMessage("E-mail já cadastrado!", "error", "back");
            }
        }else{
             $message->setMessage("As senhas não são iguais", "error", "back");
        }
    }else{
        //msg dados faltando
        $message->setMessage("Por favor, preencha todos os campos", "error", "back");
    }



    }else if($type === "login"){

    }


?>