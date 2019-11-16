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

Scenario('AT1.2.1 - Verificar CRUD administrativa (Pacientes - Create)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Pacientes');
    I.click('Novo paciente');
    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.fillField('cpf', '123456789');
    I.fillField('password', '12345');
    I.fillField('endereco', 'R. Guilherme Dumont Vilares');
    I.fillField('nascimento', '04/10/1997');
    I.fillField('sexo', 'Masculino');
    I.fillField('email1', 'hskodama@gmail.com');
    I.fillField('email2', 'hskodama@hotmail.com');
    I.fillField('telefone1', '11123456');
    I.fillField('telefone2', '119876542');
    I.fillField('passaporte', 'B2223333');
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Pacientes');
    I.see('Henrique Kodama');
});

Scenario('AT1.2.2 - Verificar CRUD administrativa (Pacientes - Create)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Pacientes');
    I.click('Novo paciente');
    I.click('Salvar');
    I.see('Username é obrigatório!');

    I.fillField('username', 'hskodama');
    I.click('Salvar');
    I.see('Nome é obrigatório!');

    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.click('Salvar');
    I.see('Cpf é obrigatório!');

    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.fillField('cpf', '123456789');
    I.click('Salvar');
    I.see('Password é obrigatório!');

    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.fillField('cpf', '123456789');
    I.fillField('password', '12345');
    I.click('Salvar');
    I.see('Endereco  é obrigatório!');

    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.fillField('cpf', '123456789');
    I.fillField('password', '12345');
    I.fillField('endereco', 'R. Guilherme Dumont Vilares');
    I.click('Salvar');
    I.see('Nascimento  é obrigatório!');

    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.fillField('cpf', '123456789');
    I.fillField('password', '12345');
    I.fillField('endereco', 'R. Guilherme Dumont Vilares');
    I.fillField('nascimento', '04/10/1997');
    I.click('Salvar');
    I.see('Sexo  é obrigatório!');

    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.fillField('cpf', '123456789');
    I.fillField('password', '12345');
    I.fillField('endereco', 'R. Guilherme Dumont Vilares');
    I.fillField('nascimento', '04/10/1997');
    I.fillField('sexo', 'Masculino');
    I.click('Salvar');
    I.see('Email1  é obrigatório!');

    I.fillField('username', 'hskodama');
    I.fillField('nome', 'Henrique Kodama');
    I.fillField('cpf', '123456789');
    I.fillField('password', '12345');
    I.fillField('endereco', 'R. Guilherme Dumont Vilares');
    I.fillField('nascimento', '04/10/1997');
    I.fillField('sexo', 'Masculino');
    I.fillField('email1', 'hskodama@gmail.com');
    I.click('Salvar');
    I.see('Telefone1  é obrigatório!');

    I.fillField('username', 'testUser');
    I.fillField('nome', 'Test User');
    I.fillField('cpf', '123456789');
    I.fillField('password', '12345');
    I.fillField('endereco', 'R. Guilherme Dumont Vilares');
    I.fillField('nascimento', '04/10/1997');
    I.fillField('sexo', 'Feminino');
    I.fillField('email1', 'test@gmail.com');
    I.fillField('telefone1', '11123456');
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Pacientes');
    I.see('testUser');
});

Scenario('AT1.2.3 - Verificar CRUD administrativa (Pacientes - Delete)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Pacientes');
    I.click('hskodama');
    I.click('❌');
    I.click('Confirmar exclusão');
    I.amOnPage('/admin/patient.php');
    I.dontSee('hskodama');
});

Scenario('AT1.2.3 - Verificar CRUD administrativa (Pacientes - Update)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Pacientes');
    I.click('hskodama');
    I.click('✏️');
    I.fillField('nome', 'Shinki Kodama');
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Pacientes');
    I.see('Shinki Kodama');
    I.dontSee('Henrique Shinki');
});

Scenario('AT1.2.3 - Verificar CRUD administrativa (Pacientes - Filtro)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Funcionários');
    I.selectOption('#searchAttribute', 'Nome');
    I.fillField('searchValue', 'Rodrigo Kinchoko');
    I.click('Buscar');
    I.see('choko');

    I.selectOption('#searchAttribute', 'CPF');
    I.fillField('searchValue', '44368372630');
    I.click('Buscar');
    I.see('Pedro Coelho');
});

Scenario('AT1.3.1 - Verificar CRUD administrativa (Procedimento - Create)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Procedimentos');
    I.click('Novo procedimento');
    I.fillField('protocolo', '9831251');
    I.fillField('datahora', '10/10/1998');
    I.fillField('local', 'Sorocaba');
    I.fillField('paciente', 'eleven');
    I.fillField('exames', 'Glicose');
    I.fillField('funcionarios', 'rocha');
    I.fillField('resultado', 'Toer de glicose muito alto');
    I.click('Slavar');
    I.click('Dashboard administrativo');
    I.click('Procedimentos');
    I.see('9831251');
});

Scenario('AT1.3.2 - Verificar CRUD administrativa (Procedimento - Create)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Procedimentos');
    I.click('Novo procedimento');
    I.click('Salvar');
    I.see('Protocolo é obrigatório!');

    I.click('Salvar');
    I.fillField('protocolo', '9831251');
    I.see('Datahora é obrigatório!');

    I.click('Salvar');
    I.fillField('protocolo', '9831251');
    I.fillField('datahora', '10/10/1998');
    I.see('Local é obrigatório!');

    I.click('Salvar');
    I.fillField('protocolo', '9831251');
    I.fillField('datahora', '10/10/1998');
    I.fillField('local', 'Sorocaba');
    I.fillField('paciente', 'eleven');
    I.see('Paciente é obrigatório!');

    I.click('Salvar');
    I.fillField('protocolo', '9831251');
    I.fillField('datahora', '10/10/1998');
    I.fillField('local', 'Sorocaba');
    I.fillField('paciente', 'eleven');
    I.see('Resultado é obrigatório!');
    
    I.click('Salvar');
    I.fillField('protocolo', '9831251');
    I.fillField('datahora', '10/10/1998');
    I.fillField('local', 'Sorocaba');
    I.fillField('paciente', 'aaa');
    I.fillField('resultado', 'Toer de glicose muito alto');
    I.see('Paciente informado não existe!');

    I.click('Salvar');
    I.fillField('protocolo', '9831251');
    I.fillField('datahora', '10/10/1998');
    I.fillField('local', 'Sorocaba');
    I.fillField('paciente', 'ryze');
    I.fillField('resultado', 'Toer de glicose muito alto');
    I.see('Algum dos funcionários informados não existe!');

    I.click('Salvar');
    I.fillField('protocolo', '9831251');
    I.fillField('datahora', '10/10/1998');
    I.fillField('local', 'Sorocaba');
    I.fillField('paciente', 'ryze');
    I.fillField('resultado', 'Toer de glicose muito alto');
    I.fillField('funcionarios', 'rocha');
    I.see('Algum dos exames informados não existe!');
});


Scenario('AT1.3.3 - Verificar CRUD administrativa (Procedimentos - Delete)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Procedimentos');
    I.click('4651ds32f');
    I.click('❌');
    I.click('Confirmar exclusão');
    I.amOnPage('/admin/procedure.php');
    I.dontSee('4651ds32f');
});

Scenario('AT1.3.4 - Verificar CRUD administrativa (Procedimentos - Update)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Procedimentos');
    I.click('4651ds32f');
    I.click('✏️');
    I.fillField('local', 'Sao Paulo - Morumbi');
    I.click('Salvar');
    I.click('Dashboard administrativo');
    I.click('Procedimentos');
    I.see('Sao Paulo - Morumbi');
});

Scenario('AT1.4.1 - Verificar Interface administrativa (Funcionarios)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Funcionários');
    I.see('rocha');
    I.see('verinha');
});

Scenario('AT1.4.2 - Verificar Interface administrativa (Funcionarios)', (I, loginAs) => {
    //pause();
    loginAs('admin');
    //I.amOnPage('/index.php');
    I.click('Funcionários');
    I.selectOption('#searchAttribute', 'Nome');
    I.fillField('searchValue', 'rocha');
    I.click('Buscar');
    I.see('Gabriel Rodrigues');

    I.selectOption('#searchAttribute', 'Cargo');
    I.fillField('searchValue', 'Gerente');
    I.click('Buscar');
    I.see('gabriel');

    I.selectOption('#searchAttribute', 'Username');
    I.fillField('searchValue', 'pablooo');
    I.click('Buscar');
    I.see('Recepcionista');
});

