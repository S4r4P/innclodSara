<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../media/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <section>
        <img src="../media/img/descarga.jpeg" alt="">
        <article>
            <h1>LOG IN</h1>
            <div class="campo" id="campo">
                <label for=""><strong>Usuario</strong></label>
                <input type="text" id="user">        
            </div>
            <div class="campo">
                <label for=""><strong>Clave</strong></label>
                <input type="text" id="clave">
            </div>
            <button type="submit" id="send"><strong>Ingresar</strong></button>
        </article>
    </section>
</body>
<script src="../js/user/login.js"></script>
<script src="../js/crud/view.js"></script>
<script src="../js/crud/doc.js"></script>
<script src="../js/crud/tipo.js"></script>
<script src="../js/crud/proceso.js"></script>
</html>