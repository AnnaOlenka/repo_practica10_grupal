<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Método no permitido. Use POST.";
    exit;
}

$nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
$correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";

if (empty($nombre) || empty($correo)) {
    http_response_code(400);
    echo "Datos inválidos. Complete todos los campos.";
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Correo inválido.";
    exit;
}

$nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, "UTF-8");
$correoSeguro = htmlspecialchars($correo, ENT_QUOTES, "UTF-8");

if (!isset($_SESSION["registros"])) {
    $_SESSION["registros"] = [];
}

$_SESSION["registros"][] = [
    "nombre" => $nombreSeguro,
    "correo" => $correoSeguro
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registros PHP</title>
</head>
<body>
    <h2>Registros almacenados en PHP</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Correo</th>
        </tr>

        <?php foreach ($_SESSION["registros"] as $index => $registro): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $registro["nombre"]; ?></td>
                <td><?php echo $registro["correo"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="index.html">Registrar otro contacto</a>
</body>
</html>