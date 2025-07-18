<?php
/**
 * Author  : Sandroputraa
 * Name    : Instagram Web API ❤️️
 * Build   : 08-10-2020
 * Updated : 2025-07-08 (for current Instagram API)
 *
 * If you are a reliable programmer or the best developer, please don't change anything.
 * If you want to be appreciated by others, then don't change anything in this script.
 * Please respect me for making this tool from the beginning.
 */
include 'func.php';
define('API', 'https://www.instagram.com');
define('MOBILE_API', 'https://i.instagram.com/api/v1');


// ADD THIS MISSING FUNCTION
function GraphQLQuery($query_hash, $variables, $cookie)
{
    $headers = [
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36",
        "x-ig-app-id: 936619743392459",
        "x-requested-with: XMLHttpRequest",
        "cookie: ".$cookie['Data']
    ];
    
    $url = API . "/graphql/query/?query_hash={$query_hash}&variables=" . urlencode(json_encode($variables));
    
    $response = curl(
        $url,
        'GET',
        null,
        null,
        $headers
    );
    
    return $response[2];
}



//Get Cookie for Login (Remains functional)
function Cookie()
{
    $cookie = curl(
        API.'/data/shared_data/?__a=1',
        'GET',
        null,
        null,
        null
    );
    if (empty($cookie[3]['csrftoken'])) {
        return array(
            "Response" => "Failed"
        );
    } else {
        return array(
          "Response" => "Success",
          "Data" => array(
              "Csrf" => $cookie[3]['csrftoken'],
              "Mid" => $cookie[3]['mid'],
              "Ig_did" => $cookie[3]['ig_did']
          )
      );
    }
}

// Login Instagram (Remains functional)
function Login($username, $password, $cookie)
{
    $login = curl(
        API.'/accounts/login/ajax/',
        'POST',
        'username='.$username.'&enc_password=#PWD_INSTAGRAM_BROWSER:0:'.time().':'.$password.'&queryParams=%7B%7D&optIntoOneTap=false',
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ig_did=".$cookie['Data']['Ig_did']."; csrftoken=".$cookie['Data']['Csrf']."; mid=".$cookie['Data']['Mid']."",
            "host: www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-csrftoken: ".$cookie['Data']['Csrf']."",
            "x-ig-www-claim: 0",
            "x-requested-with: XMLHttpRequest"
        ]
    );
    if (strpos($login[2], '"authenticated":true') || strpos($login[2], '"authenticated": true')) {
        return array(
                "Response" => "Success",
                "Data" => "ig_did=".$cookie['Data']['Ig_did']."; mid=".$cookie['Data']['Mid']."; csrftoken=".$login[3]['csrftoken']."; ds_user_id=".$login[3]['ds_user_id']."; sessionid=".$login[3]['sessionid']."; rur=FTW; ig_direct_region_hint=PRN;",
                "XCSRF" => $login[3]['csrftoken']
            );
    } else {
        return array(
                "Response" => "Failed",
                "Data" => $login[2]
            );
    }
}

// UPDATED: Get account information and first post
function InfoAccount($username, $cookie)
{
    $headers = [
        "User-Agent: Instagram 123.0.0.21.114 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148",
        "x-ig-app-id: 936619743392459",
        "Accept: */*",
        "Accept-Language: en-US",
        "Connection: close"
    ];
    
    if (!empty($cookie['Data'])) {
        $headers[] = "Cookie: ".$cookie['Data'];
    }
    
    $response = curl(
        MOBILE_API.'/users/web_profile_info/?username='.$username,
        'GET',
        null,
        null,
        $headers
    );
    
    // Check HTTP status first
    if ($response[0] != 200) {
        return [
            'error' => true,
            'message' => 'HTTP error: ' . $response[0],
            'response' => $response[2]
        ];
    }
    
    $profileData = json_decode($response[2], true);
    
    // Check for valid JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        return [
            'error' => true,
            'message' => 'JSON decode error: ' . json_last_error_msg(),
            'response' => $response[2]
        ];
    }
    
    // CORRECTED: Proper path for user ID
    if (empty($profileData['data']['user']['id'])) {
        return [
            'error' => true,
            'message' => 'User data not found in response',
            'response' => $profileData
        ];
    }
    
    $userId = $profileData['data']['user']['id'];
    
    // GraphQL query to get first post
    $query_hash = "472f257a40c653c64c666ce877d59d2b";
    $variables = [
        'id' => $userId,
        'first' => 1
    ];
    
    $postResponse = GraphQLQuery($query_hash, $variables, $cookie);
    $postData = json_decode($postResponse, true);
    
    // CORRECTED: Proper paths for user and post data
    return [
        'user' => $profileData['data']['user'],  // Corrected path
        'first_post' => $postData['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node'] ?? null
    ];
}


// Followers Count
// $cookie return Data cookie from Login();
function followc($username, $cookie)
{
    $Info = curl(
         API1.'/api/v1/users/web_profile_info/?username='.$username.'',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "cookie: ".$cookie['Data']."",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36",
            "x-ig-app-id: 936619743392459",
        ]
    );
  //  instagram->graphql->user->edge_followed_by->count;
    return array(
        "Count" => json_decode($Info[2], true)['graphql']['user']['edge_followed_by']['count']
    );
}

function Userid($username, $cookie)
{
    $Userid = curl(
         API1.'/api/v1/users/web_profile_info/?username='.$username.'',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "cookie: ".$cookie['Data']."",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36",
            "x-ig-app-id: 936619743392459",
        ]
    );
  //  instagram->graphql->user->edge_followed_by->count;
        //"Userid" => 
            return array(
        json_decode($Userid[2], true)['graphql']['user']['id']
    );
    
}




// Follow Account
// $Cookie From Return Data Login();
function Follow($user_id, $cookie)
{
    $follow = curl(
        API.'/web/friendships/'.$user_id.'/follow/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($follow[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $follow
            );
    }
}

// Unfollow Account
// $Cookie From Return Data Login();
function Unfollow($user_id, $cookie)
{
    $unfollow = curl(
        API.'/web/friendships/'.$user_id.'/unfollow/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($unfollow[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $unfollow
            );
    }
}

// Like Media
// $Cookie From Return Data Login();
function Like($media_id, $cookie)
{
    $Like = curl(
        API.'/web/likes/'.$media_id.'/like/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Like[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $unfollow
            );
    }
}

// Unlike Media
// $Cookie From Return Data Login();
function Unlike($media_id, $cookie)
{
    $Unlike = curl(
        API.'/web/likes/'.$media_id.'/unlike/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Unlike[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $unfollow
            );
    }
}

// Comment Media
// $Cookie From Return Data Login();


// Uncomment Media
// $Cookie From Return Data Login();
function Uncomment($media_id, $comment_id, $cookie)
{
    $Uncomment = curl(
        API.'/web/comments/'.$media_id.'/delete/'.$comment_id.'/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Uncomment[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $Uncomment
            );
    }
}

// Get Comment Media
// $Cookie From Return Data Login(); & $shortcode From Link Media
function Getcomment($shortcode, $cookie)
{
    $Getcomment = curl(
        API.'/p/'.$shortcode.'/?__a=1',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ".$cookie['Data']."",
            "host: www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "x-ig-www-claim: 0",
            "x-requested-with: XMLHttpRequest"
        ]
    );
    return json_decode($Getcomment[2], true)['graphql']['shortcode_media']['edge_media_to_parent_comment']['edges'];
}

// Get Media Count
// $Cookie From Return Data Login(); & $shortcode From Link Media
function Getcount($shortcode, $cookie)
{
    $Getcount = curl(      
        API1.'/api/v1/media/'.$shortcode.'/info/',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ".$cookie['Data']."",
            "host: www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "x-ig-www-claim: 0",
            "x-requested-with: XMLHttpRequest"
        ]
    );
    //return json_decode($Getcount[2], true)['data']['shortcode_media']['edge_media_preview_like']['count'];
 return preg_match('/\"edge_liked_by\"\:\s?\{\"count\"\:\s?([0-9]+)/',$Getcount,$m);
//var_dump ($raw);
}

// Get Media to user id
// $Cookie From Return Data Login(); & $shortcode From Link Media
function Mediatouserid($shortcode, $cookie)
{
    $Mediatouserid = curl(
        API.''.$shortcode.'/?__a=1',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ".$cookie['Data']."",
            "host: www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "x-ig-www-claim: 0",
            "x-requested-with: XMLHttpRequest"
        ]
    );
        return array(
        "Userid" => json_decode($Mediatouserid[2], true)['owner']['id']
    );
}



// Like Comment in Media
// $Cookie From Return Data Login(); & $comment_id From Return Data Getcomment();
function Likecomment($comment_id, $cookie)
{
    $Likecomment = curl(
        API.'/web/comments/like/'.$media_id.'/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Likecomment[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $Likecomment
            );
    }
}

// Save Media
// $Cookie From Return Data Login();
function Savemedia($media_id, $cookie)
{
    $Savemedia = curl(
        API.'/web/save/'.$media_id.'/save/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Savemedia[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $Savemedia
            );
    }
}

// Get Activty Account
// $Cookie From Return Data Login();
function Getactivity($cookie)
{
    $Getactivity = curl(
        API.'/accounts/activity/?__a=1&include_reel=true',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ".$cookie['Data']."",
            "host: www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "x-ig-www-claim: 0",
            "x-requested-with: XMLHttpRequest"
        ]
    );
    return array(
        "Activty" => json_decode($Getactivity[2], true)['graphql']['user']['activity_feed']['edge_web_activity_feed']['edges'],
        "Count" => json_decode($Getactivity[2], true)['graphql']['user']['activity_feed']['edge_web_activity_feed']['count']
    );
}

// Get Home Timeline
// $Cookie From Return Data Login();

function Gethome($cookie, $End_cursor = null)
{
    $Gethome = curl(
        API.'/graphql/query/?query_hash=e3ae866f8b31b11595884f0c509f3ec5&variables={"fetch_media_item_cursor":"'.$End_cursor.'"}',
        'GET',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Gethome[2], true)['status'] == 'ok') {
        return array(
            "Activty" => json_decode($Gethome[2], true)['data']['user']['edge_web_feed_timeline']['edges'],
            "End_cursor" => json_decode($Gethome[2], true)['data']['user']['edge_web_feed_timeline']['page_info']['end_cursor']
        );
    } else {
        return array(
            "Response" => "Failed",
            "Data" => $Gethome
        );
    }
}

// Get Edit Profile
// $Cookie From Return Data Login();
function Geteditprofile($cookie)
{
    $Geteditprofile = curl(
        API.'/accounts/edit/?__a=1',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ".$cookie['Data']."",
            "host: www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "x-ig-www-claim: 0",
            "x-requested-with: XMLHttpRequest"
        ]
    );
    return json_decode($Geteditprofile[2], true)['form_data'];
}

// Edit Profile
// $Cookie From Return Data Login();
function Editprofile($cookie, $first_name, $email, $username, $phone_number, $biography)
{
    $Editprofile = curl(
        API.'/accounts/edit/',
        'POST',
        'first_name='.$first_name.'&email='.$email.'&username='.$username.'&phone_number=+'.$phone_number.'&biography='.$biography.'&external_url=&chaining_enabled=on',
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Editprofile[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $Editprofile
            );
    }
}

// Change Password
// $Cookie From Return Data Login();
function Changepassword($cookie, $old_password, $new_password)
{
    $Changepassword = curl(
        API.'/accounts/password/change/',
        'POST',
        'enc_old_password=#PWD_INSTAGRAM_BROWSER:0:'.time().':'.$old_password.'&enc_new_password1=#PWD_INSTAGRAM_BROWSER:0:'.time().':'.$new_password.'&enc_new_password2=#PWD_INSTAGRAM_BROWSER:0:'.time().':'.$new_password.'',
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    if (json_decode($Changepassword[2], true)['status'] == 'ok') {
        return array(
                "Response" => "Success"
            );
    } else {
        return array(
                "Response" => $Changepassword
            );
    }
}

// Get Direct Message
// $Cookie From Return Data Login();
function fetch_inbox($cursor = null, $cookie)
{
    $fetch = curl(
        API.'/direct_v2/web/inbox/?persistentBadging=true&folder=0&cursor='.$cursor.'',
        'GET',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "host: www.instagram.com",
            "referer: https://www.instagram.com/direct/inbox/",
            "sec-ch-ua-mobile: ?0",
            "sec-fetch-dest: empty",
            "sec-fetch-mode: cors",
            "sec-fetch-site: same-origin",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    return array(
            'Cursor' => json_decode($fetch[2], true)['inbox']['oldest_cursor'],
            'Thread' => json_decode($fetch[2], true)['inbox']['threads']
        );
}

// Delete Direct Message
// $Cookie From Return Data Login();
function delete_inbox($thread_id, $cookie)
{
    $delete = curl(
        API.'/direct_v2/web/threads/'.$thread_id.'/hide/',
        'POST',
        null,
        null,
        [
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-length: 0",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "referer: https://www.instagram.com/direct/inbox/",
            "sec-ch-ua-mobile: ?0",
            "sec-fetch-dest: empty",
            "sec-fetch-mode: cors",
            "sec-fetch-site: same-origin",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 470fd86be390",
            "x-requested-with: XMLHttpRequest"
          ]
    );
    return $delete[2];
}

// Change Profile Picture
// $Cookie From Return Data Login();

function Changeprofile($cookie, $path_image)
{
    $ext = pathinfo($path_image, PATHINFO_EXTENSION);
    if ($ext !=='jpg') {
        return array(
            "Response" => "Failed",
            "Data" => "Image not jpg"
        );
    } else {
        $headers = [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "Content-Type: multipart/form-data",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
                    ];

        $data = array(
    'profile_pic' => new CURLFile(
        ''.$path_image.'',
        'image/jpeg',
        'profilepic.jpg'
    ),
);

        $ch = curl_init(API.'/accounts/web_change_profile_picture/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return $response;
    }
}

// Remove Profile Picture
// $Cookie From Return Data Login();
function Removeprofilepicture($cookie){
    $Removeprofilepicture = curl(
        API.'/accounts/web_change_profile_picture/',
        'POST',
        null,
        null,
        [
            "cookie: ig_nrcb=1; ".$cookie['Data']."",
            "x-csrftoken: ".$cookie['XCSRF']."",
            "accept: */*",
            "accept-language: en-US,en;q=0.9,id;q=0.8",
            "connection: keep-alive",
            "content-type: application/x-www-form-urlencoded",
            "host: www.instagram.com",
            "origin: https://www.instagram.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36",
            "x-ig-app-id: 936619743392459",
            "x-instagram-ajax: 38f51516507c",
            "x-requested-with: XMLHttpRequest"
        ]
        );
        return $Removeprofilepicture[2];
}

// Save Cookie
function Savecookie($username , $cookie){
    $tmp = json_encode(array(
        "Data" => $cookie['Data'],
        "XCSRF" => $cookie['XCSRF']
    ));
    save(__DIR__.'/Cookie/'.$username.'.json' , $tmp);
}


function Logincookie($username){
    $mafile = fopen(__DIR__ .'/Cookie/'.$username.'.json', 'r');
    $file = fread($mafile, filesize(__DIR__ .'/Cookie/'.$username.'.json'));
    $data = json_decode($file);
    fclose($mafile);
    return array(
        "Data" => $data->Data,
        "XCSRF" => $data->XCSRF
    );
}