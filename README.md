# iaw-practica-08

## Implantación de Wordpress en Amazon Web Services (AWS) sobre la pila LAMP

### Fase 0

Para esta práctica he tomado como base el script que completamos en la práctica 01, añadiendo las modificaciones necesarias:

- La base de datos se cambia. Hay dos opciones para este caso: introducimos dentro del script los comandos de creación de la base de datos o introducimos un archivo externo. He optado por introducir la base de datos como archivo:

    `mysql -u root < database.sql`

    También hay que tener en cuenta que en este caso no hemos cambiado la contraseña de root en MySQL. El script para la base de datos es el siguiente:

    ```
    DROP DATABASE IF EXISTS db_wordpress;
    CREATE DATABASE db_wordpress CHARSET utf8mb4;
    USE db_wordpress;

    CREATE USER IF NOT EXISTS 'db_user'@'%';
    SET PASSWORD FOR 'db_user'@'%' = 'db_password';
    GRANT ALL PRIVILEGES ON db_wordpress.* TO 'db_user'@'%';
    ```

- Para instalar Wordpress primero lo descargamos y lo descomprimimos:

    ```
    wget https://wordpress.org/latest.tar.gz
    tar -xzvf latest.tar.gz
    rm latest.tar.gz
    ```

    Copiamos el contenido a la carpeta /var/www/html:

    `cp -r wordpress/* /var/www/html`

    Copiamos el archivo de configuración en /var/www/html de Wordpress. En ese archivo tenemos que cambiar los datos de la base de datos donde se va a almacenar y debemos introducir unas claves que se generan a través de la página https://api.wordpress.org/secret-key/1.1/salt/:

    ```
    define( 'DB_NAME', 'db_wordpress' );
    define( 'DB_USER', 'db_user' );
    define( 'DB_PASSWORD', 'db_password' );
    ```

    Estas serían las claves generadas para la máquina de prueba:

    ```
    define('AUTH_KEY',         'Ly>k5iDG8e6*Y4C@x|D6m&~jAY~L54]~.Cp|R+Snl9Q`-=WU[1hL~g>9m-d2=cN@');
    define('SECURE_AUTH_KEY',  'ULK@xG#L%?L:e=w>B=`}S{Paj+UX)S3SvICKFas*P~MwzFRDSmCl%c`57k;wqoB&');
    define('LOGGED_IN_KEY',    'd~DxhLb{!`+vB#~AK ],H:|vd?*|yz.9Ect+3I6dh6pE 5pWfd~TFm+qu<4aU3k-');
    define('NONCE_KEY',        '_x|AZ?iv+|<^cX,ux^Xf=@ls)Czmo|PUD d|WC5Y``HEFHbt7c}+{I&Fhji%#I1#');
    define('AUTH_SALT',        'ZBfUHN${/b0.PWRpAL9eoRw229O;L`2Ny+*cqjU-N}oM]E%Ic&eN!#:l_SO.S<-#');
    define('SECURE_AUTH_SALT', '::oA=st{gtc:xAS2~Oj@uk/;$]h-aG|#./6SIpwtgP/XiOOko.8GdNGR&>S8e=}j');
    define('LOGGED_IN_SALT',   'IZD|Ijk(1v>uTHh$Dn]#/rU1apBqEl*BF]?6H{W<>)Y7[5. -+uw<B$pT~d1Y>CU');
    define('NONCE_SALT',       'O9aFMNd97Xjgi-|+,WL:ad(<vV,|Z|#*.{t+)qx .HMExiH,[eE&RJmf-^mSEXxf');
    ```
