<?php

include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Captura os dados digitando em form e salva em variáveis 
    //Para facilitar a manipulação dos dados
   
    $descricao=$_POST['descricao'];
    $valor=$_POST['valor'];
    $data_do_vale=$_POST['data_do_vale'];
  
    $conexao = abrirBanco();
    

    //Vamos criar o SQL para realizar o insert dos dados no BD
    $sql ="INSERT INTO vales (descricao, valor, data_do_vale)
    VALUES ('$descricao', '$valor', '$data_do_vale')";

    
    if ($conexao->query($sql) === TRUE){

        echo "Sucesso ao cadastrar o vale!";
        header("location:index.php");
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
    <title>Empresa</title>
    <link rel="stylesheet" href="css/cadastro.css">

    
</head>
<body>
    <h1>Gerenciar vales</h1>
    <hr>
    <section>
        <br>
        <h2>Cadastrar vales</h2>

<div class="card_vale">
<form action="" method="post">

<label for="descricao">Descrição</label>
<input type="text" required placeholder="Insira a descrição" name="descricao">

<label for="data_do_vale">Data do Vale</label>
<input type="date" required name="data_do_vale">

<label for="valor">Valor</label>
<input type="text" required placeholder="Insira o valor" name="valor">

<button class="btn_cad" type="submit">Cadastrar</button>

</form>
</div>

<?php
//incluir a conexão na pagina e todo o seu conteúdo
// include 'conexao.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $id = $_GET['id'];

    if($id > 0){
         //Abrir conexao com o banco de dados 
         $conexao = abrirBanco();
         //Preparar um SQL de Exclusão
         $sql = "DELETE FROM vales WHERE id = $id";
         //Executar comando no banco
         if($conexao->query($sql) === TRUE){
            echo "<script>alert('Contato excluido com sucesso!)</script>";
            header("location:index.php");
         }else{
            echo "Contato excluido com sucesso!";

         }


    }
fecharBanco($conexao);
}

?>
    <div class="quadrado">
        <table border="1" class="table-listar">
            <thead>
                <tr>
                    <td>Data de Cadastro</td>
                    <td>Data do Vale</td>
                    <td>Descrição</td>
                    <td>Valor</td>
                    <td>Atualizado</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
            <?php
                //Abrir conexao com o banco de dados 
                $conexao = abrirBanco();

                //Preparar a consulta SQL para selecionar os dados no BD
                $query = "SELECT id, descricao, valor, data_do_vale, atualizado_em, criado_em
                        FROM vales";

                //Executar a query(o SQL no banco)

                $result = $conexao->query($query);
                $registros = $result->fetch_assoc();
                if ($result->num_rows > 0) {
                    //tem registro no banco
                    while ($registros = $result->fetch_assoc()) {
                        // echo "<pre>";
                        // print_r($registros);
                        // echo "</pre>";
                        // exit;
                ?> 
                <tr>
                <td><?= date("d/m/Y", strtotime($registros['criado_em'])) ?></td>
                <td><?= date("d/m/Y", strtotime($registros['data_do_vale'])) ?></td>
                <td><?= $registros['descricao'] ?></td>
                <td><?= $registros['valor'] ?></td>
                <td><?= date("d/m/Y", strtotime($registros['atualizado_em'])) ?></td>
                
               <td>
                    <a class="btn_editar" href="editar.php?acao=editar&id=<?= $registros['id'] ?>">Editar</a>
                    <a class="btn_excluir" href="?acao=excluir&id=<?= $registros['id'] ?>" onclick="return confirm
                    ('Tem certeza que deseja excluir?');">
                        Excluir</a>
                        </td>

                </tr>

                
            <?php
 

    }
    } else {
        ?>

        <tr>
            <td colspan='7'>Nenhum registro encontrado no banco de dados</td>
        </tr>
        <?php

    }
        ?>

            </tbody>

        </table>
        </div>
        </section>
</body>
</html>