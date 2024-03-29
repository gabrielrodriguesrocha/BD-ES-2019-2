<?php

class Funcionario {
    private $username;
    private $cargo;
	private $nome;
	private $password;
    private $telefone1;
    private $telefone2;

    function __construct($username, $cargo, $nome, $password, $telefone1, $telefone2) {
        $this->username = $username;
        $this->cargo = $cargo;
		$this->nome = $nome;
		$this->password = $password;
        $this->telefone1 = $telefone1;
        $this->telefone2 = $telefone2;
    }

    public function getUsername(){
		return $this->username;
	}

	public function getCargo(){
		return $this->cargo;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getTelefone1(){
		return $this->telefone1;
	}

	public function getTelefone2(){
		return $this->telefone2;
	}
}

?>