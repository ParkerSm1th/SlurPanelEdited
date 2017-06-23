<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
    
    $pin=$_POST['pin'];

    include("../assets/conn.php");
    $sql="SELECT * FROM `registration` WHERE `pin` = '$pin'";
    $fetchData=mysqli_query($conn, $sql);
    $regiData=mysqli_fetch_assoc($fetchData);

    if(empty($regiData['pin'])){
        header("Location: index.php?invalidPin=1");
        die("wrong pin");
    }

    // This if statement checks to determine whether the registration form has been submitted 
    // If it has, then the registration code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // Ensure that the user has entered a non-empty password 
        if(empty($_POST['password'])) 
        { 
            die("Please enter a password."); 
        } 
         
        
        // An INSERT query is used to add new rows to a database table. 
        // Again, we are using special tokens (technically called parameters) to 
        // protect against SQL injection attacks. 
        
        $query = " 
            INSERT INTO users ( 
                username,
                role,
                visiblerole,
                region,
                password,
                salt
            ) VALUES ( 
                :username,
                :role,
                :visiblerole,
                :region,
                :password,
                :salt 
            ) 
        "; 
         
        // A salt is randomly generated here to protect again brute force attacks 
        // and rainbow table attacks.  The following statement generates a hex 
        // representation of an 8 byte salt.  Representing this in hex provides 
        // no additional security, but makes it easier for humans to read. 
        // For more information: 
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29 
        // http://en.wikipedia.org/wiki/Brute-force_attack 
        // http://en.wikipedia.org/wiki/Rainbow_table 
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        // This hashes the password with the salt so that it can be stored securely 
        // in your database.  The output of this next statement is a 64 byte hex 
        // string representing the 32 byte sha256 hash of the password.  The original 
        // password cannot be recovered from the hash.  For more information: 
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function 
        $password = hash('sha256', $_POST['password'] . $salt); 
         
        // Next we hash the hash value 65536 more times.  The purpose of this is to 
        // protect against brute force attacks.  Now an attacker must compute the hash 65537 
        // times for each guess they make against a password, whereas if the password 
        // were hashed only once the attacker would have been able to make 65537 different  
        // guesses in the same amount of time instead of only one. 
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array( 
            ':password' => $password, 
            ':salt' => $salt, 
            ':username' => $regiData['username'],
            ':role' => $regiData['role'],
            ':visiblerole' => $regiData['visiblerole'],
            ':region' => $regiData['region']
        ); 
         
        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        }
        
        $regipin=$regiData['pin'];
        
        $sql="DELETE FROM `registration` WHERE `pin` = '$regipin'";
        mysqli_query($conn, $sql);

            
        // This redirects the user back to the login page after they register 
        header("Location: ../index.php?accountCreated=1"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to ../index.php?accountCreated=1"); 
    } 
     
?> 
