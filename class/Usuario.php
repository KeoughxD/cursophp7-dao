<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

		public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){ // Busca um determinado cadastro no Banco de Dados com base em um ID passado por parametro .. 
 
		$sql = new Sql(); // Cria o objeto de instancia para conexão do BD

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id)); // Utiliza a função select da Instancia do Objeto sql 

		if(count($results) > 0 ){

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}

	public static function getList(){ // RETORNAR TODOS OS DADOS DO BD

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}


	public static function search($login){ // MÉTODO ESTATICO para Buscar um determinado cadastro com base no nome do login.. por exemplo se tiver um BErnardo e um BEnedito no BD e eu pesquisar por "BE" %BE% irá retornar benedito e bernardo ... 


		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
		  ':SEARCH'=>"%".$login."%"

		));
	}

	public function login($login,$password){ // FUNÇÃO RESPONSÁVEL POR REALIZAR UMA AUTENTICAÇÃO DE LOGIN E SENHA DE UM DETERMINADO USUARIO CADASTRADO NO BANCO DE DADOS.. 

		$sql = new Sql(); // Cria o objeto de instancia para conexão do BD

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$login,
			         ":PASSWORD"=>$password

		)); // Utiliza a função select da Instancia do Objeto sql 

		if(count($results) > 0 ){

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}	
		else{

			throw new Exception("Login e/ou senha inválidos.");

		}

	}

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}
}

?>