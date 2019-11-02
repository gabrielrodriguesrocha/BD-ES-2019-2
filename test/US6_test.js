const faker = require('faker');

Feature('US6 - Interface admin');

Scenario('AT1 - Verificar acesso correto à interface de usuário', (I, loginAs) => {
    //pause();
    loginAs('user');
    //I.amOnPage('/index.php');
    I.see('Meus exames');
    I.click({tag: 'a'});
    I.see('Procedimento de protocolo');
    I.click('Voltar');
    I.see('Meus exames');
});