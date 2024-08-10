# Aplicación Web REST con MVC

## Descripción

Esta aplicación web permite consultar información almacenada en una base de datos a través de un servicio web tipo REST. El proyecto sigue el patrón de diseño MVC (Modelo-Vista-Controlador) para organizar el código de manera eficiente y facilitar su mantenimiento. Además, se utilizan los patrones de diseño DAO (Data Access Object) para el acceso a datos y Singleton para la gestión de la conexión a la base de datos. 

La respuesta del servicio se genera en formato JSON, cumpliendo con los requisitos especificados.

## Tabla de Contenidos

- [Características](#características)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Requisitos Previos](#requisitos-previos)
- [Instalación](#instalación)
- [Uso](#uso)
- [Configuración](#configuración)
- [Patrones de Diseño Implementados](#patrones-de-diseño-implementados)
- [Licencia](#licencia)

## Características

- Consulta de información vía Web Service REST.
- Respuesta en formato JSON.
- Uso de patrón de diseño MVC.
- Implementación de patrones DAO y Singleton.
- Código limpio, desacoplado y bien documentado.

## Estructura del Proyecto
![Texto alternativo](https://i.imgur.com/8vwkqyK.png)

- **`config/`**: Contiene la configuración de la base de datos y otras configuraciones generales.
- **`controller/`**: Contiene el controlador `UserController.php` que maneja las solicitudes y respuestas.
- **`models/`**: Contiene las clases del modelo (`User.php`), acceso a la base de datos (`Database.php`), y la capa DAO (`UserDao.php`).
- **`views/`**: Contiene las vistas, hojas de estilo CSS y scripts JavaScript.
- **`index.php`**: Punto de entrada de la aplicación.

## Requisitos Previos

- PHP 7.4 o superior.
- Servidor web (Apache, Nginx, etc.).
- MySQL o cualquier sistema de gestión de bases de datos compatible.
- Composer (para la gestión de dependencias si es necesario).

## Instalación

1. Clona este repositorio en tu servidor web.

2. Configura las credenciales de la base de datos en config/config.php.

3. Crea la base de datos y la tabla correspondiente utilizando las consultas SQL provistas en models/Database.php.

## Base de datos
3. **Selecciona la base de datos:**

    ```sql
    member_club
    ```

4. **Crea la tabla de Miembros:**

    ```postgresql
    CREATE TABLE member_user (
        id SERIAL PRIMARY KEY,
        contact_email VARCHAR(255) UNIQUE NOT NULL,
        firt_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        membership_type VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    );
    ```
## Patrones de Diseño Implementados
1. MVC (Model-View-Controller): Estructura el código en tres capas (Modelo, Vista, Controlador) para separar responsabilidades.
2. DAO (Data Access Object): Centraliza el acceso a los datos mediante la clase UserDao.php.
3. Singleton: Implementado en Database.php para garantizar una única instancia de la conexión a la base de datos.