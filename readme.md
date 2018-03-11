## CerteSE

Esta aplicacion permite estar al tanto de los diferentos eventos que existen en Sevilla

### Instalacion

Para poder instalar la aplicacion desde un terminal de linux o terminal git realiza un `"`$ git clone https://github.com/Anmoysan/CerteSE.git`"` e importa la ultima version del proyecto a tu equipo.

Para poder usar correctamente la aplicacion debe terner instalado composer de manera nativa, también debe terner vagrant y virtualbox instalados.

### Configuracion

Para poder usar la base de datos debe acceder a la carpeta Homestead y modificar el archivo `"`Homestead.yaml`"`
![Archivo Homestead.yaml](https://imgur.com/J1JHGHg.png)

Se debe rellenar sites y databases igual que aparece aqui, sino se ha modificado folders(campo **to**)

Tambien se deberá modificar el archivo host ubicado en Windows en `C:\Windows\System32\drivers\etc`. Este archivo debe modificarse fuera de esa carpeta y despues pegarla dentro o editarla con permisos de administrador. Al final del archivo se debera ingresar esta linea

> 192.168.10.10 certese.test
![Archivo Hosts](https://imgur.com/a/ps34Q.png)


Una vez el proyecto instalado correctamente deberas crear un .env con tus datos corresposdientes a partir de .env.example y poner los datos como muestra la imagen

![.env](https://imgur.com/1TeLbPv.png)

Ir al archivo `php.ini` situado en nuestra carpeta de php y quitar el comentario con ; delante a la linea `extensión=php_gd2.dll` para usar dompdf y descargar nuestras facturas.

En la terminal de la aplicacion se debe ejecutar el comando `composer install` para poder empezar a usar la aplicacion

Se debe hacer un enlace blando para poder guardar los documentos en local. Debe ejecutarse el comando `php artisan storage:link` y despues ejecutar `vagrant ssh` desde la carpeta Homestead para acceder a la maquina virtual. Una vez dentro ejecutar estos comando:

>cd code/CerteSE/public

>rm -rf storage

>ln -s /home/vagrant/code/CerteSE/storage/app/public/ storage


### Uso

Para poder usar la aplicacion se debe ejecutar `vagrant up` para poder acceder al archivo. En la pagina web debe enlazar a la url indicada al proyecto tanto en `"`Homestead.yaml`"` como en `"`Hosts`"`

Si se desea tener valores por defecto ejecutar en la carpeta del proyecto el siguiente comando:

>php artisan migrate --seed

**Espero que les sea de ayuda y gracias por usar esta aplicacion**# CerteSE
