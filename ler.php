<html>
<head>
 <title>Livro de Visitas: Ler</title>
</head>
<body bgcolor="white">
<h1>Livro de Visitas</h1>
<?php
$begin = $_GET['begin'];
if (!$begin) {
    $begin = 0;
}

$conexao = mysqli_connect("localhost", "root", "");
mysqli_select_db($conexao, "visitas");

$query = "SELECT count(*) FROM livro";
$query = mysqli_query($conexao, $query);
$query = mysqli_fetch_array($query);
$total = $query[0];

mysqli_close($conexao);
?>

<p>
Total de mensagens postadas: <b><?PHP echo $total; ?></b>
(<a href="assinar.php">Assine você também!</a>)<br>
Exibindo <b>20</b> mensagens por página, mostrando mensagens de
<b><?PHP echo $begin+1; ?></b> a <b><?PHP echo $begin+20; ?></b>.
</p>
<?PHP
if (($begin > 0) and ($begin <= 20)) {
 $anteriores = '<a href="ler.php?begin=0">Anteriores</a>';
} elseif (($begin > 0) and ($begin > 20)) {
 $anteriores = '<a href="ler.php?begin=' . ($begin-20) . '">Anteriores</a>';
} else {
 $anteriores = 'Anteriores';
}
if (($begin < $total) and (($begin+20) >= $total)) {
 $proximas = 'Próximas';
} else {
 $proximas = '<a href="ler.php?begin=' . ($begin+20) . '">Próximas</a>';
}
echo $anteriores . " | " . $proximas;
// Faz uma consulta SQL trazendo as linhas das 20 ultimas mensagens
// que foram colocadas no livro de visitas.
$query = "SELECT * FROM livro ORDER BY data DESC LIMIT $begin,20";
$query = mysqli_query($conexao,$query);
// Gera uma tabela para cada assinatura no livro de visitas (loop)
while ($linha = mysql_fetch_array($query)) {
 // Organiza a mostragem da data, já que no campo do MySQL, a data
 // se encontra em uma forma não tão legal.
 $var = $linha['data'];
 $var = explode(" ",$var);
 $dia = $var[0];
 $hora = $var[1];
 $dia = explode("-",$dia);
 $data = "$dia[2]/$dia[1]/$dia[0] às $hora";
 ?>
 <table border="0" width="70%">
 <tr><td bgcolor="navy" colspan="2"> </td></tr>
 <tr>
 <td><b>Data:</b></td>
 <td width="100%"><?PHP echo $data; ?></td>
 </tr>
 <tr>
 <td><b>Nome:</b></td>
 <td><?PHP echo $linha['nome']; ?></td>
 </tr>
 <tr>
 <td><b>Localização:</b></td>
 <td><?PHP echo $linha['localizacao']; ?></td>
 </tr>
 <tr>
 <td><b>Mensagem:</b></td>
 <td><?PHP echo $linha['mensagem']; ?></td>
 </tr>
 </table>
 <?PHP
}
?>
</body>
</html>