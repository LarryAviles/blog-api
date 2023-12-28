# Blog PHP/Laravel
## Funcionalidad

La prueba se divide en dos proyectos: "blog-api" y "blog-client". Opté por esta estructura para evaluar los endpoints en un proyecto separado. Al configurar los servidores locales, es esencial tener en cuenta que "blog-api" se ejecutará en el puerto 8000 y "blog-client" en el puerto 8001, mediante el comando "php artisan serve --port=8001".

Además, se debe crear una base de datos en MySQL llamada "blog-api" y realizar las migraciones en ese proyecto para visualizar las publicaciones, autores y sus comentarios.

Aqui esta el repositorio del proyecto de client: https://github.com/LarryAviles/blog-client
## Instalación
API:
```
git clone https://github.com/LarryAviles/blog-api.git
cd blog-api
composer install
```
Client:
```
git clone https://github.com/LarryAviles/blog-client.git
cd blog-client
composer install
```

### Configuración del .env
Se puede usar el .env.example del proyecto que ya tiene las configuraciones

API:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog-api
DB_USERNAME=root
DB_PASSWORD=

al final del .env agregar:
SANCTUM_STATEFUL_DOMAINS="*"
```
Client:
```
al final del .env agregar:
URL_SERVER_API="http://127.0.0.1:8000/api"
```

### Pasos finales
API:
```
php artisan migrate --seed
php artisan key:generate
php artisan serve
```
Client:
```
php artisan key:generate
php artisan serve --port=8001
```
Para usar el cliente en local se entra a http://127.0.0.1:8001/
Se pueden realizar prueba de los Endpoints en http://127.0.0.1:8000/
## Endpoints

Posts:

```
All -> /api/posts
Search -> /api/posts/search 
Show -> /api/post/{id}
Store -> /api/post/store 
Update -> /api/post/{id}/update
Remove -> /api/post/{id}/destroy
```

Autores:

```
All -> /api/authors
Show -> /api/author/{id}
Store -> /api/author/store 
Update -> /api/author/{id}/update
Remove -> /api/author/{id}/destroy
```

Comentarios:

```
All -> /api/comments
Export -> /api/comments/export
Store -> /api/comment/store 
Remove -> /api/comment/{id}/destroy
```
