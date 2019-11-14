<?php

class Exame {
    private $nome;
	private $valor;
    private $restricoes;
	private $competencias;

    function __construct($nome, $valor, $restricoes, $competencias) {
        $this->nome = $nome;
		$this->valor = $valor;
		$this->restricoes = $restricoes;
		$this->competencias = $competencias;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getValor(){
		return trim($this->valor, '$');
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
}

?>