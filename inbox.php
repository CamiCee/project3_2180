<?php
     session_start();
     $host = getenv('IP');
    $username = getenv('C9_USER');
    $password = '';
    $dbname = 'test';
    $pdo_dsn="mysql:dbname=$dbname;host=$host";
    $pdo_user=$username; 
    $pdo_password=$password;
    $message=$_GET['msg'];
    
    $conn = new PDO($pdo_dsn, $pdo_user, $pdo_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_SESSION['login_user']))
    {
        
        $get=$conn->query("SELECT body FROM Message WHERE id LIKE '%$message%'");
        $get=$get->fetchAll(PDO::FETCH_ASSOC);
        foreach ($get as $row) 
        {
            $rID="yes";
            echo $row['body'];
            $qry=$conn->prepare("UPDATE Message_read SET reader_id= :reader_id WHERE message_id= :message_id");
            $qry->execute(Array(':reader_id'=>$rID, ':message_id'=>$message));
            
        }
    }
    else
    {
        echo "User not logged in";
    }
?>

