# Investigación Aplicada 1  
## Estrategias para Escalar Aplicaciones Web con Docker y Kubernetes

---

## 📌 Descripción del Proyecto

Este proyecto consiste en el desarrollo y despliegue de una aplicación web en PHP que implementa un sistema básico de autenticación.  

La aplicación fue empaquetada utilizando Docker y desplegada en un clúster de Kubernetes, implementando:

- Replicación de instancias (Horizontalización)
- Balanceo de carga
- Escalado automático (HPA)
- Alta disponibilidad

---

## 🖥️ 1. Desarrollo de la Aplicación Web

La aplicación web incluye:

- Login con usuario y contraseña definidos en el script.
- Uso de variables de sesión (`session_start()`).
- Redirección automática al dashboard después del login.
- Dashboard sin navegación adicional.
- Funcionalidad de logout.

⚠ No se utiliza base de datos, ya que la guía indica que debe ser una simulación.

---

## 🐳 2. Empaquetado con Docker

### 📄 Dockerfile

Se creó un Dockerfile que:

- Utiliza una imagen base con soporte para PHP.
- Copia los archivos del proyecto al contenedor.
- Expone el puerto 80.

### 🔨 Construcción de la imagen

```bash
docker build -t mi-app-php .
