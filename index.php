<?php

require_once("config.php");
//carrega um usuario
//$root = new Usuario();
//$root->loadbyId(11);
//echo $root;

//Carrega uma lista de usuarios
//$lista = Usuario::getList();

//echo json_encode($lista);

//CARREGA UMA LISTA DE USUARIOS BUSCANDO PELO LOGIN

//$search = Usuario::search("pe");
//echo json_encode($search);

//CARREGA UM USUARIO IDENTIFICANDO LOGIN E SENHA
//$usuario = new Usuario();
//$usuario->login("guido", "1234567");

//echo $usuario;

$aluno = new Usuario();

$aluno->setDeslogin("aluno");
$aluno->setDessenha("@alun0");

$aluno->insert();

echo $aluno;

?>