<?php
    $host = getenv('IP');
    $username = getenv('C9_USER');
    $password = '';
    $dbname = 'test';
    
     if (isset ($_POST[username]) && isset ($_POST['password']))
    {
        $pdo_dsn="mysql:dbname=$dbname;host=$host";
        $pdo_user=$username; 
        $pdo_password=$password;
        
        $conn = new PDO($pdo_dsn, $pdo_user, $pdo_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $user=$_POST[username];
        $pword=$conn->query("SELECT password FROM User WHERE username LIKE '%$user%'");
        $pword=$pword->fetchAll(PDO::FETCH_ASSOC);
        $name=$conn->query("SELECT username FROM User WHERE username LIKE '%$user%'");
        $name=$name->fetchAll(PDO::FETCH_ASSOC);
        foreach ($name as $row1) 
        {
            if($_POST[username]===$row1['username'])
            {
                foreach ($pword as $row) 
                {
                        if(md5($_POST['password'])=== $row['password'])
                        {
                            session_start();
                            $_SESSION['login_user']=$user;
                            echo '<br /><a href="home2.php?' . SID . '"></a>';
                            header('Location: userindex.php');
                            
                        }
                        else 
                        {
                            echo "Wrong password";
                            header('Location: index.php#getinput'); 
                        }
                }
            }
            else
            {
                header('Location: index.php#getinput');
            }
        }
    }
?>