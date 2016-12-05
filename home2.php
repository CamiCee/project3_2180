<?php
    $host = getenv('IP');
    $username = getenv('C9_USER');
    $password = '';
    $dbname = 'test';
    $pdo_dsn="mysql:dbname=$dbname;host=$host";
    $pdo_user=$username; 
    $pdo_password=$password;
        
    $conn = new PDO($pdo_dsn, $pdo_user, $pdo_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    session_start();
     if(isset($_SESSION['login_user']))
    {
        $user=$_SESSION['login_user'];
        
        date_default_timezone_set('America/Jamaica');
       
        $mydate=getdate(date("U"));
        echo $mydate[weekday].", ". $mydate[month]."  ".$mydate['mday']."  ".$mydate[year];
        echo '<br/>Welcome to your homepage'." ".$_SESSION['login_user'].'!<br />';
        echo '<br /><a href="compose2.php?' . SID . '"></a>';
        echo '<br /><a href="inbox.php?' . SID . '"></a>';
        
        echo "Messages (Refresh page to view messages) <br/>";//put in html code for line or css
        echo "_____________________________________________________________________________________________";
        
        $userID=$conn->query("SELECT id FROM User WHERE username LIKE '%$user%'");
        $userID=$userID->fetchAll(PDO::FETCH_ASSOC);
        foreach($userID as $myID)
        {
            $currID=$myID['id'];
        }
        $userMsg=$conn->query("SELECT * FROM Message WHERE recipient_ids LIKE '%$currID%'");
        $userMsg=$userMsg->fetchAll(PDO::FETCH_ASSOC);
        echo"<link rel='stylesheet' href='style.css' media='screen' />
             <script src='view.js' charset='utf-8'></script>";
        foreach ($userMsg as $value)
        {
            $time=$value['date_sent'];
            $msgSender=$value['user_id'];
            $msgSender=$conn->query("SELECT * FROM User WHERE id LIKE '%$msgSender%'");
            foreach($msgSender as $person)
            {
                $ppl=$person['username'];
                $msgSub=$value['subject'];
                $msgID=$value['id'];
                $msg_read=$conn->query("SELECT reader_id FROM Message_read WHERE message_id LIKE '%$msgID%'");
                $msg_read=$msg_read->fetchAll(PDO::FETCH_ASSOC);
                foreach($msg_read as $check)
                {
                    $getval=$check['reader_id'];
                    if($getval=='no')
                    {
                        echo"<div> &nbsp; </div>
                            <table>
                             <td class='sender'>$ppl</td>
                             <td><button class='msg' value=$msgID><strong>$msgSub</strong></button></td>
                             <td><div id='result_style'><div id='result'></div></div></td>
                             <td>$time</td>
                             </table>";
                    }
                    if($getval=='yes')
                    {
                        echo"<div> &nbsp; </div>
                        <table>
                         <td class='sender'>$ppl</td>
                         <td><button class='msg' value=$msgID>$msgSub</button></td>
                         <td><div id='result_style'><div id='result'></div></div></td>
                          <td>$time</td>
                         </table>";
                    }
                }
                echo "<script>
                      var httpRequest;
                      var sb=document.querySelectorAll('.msg');
                       for (var i=0;i<sb.length;i++)
    {
        sb[i].addEventListener('click',function()
        {
            httpRequest = new XMLHttpRequest();
            var url='https://testproject2-cami-cee.c9users.io/inbox.php?msg=';
            httpRequest.onreadystatechange = View;
            httpRequest.open('GET', url + encodeURIComponent(this.value));
            httpRequest.send();
            alert('okkkkk');
            alert(this.value);
                //window.location=url;
                
            return false;
        });
     }
                    </script>";
                    
            }
            
        }
    }
    else
    {
        echo "noo";
    }
?>
