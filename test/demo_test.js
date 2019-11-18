const faker = require('faker');

Feature('Demo - Apresentação de features');

Scenario('D1 - Interface administrativa', (I, loginAs) => {
    //pause();
    loginAs('rocha');
    pause();
    // Exames
    I.click('Exames');
    I.click('Novo exame');
    I.fillField('nome', 'ACTH');
    I.fillField('restricoes', 'Não estar sob efeito de glucocorticoides; Reduzir consumo de sal ao mínimo nas últimas 24 horas;');
    I.click('Salvar');
    I.see('Valor é obrigatório!');
    I.fillField('nome', 'ACTH');
    I.fillField('valor', 150.0);
    I.fillField('restricoes', 'Não estar sob efeito de glucocorticoides; Reduzir consumo de sal ao mínimo nas últimas 24 horas;');
    I.fillField('competencias', 'Endocrinologista');
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Exames');
    I.selectOption('#searchAttribute', 'Nome');
    I.fillField('searchValue', 'ACTH');
    I.click('Buscar');
    I.click('ACTH');
    I.click('✏️ Editar');
    I.fillField('valor', 175.0);
    I.click('Salvar');
    // Pacientes
    I.click('Dashboard administrativo');
    I.click('Pacientes');
    I.selectOption('#searchAttribute', 'Nome');
    I.fillField('searchValue', 'Pedro Coelho');
    I.click('Buscar');
    I.click('eleven');
    // Procedimentos
    I.click('Dashboard administrativo');
    I.click('Procedimentos');
    I.click('Novo procedimento');
    I.fillField('protocolo', '5t4g45f1f');
    I.fillField('datahora', '2019-11-18 09:15:06');
    I.fillField('local', 'Sorocaba');
    I.fillField('paciente', 'eleven');
    I.fillField('exames', 'ACTH');
    I.fillField('funcionarios', 'rocha;shiko');
    I.fillField('resultado', 'Baixo');
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Procedimentos');
    I.selectOption('#searchAttribute', 'Protocolo');
    I.fillField('searchValue', '5t4g45f1f');
    I.click('Buscar');
    I.see('5t4g45f1f');
    pause();
    I.click('5t4g45f1f');
    I.click('❌ Excluir');
    I.click('Confirmar exclusão');
    // Funcionários
    I.click('Dashboard administrativo');
    I.click('Funcionários');
    // Relatórios
    I.click('Dashboard administrativo');
    I.click('Relatório mensal');
    I.click('Dashboard administrativo');
    I.click('Relatório periódico');
    I.fillField('startDate', '12-03-2019');
    I.fillField('endDate', '12-06-2019');
    I.click('Obter');
    I.see('2019-12-03 ~ 2019-12-06');
    I.click('Dashboard administrativo');
});

Scenario('D2 - Interface do usuário', (I, loginAs) => {
    loginAs('eleven');
    pause();
    I.click('5t4g45f1f');
    I.see('Resultado');
    I.click('Voltar');
    I.click('Logout');
    loginAs('drauzio');
    I.click('123sdf564');
    I.see('Resultado');
});