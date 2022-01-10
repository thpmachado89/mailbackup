<?php

include("credentials.php");

ini_set('max_execution_time', '-1');

$mbox = imap_open( "{".$host.":".$port."/novalidate-cert}INBOX" , $username, $password );

$list = imap_list($mbox, "{".$host."}", "*");

foreach($list as $folder){

    $folder = str_replace("{".$host."}", "", $folder);

    getMail($folder);

}

function getMail($folder){

    include("credentials.php");
    
    $mbox = imap_open( "{".$host.":".$port."/novalidate-cert}".$folder , $username, $password );

    $folder = $folder . "/"; 

    if( $mbox ) {
   
        $num = imap_num_msg($mbox);
    
        echo "Total de mensagens: " . $num . "<br>";
             
        $email_number = 2;
    
    
        for($i=1;$i<=$num;$i++){
    
            $message_count = imap_num_msg($mbox);
    
            $headers = imap_fetchheader($mbox, $i);
           
            $body = imap_body($mbox, $i, 1.2);
    
            $directory = "C:/projects/mailbackup/eml/";
    
            if (!file_exists($directory.$folder)) {
    
                mkdir($directory.$folder, 0777, true);
            
            }
        
            file_put_contents($directory.$folder.$i.".eml", $headers . "\n" . $body);
    
        }
        
        imap_close($mbox);
    
    }

}


