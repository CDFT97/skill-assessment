<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Quotes App
#### Evaluación de Habilidades

El desafío contendrá algunas características fundamentales que la mayoría de las aplicaciones tienen. Esto incluye la conexión a una API, un MVC básico, la exposición de una API y, finalmente, pruebas.

### Importante
* Crear el frontend junto al backend en el mismo projecto o applicacion

La API a la que queremos que te conectes es [https://dummyjson.com/docs/quotes](https://dummyjson.com/docs/quotes)

### La aplicación debe tener las siguientes características:
1. Autenticación de usuario y página de actualización de perfil ✅
2. Una página que muestre 5 citas aleatorias ✅
    * Debe haber un botón para actualizar las citas ✅
    * Debe haber un botón junto a cada cita para guardarla en tus favoritos ✅
3. Una página que muestre tus favoritos guardados. Debe haber un botón para eliminar una cita de tus favoritos ✅
4. Implementar límites de velocidad para las solicitudes de la API a `https://dummyjson.com/quotes` para evitar el abuso. La API debe estar limitada a 30 solicitudes por minuto.
5. Autenticación de administrador por separado para moderar las citas de usuario guardadas y prohibir usuarios
6. El frontend debe hacerse con Vue.js y opcionalmente Inertia.js
    * TypeScript debe usarse para cualquier funcionalidad del frontend
    * La interfaz de usuario debe ser receptiva
7. Debe estar disponible una ruta de API para recuperar un número especificado de citas aleatorias de Kayne West
8. Debe estar disponible una ruta de API para recuperar tus citas favoritas
9. Debe estar disponible una ruta de API para eliminar una cita de tus favoritos
10. Todas las rutas de la API deben estar aseguradas con un token de usuario
11. Todas las características anteriores deben probarse con pruebas de características

#### Extra Credit
* Usar Composition API y setup script en componentes de Vue

## Desarrollador
Nombre: Cesar Febres <br/>
Correo electrónico: febrescesar7@gmail.com<br/>

## Instrucciones
### NO INICIES UNA NUEVA APLICACIÓN LARAVEL, ¡UTILIZA ESTE ESQUELETO EN SU LUGAR!

### Clonar el repositorio
1. Crea un clon sin contenido del repositorio. (Esto es temporal y se eliminará, así que hazlo donde sea.)
    ```bash
    git clone --bare https://github.com/FmTod2/skill-assessment.git
    ```

2. Crea un nuevo repositorio en GitHub.

3. Haz un push en espejo de tu clon sin contenido a tu nuevo repositorio.<br/>_Reemplaza &lt;username&gt; con tu nombre de usuario real de GitHub en la URL de abajo._<br/>_Reemplaza &lt;repository&gt; con el nombre de tu nuevo repositorio._
    ```shell
    cd skill-assessment-quotes.git
    git push --mirror https://github.com/<username>/<repository>.git
    ```
4. Elimina el clon sin contenido creado en el paso 1.
    ```shell
    cd ..
    rm -rf skill-assessment-quotes.git
    ```
   
5. Ahora puedes clonar tu repositorio, donde vas a trabajar, en tu máquina (en mi caso, en la carpeta de código).
    ```shell
    cd ~/code
    git clone https://github.com/<username>/<repository>.git
    ```

## Empezando

1. Crea una copia del archivo `.env.example` como `.env`
    ```bash
    cp .env.example .env
    ```

2. Instala las dependencias:

<details>
<summary> a. Docker (Recomendado)</summary>

3. Instala las dependencias de Composer
    ```shell
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
    ```

4. Inicia el contenedor (Sail):
    ```shell
    ./vendor/bin/sail up -d
    ```

5. Genera una nueva clave secreta:
    ```shell
    ./vendor/bin/sail artisan key:generate
    ```
</details>

<details>
<summary>b. Sin Docker (No recomendado)</summary>

3. Instala todas las dependencias requeridas
    ```bash
    composer install
    ```

4. Genera una nueva clave secreta:
    ```shell
    php artisan key:generate
    ```

</details>

‼️ <i>Nota: Se recomienda Docker ya que todas las dependencias externas necesarias ya están presentes en el contenedor proporcionado. Sin Docker, es posible que debas instalar algunas dependencias externas como MySQL o algunas extensiones adicionales de PHP requeridas por el proyecto</i>

## Tu primer commit (IMPORTANTE)
   
1. Edita el archivo README.md y agrega tu nombre y correo electrónico.
    ```diff
    - Nombre: `<tu nombre>` <br/>
    - Correo electrónico: `<tu correo electrónico>` <br/>
    + Nombre: Jhon Doe <br/>
    + Correo electrónico: jhondoe@ejemplo.com <br/>
    ```
   
2. Envía tu primer commit solo con los cambios al archivo README.md. Debe hacerse antes de comenzar la asignación.
    ```shell
    git add README.md
    git commit -m "Commit inicial"
    git push
    ```

## Ejecución de Comandos

<details>
<summary>Docker/Sail</summary>

### Comandos de PHP
```shell
./vendor/bin/sail php --version
 
./vendor/bin/sail php script.php
