const faker = require('faker');

Feature('US5 - Dashboard');

Scenario('AT1.1 - Verificar acesso incorreto à interface administrativa', (I) => {
    //pause();
    I.amOnPage('/index.php');
    I.see('Login');
    I.fillField('username', faker.internet.email());
    I.fillField('password', faker.internet.password());
    I.click('Login');
    //I.amOnPage('/index.php');
    I.see('Usuário ou senha incorretos');
});

Scenario('AT1.1 - Verificar acesso incorreto à interface administrativa', (I) => {
    //pause();
    I.amOnPage('/index.php');
    I.see('Login');
    I.fillField('username', faker.internet.email());
    I.click('Login');
    //I.amOnPage('/index.php');
    I.see('É necessário fornecer usuário e senha');
});

Scenario('AT2 - Verificar acesso correto à interface administrativa', (I, loginAs) => {
    //pause();
    loginAs('admin');
    I.see('Dashboard administrativo');
    I.click('Logout');
    I.see('Login');
});