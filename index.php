<?php

include("credentials.php");

ini_set('max_execution_time', '-1');

$mbox = imap_open( "{".$host.":".$port."/novalidate-cert}INBOX" , $username, $password );

if( $mbox ) {
   
    $num = imap_num_msg($mbox);

    echo "Total de mensagens: " . $num . "<br>";
         
    $email_number = 2;


    for($i=140;$i<=$num;$i++){

        $message_count = imap_num_msg($mbox);

        $headers = imap_fetchheader($mbox, $i);
       
        $body = imap_body($mbox, $i, 1.2);
    
        file_put_contents("C:/projects/mailbackup/eml/".$i.".eml", $headers . "\n" . $body);

    }
    
    imap_close($mbox);

}
