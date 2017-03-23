<?php
define( 'API_ACCESS_KEY', 'AAAA7sZZJSg:APA91bE7TnVswXUZRYHVVIlC36bUUoRaF4qQWML0X2pF-D7krJ-o3NUzXe-F0EfQ3NZe3yQv8zOxLkvJynCpKcbM_XoAm2EJ43YxL_-jDR7FN6Ex2Kvf41bem12c7_Z9Jj0t-zqfNJHQ');
class PushMessage {
    //put your code here
    
    
    public function send($ids,$message){
        $fields = array
(
	'registration_ids' 	=> $ids,
	'data'			=> $message
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
        $ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
    }
    
}
