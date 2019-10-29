<?php

class Funcionario {
    private $username;
    private $cargo;
    private $nome;
    private $senha;
    private $telefone1;
    private $telefone2;

    function __construct($username, $cargo, $nome, $senha, $telefone1, $telefone2) {
        $this->username = $username;
        $this->cargo = $cargo;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->telefone1 = $telefone1;
        $this->telefone2 = $telefone2;
    }

    public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getCargo(){
		return $this->cargo;
	}

	public function setCargo($cargo){
		$this->cargo = $cargo;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getTelefone1(){
		return $this->telefone1;
	}

	public function setTelefone1($telefone1){
		$this->telefone1 = $telefone1;
	}

	public function getTelefone2(){
		return $this->telefone2;
	}

	public function setTelefone2($telefone2){
		$this->telefone2 = $telefone2;
	}
}

?>