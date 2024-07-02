<?php
    $msg[0] = "Conexão com o banco falhou!";
    $msg[1] = "Não foi possível selecionar o banco de dados!";

    $conexao = mysqli_connect("localhost", "root", "") or die($msg[0]);
    mysqli_select_db($conexao, "visitas") or die($msg[1]);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $query = "SELECT cod, nome, localizacao FROM livro ORDER BY nome";
    $resultado = mysqli_query($conexao, $query);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }
?>
<table border="1">
<tr>
    <td><b>Cód</b></td>
    <td><b>Nome</b></td>
    <td><b>Localização</b></td>
</tr>
<?php
    while ($linha = mysqli_fetch_array($resultado)) {
        ?>
        <tr>
            <td><?php echo $linha['cod']; ?></td>
            <td><?php echo $linha['nome']; ?></td>
            <td><?php echo $linha['localizacao']; ?></td>
        </tr>
        <?php
    }
?>
</table>


