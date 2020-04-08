<?php

class Post
{

    public function sendMsg()
    {
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=chat_num;charset=UTF8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare
                    ('INSERT INTO posts (User_Id, Author, Content, CreationTimestamp) 
                    VALUES(?, ?, ?, NOW())');
$req->execute(array(
    $_SESSION['id'], 
    $_SESSION['pseudo'], 
    $_POST['message']
));

// Redirection du visiteur vers la page du minichat
header('Location: index.php');
    }

    public function getMyMessages()
    {
        $database = new Database();
        $sql = 'SELECT *
                FROM posts
                WHERE User_Id = ?';
        return $database->query($sql, [$_SESSION['id']]);
    }

    public function getAllMessages()
    {
        $database = new Database();
        $sql = 'SELECT posts.`Id`,`User_Id`,`Author`,`Content`,posts.`CreationTimestamp`
        FROM posts
        INNER JOIN users ON users.Pseudo = posts.Author';
        return $database->query($sql, []);
    }

}
?>