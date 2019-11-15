const faker = require('faker');

Feature('US1 - Dashboard Funcionalidades');

Scenario('AT1.1 - Verificar CRUD administrativa (Exames)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Exames');
    I.click('Novo exame');
    I.fillField('nome', 'HCT');
    I.fillField('valor', 50.00);
    I.fillField('restricoes', 'Jejum 12 horas; Sem consumo de álcool por 12 horas');
    I.fillField('competencias', 'Enfermeiro sênior;');
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Exames');
    I.selectOption('#searchAttribute', 'Nome');
    I.fillField('searchValue', 'HCT');
    I.click('Buscar');
    I.see('HCT');
    I.click('✏️');
    I.fillField('valor', 75.00);
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Exames');
    I.click('HCT');
    I.see(75.00);
    I.click('Dashboard administrativo');
    I.click('Exames');
    I.click('❌');
    I.click('Confirmar exclusão');
    I.amOnPage('/admin/exam.php');
    I.dontSee('HCT');
});

Scenario('AT1.1.1 - Verificar CRUD administrativa (Exames)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Exames');
    I.click('Novo exame');
    I.click('Salvar');
    I.see('Nome é obrigatório!');
});