<?php
// src/model/post.php

class Post {
    public $identifier;
    public $title;
    public $content;
    public $frenchCreationDate;
}

class PostRepository
{
    public $database = null; // Connexion à la base de données

    public function dbConnect()
    {
        if ($this->database === null) {
            $this->database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        }
    }

    public function getPosts()
    {
        $this->dbConnect(); // Connexion à la base de données
        $statement = $this->database->query(
            "SELECT id, titre AS title, contenu AS content, 
            DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
            FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
        );

        $posts = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post();
            $post->identifier = $row['id'];
            $post->title = $row['title'];
            $post->content = $row['content'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $posts[] = $post;
        }
        return $posts;
    }

    public function getPost($identifier)
    {
        $this->dbConnect(); // Connexion à la base de données
        $statement = $this->database->prepare(
            "SELECT id, titre AS title, contenu AS content, 
            DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date 
            FROM billets WHERE id = ?"
        );
        $statement->execute([$identifier]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        $post = new Post();
        $post->identifier = $row['id'];
        $post->title = $row['title'];
        $post->content = $row['content'];
        $post->frenchCreationDate = $row['french_creation_date'];
        return $post;
    }
}
?>
