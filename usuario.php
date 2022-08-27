<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title> Listagem de usuarios </title>
    <script>
    function confirmacao($id_usuario) {
        var resposta = confirm("Deseja realmente excluir este usuario do sistema?");
        if (resposta == true) {
            window.location.href = "excluir_usuario.php?id_usuario=" + $id_usuario;
        }
    }
    </script>

</head>


<body>
    <?php include_once "./conecta.php"; ?>

    <main class="container">

        <table id="usuario" class="bordered highlight responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>senha</th>
                    <th>Status</th>
                    <th>Permissão</th>
                </tr>
            </thead>
            <tbody>


                <?php
                $sql = "SELECT * FROM usuario";
                $resultado = mysqli_query($conexao, $sql);

                while ($linha = mysqli_fetch_assoc($resultado)) {
                    $id_usuario = $linha['id_usuario'];
                    $nome_usuario = $linha['nome'];
                    $email = $linha['email'];
                    $senha = $linha['senha'];
                    $sts = $linha['sts'];
                    $permissao = $linha['permissao'];


                    echo "<tr>";
                    echo "<td>" . $id_usuario . "</td>";
                    echo "<td>" . $nome_usuario . "</td>";
                    echo "<td>" . $email . "</td>";
                    echo "<td>" . $senha . "</td>";
                    echo "<td>" . $sts . "</td>";
                    echo "<td>" . $permissao . "</td>";


                    echo "<td> <a href='formaltera_usuario.php?id_usuario=$id_usuario' class='btn-floating btn-large waves-effect waves-light blue darken-1'>
    <i class='material-icons'>edit</i></a></td>";

                    echo "<td> <a href='#' " . " onclick='confirmacao($id_usuario)' class='btn-floating btn-large waves-effect waves-light blue darken-1'>
    <i class='material-icons'>delete</i></a></td>";

                    echo "</tr>";
                }

                echo "</table>";

                ?>

            </tbody>
        </table>

        <br> <br>

        <br>
        <center> <a id="bot" href="inserir_usuario.html" class="waves-effect waves-light btn-large blue darken-1">
                <i class="material-icons right"></i> Adicionar usuario </a> </center>


</body>

</html>