<?php
session_start(); //Abre sessão (cria um cookie)
include('conexao.php'); //Inclui todo o conteúdo do arquivo conexao.php, que é executado e todas as variáveis e conteudos dele ficam disponíveis aqui para uso

if(empty($_POST['email']) || empty($_POST['senha'] || empty($_POST['senha2'] || empty($_POST['nome'])))) { //Verifica se há campos vazios
	echo "<script>alert('Algum campo está vazio!')</script>"; //manda um alerta de email ou senha vazios antes de redirecionar para a tela de login
	header("Refresh:0; url=../index.html"); //Manda erro 302 e redireciona o usuário para / (início do domínio);
	exit(); //Encerra a execução do arquivo
}
$data = date("Y-m-d H:i:s");
$email = $_POST['email']; //Salva o email na variável $email
$nome = $_POST['nome']; //Salva o nome na variável nome

if($_POST['senha'] == $_POST['senha2']){ //Confirma se as duas senhas são iguais
	$senha = md5($_POST['senha']); //Transforma a senha em MD5 e salva ela na variável $senha. 
}else{
	echo "<script>alert('As senhas não conferem!')</script>"; //manda um alerta dizendo que a senha está errada
	header("Refresh:0; url=../index.html"); //Manda erro 302 e redireciona o usuário para início;
	exit();
}


$sql = $pdo->prepare("SELECT (`nome`) FROM `usuario` WHERE `usuario` = :email"); //Prepara a query do PDO; Essa query vai selecionar a coluna "nome" da tabela "usuario" onde a coluna usuario é igual ao email 
$sql->execute(array(':email' => $email)); //Executa a query tornando os :valor em valores reais. É um método de segurança para evitar todos os tipos de ataque e que faz com que a query não leve valores reais sem filtro

$contagem = $sql->rowCount(); //Conta o número de colunas que a query produziu.

if($contagem == 1){ //Verifica se a query produziu algum resultado
	echo "<script>alert('Esta conta já existe!')</script>"; //manda um alerta de login existente
	header("Refresh:0; url=../index.html"); //Direciona para a página inicial
	exit(); //Encerra a execução do documento
} else { //Caso não tenha produzido resultado,

	$sql = $pdo->prepare("INSERT INTO `usuario` (`usuario`, `senha`, `nome`, `data_cadastro`) VALUES (:email, :senha, :nome, :data)");
	if($sql->execute(array(':email' => $email, ':senha' => $senha, ':nome' => $nome, ':data' => $data))){
		echo "<script>alert('A conta foi criada com sucesso!')</script>"; //Avisa que a criação foi bem sucedida
		header("Refresh:0; url=../index.html"); //Volta para o index
		$_SESSION['nome'] = $nome; //Coloca o nome do usuário na sessão (que é uma array);
		exit();
	}else{
		echo "<script>alert('A conta não foi criada')</script>"; //manda um alerta de falha
		$_SESSION['nao_autenticado'] = true; //Coloca a chave nao_autenticado dentro da sessão com valor de true. Pode ser usado para dizer "você não está logado" na tela inicial ou coisas do tipo.
		header("Refresh:0; url=../index.html"); //Volta para o index
		exit();
	}
}