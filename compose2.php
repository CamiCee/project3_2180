<?php
    $host = getenv('IP');
    $username = getenv('C9_USER');
    $password = '';
    $dbname = 'test';
    
    $to=$_POST[recipients];
	$subject=$_POST[subject];
	$message=$_POST[msg];
	
	session_start();
    if(isset($_SESSION['login_user']))
    {
        if(isset($_POST[recipients]) && isset($_POST[subject]) && $_POST[msg])
        {
            $pdo_dsn="mysql:dbname=$dbname;host=$host";
            $pdo_user=$username; 
            $pdo_password=$password;
            
            $conn = new PDO($pdo_dsn, $pdo_user, $pdo_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sender=$_SESSION['login_user'];
            $myID=$conn->query("SELECT id FROM User WHERE username LIKE '%$sender%'");
            $myID=$myID->fetchAll(PDO::FETCH_ASSOC);
            foreach($myID as $i)
            {
                $valI=$i['id'];
            }
            
            $user=$_POST[recipients];
            $rcvr=$conn->query("SELECT username FROM User WHERE username LIKE '%$user%'");
            $rcvr=$rcvr->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rcvr as $row)
            {
                if($row['username']=="")
                {
                    echo "yes";
                    
                    try
                    {
                        
                            $rcvrID=$val['id'];
                            $dt = new DateTime("now", new DateTimeZone('America/Jamaica'));

                            $dt->format('Y-m-d, H:i:s');
                            //$curr=date('Y-m-d H:i:s');
                            $curr=$dt;
                            $qry=$conn->prepare('INSERT INTO Message (recipient_ids,user_id,subject,body,date_sent) VALUES(:recipient_ids,:user_id,:subject,:body,:date_sent)');
                            $qry->execute(Array(
                                    ':recipient_ids'=>$valI=filter_var($valI, FILTER_SANITIZE_STRING),
                                    ':user_id'=>$valI=filter_var($valI, FILTER_SANITIZE_STRING),
                                    ':subject'=>$_POST[subject]=filter_input (INPUT_POST, 'subject', FILTER_SANITIZE_STRING),
                                    ':body'=>$_POST[msg]=filter_input (INPUT_POST, 'msg', FILTER_SANITIZE_STRING),
                                    ':date_sent'=>$curr =filter_var($curr, FILTER_DEFAULT)
                                ));
                            $rID="no";
                            $last=$conn->lastInsertId();
                            $qry=$conn->prepare('INSERT INTO Message_read (id,message_id,reader_id,date) VALUES (:id,:message_id,:reader_id,:date)');
                            $qry->execute(Array(
                                ':id'=> $valI =filter_var($valI, FILTER_SANITIZE_STRING),
                                //':message_id'=> $readID=filter_var($readID, FILTER_SANITIZE_STRING),
                                ':message_id'=> $last=filter_var($last, FILTER_SANITIZE_STRING),
                                ':reader_id'=> $rID =filter_var($rID, FILTER_SANITIZE_STRING),
                                ':date' => $curr =filter_var($curr, FILTER_DEFAULT)
                                ));
                         
                                
                            echo "<a href='no-refresh2.php#home2'>Sent!</a>";
                            if(isset($_SESSION['login_user']))
                            {
                               if($_SESSION['login_user']==$row['username']) 
                               {
                                   echo "<script>
                                            alert('You have a new message!')
                                            </script>";
                               }
                            }
                    }
                     catch (PDOException $e) 
                    {
                         echo "Could not connect to the database!";
                        echo 'Error: ' . $e->getMessage() . " file: " . $e->getFile() . " line: " . $e->getLine();
                        exit;
                    }
                }
                else
                {
                    try
                    {
                        $rcvr_id=$conn->query("SELECT id FROM User WHERE username LIKE '%$user%'");
                        $rcvr_id=$rcvr_id->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rcvr_id as $val)
                        {
                            date_default_timezone_set('America/Jamaica');
                            $rcvrID=$val['id'];
                            $curr=date('Y-m-d H:i:s');
                            //echo $curr;
                            $qry=$conn->prepare('INSERT INTO Message (recipient_ids,user_id,subject,body,date_sent) VALUES(:recipient_ids,:user_id,:subject,:body,:date_sent)');
                            $qry->execute(Array(
                                    ':recipient_ids'=>$rcvrID=filter_var($rcvrID, FILTER_SANITIZE_STRING),
                                    ':user_id'=>$valI=filter_var($valI, FILTER_SANITIZE_STRING),
                                    ':subject'=>$_POST[subject]=filter_input (INPUT_POST, 'subject', FILTER_SANITIZE_STRING),
                                    ':body'=>$_POST[msg]=filter_input (INPUT_POST, 'msg', FILTER_SANITIZE_STRING),
                                    ':date_sent'=>$curr =filter_var($curr, FILTER_DEFAULT)
                                ));
                            $rID="no";
                            $last=$conn->lastInsertId();
                            $qry=$conn->prepare('INSERT INTO Message_read (id,message_id,reader_id,date) VALUES (:id,:message_id,:reader_id,:date)');
                            $qry->execute(Array(
                                ':id'=> $rcvrID =filter_var($rcvrID, FILTER_SANITIZE_STRING),
                                ':message_id'=> $last=filter_var($last, FILTER_SANITIZE_STRING),
                                ':reader_id'=> $rID =filter_var($rID, FILTER_SANITIZE_STRING),
                                ':date' => $curr =filter_var($curr, FILTER_DEFAULT)
                                ));
                         
                                
                            echo "<a href='userindex.php#home2'>Sent!</a>";
                            if(isset($_SESSION['login_user']))
                            {
                               if($_SESSION['login_user']==$row['username']) 
                               {
                                   echo "<script>
                                            alert('You have a new message!')
                                            </script>";
                               }
                            }
                        }
                    }
                     catch (PDOException $e) 
                    {
                         echo "Could not connect to the database!";
                        echo 'Error: ' . $e->getMessage() . " file: " . $e->getFile() . " line: " . $e->getLine();
                        exit;
                    }
                }
            }
            
        }
    }
?>