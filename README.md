hosts-datei
192.168.56.200 private-services.devel
192.168.56.200 www.private-services.devel

sudo su && \
apt-get update && \
apt-get install apache2 && \
apt-get install php5 && \
apt-get install mariadb-server


cd /etc/apache2/sites-available/
cp 000-default.conf private-services.conf

---------------------------------------------------------------------------------------
<VirtualHost 192.168.56.200:80>
        # The ServerName directive sets the request scheme, hostname and port that
        # the server uses to identify itself. This is used when creating
        # redirection URLs. In the context of virtual hosts, the ServerName
        # specifies what hostname must appear in the request's Host: header to
        # match this virtual host. For the default virtual host (this file) this
        # value is not decisive as it is used as a last resort host regardless.
        # However, you must set it for any further virtual host explicitly.
        ServerName private-services.devel
        ServerAlias www.private-services.devel

        ServerAdmin webmaster@localhost

        DocumentRoot /var/www/private-services/web
        <Directory /var/www/private-services/web>

                #Options Indexes FollowSymlinks MultiViews
                #AllowOverride All
                #Require all granted


                AllowOverride None
                Order Allow,Deny
                Allow from All

                <IfModule mod_rewrite.c>
                    Options -MultiViews
                    RewriteEngine On
                    RewriteCond %{REQUEST_FILENAME} !-f
                    RewriteRule ^(.*)$ app_dev.php [QSA,L]
                </IfModule>


        </Directory>

        <Directory /var/www/project/web/bundles>
                <IfModule mod_rewrite.c>
                    RewriteEngine Off
                </IfModule>
        </Directory>

        # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
        # error, crit, alert, emerg.
        # It is also possible to configure the loglevel for particular
        # modules, e.g.
        LogLevel debug



        ErrorLog /var/log/apache2/private-services_error.log
        CustomLog /var/log/apache2/private-services_access.log combined


        # For most configuration files from conf-available/, which are
        # enabled or disabled at a global level, it is possible to
        # include a line for only one particular virtual host. For example the
        # following line enables the CGI configuration for this host only
        # after it has been globally disabled with "a2disconf".
		 #Include conf-available/serve-cgi-bin.conf



</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
---------------------------------------------------------------------------------------

sudo a2enmod rewrite
sudo a2ensite private-services
