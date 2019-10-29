<?php

class Paciente {
    private $username;
    private $nome;
    private $senha;
    private $cpf;
    private $endereco;
    private $nascimento;
    private $sexo;
    private $email1;
    private $email2;
    private $passaporte;

    function __construct($username, $nome, $senha, $cpf, $endereco, $nascimento, $sexo, $email1, $email2, $passaporte) {
        $this->username = $username;
        $this->nome = $nome;
        $this->senha = $senha;
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

	public function setUsername($username){
		$this->username = $username;
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

	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function getNascimento(){
		return $this->nascimento;
	}

	public function setNascimento($nascimento){
		$this->nascimento = $nascimento;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function setSexo($sexo){
		$this->sexo = $sexo;
	}

	public function getEmail1(){
		return $this->email1;
	}

	public function setEmail1($email1){
		$this->email1 = $email1;
	}

	public function getEmail2(){
		return $this->email2;
	}

	public function setEmail2($email2){
		$this->email2 = $email2;
	}

	public function getPassaporte(){
		return $this->passaporte;
	}

	public function setPassaporte($passaporte){
		$this->passaporte = $passaporte;
	}
}

?>