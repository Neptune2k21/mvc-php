<?php
// Connexion à la base de données

function dbConnect() {
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        return $database;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getPosts() {
    $database = dbConnect();

    // On récupère les 5 derniers billets
    $statement = $database->query(
        "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr 
        FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
    );

    $posts = [];
    while ($row = $statement->fetch()) {
        // On stocke chaque billet dans le tableau $posts
        $post = [
            'identifier' => $row['id'],
            'title' => $row['titre'],
            'content' => $row['contenu'],
            'frenchCreationDate' => $row['date_creation_fr']
        ];
        $posts[] = $post;
    }
    return $posts;
}

function getPost($identifier) {
    $database = dbConnect();
    
    $statement = $database->prepare(
        "SELECT id, titre, contenu,
        DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss')
        AS date_creation FROM billets WHERE id = ?"
    );
    $statement->execute([$identifier]);
    $row = $statement->fetch();
    $post = [
        'identifier' => $row['id'],
        'title' => $row['titre'],
        'content' => $row['contenu'],
        'frenchCreationDate' => $row['date_creation']
    ];
    return $post;
}


?> 
