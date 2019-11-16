const faker = require('faker');

Feature('US2 - Relatório mensal');

Scenario('AT2.1 - Verificar geração de relatório mensal', (I, loginAs) => {
    //pause();
    loginAs('admin');
    I.click('Relatório mensal');
    I.see('Relatório Mensal');
    I.seeElement('#grafico');
    I.see('Quantidade de exames pelos meses');
    I.seeElement('#tabela');
    I.see('Salvar');
});