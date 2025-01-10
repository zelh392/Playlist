# Playlist Web Application

## Descripción

La aplicación **Playlist Web Application** permite a los usuarios crear y gestionar sus propias listas de reproducción de música. Los usuarios pueden añadir canciones a sus listas, ver detalles de las canciones y escuchar los archivos subidos (en formato MP3). Además, los usuarios pueden añadir listas a sus favoritos y buscar canciones en toda la base de datos.

El sistema está dividido en dos tipos de usuarios:
- **Usuarios normales**: Pueden crear y gestionar sus propias listas de reproducción y canciones.
- **Administradores**: Además de las funcionalidades de los usuarios normales, tienen acceso a la gestión completa del sistema.

## Funcionalidades

### Usuarios No Registrados
- Cuando un usuario **no registrado** entra en la web, verá un mensaje de bienvenida con opciones para **registrarse** o **iniciar sesión**.

### Registro e Inicio de Sesión
- Los usuarios **registrados** pueden iniciar sesión con sus credenciales.

### Listas de Reproducción
- Los usuarios pueden **ver sus listas de reproducción** existentes.
- Los usuarios pueden **crear nuevas listas de reproducción**, proporcionando un título para la lista.
- Cada lista de reproducción muestra:
  - Título de la lista.
  - Número total de canciones en la lista.
  - Duración total de la lista (en minutos:segundos).

### Canciones
- Los usuarios pueden **crear nuevas canciones**, añadiendo:
  - Título de la canción.
  - Autor de la canción.
  - Duración de la canción (en segundos).
  - Subir un archivo MP3 para la canción.
  
### Buscador de Canciones
- Los usuarios pueden **buscar canciones** en todo el sistema filtrando por:
  - Título de la canción.
  - Autor de la canción.

### Asignar Canciones a Listas
- Los usuarios pueden **asignar canciones** a sus listas de reproducción mediante un formulario, utilizando un input (idealmente con `datalist` para mostrar las opciones).

### Detalle de Listas de Reproducción
- Al seleccionar una lista de reproducción, el usuario podrá ver un **detalle completo** de la lista:
  - Título de la lista.
  - Canciones contenidas en la lista (con título, autor y duración de cada canción).
  
### Funcionalidad de Favoritos
- Los usuarios pueden **agregar listas de reproducción a sus favoritos**.
- En la vista principal, los usuarios pueden ver:
  - Sus propias listas de reproducción.
  - Sus listas favoritas.

### Funcionalidades Extras
- **Escuchar Canciones**: Al agregar una nueva canción, se puede **subir un archivo MP3** y el usuario puede escuchar la canción directamente desde la lista de reproducción.
- **Buscador de Listas de Reproducción**: Los usuarios pueden **buscar listas de reproducción** por título o autor y agregarlas a sus favoritas.

---

## Tecnologías Utilizadas

- **Backend**: Laravel (PHP)
- **Frontend**: HTML, CSS, JavaScript
- **Base de Datos**: MySQL
- **Autenticación**: Laravel Breeze (Autenticación de usuarios)
- **Archivos**: MP3 para las canciones


