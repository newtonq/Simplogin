Simplogin
=========

A very simple login class written in PHP with MySQLi (OO!)

# Installation
To start we need to include the class itself. You can do this by writing:

    <?php
    require 'classes/simplogin.class.php';
    
Now we need to load the class, and initialize it:

    <?php
    $simplogin = new Simplogin();
    
You will need to change the settings in the class (classes/simplogin.class.php), I recommend using SHA512 as the hash and a 32 character salt.

Now that you've initialized the class, you'll have to import the SQL. The SQL code is:

    -- 
    -- Structure for table `users`
    -- 
    
    DROP TABLE IF EXISTS `users`;
    CREATE TABLE IF NOT EXISTS `users` (
      `id` int(12) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) COLLATE latin7_general_cs NOT NULL,
      `email` varchar(255) CHARACTER SET utf8 NOT NULL,
      `password` varchar(128) CHARACTER SET utf8 NOT NULL,
      `last_ip` varchar(15) CHARACTER SET utf8 NOT NULL,
      `last_login` int(10) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;
    
    -- 
    -- Data for table `users`
    -- 
    
    INSERT INTO `users` (`id`, `username`, `email`, `password`, `last_ip`, `last_login`) VALUES
      ('1', 'username', 'example@example.com', '9055ecf4267bdb4476e2c2e84fd375bdf176244bccbbbe1beb87917dda3fb0962ee3232774b5b5a1723f9803be60af5e63bcd8613c5ebd6b05697e253d98f258', '127.0.0.1', '0');
    


The setup is now complete, although the created account uses the SHA-512 hash so it will not work with any other hash!

The username is 'username' and the password = 'password'.
# Using the class
The class is very simple to use, just make an if statement. You can view examples in the examples folder.
    
### Any questions, idea's, bugs? Please create a issue.