const faker = require('faker');

Feature('US4 - Download de relatórios');

Scenario('AT4.1 - Verificar download de relatório mensal', (I, loginAs) => {
    //pause();
    loginAs('admin');
    I.click('Relatório mensal');
    //I.amOnPage('/index.php');
    I.see('Salvar');
});

Scenario('AT4.2 - Verificar download de relatório periódico', (I, loginAs) => {
    loginAs('admin');
    //pause();
    I.click('Relatório periódico');
    //I.amOnPage('/index.php');
    I.fillField('startDate', '12-05-2019');
    I.fillField('endDate', '13-05-2019');
    I.click('Obter');
    I.see('Salvar');
});