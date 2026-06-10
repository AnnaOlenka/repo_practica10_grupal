<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page import="java.util.*" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%-- En Tomcat 10/11 (Jakarta) usar: uri="jakarta.tags.core" --%>

<%
  // 1. Validar método HTTP: solo POST (manejo de error 405)
  if (!"POST".equals(request.getMethod())) {
      response.setStatus(405);
      response.setHeader("Allow", "POST");
%>
      <!DOCTYPE html><html lang="es"><body>
        <h3>405 - Método no permitido</h3>
        <p>Use el formulario: <a href="index.jsp">volver</a></p>
      </body></html>
<%
      return;
  }

  // 2. Obtener y validar parámetros del request
  String nombre = request.getParameter("nombre");
  String correo = request.getParameter("correo");

  boolean nombreValido = nombre != null && !nombre.trim().isEmpty() && nombre.trim().length() <= 60;
  boolean correoValido = correo != null && correo.trim().matches("^[\\w.%+-]+@[\\w.-]+\\.[A-Za-z]{2,}$");

  if (!nombreValido || !correoValido) {
      // 4xx: petición inválida -> redirigir al formulario con mensaje
      response.setStatus(400);
      response.sendRedirect("index.jsp?error=1");
      return;
  }

  nombre = nombre.trim();
  correo = correo.trim().toLowerCase();

  // 3. Guardar en sesión (gestión de estado con HttpSession)
  HttpSession sesion = request.getSession();
  @SuppressWarnings("unchecked")
  List<Map<String, String>> registros =
      (List<Map<String, String>>) sesion.getAttribute("registros");

  if (registros == null) {
      registros = new ArrayList<>();
  }

  Map<String, String> registro = new HashMap<>();
  registro.put("nombre", nombre);
  registro.put("correo", correo);
  registro.put("fecha", new java.text.SimpleDateFormat("dd/MM/yyyy HH:mm:ss").format(new Date()));
  registros.add(registro);

  sesion.setAttribute("registros", registros);

  // Exponer la lista para EL/JSTL
  request.setAttribute("listaRegistros", registros);
  request.setAttribute("totalRegistros", registros.size());
%>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado | Registro JSP</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 640px; margin: 40px auto; }
    table { border-collapse: collapse; width: 100%; margin-top: 12px; }
    th, td { border: 1px solid #444; padding: 8px; text-align: left; }
    th { background: #f0f0f0; }
    .ok { color: #0a7d2c; }
  </style>
</head>
<body>
  <h2>Respuesta estructurada (JSP)</h2>
  <p class="ok">Registro guardado correctamente en la sesión.</p>
  <p>ID de sesión: <c:out value="${pageContext.session.id}"/></p>
  <p>Total de registros: <c:out value="${totalRegistros}"/></p>

  <h3>Registros almacenados</h3>
  <table>
    <tr><th>#</th><th>Nombre</th><th>Correo</th><th>Fecha</th></tr>
    <%-- Iteración con <c:forEach> y prevención XSS con <c:out> --%>
    <c:forEach var="reg" items="${listaRegistros}" varStatus="st">
      <tr>
        <td>${st.count}</td>
        <td><c:out value="${reg.nombre}"/></td>
        <td><c:out value="${reg.correo}"/></td>
        <td><c:out value="${reg.fecha}"/></td>
      </tr>
    </c:forEach>
  </table>

  <p><a href="index.jsp">Registrar otro contacto</a></p>
</body>
</html>
