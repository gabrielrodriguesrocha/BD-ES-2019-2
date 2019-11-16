<h5>Nome:</h5>
    <p><?php echo $exame->getNome(); ?></p>
    <h5>Valor: </h5>
    <p><?php echo $exame->getValor() ?></p>
    <h5>Restrições: </h5>
    <?php if ($exame->getRestricoes())
        foreach($exame->getRestricoes() as &$restricao): ?>
            <p><?php echo $restricao ?></p>
    <?php endforeach; ?>
    <h5>Competências: </h5>
    <?php if ($exame->getCompetencias())
        foreach($exame->getCompetencias() as &$competencia): ?>
            <p><?php echo $competencia ?></p>
    <?php endforeach; ?>