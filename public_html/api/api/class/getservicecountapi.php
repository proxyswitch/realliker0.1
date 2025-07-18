<?php 
class instagram_without_api{
function get_instagram_id($username)
{
$username = strtolower($username); // sanitization
$client_id  = "014b3b67eb7b4c25ad596b86a953a7fb";
$url = "https://api.instagram.com/v1/users/search?q=".$username."&client_id=". $client_id ;
$get = file_get_contents($url);
$json = json_decode($get);
foreach($json->data as $user)
{
if($user->username == $username)
{
return $user->id;
}
}
return '00000000'; // return this if nothing is found
}
function get_instagram_followers ($url) {
$username = preg_split('#\/#', rtrim(urldecode($url), '/'));
$username = $username[count($username) - 1];
$raw = file_get_contents('https://www.instagram.com/'.$username); //replace with user
preg_match('/\"followed_by\"\:\s?\{\"count\"\:\s?([0-9]+)/',$raw,$m);
return  intval($m[1]);
}
function get_instagrm_media_id($url)
{
$username = strtolower($url); // sanitization
$client_id  = "014b3b67eb7b4c25ad596b86a953a7fb";
$url = "http://api.instagram.com/oembed?url=".$url."";
$get = file_get_contents($url);
$json = json_decode($get,true);
return $json['media_id'];
return '0';
}

function get_instagram_likes($url) {
$username = preg_split('#\/#', rtrim(urldecode($url), '/'));
$username = $username[count($username) - 1];
$raw = file_get_contents('https://www.instagram.com/p/'.$username); //replace with user
preg_match('/\"likes\"\:\s?\{\"count\"\:\s?([0-9]+)/',$raw,$m);
return intval($m[1]);
}
function get_instagram_comments($url) {
$username = preg_split('#\/#', rtrim(urldecode($url), '/'));
$username = $username[count($username) - 1];
$raw = file_get_contents('https://www.instagram.com/p/'.$username); //replace with user
preg_match('/\"comments\"\:\s?\{\"count\"\:\s?([0-9]+)/',$raw,$m);
return intval($m[1]);
}
}
class soundcloud_without_api{
function get_soundcloud_info($url) {
$url = urldecode($url);
$username = str_replace('https://soundcloud.com/', '', $url);
$url = urldecode("http://api.soundcloud.com/users/" . $username . ".json?client_id=c238fe8731bbd341c915f19f02bb61e7");
$get = file_get_contents($url);
$json = json_decode($get);
return $json;
}
function get_soundcloud_plays ($url) {
$url = urldecode($url);
$songname = preg_split('#\/#', rtrim(urldecode($url), '/'));
$url = urldecode("http://api.soundcloud.com/resolve.json?url=".$url."&client_id=c238fe8731bbd341c915f19f02bb61e7");
$get = file_get_contents($url);
$json = json_decode($get);
return $json -> {"playback_count"}; 
return '0';
}

function get_soundcloud_downloads ($url) {
$url = urldecode($url);
$songname = preg_split('#\/#', rtrim(urldecode($url), '/'));
$url = urldecode("http://api.soundcloud.com/resolve.json?url=".$url."&client_id=c238fe8731bbd341c915f19f02bb61e7");
$get = file_get_contents($url);
$json = json_decode($get);
return $json -> {"download_count"}; 
return '0';
}
function get_soundcloud_followers($url) {
$json=$this-> get_soundcloud_info($url);
return $json ->{"followers_count"}; 
return '0';      
}
}
class twitter_without_api{	
function get_twitter_followers($url) {
require_once('twitter/TwitterAPIExchange.php');
$settings = array(
'consumer_key' =>'8r3gf9YEVMkklMyj8QNYQ',
'consumer_secret' =>'Hdla1zPUptW1GI16SokZDw7jTuOdOooFajoXMdB6neI',
'oauth_access_token' =>'590780068-p8wG9VlvON4HJHXlvji6MbR0n0x4UllsqOfJEuk1',
'oauth_access_token_secret' =>'cyMEiwH9A7WqToonsQjYaoFXVE52nNll7Mc2y1qYfYs',
);
$username = preg_split('#\/#', rtrim(urldecode($url), '/'));
$username = $username[count($username) - 1];
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=' . $username;
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$follow_count=$twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest();
$testCount = json_decode($follow_count, true);
return	$testCount[0]['user']['followers_count'];
return '0';
}
function get_twitter_favorites($url) {
require_once('twitter/TwitterAPIExchange.php'); //get it from https://github.com/J7mbo/twitter-api-php
$settings = array(
'consumer_key' =>'8r3gf9YEVMkklMyj8QNYQ',
'consumer_secret' =>'Hdla1zPUptW1GI16SokZDw7jTuOdOooFajoXMdB6neI',
'oauth_access_token' =>'590780068-p8wG9VlvON4HJHXlvji6MbR0n0x4UllsqOfJEuk1',
'oauth_access_token_secret' =>'cyMEiwH9A7WqToonsQjYaoFXVE52nNll7Mc2y1qYfYs',
);
$username = preg_split('#\/#', rtrim(urldecode($url), '/'));
$username = $username[count($username) - 1];
$url ='https://api.twitter.com/1.1/statuses/show/'.$username.'.json';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$follow_count=$twitter->buildOauth($url, $requestMethod)->performRequest();
$testCount = json_decode($follow_count, true);
return $testCount['favorite_count'];
return '0';
}
function get_twitter_retweets($url) {
require_once('twitter/TwitterAPIExchange.php'); //get it from https://github.com/J7mbo/twitter-api-php
$settings = array(
'consumer_key' =>'8r3gf9YEVMkklMyj8QNYQ',
'consumer_secret' =>'Hdla1zPUptW1GI16SokZDw7jTuOdOooFajoXMdB6neI',
'oauth_access_token' =>'590780068-p8wG9VlvON4HJHXlvji6MbR0n0x4UllsqOfJEuk1',
'oauth_access_token_secret' =>'cyMEiwH9A7WqToonsQjYaoFXVE52nNll7Mc2y1qYfYs',
); 
$username = preg_split('#\/#', rtrim(urldecode($url), '/'));
$username = $username[count($username) - 1];
$url ='https://api.twitter.com/1.1/statuses/show/'.$username.'.json';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$follow_count=$twitter->buildOauth($url, $requestMethod)->performRequest();
$testCount = json_decode($follow_count, true);
return $testCount['retweet_count'];
return '0';
}
}
class youtube_without_api{

function get_youtube_views ($url) {
$jsonURL = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id={$url}&key=AIzaSyDCvl43jB52DsxoJMTx0hDTrt4UfBGz_Mc&part=statistics");
$json = json_decode($jsonURL);
return $json->{'items'}[0]->{'statistics'}->{'viewCount'};
return '0';
}

function get_youtube_likes ($url) {
$jsonURL = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id={$url}&key=AIzaSyDCvl43jB52DsxoJMTx0hDTrt4UfBGz_Mc&part=statistics");
$json = json_decode($jsonURL);
return $json->{'items'}[0]->{'statistics'}->{'likeCount'};  
return '0';
}

function get_youtube_dislikes ($url) {
$jsonURL = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id={$url}&key=AIzaSyDCvl43jB52DsxoJMTx0hDTrt4UfBGz_Mc&part=statistics");
$json = json_decode($jsonURL);
return $json->{'items'}[0]->{'statistics'}->{'dislikeCount'};  
return '0';
}

function get_youtube_favorite ($url) {
$jsonURL = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id={$url}&key=AIzaSyDCvl43jB52DsxoJMTx0hDTrt4UfBGz_Mc&part=statistics");
$json = json_decode($jsonURL);
return $json->{'items'}[0]->{'statistics'}->{'favoriteCount'};  
return '0';
}

function get_youtube_comment ($url) {
$jsonURL = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id={$url}&key=AIzaSyDCvl43jB52DsxoJMTx0hDTrt4UfBGz_Mc&part=statistics");
$json = json_decode($jsonURL);
return $json->{'items'}[0]->{'statistics'}->{'commentCount'};  
return '0';
}


function get_youtube_subscribers ($url) {
$url = preg_split('#\/#', rtrim(urldecode($url), '/'));
$url = $url[count($url) - 1];
$jsonURL = file_get_contents("https://www.googleapis.com/youtube/v3/channels?id={$url}&key=AIzaSyDCvl43jB52DsxoJMTx0hDTrt4UfBGz_Mc&part=statistics");
$json = json_decode($jsonURL);
return $json->{'items'}[0]->{'statistics'}->{'subscriberCount'};  
return '0';
}	

}
class facebook_without_api{
function get_fb_likes($url) {
$username=@split("/",$url);
$username = $username[count($username) - 1];
$json = file_get_contents("https://graph.facebook.com/".$username);
$counts = json_decode($json, true);
return $counts['likes'];
return '0';
}
function getfbuserid($username){
$json = file_get_contents("https://graph.facebook.com/".$username);
$counts = json_decode($json, true);
return $counts['id'];
}
function get_fb_followers($url) {
$username=@split("/",$url);
$username = $username[count($username) - 1];
$userid=$this->getfbuserid($username);
$json = file_get_contents("https://graph.facebook.com/".$userid."/subscribers?access_token=CAAYdNZArRJ40BAHcp8gb4MnSfAZCtJZAN7MfCn15adBC48oWm5HYxIZCSiYy1vUKoPMjepDgE8jY4WXJuAdGETHHlOHJnZBUq5zwZAJgr3IS7feueIkwWLZCLXjddk4NPjAdLYqaqqhJ9xU4ztXXtPjGvhMSUFt35wFOw8cqSw56Axbqkm0iwX0gWk9MDBKZC1JElVxZCqzsziZC1gTNMkHHqjbZB2O3T4F0N8ZD");
$counts = json_decode($json, true);
return $counts['summary']['total_count'];
return '0';
}
function get_fb_photolikes($url) {
$username=@split("=",$url);
$username = $username[count($username) - 1];
$json = file_get_contents("https://graph.facebook.com/".$username."/likes");
$counts = json_decode($json, true);
return count($counts['data']);
return '0';
} 
function get_fb_groupmember($url) {
return 0;
} 
function get_fb_fanpagelikes($url){
$username=@split("/",$url);
$username = $username[count($username) - 1];
$json = file_get_contents("https://graph.facebook.com/".$username."?access_token=CAAYdNZArRJ40BAHcp8gb4MnSfAZCtJZAN7MfCn15adBC48oWm5HYxIZCSiYy1vUKoPMjepDgE8jY4WXJuAdGETHHlOHJnZBUq5zwZAJgr3IS7feueIkwWLZCLXjddk4NPjAdLYqaqqhJ9xU4ztXXtPjGvhMSUFt35wFOw8cqSw56Axbqkm0iwX0gWk9MDBKZC1JElVxZCqzsziZC1gTNMkHHqjbZB2O3T4F0N8ZD&fields=likes");
$counts = json_decode($json, true);
return $counts['likes'];
return '0';
}
}
class vine_without_api{
function get_vine_followers ($userid) {
$url = urldecode($url);
$songname = preg_split('#\/#', rtrim(urldecode($url), '/'));
$url = urldecode("https://api.vineapp.com/users/profiles/$userid");
$get = file_get_contents($url);
$json =json_decode($get);
return $json->data->followerCount;
return '0';
}


function get_vine_likes ($videoid) {
$videoid = preg_split('#\/#', rtrim(urldecode($videoid), '/'));
$videoid= $videoid[count($videoid) - 1];
$get = file_get_contents("https://api.vineapp.com/timelines/posts/s/".$videoid);
$json =json_decode($get,true);
return $json[data][records][0][likes][count];
return '0';
}
function get_vine_comments($videoid) {
$url = urldecode($url);
$videoid = preg_split('#\/#', rtrim(urldecode($videoid), '/'));
$videoid= $videoid[count($videoid) - 1];
$url = urldecode("https://api.vineapp.com/timelines/posts/s/$videoid");
$get = file_get_contents($url);
$json =json_decode($get,true);
return $json[data][records][0][comments][count];
return '0';
}

function get_vine_revines($videoid) {
$url = urldecode($url);
$videoid = preg_split('#\/#', rtrim(urldecode($videoid), '/'));
$videoid= $videoid[count($videoid) - 1];
$url = urldecode("https://api.vineapp.com/timelines/posts/s/$videoid");
$get = file_get_contents($url);
$json =json_decode($get,true);
return $json[data][records][0][reposts][count];
return '0';
}
}
?>