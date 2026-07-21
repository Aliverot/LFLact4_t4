# API REST de Videojuegos - Laravel & Sanctum

**Autor:** Leonardo Fuentes López  
**No. Control:** 22161062
**Institución:** Instituto Tecnológico de Oaxaca  

---

## Descripción del Proyecto
Este proyecto consiste en el desarrollo de una **API REST completa** construida con Laravel. El sistema permite gestionar un catálogo de videojuegos mediante operaciones CRUD completas y seguras. 

Características principales implementadas:
* **Autenticación basada en Tokens:** Integración de Laravel Sanctum para el registro y login de usuarios.
* **Seguridad (Middleware):** Protección de rutas CRUD para denegar el acceso a peticiones no autenticadas (Error 401).
* **Validación de Datos:** Reglas estrictas en los controladores para la creación y actualización, devolviendo respuestas JSON estructuradas ante errores (Error 422).
* **API Resources:** Transformación de la capa de salida para controlar exactamente qué datos se exponen en las respuestas JSON.
* **Pruebas de API:** Colección nativa exportada con el cliente Bruno (`.bru`).

---

## 🧪 Evidencia de Pruebas en Entorno Local (Bruno)

A continuación, se documenta la ejecución exitosa de cada uno de los endpoints de la API en el entorno de desarrollo local, siguiendo la colección de pruebas construida.

### 1. Registro de Usuario (POST)
Se valida la creación de un nuevo usuario en el sistema. Si los datos son correctos, devuelve código `201` y el token de acceso.

<img width="1432" height="565" alt="image" src="https://github.com/user-attachments/assets/43f9d990-b5b6-4f52-a562-7571d3459d65" />


### 2. Login de Usuario (POST)
Se autentican las credenciales del usuario, devolviendo un código `200` y el `access_token` necesario para consumir la API.

<img width="1431" height="561" alt="image" src="https://github.com/user-attachments/assets/e136a9b6-8da7-43aa-9f3e-97d43976b6f7" />


### 3. Comprobación de Seguridad (GET)
Se intenta acceder a la ruta protegida de videojuegos sin enviar el token Bearer. La API rechaza la petición con un `401 Unauthorized`.

<img width="1440" height="267" alt="image" src="https://github.com/user-attachments/assets/912ed849-b804-44a3-b4df-0baa3551e73d" />


### 4. Crear Videojuego (POST)
Se envía un payload JSON con los datos del videojuego junto con el token válido. La API valida y registra el juego (Código `201`).

<img width="1437" height="450" alt="image" src="https://github.com/user-attachments/assets/e045f2cb-f804-4b84-8893-e9d387253ce8" />


### 5. Listar Videojuegos (GET)
Se recupera el listado paginado de los videojuegos almacenados en la base de datos (Código `200`).

<img width="2246" height="892" alt="image" src="https://github.com/user-attachments/assets/b23abdca-f548-4c5b-a474-4c786468f2a9" />


### 6. Actualizar Videojuego (PUT)
Se modifica un atributo específico de un videojuego existente (ej. peso_gb), obteniendo un `200 OK` con la información actualizada.

<img width="1428" height="508" alt="image" src="https://github.com/user-attachments/assets/b8d555bd-4da4-499a-b42d-1bb016ae4765" />


### 7. Eliminar Videojuego (DELETE)
Se elimina el registro especificado, obteniendo una respuesta `204 No Content` que confirma la ejecución exitosa.

<img width="1435" height="408" alt="image" src="https://github.com/user-attachments/assets/bc90a1f5-b680-46f0-acb9-eefbf4d5ec26" />


---

## Fase 2: Despliegue en VPS

El proyecto fue desplegado exitosamente en un Servidor Privado Virtual (VPS) configurando Nginx como servidor web, bases de datos y gestión de permisos. 

La siguiente captura demuestra la API en vivo, recibiendo peticiones, procesando el Token Bearer y conectando con la base de datos del VPS de manera exitosa:

<img width="1432" height="556" alt="image" src="https://github.com/user-attachments/assets/2c548ba7-a235-4b34-accb-06d206e06d7d" />
