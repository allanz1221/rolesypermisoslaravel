<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Buscador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: flex-end;
            padding: 20px;
        }
        header a {
            margin-left: 15px;
            text-decoration: none;
            color: #000;
        }
        main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .logo {
            font-size: 72px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .search-box {
            width: 80%;
            max-width: 584px;
        }
        .search-box input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
        }
    </style>
</head>
<body>
    <header>
        <a href="#">Registro</a>
        <a href="#">Iniciar sesión</a>
    </header>
    <main>
        <div class="logo">Mi Buscador</div>
        <div class="search-box">
            <input type="text" placeholder="Buscar...">
        </div>
    </main>
</body>
</html>