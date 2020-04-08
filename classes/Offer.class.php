<?php 

class Offer{

    public function getAllOffers()
    {
        $database = new Database();
        $sql = 'SELECT *
                FROM offres';
        return $database->query($sql, []);
    }

    public function getOneOffer($get)
    {
        $database = new Database();
        $sql = 'SELECT *
                FROM offres
                WHERE Id = ?';
        return $database->queryOne($sql, [$get]);
    }


    public function addOffer($post)
    {

        $database = new Database();
        $database->executeSql(
            'INSERT INTO
			offres(Url, Title, CreationTimeStamp)
			VALUES (?, ?, NOW())',

            [
                $post['url'],
                $post['title']
            ]
        );
        header('Location: offer.php');
        exit();
    }

    public function deleteOffer($get)
    {
    $database = new Database();
    $database->executeSql(
        'DELETE
			FROM offres
			WHERE Id = ?',
        [$get]
    );
    header('Location: offer.php');
    exit();
    }

    public function updateOffer($post)
    {

        $database = new Database();
        $database->executeSql(
            'UPDATE offres 
            SET Url= ?, Title= ? 
            WHERE Id= ?',

            [
                $post['url'],
                $post['title'],
                $post['id']
            ]
        );
        header('Location: offer.php');
        exit();
    }
}

?>