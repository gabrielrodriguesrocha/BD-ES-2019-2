<?php

class Procedimento {
    private $protocolo;
    private $dataHora;
    private $local;
    private $paciente;
    private $exames;
	private $funcionario;
	private $resultado;
	private $valorTotal;

    function __construct($protocolo, $dataHora, $local, $paciente, $exames, $funcionario, $resultado) {
        $this->protocolo = $protocolo;
        $this->dataHora = $dataHora;
        $this->local = $local;
        $this->paciente = $paciente;
        $this->exames = $exames;
		$this->funcionario = $funcionario;
		$this->resultado = $resultado;
		if($exames !== NULL)
			$this->valorTotal = array_reduce($this->exames, function ($acc, $e) { $acc = $acc + $e->getValor(); return $acc; });
    }

    public function getProtocolo(){
		return $this->protocolo;
	}

	public function setProtocolo($protocolo){
		$this->protocolo = $protocolo;
	}

	public function getDataHora(){
		return $this->dataHora->format('d-m-Y');
	}

	public function setDataHora($dataHora){
		$this->dataHora = $dataHora;
	}

	public function getLocal(){
		return $this->local;
	}

	public function setLocal($local){
		$this->local = $local;
	}

	public function getPaciente(){
		return $this->paciente->getUsername();
	}

	public function setPaciente($paciente){
		$this->paciente = $paciente;
	}

	public function getExames(){
		return $this->exames->getNome();
	}

	public function setExames($exames){
		$this->exames = $exames;
	}

	public function getFuncionario(){
		return $this->funcionario->getNome();
	}

	public function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}

	public function getValorTotal(){
		return $this->exames->getValor();
	}

	public function setValorTotal($valorTotal){
		$this->exames->setValor($valorTotal);
	}
}

?>