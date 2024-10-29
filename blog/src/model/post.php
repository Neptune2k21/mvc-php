<?php

class Post
{
    public $identifier;          // Identifiant du post
    public $title;               // Titre du post
    public $content;             // Contenu du post
    public $frenchCreationDate;  // Date de création formatée
}

function dbConnect() {
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    return $database;
}

function getPosts() {
    $database = dbConnect();

    // On récupère les 5 derniers billets
    $statement = $database->query(
        "SELECT id, titre, contenu, 
        DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr 
        FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
    );

    $posts = [];
    while ($row = $statement->fetch()) {
        // On stocke chaque billet dans le tableau $posts
        $post = new Post();
        $post->identifier = $row['id'];
        $post->title = $row['titre'];
        $post->content = $row['contenu'];
        $post->frenchCreationDate = $row['date_creation_fr'];

        $posts[] = $post;
    }
    return $posts;
}

function getPost($identifier) {
    $database = dbConnect();
    
    $statement = $database->prepare(
        "SELECT id, titre, contenu,
        DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation 
        FROM billets WHERE id = ?"
    );
    $statement->execute([$identifier]);
    $row = $statement->fetch();

    if ($row) {
        $post = new Post();
        $post->identifier = $row['id'];
        $post->title = $row['titre'];
        $post->content = $row['contenu'];
        $post->frenchCreationDate = $row['date_creation'];
        return $post;
    } else {
        return null; // Aucun post trouvé
    }
}
?>
