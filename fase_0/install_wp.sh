#!/bin/bash

#-------------------------------------------------------------------------------
# Configuramos las variables
#-------------------------------------------------------------------------------

# Variables GoAcces
HTTPASSWD_USER=usuario
HTTPASSWD_PASSWD=usuario
HTTPASSWD_DIR=/home/ubuntu

# Variables base de datos
NDB=db_wordpress
UNDB=lamp_user
PNDB=lamp_password

# ------------------------------------------------------------------------------
# Instalación de la máquina LAMP
# ------------------------------------------------------------------------------

# Habilitamos el modo de shell para mostrar los comandos que se ejecutan
set -x

# Actualizamos la lista de paquetes
apt update -y

# Instalamos el servidor web Apache
apt install apache2 -y

# Instalamos los módulos necesarios de PHP
apt install php libapache2-mod-php php-mysql -y

# Instalamos los módulos de phpMyAdmin excepto el principal
apt install php-mbstring php-zip php-gd php-json php-curl -y

# Instalamos el sistema gestor de base de datos
apt install mysql-server -y

# Copiamos la base de datos creada en MySQL
mysql -u root < database.sql

# Descargamos Adminer
mkdir /var/www/html/adminer
cd /var/www/html/adminer
wget https://github.com/vrana/adminer/releases/download/v4.7.7/adminer-4.7.7-mysql.php
mv adminer-4.7.7-mysql.php index.php

# Instalación de GoAccess
echo "deb http://deb.goaccess.io/ $(lsb_release -cs) main" | tee -a /etc/apt/sources.list.d/goaccess.list
wget -O - https://deb.goaccess.io/gnugpg.key | sudo apt-key add -
apt-get update -y
apt-get install goaccess -y

# Creacion de un directorio para consultar las estadísticas
mkdir -p /var/www/html/stats

# Lanzamos el proceso
nohup goaccess /var/log/apache2/access.log -o /var/www/html/stats/index.html --log-format=COMBINED --real-time-html &
htpasswd -bc $HTTPASSWD_DIR/.htpasswd $HTTPASSWD_USER $HTTPASSWD_PASSWD

# Copiamos el archivo de configuración de Apache
cp /home/ubuntu/000-default.conf /etc/apache2/sites-available/
systemctl restart apache2

# Instalamos Unzip
apt install unzip -y

# Instalamos phpMyAdmin
cd /home/ubuntu
rm -rf phpMyAdmin-5.0.4-all-lenguages.zip
wget https://files.phpmyadmin.net/phpMyAdmin/5.0.4/phpMyAdmin-5.0.4-all-languages.zip
unzip phpMyAdmin-5.0.4-all-languages.zip
rm -rf phpMyAdmin-5.0.4-all-languages.zip
rm -rf /var/www/html/phpmyadmin
mv phpMyAdmin-5.0.4-all-languages /var/www/html/phpmyadmin
cp config.inc.php /var/www/html/phpmyadmin/

# Cambiamos los permisos de la carpeta html
cd /var/www/html
chown www-data:www-data * -R

# ------------------------------------------------------------------------------
# Instalación de la aplicación web propuesta
# ------------------------------------------------------------------------------

cd /home/ubuntu

# Instalamos Wordpress
wget https://wordpress.org/latest.tar.gz
tar -xzvf latest.tar.gz
rm latest.tar.gz

# Borramos el archivo index.html
rm /var/www/html/index.html

# Movemos el contenido de Wordpress la carpeta html
cp -r wordpress/* /var/www/html

# Copiamos nuestra configuración de Wordpress
cp wp-config.php /var/www/html

# Reiniciamos apache2
systemctl restart apache2