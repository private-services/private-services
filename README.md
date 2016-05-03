0. Install symfony
	- composer install
		- database_name: private-services
		- database_password: 123
		
1. Install Vagrant
    - vagrant plugin install vagrant-winnfsd
	- vagrant plugin install vagrant-proxyconf
	
2. Install vagrant box
	- vagrant up (execute in Config dir)
	    - will use the vagrantfile setup
	- provision: (provision/setup.sh)
		- will install php, mariadb, apache
		- will configurate apache 
		    - create vhost (copy provision/config/private-services.conf to apache)
		    - enable modrewrite
		    - enable vhost
		- will setup MariaDB (MySql) with:
        	- user: root
        	- password: 123
        	
3. Adjust hosts-file on host system (windows/system32/etc/host)
	- 192.168.56.200 private-services.devel
    - 192.168.56.200 www.private-services.devel
