<?php
$pdo = new PDO('mysql:host=localhost;dbname=projet-garage', 'root', '');
$requete = $pdo->prepare("SELECT * FROM horaires WHERE id = 1");
$requete->execute();
$horaires = $requete->fetch(PDO::FETCH_ASSOC);
?>
<table>
    <caption> NOS HORAIRES </caption>
  <tr>
    <td>Lundi</td>
    <td><?php echo $horaires['lundi']; ?></td>
  </tr>
  <tr>
    <td>Mardi</td>
    <td><?php echo $horaires['mardi']; ?></td>
  </tr>
  <tr>
    <td>Mercredi</td>
    <td><?php echo $horaires['mercredi']; ?></td>
  </tr>
  <tr>
    <td>Jeudi</td>
    <td><?php echo $horaires['jeudi']; ?></td>
  </tr>
  <tr>
    <td>Vendredi</td>
    <td><?php echo $horaires['vendredi']; ?></td>
  </tr>
  <tr>
    <td>Samedi</td>
    <td><?php echo $horaires['samedi']; ?></td>
  </tr>
  <tr>
    <td>Dimanche</td>
    <td><?php echo $horaires['dimanche']; ?></td>
  </tr>
</table>
