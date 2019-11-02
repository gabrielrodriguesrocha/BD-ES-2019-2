<?php

class Funcionario {
    private $username;
    private $cargo;
    private $nome;
    private $telefone1;
    private $telefone2;

    function __construct($username, $cargo, $nome, $telefone1, $telefone2) {
        $this->username = $username;
        $this->cargo = $cargo;
        $this->nome = $nome;
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

	public function getSenha(){
		return $this->senha;
	}

	public function getTelefone1(){
		return $this->telefone1;
	}

	public function getTelefone2(){
		return $this->telefone2;
	}
}

?>