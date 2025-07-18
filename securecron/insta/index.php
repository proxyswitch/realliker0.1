<?php


include 'InstagramFunc.php';
//$login = login('kenanorge25756ewl','asdfgh4567',Cookie());
//Savecookie('kenanorge25756ewl',$login);
//$cookie = Cookie();


//print_r ($cookie);

$login_cookie = Logincookie('kenanorge25756ewl');


$username = 'mysteriousboi';
//$InfoAccount = InfoAccount($username, $login_cookie);
//print_r ($InfoAccount);
//$InfoAccount = followc($username, $login_cookie);


//$login_cookie = Logincookie('kenanorge25756ewl');
$InfoAccount = Userid($username, $login_cookie);

print_r ($InfoAccount[0]);

//$data = json_decode($insta_source, true);
//$m1 = $data['author_id'];
//$uname = $data['author_name'];
$latest_array =@file_get_contents('https://www.instagram.com/graphql/query/?query_id=17880160963012870&id='.($InfoAccount[0]).'&first=5'); //replace with user
$results_array = json_decode($latest_array , TRUE);
$post_id=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['shortcode'];
$lastupdate=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['taken_at_timestamp'];
$p = array('http://instagram.com/p/'.$post_id,$lastupdate);
print_r($p);
//echo 'http://instagram.com/p/'.$post_id,$lastupdate;

?>