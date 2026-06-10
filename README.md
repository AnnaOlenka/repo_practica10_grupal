# Práctica Semana 10
Se presenta el desarrollo de los puntos: 
- **Ciclo HTTP:** Documentar flujo: Cliente → DNS → TCP/IP → HTTP Request → Server → Backend → Response → Render.
- **Comparativa** Técnica: Matriz PHP vs JSP (ciclo de vida, rendimiento, despliegue, gestión de estado, madurez ecosistema).

## Integrantes:
- Alarcón Mendoza Estiven Rodrigo
- Calderón Leiva Anna Olenka
- Cruz Cruz Alexander Jhon
- Espíritu Díaz Olayne Guadalupe María Isabel
- Llanos Lozano Ricardo Alexander
- Martínez Casas Cristhian Emilio


## 3. Ciclo HTTP: Documentar flujo: Cliente → DNS → TCP/IP → HTTP Request → Server → Backend → Response → Render.
```
[Cliente/Navegador]
       |
       | 1. El usuario llena el formulario y hace clic en "Enviar"
       v
[DNS Resolution]
       |
       | 2. El navegador resuelve el nombre de dominio a una IP
       |    Ej: localhost → 127.0.0.1
       v
[TCP/IP - Conexión]
       |
       | 3. Se establece la conexión TCP entre navegador y servidor
       |    (Three-way handshake: SYN → SYN-ACK → ACK)
       v
[HTTP Request]
       |
       | 4. El navegador envía la petición HTTP:
       |    POST /practica10/registro.php HTTP/1.1   (PHP)
       |    POST /practica10/registro.jsp   HTTP/1.1  (JSP)
       |    Host: localhost
       |    Content-Type: application/x-www-form-urlencoded
       |    Body: nombre=Juan&correo=juan@ejemplo.com
       v
[Servidor Web]
       |
       | 5. Apache (XAMPP) recibe la petición → enruta a PHP
       |    Tomcat recibe la petición → enruta a JSP
       v
[Backend]
       |
       | 6. PHP: session_start(), filter_input(), htmlspecialchars()
       |         guarda en $_SESSION["registros"]
       |
       |    JSP: request.getParameter(), HttpSession,
       |         guarda en session.setAttribute("registros", lista)
       v
[HTTP Response]
       |
       | 7. El servidor responde:
       |    HTTP/1.1 200 OK
       |    Content-Type: text/html; charset=UTF-8
       |    Body: HTML con la tabla de registros
       v
[Render]
       |
       | 8. El navegador recibe el HTML y renderiza
       |    la tabla con los contactos registrados
       v
[Usuario ve el resultado]
```

### Resumen por paso

| Paso | Descripción |
|------|-------------|
| **Cliente** | El usuario completa el formulario y envía los datos |
| **DNS** | Resolución del dominio a IP (`localhost` → `127.0.0.1`) |
| **TCP/IP** | Handshake de 3 vías para establecer la conexión |
| **HTTP Request** | Petición POST con los datos del formulario en el body |
| **Server** | Apache (PHP) o Tomcat (JSP) recibe y enruta la petición |
| **Backend** | Validación, sanitización y almacenamiento en sesión |
| **HTTP Response** | Respuesta `200 OK` con el HTML generado |
| **Render** | El navegador muestra la tabla de registros al usuario |

## 5. Comparativa Técnica: Matriz PHP vs JSP (ciclo de vida, rendimiento, despliegue, gestión de estado, madurez ecosistema).

### JSP
JSP o Java Server Pages es un lenguaje de programación diseñado para el desarrollo de aplicaciones basadas en web. Se caracteriza por ser una extensión de `Java Servlet`, el cual supera las limitaciones de este último al proveer a los desarrolladores de un entorno más conveniente para el desarrollo dinámico de webs.

Los archivos JSP están formados etiquetas `HTML`, para el contenido estático, y el tag `<% %>` que permite utilizar código Java dentro de HTML. 

Estos archivos tienen la extensión `.jsp`.

A continuación se muestra un ejemplo de código JSP:

```jsp
        <%@page contentType="text/html" pageEncoding="UTF-8"%>
        <!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Tutorials Point</title>
        </head>
        <body>
            <h1>Example of JSP</h1>
            <h2>Receiving Data from Client</h2>
            <% String data1 = request.getParameter("data1"); %>
            <h3>Data1: <%= data1 %></h3>
            <% String data2 = request.getParameter("data2"); %>
            <h3>Data2: <%= data2 %></h3>
        </body>
        </html>
```

### PHP
PHP, al igual que JSP, es un lenguaje de programación que permite el desarrollo de páginas web dinámicas e interactivas. PHP utiliza scripts similares al lenguaje C; la estructura se basa en iniciar y finalizar todo script con los tags: `<?php ?>`. 

Los archivos PHP poseen la extensión `.php`

- Ejemplo de código PHP puro:
    
```php
    <?php
        echo "This is sample example of PHP!";
    ?>
```

- Ejemplo de código PHP con HTML:

```html
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8"/>
            <meta name="viewport" content="width=width-device, initial-scale=1.0"/>
            <title>PHP in HTML</title>
        </head>
        <body>
            <h1>
            <?php
                echo "This is sample example of PHP!";
            ?>
            </h1>
        </body>
    </html>
```

### Comparativa Técnica
<table>
    <thead>
        <th>Criterio</th>
        <th>JSP</th>
        <th>PHP</th>
    </thead>
    <tbody>
        <tr>
            <td>Ciclo de Vida</td>
            <td>Está basado en hilos que se mantienen siempre encendidos sobre una única instancia.</td>
            <td>Nace y muere con cada clic.</td>
        </tr>
        <tr>
            <td>Rendimiento</td>
            <td>Compartida (Todos los usuarios en la misma RAM). Consumo alto de memoria al necesitar mantener JVM con vida.</td>
            <td>"Usar y tirar" (Aislada por usuario). Consume una mísera cantidad de memoria.</td>
        </tr>
        <tr>
            <td>Despliegue</td>
            <td>Compilación y empaquetado formal (`.war`). Normalmente con Contenedores Servlets, o Servidores como Tomcat, Jetty, etc.</td>
            <td>Copiar, pegar y actualizar en caliente. Usualmente se realiza mediante servidores como PHP-FPM + Servidor Web (NGINX, Caddy, Apache)</td>
        </tr>
        <tr>
            <td>Gestión de Estado</td>
            <td>Manejadas de manera nativa mediante paquetes: Page, Request, Session, Aplications</td>
            <td>Sesiones basada en archivos u almacenamiento externo como Redis</td>
        </tr>
        <tr>
            <td>Madurez Ecosistema</td>
            <td>Usado por su robustez y escalabilidad. Muy famoso en el ámbito coorporativo.</td>
            <td>Usado para proyectos ágiles, domina actualmente la web por su variedad de frameworks (Laravel, Symfony)</td>
        </tr>
    </tbody>
</table>

Fuente: [Difference Between JSP and PHP](https://www.tutorialspoint.com/article/difference-between-jsp-and-php)
