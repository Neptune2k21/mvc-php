<?php

class Comment
{
    public $author;             // Auteur du commentaire
    public $frenchCreationDate; // Date de création formatée
    public $comment;            // Contenu du commentaire
}

function getComments($identifier) {
    $database = commentDbConnect();
    
    $statement = $database->prepare(
        "SELECT id, author, comment,
        DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS frenchCreationDate 
        FROM comments WHERE post_id = ?
        ORDER BY comment_date DESC"
    );
    $statement->execute([$identifier]);
    $comments = [];
    
    while (($row = $statement->fetch())) {
        $comment = new Comment();
        $comment->author = $row['author'];
        $comment->frenchCreationDate = $row['frenchCreationDate'];
        $comment->comment = $row['comment'];
        
        $comments[] = $comment;
    }
    
    return $comments;
}

function createComment($post, $author, $comment) {
    $database = commentDbConnect();
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
}

function commentDbConnect() {
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database;
}
?>
