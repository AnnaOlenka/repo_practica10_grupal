<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lab 09 | Registro JSP</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 480px; margin: 40px auto; }
    label { display: block; margin-bottom: 10px; }
    input { padding: 6px; width: 100%; box-sizing: border-box; }
    button { padding: 8px 16px; cursor: pointer; }
    .error { color: #b00020; }
  </style>
</head>
<body>
  <h2>Formulario de Contacto (JSP)</h2>

  <%-- Mensaje de error si registro.jsp redirige con ?error=... --%>
  <%
    String error = request.getParameter("error");
    if (error != null) {
  %>
    <p class="error">Error: datos inválidos. Verifique nombre y correo.</p>
  <% } %>

  <form action="registro.jsp" method="POST">
    <label>Nombre: <input type="text" name="nombre" required maxlength="60"></label>
    <label>Correo: <input type="email" name="correo" required maxlength="100"></label>
    <button type="submit">Enviar</button>
  </form>
</body>
</html>
