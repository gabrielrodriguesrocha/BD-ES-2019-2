const faker = require('faker');

Feature('Demo - Apresentação de features');

Scenario('D1 - Interface administrativa', (I, loginAs) => {
    //pause();
    loginAs('admin');
});

Scenario('D2 - Interface do usuário', (I, loginAs) => {
    //pause();
    loginAs('user');
});