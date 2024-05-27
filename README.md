PROYECTO CRUD DOCUMENTOS PHP,MSQL Y AJAX
DISFRUTÉ MUCHO REALIZANDO ESTE PROYECTO YA QUE ME APASIONA PROGRAMAR Y APRENDER ACERCA DE TODOS LOS LENGUAJES, PODRAN NOTAR QUE SOY UN POCO PRINCIPIANTE, PERO POR ELLO SERIA PERTINENTE QUE SE COMUNICARAN CONMIGO POR SI PRESENTAN ALGUNA NOVEDAD A LA HORA DE  EJECUTAR EL CODIGO, YA SEA POR LOS SERVIDORES, DIMENSIONES DE PANTALLAS, ETC.

INSTALACIÓN 
1. Descarga XAMPP desde su página oficial (asegurate de descargar la versión adecuada para tu sistema operativo).
2. Clona el repositorio en la carpeta «htdocs» de XAMPP.
3. Abre XAMPP y asegúrate de que los servidores de Apache y MySQL estén activos.
4. Importa el archivo database.sql en el servidor MyADMINPHP de XAMPP. Nombre bd = innclod_db.  
5. Crea host local "phpinnclod.local" en Windows
    - Configura el archivo "hosts" de Windows, que mantiene una lista de nombres de dominio que corresponden a direcciones IP.
    - El archivo de hosts en Windows 7, o Windows 10, está en la carpeta C:\Windows\System32\drivers\etc. Edita el archivo llamado "hosts" en un bloc de notas (abrelo como administrador).
    - Se indica primero la IP local 127.0.0.1 y luego el nombre del host virtual PHPInnClod.local, separados por un espacio o tabulador. debe verse asi:

      # For example:
      #
      #      102.54.94.97     rhino.acme.com          # source server
      #       38.25.63.10     x.acme.com              # x client host
      
      # localhost name resolution is handled within DNS itself.
      #	127.0.0.1       localhost
      #	::1             localhost
      127.0.0.1       PHPInnClod.local

     Guarda el archivo hosts con los cambios realizados.

6. Abre el archivo de configuración de Apache para los host virtuales "vhost". El archivo está en esta ruta en mi Xampp, se llama: httpd-vhosts.conf. La ruta completa es   C:\xampp\apache\conf\extra\httpd-vhosts.conf. Las ultimas dos lineas del archivo deben quedar asi:

   ##<VirtualHost *:80>
    ##ServerAdmin webmaster@dummy-host2.example.com
    ##DocumentRoot "C:/xampp/htdocs/dummy-host2.example.com"
    ##ServerName dummy-host2.example.com
    ##ErrorLog "logs/dummy-host2.example.com-error.log"
    ##CustomLog "logs/dummy-host2.example.com-access.log" common
  ##</VirtualHost>

  <VirtualHost *:80>
     DocumentRoot "C:/xampp/htdocs/PHPInnClod"
     ServerName PHPInnClod.local
  </VirtualHost>

  No olvides abrir el archivo como administrador y guardar los cambios. 

7. Reinicia el servidor Apache para que los cambios se vean reflejados.  
8. Accede al host a través de tu navegador: http://PHPInnClod.local

Soluciona "Acceso prohibido!" Error 403

Si te aparece este error, es porque Apache está rechazando la conexión por la configuración del Virtualhost. 
Cambia unas líneas en el bloque "Directory". Con esta otra configuración, el error 403 debe desaparecer.

<Directory "C:\PHPInnClod\httpdocs">
   Options All
   AllowOverride All
   Require all granted
</Directory>
