<?php

class eaq_checker_db
{
    //host
    private $host = 'localhost';

    //user
    private $user = 'root';

    //password
    private $password = '';

    //database
    private $database = 'twitter_clone';

    public function mysqli_connection() {

        //creating connection
        mysqli_connect($this->host, $this->user, $this->password, $this->database);

        //charset setting
        mysqli_set_charset($con, 'utf8');

        //verifying errors
        if(mysqli_connect_errno()) {
            echo 'Error when trying to connect to database: '.mysqli_connect_error();
        }

        return $con;

    }

}

?>
