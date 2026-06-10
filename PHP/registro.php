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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #edf2f8;
            color: #22303f;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .container {
            width: 100%;
            max-width: 900px;
            background: #ffffff;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 18px 44px rgba(34, 48, 63, 0.14);
            border: 1px solid rgba(34, 48, 63, 0.08);
        }
        h2 {
            margin-top: 0;
            color: #1b365e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th,
        td {
            padding: 14px 16px;
            border: 1px solid #d3dce7;
            text-align: left;
        }
        th {
            background: #1e5bbf;
            color: #ffffff;
            font-weight: 700;
        }
        tr:nth-child(even) {
            background: #f7f9fd;
        }
        tr:hover {
            background: #eef3fb;
        }
        a {
            display: inline-block;
            margin-top: 18px;
            color: #1e5bbf;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registros almacenados en PHP</h2>

        <table>
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

        <a href="index.html">Registrar otro contacto</a>
    </div>
</body>
</html>