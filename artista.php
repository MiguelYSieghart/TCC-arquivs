<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title> Listagem de artistas </title>
    <script>
    function confirmacao($id_art) {
        var resposta = confirm("Deseja realmente excluir este artista do sistema?");
        if (resposta == true) {
            window.location.href = "excluir_artista.php?id_art=" + $id_art;
        }
    }
    </script>

</head>


<body>
    <?php include_once "conecta.php"; ?>

    <main class="">

        <table id="artista" class="">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>


                <?php
                $sql = "SELECT * FROM artista";
                $resultado = mysqli_query($conexao, $sql);

                while ($linha = mysqli_fetch_assoc($resultado)) {
                    $id_art = $linha['id_art'];
                    $nome_artist = $linha['nome_artist'];


                    echo "<tr>";
                    echo "<td>" . $id_art . "</td>";
                    echo "<td>" . $nome_artist . "</td>";


                    echo "<td> <a href='formaltera_artista.php?id_art=$id_art' class='btn-floating btn-large waves-effect waves-light blue darken-1'>
    <i class='material-icons'>edit</i></a></td>";

                    echo "<td> <a href='#' " . " onclick='confirmacao($id_art)' class='btn-floating btn-large waves-effect waves-light blue darken-1'>
    <i class='material-icons'>delete</i></a></td>";

                    echo "</tr>";
                }

                echo "</table>";

                ?>

            </tbody>
        </table>

        <br> <br>

        <br>
        <center> <a id="bot" href="inserir_artista.html">Adicionar Artista </a> </center>


</body>

</html>