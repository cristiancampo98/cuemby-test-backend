## Cuemby-test

Esta aplicación te permitirá buscar a tu equipo favorito y conocer
que jugadores pertenecen a este. Además, podrás buscar a jugadores
de su interés y conocer algunos detalles de ellos.

## Clonar proyecto

    git clone https://github.com/cristiancampo98/cuemby-test-backend.git

## Instalar dependencias

    cd cuemby-test-backend

    composer install

## Crear archivo .env

    cp .env.example .env

El archivo .env contiene una API_KEY la cual es necesaria para poder realizar consultas a la api

## Ejecutar migraciones

    php artisan migrate

Puede ser necesario configurar la base de datos para poder ejecutar las migraciones

## Ejecutar proyecto

    php artisan serve
