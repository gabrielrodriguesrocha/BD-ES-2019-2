<?php

class Paciente {
    private $username;
    private $nome;
    private $cpf;
    private $endereco;
    private $nascimento;
    private $sexo;
    private $email1;
    private $email2;
    private $passaporte;

    function __construct($username, $nome, $cpf, $endereco, $nascimento, $sexo, $email1, $email2, $passaporte) {
        $this->username = $username;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
        $this->nascimento = $nascimento;
        $this->sexo = $sexo;
        $this->email1 = $email1;
        $this->email2 = $email2;
        $this->passaporte = $passaporte;
    }

    public function getUsername(){
		return $this->username;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function getNascimento(){
		return $this->nascimento;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function getEmail1(){
		return $this->email1;
	}

	public function getEmail2(){
		return $this->email2;
	}

	public function getPassaporte(){
		return $this->passaporte;
	}
}

?>