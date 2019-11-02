<?php

class Procedimento {
    private $protocolo;
    private $dataHora;
    private $local;
    private $paciente;
    private $exames;
	private $funcionario;
	private $valorTotal;

    function __construct($protocolo, $dataHora, $local, $paciente, $exames, $funcionario, $valorTotal = 0) {
        $this->protocolo = $protocolo;
        $this->dataHora = $dataHora;
        $this->local = $local;
        $this->paciente = $paciente;
        $this->exames = $exames;
		$this->funcionario = $funcionario;
		$this->resultado = $resultado;
		if (!$valorTotal) {
			foreach ($exames as &$exame) {
				$this->valorTotal += $exame->getValor();
			}
		}
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

	public function getFuncionario(){
		return $this->funcionario;
	}

	public function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}
}

?>