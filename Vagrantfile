# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
  config.vm.define "php" do |php|

 	php.vm.box = "ubuntu/bionic64"
 	php.vm.network "forwarded_port", guest: 80, host: 8000
  	php.vm.network "public_network"
    php.vm.network "private_network", ip: "192.168.50.2"
  	php.vm.hostname = "php"
  	php.vm.provider "virtualphp" do |vb|
      		vb.memory = "2048"
    	  	vb.name = "php"
  	end
    php.vm.provision :shell, path: "./provision.sh"
end
end
