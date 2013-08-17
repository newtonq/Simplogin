<?php
class Simplogin {
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = 'root';
    private $db_name = 'simplogin';
    private $hash = 'SHA512';
    private $salt = 'my_salt';
    
    function __construct()
    {
        // Connect to the database
        @$db = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($db->connect_error) {
            die('Database connection failed!');
        }
        
        // Setup all the information for the class
        $this->db = $db;
        $this->hash = $this->hash;
        $this->salt = $this->salt;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->time = time();

    }
    function login($username = false, $password = false)
    {
        // Escape the input
        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);
        
        // Hash the password
        $password = hash($this->hash, $this->salt.$password);
        
        
        // Execute the query
        $query = $this->db->query("
                                    SELECT username, password
                                    FROM users
                                    WHERE username = '$username' AND password = '$password'
                                  ");
        
        // Send true or false
        if ($query->num_rows == 1)
        {
            // Since the result is true, update the database information
            $this->db->query("
                                UPDATE users
                                SET last_ip = '$this->ip', last_login = '$this->time'
                                WHERE username = '$username'
                             ");
            return true;
        }
        else
        {
           return false;
        }
    }
    function register($username = false, $email = false, $password = false, $password2 = false)
    {
        $error = false;
        
        // Escape the input
        $username = $this->db->real_escape_string($username);
        $email = $this->db->real_escape_string($email);
        $password = $this->db->real_escape_string($password);
        $password2 = $this->db->real_escape_string($password2);
        
        // Check if the input is right
        if ($password != $password2)
        {
            $error = true;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error = true;
        }
        
        // Execute the rest if error is false
        if ($error == false) 
        {
            // Hash the password
            $password = hash($this->hash, $this->salt.$password);
            
            // Check if the username already exists
            $sql = "
                        SELECT username
                        FROM users
                        WHERE username = '$username'
                   ";
            $query = $this->db->query($sql);
            
            if ($query->num_rows == 1)
            {
                $error = true;
            }
            // Check if the email already exists
            if ($error == false)
            {
                $sql = "
                            SELECT email
                            FROM users
                            WHERE email = '$email'
                       ";
                $query = $this->db->query($sql);
                
                if ($query->num_rows == 1)
                {
                    $error = true;
                }
            }
            
            // Create the account if everything went right
            if ($error == false)
            {
                $this->db->query("
                                   INSERT INTO users
                                   (id, username, email, password, last_ip, last_login)
                                   VALUES (false, '$username', '$email', '$password', '$this->ip', 0)
                                 ");
            }
        }
        
        // Return true or false
        if ($error == true)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}