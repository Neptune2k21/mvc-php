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
         <h1 class="text-center my-5">Le super blog de l'AVBN !</h1>
         <p class="text-center">Derniers billets du blog :</p>

         <?php foreach ($posts as $post) { ?>
         <div class="news card my-4">
            <div class="card-header bg-dark text-white">
               <h3 class="mb-0">
                  <?php echo htmlspecialchars($post['title']); ?>
                  <em class="small float-right">le <?php echo $post['frenchCreationDate']; ?></em>
               </h3>
            </div>
            <div class="card-body">
               <p class="card-text">
                  <?php echo nl2br(htmlspecialchars($post['content'])); ?>
               </p>
               <a href="#" class="btn btn-primary btn-sm">Commentaires</a>
            </div>
         </div>
         <?php } ?>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
