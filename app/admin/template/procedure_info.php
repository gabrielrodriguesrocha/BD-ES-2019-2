<h5>Protocolo:</h5>
<p><?php echo $procedimento->getProtocolo(); ?></p>
<h5>Data: </h5>
<p><?php echo $procedimento->getDataHora() ?></p>
<h5>Local:</h5>
<p><?php echo $procedimento->getLocal(); ?></p>
<h5>Paciente:</h5>
<p><a href="/admin/view_patient.php?username=<?php echo $procedimento->getPaciente()->getUsername(); ?>"><?php echo $procedimento->getPaciente()->getNome(); ?></a></p>
<h5>Exames:</h5>
<?php foreach($procedimento->getExames() as &$exame) { ?>
    <p><a href="/admin/view_exam.php?nome=<?php echo $exame->getNome(); ?>"><?php echo $exame->getNome(); ?></a></p>
<?php } ?>
<h5>Funcionário:</h5>
<?php foreach($procedimento->getFuncionarios() as &$funcionario) { ?>
    <p><a href="/admin/view_employee.php?username=<?php echo $funcionario->getUsername(); ?>"><?php echo $funcionario->getNome(); ?></a></p>
<?php } ?>
<h5>Resultado:</h5>
<p><?php echo $procedimento->getResultado(); ?></p>
<h5>Valor Total:</h5>
<p><?php echo $procedimento->getValorTotal(); ?></p>