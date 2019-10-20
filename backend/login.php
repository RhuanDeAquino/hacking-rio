<?php
session_start(); //Abre sessão (cria um cookie)
include('conexao.php'); //Inclui todo o conteúdo do arquivo conexao.php, que é executado e todas as variáveis e conteudos dele ficam disponíveis aqui para uso

if(empty($_POST['email']) || empty($_POST['senha'])) { //Verifica se ambos login e senha não estão vazios, se estiverem, volta ao início e cancela o resto da execução
	echo "<script>alert('Email ou senha vazios!')</script>"; //manda um alerta de email ou senha vazios antes de redirecionar para a tela de login
	header("Refresh:0; url=../testepag.php"); //Manda erro 302 e redireciona o usuário para / (início do domínio);
	exit(); //Encerra a execução do arquivo
}
$email = $_POST['email']; //Salva o email na variável $email
$senha = md5($_POST['senha']); //Transforma a senha em MD5 e salva ela na variável $senha. 

$sql = $pdo->prepare("SELECT (`nome`) FROM `usuario` WHERE `usuario` = :email AND `senha` = :senha"); //Prepara a query do PDO; Essa query vai selecionar a coluna "nome" da tabela "usuario" onde a coluna usuario é igual ao nosso email e a senha é igual à senha em MD5 do $_POST 
$sql->execute(array(':email' => $email, ':senha' => $senha)); //Executa a query tornando os :valor em valores reais. É um método de segurança para evitar todos os tipos de ataque e que faz com que a query não leve valores reais sem filtro

$resultado = $sql->fetch(); //Captura o resultado da query. Se a query não foi bem sucedida, o fetch retornara vazio. Você pode checar se a query foi bem sucedida vendo o valor do $pdo->execute(). Se for true|1, deu certo.
$contagem = $sql->rowCount(); //Conta o número de colunas que a query produziu.

if($contagem == 1){ //Verifica se a query produziu algum resultado
	echo "<script>alert('O login foi bem sucedido!')</script>"; //manda um alerta de sucesso do login antes de redirecionar
	$usuario = $resultado[0]; //Como só está puxando pela coluna nome, ela é posta com index 0 quando você faz fetch();
	$_SESSION['nome'] = $usuario_bd['nome']; //Coloca o nome do usuário na sessão (que é uma array);
	header("Refresh:0; url=../inicio.php"); //Direciona para a página inicial. Pode ser qualquer coisa; estou usando inicio.php por conveniência
	exit(); //Encerra a execução do documento
} else { //Caso não tenha produzido resultado,
	echo "<script>alert('O login falhou!')</script>"; //manda um alerta de falha do login antes de redirecionar
	$_SESSION['nao_autenticado'] = true; //Coloca a chave nao_autenticado dentro da sessão com valor de true. Pode ser usado para dizer "você não está logado" na tela inicial ou coisas do tipo.
	header("Refresh:0; url=../index.html"); //Volta para o index
	exit();  //Encerra a execução do documento
}