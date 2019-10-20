<?php
/**
 * Utilizando PDO ao invés do datado e não-mais-suportado MySQLi;
 * PDO é mais seguro & fácil de usar; 
 */
$host       = 'localhost'; //Host da conexão do PDO
$usuario    = 'root'; //Usuário para conexão
$senha      = ''; //Senha para conexão
$banco      = 'login';  //Banco de dados para conexão

$pdo = new pdo("mysql:host=$host;dbname=$banco;charset=utf8","$usuario","$senha"); //Se você não especificar a porta do MySQL, o PDO assume que é a padrão
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Ativa que erros graves sejam mostrados. Para produção, é bom desativar esses atributos ou utilizar um bloco TRY/CATCH com mensagem de erro customizada
