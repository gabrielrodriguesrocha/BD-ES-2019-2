<h5>Protocolo:</h5>
<p><?php echo $procedimento->getProtocolo(); ?></p>
<h5>Data: </h5>
<p><?php echo $procedimento->getDataHora() ?></p>
<h5>Local:</h5>
<p><?php echo $procedimento->getLocal(); ?></p>
<h5>Paciente:</h5>
<p><a href="/admin/view_patient.php?username=<?php echo $procedimento->getPaciente(); ?>"><?php echo $procedimento->getPaciente(); ?></a></p>
<h5>Exames:</h5>
<?php foreach($procedimento->getExames() as &$exame) ?>
    <p><a href="/admin/view_exam.php?nome=<?php echo $exame->getNome(); ?>"><?php echo $exame->getNome(); ?></a></p>
<?php endforeach ?>
<h5>Funcionário:</h5>
<p><a href="/admin/view_employee.php?username=<?php echo $procedimento->getFuncionario(); ?>"><?php echo $procedimento->getFuncionario(); ?></a></p>
<h5>Resultado:</h5>
<p><?php echo $procedimento->getResultado(); ?></p>
<h5>Valor Total:</h5>
<p><?php echo $procedimento->getValorTotal(); ?></p>