<?php

function getComments($identifier) {
    $database = commentDbConnect();
    
    $statement = $database->prepare(
        "SELECT id, author, comment,
        DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss')
        AS frenchCreationDate FROM comments WHERE post_id = ?
        ORDER BY comment_date DESC"
    );
    $statement->execute([$identifier]);
    $comments = [];
    while (($row = $statement->fetch())) {
        $comment = [
            'author' => $row['author'],
            'frenchCreationDate' => $row['frenchCreationDate'],
            'comment' => $row['comment'],
        ];
        $comments[] = $comment;
    }
    return $comments;
}

function createComment(string $post, string $author, string $comment)
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
}

function commentDbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    


    return $database;
}
