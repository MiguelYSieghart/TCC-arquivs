<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Associação de Usuário</title>
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../_.materialize/css/configs.css">
    
</head>

<body class="container">

    <?php
    
    require_once "../_______necessarios/.conexao_bd.php";
    
    $id_curso = $_GET['id_curso'];

    ?>

    <center><h3 class="bold">Associação de Usuário</h3></center>

    <br>

    <form action="____C2_insere_associacao_usuario.php" method="post" enctype="multipart/form-data">

        <big>Email do usuário:</big> <input type="email" name="email" required><br>

        <br>
        <br>

        <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>   
        <a href="../index/produtor/PROD___tela_curso_produtor.php?id_curso=<?php echo $id_curso; ?>" class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>
        </center>

    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>
