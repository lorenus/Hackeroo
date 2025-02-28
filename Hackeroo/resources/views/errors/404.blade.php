<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oh no! Página no encontrada</title>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            color: #455A64;
            background-color: #FEFFEB;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centra horizontalmente */
            justify-content: center; /* Centra verticalmente */
            min-height: 100vh; /* Ocupa al menos el 100% del viewport */
            margin: 0;
            font-family: 'Lilita One';
            overflow: hidden;
        }

        .container { /* Estilos para el contenedor principal */
            display: flex;
            flex-direction: column;
            align-items: center; /* Centra horizontalmente el contenido del contenedor */
            max-width: 60vw; /* Ancho máximo del contenedor */
            width: 90%; /* Ajusta el ancho para pantallas más pequeñas */
            margin: 20px auto; /* Centra el contenedor en la página y añade margen */
        }

        h1, p {
            text-align: center;
        }

        img {
            max-width: 60%;
            height: auto;
            display: block;
            margin: 20px auto; /* Centra la imagen y añade márgenes */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Ups! algo no va bien</h1>
        <p>Pero... ¡has encontrado otro de nuestros monstruos! :)</p>
        <img src="/404/monstruo404.png" alt="Monstruo">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>