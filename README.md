# 🛒 Tiendas Celeste

Tiendas Celeste es una aplicación web desarrollada con **PHP clásico y MySQL**, orientada a la gestión básica de una tienda comercial. El sistema permite administrar productos, usuarios, roles y ventas mediante operaciones CRUD, ofreciendo una solución sencilla para el control de inventario y procesos de venta.

Este proyecto fue desarrollado con fines académicos y como práctica de desarrollo web backend tradicional.

---

## 🚀 Funcionalidades principales

- Autenticación de usuarios (login)
- Gestión de productos (crear, editar, eliminar)
- Gestión de categorías de productos
- Registro y control de ventas
- Detalle de ventas
- Gestión de usuarios y roles
- Generación de reportes en PDF
- Operaciones CRUD completas sobre la base de datos

---

## 🛠️ Tecnologías utilizadas

- **PHP** (programación procedural)
- **MySQL / MariaDB**
- **HTML5**
- **CSS**
- **JavaScript**
- **phpMyAdmin** (gestión de base de datos)
- **FPDF** (generación de reportes PDF)

---

## 📁 Estructura del proyecto

TIENDAS_CELESTE2024/

├── assets/

│ ├── css/

│ ├── js/

│ └── images/

├── CRUD/

│ ├── agregar.php

│ ├── editar.php

│ ├── eliminar.php

│ ├── conexion.php

│ └── pdf_report.php

├── php/

│ ├── accesorios.php

│ ├── desayunos.php

│ ├── dulces.php

│ ├── juguetes.php

│ ├── maquillaje.php

│ ├── peluches.php

│ └── regalos.php

├── index.php

├── login.php

└── tiendasceleste1.sql


---

## ⚙️ Instalación y ejecución en local (XAMPP)

1. Instalar **XAMPP**
2. Copiar la carpeta del proyecto en: C:\xampp\htdocs\
3. Iniciar **Apache** y **MySQL** desde el panel de XAMPP
4. Importar el archivo `tiendasceleste1.sql` en phpMyAdmin
5. Configurar la conexión en: CRUD/conexion.php
6. Acceder desde el navegador: http://localhost/TIENDAS_CELESTE2024/

---

## 🌐 Despliegue en hosting gratuito

Para hosting gratuito (como InfinityFree):

- El proyecto debe subirse a `htdocs` o `public_html`
- Ajustar `conexion.php` con las credenciales del hosting
- Importar la base de datos **sin procedimientos almacenados**
- Usar el nombre real de la base de datos con prefijo asignado por el hosting

---

## ⚠️ Consideraciones importantes

- El proyecto fue diseñado originalmente para ejecutarse en **entornos locales (root@localhost)**.
- En hosting compartido/gratuito no se permite crear **procedimientos almacenados**.
- Se recomienda eliminar los bloques `CREATE PROCEDURE` del archivo SQL para evitar errores de permisos.
- Compatible con PHP 7.4 – 8.1 (puede requerir ajustes en versiones superiores).

---

## 📌 Estado del proyecto

✔ Funcional  
📚 Uso académico / demostrativo  
🛠️ Mantenimiento básico  

---

## 📄 Licencia

Este proyecto se distribuye con fines educativos.
