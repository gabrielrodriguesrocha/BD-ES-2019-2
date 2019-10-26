# BD-ES-2019-2

## Como executar

Se o `docker` já estiver instalado, basta executar `docker-compose up`.

Caso queira desenvolver de forma totalmente virtualizada, há um `Vagrantfile` que cria uma máquina virtual com Ubuntu para desenvolver. Nesse caso, basta executar:
`vagrant up`, acessar a máquina com `vagrant ssh php` e executar `cd /vagrant && sudo docker-compose up`.

## Padrões de desenvolvimento

* Não utilizar CSS: [Design brutalista](https://brutalist-web.design/);
* Nova feature? Novo branch:
    * `git checkout <branch_name> || git checkout -b <branch_name>`
* Com ORM mas sem PDO: o mais simples possível;
* Testes: utilizar `codeceptjs`;
