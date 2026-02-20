# Documentación del Proceso

---

1️) Creación y Empaquetado de la Aplicación Web en una Imagen Docker

- Desarrollo de la Aplicación Web

Se desarrolló una aplicación web utilizando PHP que implementa:

- Sistema de autenticación (Login)
- Cierre de sesión (Logout)
- Interfaz responsive con Bootstrap
- Gestión básica de sesiones

La aplicación fue diseñada para ejecutarse en un entorno servidor web ligero dentro de un contenedor.

---

- Creación del Dockerfile

Para contenerizar la aplicación se creó un archivo llamado:

Dockerfile

Ejemplo de configuración:

Dockerfile:
```
FROM php:8.2-apache

COPY . /var/www/html/

EXPOSE 80
```
Para crea la imagen se ejecuta: docker build -t php-app .
pero si utiliza minikube seria: eval $(minikube docker-env)
docker build -t php-app .

esto generara una imagen lista para Kubernetes

2️) Configuración del Clúster de Kubernetes para Desplegar Réplicas con Balanceo de Carga
- Iniciar el Clúster

Se utiliza Minikube como entorno local de pruebas:

```
minikube start
```

- Creación del Deployment

Se define un archivo 

deployment.yaml:
```
apiVersion: apps/v1
kind: Deployment
metadata:
  name: php-app-deployment
spec:
  replicas: 2
  selector:
    matchLabels:
      app: php-app
  template:
    metadata:
      labels:
        app: php-app
    spec:
      containers:
      - name: php-app
        image: php-app
        imagePullPolicy: Never
        ports:
        - containerPort: 80
        resources:
          requests:
            cpu: "100m"
          limits:
            cpu: "200m"
```
Explicación:

Se crean 2 réplicas iniciales.

Cada réplica es un Pod con el contenedor PHP.

Se configuran límites y solicitudes de CPU para permitir el escalado automático.

El selector permite que el Service identifique los Pods correctos.

Aplicación del deployment:

```
kubectl apply -f deployment.yaml
```


- Creación del Service (Balanceador de Carga)

Archivo service.yaml:
```
apiVersion: v1
kind: Service
metadata:
  name: php-app-service
spec:
  type: LoadBalancer
  selector:
    app: php-app
  ports:
  - protocol: TCP
    port: 80
    targetPort: 80
```
Aplicación:

 ```
kubectl apply -f service.yaml
```

3️) Implementación del Sistema de Escalado Horizontal

- Habilitación del Metrics Server

Verificación:
```
kubectl get pods -n kube-system
```
- Creación del Horizontal Pod Autoscaler

Archivo hpa.yaml:
```
apiVersion: autoscaling/v2
kind: HorizontalPodAutoscaler
metadata:
  name: php-app-hpa
spec:
  scaleTargetRef:
    apiVersion: apps/v1
    kind: Deployment
    name: php-app-deployment
  minReplicas: 2
  maxReplicas: 5
  metrics:
  - type: Resource
    resource:
      name: cpu
      target:
        type: Utilization
        averageUtilization: 50
```
Aplicación:
```
kubectl apply -f hpa.yaml
```
- Verificación del HPA

```
kubectl get hpa
```

Monitoreo en tiempo real:

```
kubectl get hpa -w
```
- Prueba de Escalado

Generar carga:

```
kubectl run -i --tty load-generator --rm --image=busybox -- /bin/sh
```
Dentro del contenedor:

```
while true; do wget -q -O- http://php-app-service; done
```
Cuando la CPU supera el 50%:

Se crean nuevas réplicas automáticamente.

Al detener la carga:

El sistema reduce las réplicas hasta el mínimo configurado.

4️) Funcionamiento del Balanceador de Carga y Alta Disponibilidad

- ¿Cómo funciona el balanceo de carga?

El Service de tipo LoadBalancer:

Asigna una IP interna al servicio.

Distribuye las solicitudes entrantes entre los Pods disponibles.

Utiliza el selector app: php-app para identificar las réplicas activas.

Cada vez que un usuario accede a la aplicación:

La solicitud llega al Service.

El Service redirige la solicitud a uno de los Pods disponibles.

Si un Pod falla, el tráfico se redirige automáticamente a los Pods restantes.

- Garantía de Alta Disponibilidad

La alta disponibilidad se garantiza mediante:

Múltiples réplicas activas.

Redistribución automática del tráfico.

Reemplazo automático de Pods en caso de falla.

Escalado automático según demanda.

Si un Pod deja de funcionar:

Kubernetes crea uno nuevo automáticamente.

El Service deja de enviar tráfico al Pod fallido.

 




