<?php

class Procedimento {
    private $protocolo;
    private $dataHora;
    private $local;
    private $paciente;
    private $exames;
	private $funcionarios;
	private $resultado;
	private $valorTotal;

    function __construct($protocolo, $dataHora, $local, $paciente, $exames, $funcionarios, $resultado, $valorTotal = 0) {
        $this->protocolo = $protocolo;
        $this->dataHora = $dataHora;
        $this->local = $local;
        $this->paciente = $paciente;
        $this->exames = $exames;
		$this->funcionarios = $funcionarios;
		if ($valorTotal == 0 && is_array($exames)) {
			$this->valorTotal = array_reduce($exames, function ($acc, $val) { return $acc + $val->getvalor(); }, 0);
		}
		$this->resultado = $resultado;
    }

    public function getProtocolo(){
		return $this->protocolo;
	}

	public function setProtocolo($protocolo){
		$this->protocolo = $protocolo;
	}

	public function getDataHora(){
		return $this->dataHora;
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
		return $this->paciente;
	}

	public function setPaciente($paciente){
		$this->paciente = $paciente;
	}

	public function getExames(){
		return $this->exames;
	}

	public function setExames($exames){
		$this->exames = $exames;
	}

	public function getFuncionarios(){
		return $this->funcionarios;
	}

	public function setFuncionarios($funcionarios){
		$this->funcionarios = $funcionarios;
	}

	public function getValorTotal(){
		return $this->valorTotal;
	}

	public function setValorTotal($valorTotal){
		$this->valorTotal = $valorTotal;
	}
		
	public function getResultado(){
		return $this->resultado;
	}

	public function setResultado($resultado){
		$this->resultado = $resultado;
	}
}

?>