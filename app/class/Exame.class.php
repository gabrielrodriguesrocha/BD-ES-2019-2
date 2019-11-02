<?php

class Exame {
	private $id;
    private $nome;
	private $valor;
	private $resultado;
    private $restricoes;
	private $competencias;

    function __construct($id, $nome, $valor, $restricoes, $competencias, $resultado) {
		$this->id = $id;
        $this->nome = $nome;
		$this->valor = $valor;
		$this->resultado = $resultado;
		$this->restricoes = $restricoes;
		$this->competencias = $competencias;
	}
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function getRestricoes(){
		return $this->restricoes;
	}

	public function setRestricoes($restricoes){
		$this->restricoes = $restricoes;
	}

	public function getCompetencias(){
		return $this->competencias;
	}

	public function setCompetencias($competencias){
		$this->competencias = $competencias;
	}

	public function getResultado(){
		return $this->resultado;
	}

	public function setResultado($resultado){
		$this->resultado = $resultado;
	}
}

?>