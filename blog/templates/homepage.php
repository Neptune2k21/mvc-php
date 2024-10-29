<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Le blog de l'AVBN</title>
      <!-- Lien vers le CDN Bootstrap -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <link href="style.css" rel="stylesheet" />
   </head>

   <body>
      <div class="container">
         <?php $title = "Le blog de l'AVBN"; ?>
         <?php ob_start(); ?>
         <h1>Le super blog de l'AVBN !</h1>
         <p>Derniers billets du blog :</p>
         <?php
         foreach ($posts as $post) {
            ?>
            <div class="news">
                <h3>
                    <?= htmlspecialchars($post->title); ?>
                    <em>le <?= $post->frenchCreationDate; ?> </em>
                </h3>
                <p>
                    <?= nl2br(htmlspecialchars($post->content)); ?>
                    <br />
                    <em>
                        <a href="index.php?action=post&id=<?= urlencode($post->identifier) ?> ">
                            Commentaires
                        </a>
                    </em>
                </p>
            </div>
            <?php
        }
        
         ?>
         <?php $content = ob_get_clean(); ?>
         <?php require('layout.php'); ?>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
