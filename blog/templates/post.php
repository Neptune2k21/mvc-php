<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Le blog de l'AVBN</title>
<link href="style.css" rel="stylesheet" />
</head>
<body>
<h1>Le super blog de l'AVBN !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
<div class="news">
<h3>
<?php echo htmlspecialchars($post['title']) ?>
<em>le <?php echo $post['frenchCreationDate'] ?> </em>
</h3>
<p>
<?php echo nl2br(htmlspecialchars($post['content'])) ?>
</p>
</div>
<h2>Commentaires</h2>
<?php
foreach ($comments as $comment) {
?>
<p><strong><? echo htmlspecialchars($comment['author']) ?> </strong>
le <?php echo $comment['french_creation_date'] ?> </p>
<p><?php echo nl2br(htmlspecialchars($comment['comment'])) ?> </p>
<?php
}
?>
</body>
</html>