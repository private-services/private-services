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


4. Enable XDebug
	- Provisioning will install Xdebug and config-file
    - PHP-Storm->Settings
        - Languages & Frameworks > PHP
			- Interpreter > ... > + > Remote
				- SSH Credentials
				- Host: private-services.devel
				- User name: vagrant
				- Auth type: Password
				- Password: vagrant
			- Path mappings > ...
				- Local Path: <PathToProject>/Source/private-services
				- Remote Path: /var/www/private-services
			- Servers > +
				- Name: private-services
				- Host: private-services.devel
				- Use path mappings: true
					- File/Directory: <PathToProject>/Source/private-services/
					- Absolute path on server: /var/www/private-services
					
5. Enable PHPUnit
	- create Source/private-services/app/phpunit.xml from Source/private-services/app/phpunit.xml.dist
	- Install PHPUnit if not already installed (which it should be):  composer require phpunit
    - PHP-Storm->Settings
		- Languages & Frameworks > PHP > PHPUnit > + (By remote interpreter)
			- Use custom autoloader: true
			- Path to script: /var/www/private-services/vendor/autoload.php
			- Default configuration file: /var/www/private-services/app/phpunit.xml
	- Run > Edit Configurations > + (PHPUnit)
		- Name: private-services
		- Use alternative configuration file: D:\projects\private_services\Source\private-services\app\phpunit.xml
				
					