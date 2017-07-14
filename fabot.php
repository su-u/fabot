<?php
    require "/twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    $consumerKey = "";
    $consumerSecret = "";
    $accessToken = "";
    $accessTokenSecret = "";

    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
	
	//search id
	$id = '';
	$file = 'log.log';
	$log = file_get_contents($file);
	//TL
	$tl_1 = $connection->get('statuses/user_timeline', ['user_id' => $id, 'count' => 5]);
	$tl_1 = json_decode(json_encode($tl_1), true);	
	$tl_time = $tl_1[0]['created_at'];
	//echo $tl_time;

	//iine!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	if ($log != $tl_time){
		foreach ($tl_1 as $t) {
		    $connection->post('favorites/create', ['id' => $t['id']]);
		    sleep(1);
		}
		//echo $tl_time;
		file_put_contents($file, $tl_time);
	}
