<?php

class User
{

    private function hashPassword($password)
    {

        $salt = '$2y$11$' . substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

        return crypt($password, $salt);
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return crypt($password, $hashedPassword) == $hashedPassword;
    }

    public function addUser($post)
    {

        $database = new Database();
        $hashPassword = $this->hashPassword($post['password']);
        $user = $database->queryOne(
          "SELECT Id FROM users WHERE Email = ?", [ $post['email'] ]
        );
        if($user !== false) {
            $error = 'Email déja existant !';
            return $error;
        } else {
        $database->executeSql(
            'INSERT INTO
			users(Email, Password, FirstName, LastName, Pseudo, Role, Promotion, Campus, Status, CreationTimeStamp)
			VALUES (?, ?, ?, ?, ?, "user", ?, ?,"hors ligne", NOW())',

            [
                $post['email'],
                $hashPassword,
                $post['firstname'],
                $post['lastname'],
                $post['pseudo'],
                $post['promo'],
                $post['campus']

            ]
        );
        header('Location: login.php');
        exit();
        }
    }


    public function logUser($post)
    {
        $error = null;

        $database = new Database();
        $user = $database->queryOne(
            'SELECT *
			FROM users
			WHERE Email = ? || Pseudo = ?',
            [
                $post['email'],
                $post['email']
            ]
        );

        if ($user === false) {
            $error = 'Email ou Pseudo incorrect';
            return $error;
        } else if ($user !== false && $this->verifyPassword($post['password'], $user['Password']) == true) {
            $database->executeSql(
                'UPDATE
                    users
                    SET Status = "en ligne"
                    WHERE Id = ?',
                    [$user['Id']]
            );
            $user = $database->queryOne(
                'SELECT *
                FROM users
                WHERE Email = ? || Pseudo = ?',
                [
                    $post['email'],
                    $post['email']
                ]
            );
            $_SESSION['id'] = $user['Id'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['firstname'] = $user['FirstName'];
            $_SESSION['lastname'] = $user['LastName'];
            $_SESSION['role'] = $user['Role'];
            $_SESSION['pseudo'] = $user['Pseudo'];
            $_SESSION['camp'] = $user['Campus'];
            $_SESSION['status'] = $user['Status'];
            $_SESSION['promo'] = $user['Promotion'];
            $error = null;
            //var_dump($user['Status']);
            return $error;
        }else{
            $error = 'Mot de passe incorrect, veuillez réessayer';
            return $error;
        }
}

    public function getAllUsers()
    {
        $database = new Database();
        $sql = 'SELECT * 
                FROM users 
                ORDER BY Status, Pseudo ASC';
        return $database->query($sql, []);
    }

    public function getOneUser($get)
    {
        $database = new Database();
        $sql = 'SELECT *
                FROM users
                WHERE Id = ?';
        return $database->queryOne($sql, [$get]);
    }

    public function UpdateUser($post)
    {
        $database = new Database();
        $database->executeSql(
            'UPDATE
                users
                SET FirstName = ?, LastName = ?, Pseudo = ?, Email = ?
                WHERE Pseudo = ?',
            [
                $post['firstname'],
                $post['lastname'],
                $post['pseudo'],
                $post['email'],
                $_SESSION['pseudo']
            ]
        );
        $_SESSION['firstname'] = $post['firstname'];
        $_SESSION['lastname'] = $post['lastname'];
        $_SESSION['pseudo'] = $post['pseudo'];
        $_SESSION['email'] = $post['email'];
        header('Location: updateUser.php');
        exit();
    }

}
?>