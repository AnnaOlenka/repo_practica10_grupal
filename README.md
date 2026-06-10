# Práctica Semana 10

# Integrantes
- Alarcón Mendoza Estiven Rodrigo 
- Calderón Leiva Anna Olenka 
- Cruz Cruz Alexander Jhon 
- Espiritu Diaz Olayne Guadalupe Maria Isabel 
- Llanos Loznao Ricardo Alexander 
- Martínez Casas Cristhian Emilio 

## Ciclo HTTP: Flujo Cliente → Servidor → Backend → Respuesta

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
