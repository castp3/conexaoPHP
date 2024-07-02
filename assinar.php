<?PHP
    if (getenv("REQUEST_METHOD") == "POST") {
 
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $mensagem = $_POST['mensagem'];

    if ($nome and $localizacao and $mensagem) {
        $conexao = mysqli_connect("localhost","root","");
        mysqli_select_db($conexao, "visitas");
        $query = "INSERT INTO livro
        VALUES('00000','$nome','$localizacao','$mensagem',NOW())";
        mysqli_query($conexao,$query);
        header("Location: ler.php");
    } else {
        $err = "Preencha todos os campos!";
    }
    }
?>
<html>
<head>
    <title>Livro de Visitas: Assinar</title>
</head>
<body bgcolor="white">
    <h1>Assine o Livro de Visitas</h1>
    <?PHP
        if ($err) {
    ?>
        <ul><font color="red"><?PHP echo $err; ?></font></ul>
    <?PHP
    }
    ?>
    <form method="post" action="assinar.php">
    <table border="0">
    <tr>
        <td>Nome: </td>
        <td><input type="text" size="15" name="nome" maxlength="250"></td>
    </tr>
    <tr>
        <td>Localização: </td>
        <td><input type="text" size="15" name="localizacao" maxlength="45"></td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea cols="60" rows="10" name="mensagem">Digite aqui sua mensagem!</textarea>
        </td>
    </tr>
    </table>
    <input type="submit" value="Assinar">
    </form>
</body>
</html>