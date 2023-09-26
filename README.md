# Instalacion Moodle
Para instalar Moodle 4.1 en Ubuntu, puedes seguir estos pasos generales. Ten en cuenta que los detalles específicos pueden cambiar con el tiempo, así que asegúrate de consultar la documentación más actualizada de Moodle y de Ubuntu antes de comenzar:

Actualizar el sistema: Abre una terminal y asegúrate de que tu sistema esté actualizado ejecutando los siguientes comandos:

sudo apt update
sudo apt upgrade

Instalar los requisitos previos: Moodle requiere una serie de paquetes y software adicional para funcionar correctamente. Puedes instalarlos con el siguiente comando:

## sudo apt install apache2 mariadb-server php php-gd php-xml php-mysql php-curl php-zip php-intl php-mbstring php-xmlrpc php-soap php-bcmath libapache2-mod-php unzip

Configurar la base de datos: Asegúrate de configurar una base de datos para Moodle. Puedes hacerlo ejecutando el siguiente comando:

## sudo mysql_secure_installation
Sigue las instrucciones para configurar una contraseña segura y responder a las demás preguntas.
Crear una base de datos y un usuario para Moodle: Inicia sesión en MySQL con el siguiente comando:

sudo mysql -u root -p

Luego, ejecuta estos comandos para crear una base de datos y un usuario para Moodle:

CREATE DATABASE moodle;
CREATE USER 'moodleuser'@'localhost' IDENTIFIED BY 'contraseña';
GRANT ALL PRIVILEGES ON moodle.* TO 'moodleuser'@'localhost';
FLUSH PRIVILEGES;
EXIT;

Descargar Moodle: Puedes descargar la última versión de Moodle desde el sitio web oficial o utilizando wget en la terminal. Por ejemplo:

wget https://download.moodle.org/download.php/stable41/moodle-latest-41.tgz

Descomprimir Moodle: Extrae el archivo descargado en el directorio de tu servidor web. Por lo general, se encuentra en /var/www/html. Utiliza el siguiente comando para descomprimirlo:

## sudo tar -zxvf moodle-latest-41.tgz -C /var/www/html/

Configurar Moodle: Ahora, debes configurar Moodle a través de su interfaz web. Abre un navegador y visita http://tu-direccion-ip/moodle o http://localhost/moodle, dependiendo de dónde estés configurando Moodle. Sigue las instrucciones de instalación en pantalla para completar la configuración inicial.

Finalizar la instalación: Moodle te guiará a través del proceso de instalación, donde configurarás la base de datos, la cuenta de administrador y otras configuraciones importantes.

Configurar Apache: Asegúrate de que Apache tenga habilitado el módulo mod_rewrite con el siguiente comando:

sudo a2enmod rewrite
Reiniciar Apache: Reinicia Apache para aplicar los cambios:

sudo systemctl restart apache2

¡Eso es todo! Ahora deberías tener Moodle 4.1 instalado y funcionando en tu servidor Ubuntu. Recuerda mantener tu sistema y Moodle actualizados regularmente para garantizar la seguridad y el rendimiento.


no me funciona el localhost/moodle

Si no puedes acceder a localhost/moodle después de seguir los pasos anteriores, hay algunas posibles soluciones que puedes probar:

Verifica si Apache está en funcionamiento: Asegúrate de que el servidor web Apache esté en ejecución. Puedes hacerlo con el siguiente comando:

sudo systemctl status apache2
Si Apache no está en funcionamiento, puedes iniciar el servicio con:

## sudo systemctl start apache2
Comprueba la configuración de Apache: Asegúrate de que la configuración de Apache para Moodle esté configurada correctamente. Puedes verificar los archivos de configuración en el directorio /etc/apache2/sites-available/. Asegúrate de que haya un archivo de configuración para Moodle y que contenga las configuraciones adecuadas.

Verifica los permisos de archivos y carpetas: Asegúrate de que los archivos y carpetas de Moodle tengan los permisos correctos para que Apache pueda acceder a ellos. Puedes usar los siguientes comandos para establecer permisos adecuados:

## sudo chown -R www-data:www-data /var/www/html/moodle
## sudo chmod -R 755 /var/www/html/moodle
Esto asegura que Apache tenga permisos para acceder a los archivos y carpetas de Moodle.

Verifica la URL: Asegúrate de que estás ingresando la URL correcta en tu navegador. Debería ser algo como http://localhost/moodle.

Verifica la dirección IP y el nombre de host: Si estás accediendo a Moodle desde otro dispositivo en la misma red, asegúrate de que puedas resolver "localhost" en la dirección IP del servidor donde se encuentra Moodle. También puedes intentar acceder a través de la dirección IP directamente, como http://tu-direccion-ip/moodle.

Revisa los registros de error: Puedes verificar los registros de error de Apache para obtener más información sobre cualquier problema. Los registros se encuentran en /var/log/apache2/error.log. Puedes ver los últimos registros con el siguiente comando:

tail -n 50 /var/log/apache2/error.log
Esto podría proporcionar pistas sobre lo que está causando el problema.

Si después de verificar estos puntos aún no puedes acceder a localhost/moodle, por favor, proporciona más detalles sobre los mensajes de error o problemas específicos que estás experimentando para que pueda ayudarte mejor a resolver el problema.
# PARA EL MARIADB

## DESINSTALAR MARIADB
sudo systemctl stop mariadb.service;
sudo apt-get remove mariadb-server galera;
sudo apt-get remove --purge mariadb-client;
sudo apt-get autoremove;
sudo apt-get update;
## INSTALAR MARIADB 10.4
sudo apt-get install software-properties-common;
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xF1656F24C74CD1D8;
sudo add-apt-repository 'deb [arch=amd64] http://nyc2.mirrors.digitalocean.com/mariadb/repo/10.4/ubuntu focal main';
sudo apt-get update;
sudo apt-get install mariadb-server;
sudo apt-get update;
mysql --version




SELECT g.id AS group_id, g.name AS group_name, COUNT(u.id) AS num_students
FROM mdl_groups AS g
LEFT JOIN mdl_groups_members AS gm ON g.id = gm.groupid
LEFT JOIN mdl_user AS u ON gm.userid = u.id
LEFT JOIN mdl_role_assignments AS ra ON u.id = ra.userid
LEFT JOIN mdl_context AS c ON ra.contextid = c.id
WHERE g.courseid = 'tu_id_de_curso'
AND c.contextlevel = 50 -- El nivel de contexto 50 se usa para roles de curso 



# opción a

SELECT
    u.firstname AS Nombre,
    u.lastname AS Apellido,
    c.fullname AS Curso,
    g.finalgrade AS AvanceCurso
FROM mdl_user AS u
JOIN mdl_user_enrolments AS ue ON u.id = ue.userid
JOIN mdl_enrol AS e ON ue.enrolid = e.id
JOIN mdl_course AS c ON e.courseid = c.id
LEFT JOIN mdl_grade_grades AS g ON u.id = g.userid AND c.id = g.courseid
WHERE c.id = 'tu_id_de_curso';



# opcion b

SELECT
    u.firstname AS Nombre,
    u.lastname AS Apellido,
    c.fullname AS Curso,
    SUM(g.finalgrade) AS AvanceSemana
FROM mdl_user AS u
JOIN mdl_user_enrolments AS ue ON u.id = ue.userid
JOIN mdl_enrol AS e ON ue.enrolid = e.id
JOIN mdl_course AS c ON e.courseid = c.id
LEFT JOIN mdl_grade_grades AS g ON u.id = g.userid AND c.id = g.courseid
LEFT JOIN mdl_logstore_standard_log AS l ON u.id = l.userid
WHERE c.id = 'tu_id_de_curso'
    AND l.timecreated >= UNIX_TIMESTAMP(CURRENT_DATE) - (DAYOFWEEK(CURRENT_DATE) - 1) * 86400
    AND l.timecreated < UNIX_TIMESTAMP(CURRENT_DATE) + (8 - DAYOFWEEK(CURRENT_DATE)) * 86400
GROUP BY u.id, u.firstname, u.lastname, c.fullname;



# opción 3

SELECT
    u.firstname AS nombre_alumno,
    u.lastname AS apellido_alumno,
    c.fullname AS nombre_curso,
    CASE
        WHEN ue.timecompleted IS NOT NULL THEN 'Terminado'
        ELSE 'No terminado'
    END AS estado_curso
FROM
    mdl_user AS u
INNER JOIN
    mdl_user_enrolments AS ue ON u.id = ue.userid
INNER JOIN
    mdl_enrol AS e ON ue.enrolid = e.id
INNER JOIN
    mdl_course AS c ON e.courseid = c.id
WHERE
    c.id = 'ID_DEL_CURSO' -- Reemplaza 'ID_DEL_CURSO' con el ID del curso que deseas consultar
ORDER BY
    u.lastname, u.firstname;


# Mustache
require_once($CFG->libdir . '/mustache/src/Mustache/Autoloader.php');


$mustache = new \Mustache_Engine;
$template = file_get_contents($plugin->dir . '/templates/tu_plantilla.mustache');
$output = $mustache->render($template, $tu_contexto_de_datos);

$this->content->text = $output;

<p align="center">
    
# Bibliogames

### Proyecto realizado por Guillermo Rodriguez Huguet

<img src="public/imagenes/logosintexto.png" alt="Bibliogames">
 </p>
 
## Para este proyecto he usado node y laravel auth, se necesitará instalarlo para usarse en local

### En caso de no algun error consultar github del proyecto: https://github.com/guillerhv/proyecto

Documentacion de otros recursos que he utilizado: 
- Logo:  https://studio.tailorbrands.com
- Fuentes: https://fonts.google.com/ 
- Animaciones: https://animista.net
- Bootstrap: https://getbootstrap.com/docs/4.1/getting-started/introduction/
- Laravel: https://laravel.com/docs/9.x/readme 
   https://devdocs.io/laravel~9/
- jQuery: https://api.jquery.com/
- SweetAlert2: https://sweetalert2.github.io/ 
- Izitoast: https://izitoast.marcelodolza.com


