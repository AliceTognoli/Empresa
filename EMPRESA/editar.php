<?php

    include_once 'conexao.php';
    include_once 'funcoes.php';

    if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

        //if ternário
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        //Vamos abrir a conexao com o banco de dados
        $conexaoComBanco = abrirBanco();

        $sql = "SELECT * FROM vales WHERE id = ?";
        //Preparar o SQL para consultar o id no banco de dados
        $pegarDados = $conexaoComBanco->prepare($sql);
        //Substituir o ????
        $pegarDados->bind_param("i", $id);
        //Executar o SQL que preparamos
        $pegarDados ->execute();
        $result = $pegarDados->get_result();

        if($result->num_rows == 1){
            $registro = $result->fetch_assoc();
        }else{
            echo "Nenhum registro encontrado";
            exit;
        }

        $pegarDados->close();
        fecharBanco($conexaoComBanco);

    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //dd($POST);
        $criado_em= $_POST['criado_em'];
        $data_do_vale=$_POST['data_do_vale'];
        $descricao=$_POST['descricao'];
        $valor=$_POST['valor'];
        $atualizado_em=$_POST['atualizado_em'];

        $conexaoComBanco = abrirBanco();

        $sql ="UPDATE vales SET criado_em = '$criado_em', data_do_vale = '$data_do_vale',
        descricao = '$descricao', valor = '$valor', atualizado_em = '$atualizado_em'
        WHERE id = $id";

        if ($conexaoComBanco->query($sql) === TRUE){
            echo "Sucesso ao atualizar o contato";
            header("location:index.php");
        }else{
            echo "Erro ao atualizar o contato";
        }
        fecharBanco($conexaoComBanco);
    }


   
    
        
    ?>



    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="stylesheet" href="css/cadastrar.css">
        
    </head>
    <body>
       
        
    <section>
        <h2>Atualizar cadastro</h2>
        <form action ="" method="post" enctype="multipart/form-data">
    
            <label for=criado_em>Criado em</label>
            <input type="text" id="criado_em" name="criado_em" value="<?= $registro['criado_em']?>" required placeholder="Digite seu nome:">
    
            <label for=data_do_vale>Data do vale</label>
            <input type="text" id="data_do_vale" name="data_do_vale"  value="<?= $registro['data_do_vale']?>" required placeholder="Digite seu sobrenome: ">
    
            <label for=descricao>Descricao</label>
            <input type="text" id="descricao" name="descricao"  value="<?= $registro['descricao']?>" required placeholder="Digite sua data de nascimento: ">
    
            <label for=valor>valor</label>
            <input type="text" id="valor" name="valor"  value="<?= $registro['valor']?>" required placeholder="Digite seu endereço:">
    
            <label for=atualizado_em>Atualizado em</label>
            <input type="text" id="atualizado_em" name="atualizado_em"  value="<?= $registro['atualizado_em']?>" required placeholder="Digite seu telefone: ">
    
            <input type="hidden" name="id" value="<?= $registro['id'] ?>">
    
            <button type="submit">Atualizar</button> 
    
        </form>
    </section>
    
    </body>
    </html>





        