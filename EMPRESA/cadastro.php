<?php

include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Captura os dados digitando em form e salva em variáveis 
    //Para facilitar a manipulação dos dados
    $id=$_POST['id'];
    $descricao=$_POST['descricao'];
    $valor=$_POST['valor'];
    $data_do_vale=$_POST['data_do_vale'];
    $atualizado_em=$_POST['atualizado_em'];
    $id=$_POST['criado_em'];
    
    //Vamos abrir a conexao com o banco de dados
    $$conexao = abrirBanco();

    //Vamos criar o SQL para realizar o insert dos dados no BD
    $sql ="INSERT INTO pessoas (id, descricao, valor, data_do_vale, atualizado_em, criado_em)
    VALUES ('$id', '$descricao', '$valor', '$data_do_vale', '$atualizado_em', '$criado_em')";

    if ($$conexao->query($sql) === TRUE){

        echo "Sucesso ao cadastrar o vale!";
    }else{
    echo "Erro ao cadastrar o vale!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href ="index.php">Home</a></li>
                <li><a href = "cadastro.php">Cadastro</a></li>
            </ul>
        </nav>
    </header>
    <h1>Gerenciar Vales</h1>
    <h2>Cadastrar Vales</h2>
</body>
</html>