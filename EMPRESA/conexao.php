<?php

// criar constantes para armazenar as informações de acesso ao banco de dados
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "empresa");
define("DB_PORT", 3306);

/**
 * Abre uma conexao com o banco de dados e retorna um objeto de conexao
 * @return mysqli - retorna o objeto de conexao mysql.
 */
function abrirBanco() {
    $conexao = new mysqli(DB_HOST, DB_USER, DB_PASS , DB_NAME, DB_PORT);

//verificar se ocorreu algum erro durante a conexao
if ($conexao->connect_error){
    die("Falha na conexão" . $conexao->connect_error);

   
   
}

return $conexao;

   
}

/**
 * Fecha a conexao com o banco de dados
 */
function fecharBanco($conexao){
    $conexao->close();
}
