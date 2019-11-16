const faker = require('faker');

Feature('US2 - Relatório periódico');

Scenario('AT2.1 - Verificar geração de relatório periódico', (I, loginAs) => {
    //pause();
    loginAs('admin');
    I.click('Relatório periódico');
    I.see('Relatório de média de exames por paciente');
    I.seeElement('.startDate');
    I.seeElement('.endDate');
    I.fillField('startDate', '12-05-2019');
    I.fillField('endDate', '13-05-2019');
    I.click('Obter');
    I.see('2019-05-12 ~ 2019-05-12');
});