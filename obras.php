<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="/css/styles.css">
    <title> Listagem de $id_obras </title>


    <script>
    function confirmacao($id_obra) {
        var resposta = confirm("Deseja realmente excluir este $id_obra do sistema?");
        if (resposta == true) {
            window.location.href = "excluir_obra.php?id_obra=" + $id_obra
        }
    }
    </script>
</head>


<body>

    <?php include_once "conecta.php"; ?>

    <main class="container">

        <table id="obra" class="row">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano Lançamento</th>
                    <th>Status</th>
                    <th>sinopse</th>
                    <th>demografia</th>
                    <th>Capa</th>
                </tr>
            </thead>
            <tbody>


                <?php
                $sql = "SELECT * FROM obras";
                $resultado = mysqli_query($conexao, $sql);

                while ($linha = mysqli_fetch_assoc($resultado)) {
                    $id_obra = $linha['id_obra'];
                    $titulo = $linha['titulo'];
                    $autor = $linha['autor'];
                    $ano_lanc = $linha['ano_lanc'];
                    $status_obra = $linha['status_obra'];
                    $sinopse = $linha['sinopse'];
                    $demografia = $linha['demografia'];
                    $capa_obra = $linha['capa_obra'];

                    echo "<tr>";
                    echo "<td>" . $id_obra . "</td>";
                    echo "<td>" . $titulo . "</td>";
                    echo "<td>" . $autor . "</td>";
                    echo "<td>" . $ano_lanc . "</td>";
                    echo "<td>" . $status_obra . "</td>";
                    echo "<td>" . nl2br($sinopse) . "</td>";
                    echo "<td>" . $demografia . "</td>";
                    echo "<td>" ?> <img src="<?php echo $capa_obra; ?>" class="materialboxed" width="175vh">
                <?php echo "</p><br><br>";

                    echo "<td> <a href='formaltera_obra.php?id_obra=$id_obra' class='btn-floating btn-large waves-effect waves-light blue darken-1'>
    <i class='material-icons'>editar</i></a></td>";

                    echo "<td> <a href='#' " . " onclick='confirmacao($id_obra)' class='btn-floating btn-large waves-effect waves-light blue darken-1'>
    <i class='material-icons'>delete</i></a></td>";

                    echo "</tr>";
                }

                echo "</table>";

                ?>

            </tbody>
        </table>

        <br> <br>

        <br>
        <center> <a id="bot" href="inserir_obra.html" class="waves-effect waves-light btn-large blue darken-1">
                <i class="material-icons right"></i> Adicionar </a> </center>

        <br> <br> <br>



</body>

</html>