<?php include("config/smmeconfig.php");
class autoadd{

function addsmmlite($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("smmlite.class.php");	
$socialsp=explode("-",$socialtype);
$socialtype=$socialsp[0];
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Like":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Comment":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Views":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "customcomments":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'comments' =>$ccomments));
break;	
case "randomcomments":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "MentionsPopular":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "MentionsHashtag":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count,'hashtags'=>$extdata));
break;	
case "MentionsUserFollowers":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count,'username'=>$extdata));
break;
case "MentionsMediaLikers":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count,'media'=>$extdata));
break;			
default:
$order_id=0;
break;
}
break;
case "Soundcloud":
switch($socialtype){
case "Plays":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Downloads":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;
case "Vine":
switch($socialtype){
case "Follower":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Like":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Comment":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Revines":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;
case "Facebook":
switch($socialtype){
case "Page Likes":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Social Signals":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Post Likes":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Photo Likes":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Video Views":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
default:
$order_id=0;
break;
}
break;

case "Twitter":
switch($socialtype){
case "Follower":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Retweet":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Favorite":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;

case "Telegram":
switch($socialtype){
case "Channels":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Groups":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Posts":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;

case "Youtube":
switch($socialtype){
case "View":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Like":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Dislike":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Subscriber":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Comment":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Reshare":
$Followgramnet = new smmliteapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}




function addpaneloji($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("paneloji.class.php");	
$socialsp=explode("=",$socialtype);
$socialtype=$socialsp[0];
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Like":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Comment":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Views":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "customcomments":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'comments' =>$ccomments));
break;	
case "randomcomments":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "MentionsPopular":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "MentionsHashtag":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count,'hashtags'=>$extdata));
break;	
case "MentionsUserFollowers":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count,'username'=>$extdata));
break;
case "MentionsMediaLikers":
$Followgramnet = new panelojiapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count,'media'=>$extdata));
break;			
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}



function addprm4u($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("prm4u.class.php");	
$socialsp=explode("=",$socialtype);
$socialtype=$socialsp[0];
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new prm4uapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Like":
$Followgramnet = new prm4uapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Comment":
$Followgramnet = new prm4uapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Views":
$Followgramnet = new prm4uapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}



function addapiseller($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("apiseller.class.php");	
$socialsp=explode("=",$socialtype);
$socialtype=$socialsp[0];
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Like":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Comment":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;		
default:
$order_id=0;
break;
}
break;
case "Facebook":
switch($socialtype){
case "PageLikes":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "SocialSignals":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Postlikes":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Photolikes":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Videoviews":
$Followgramnet = new apisellerapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}


function addpowerlikesprovider($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("powerlikesprovider.class.php");	
$socialsp=explode("=",$socialtype);
$socialtype=$socialsp[0];
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Like":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Views":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;		
default:
$order_id=0;
break;
}
break;
case "Facebook":
switch($socialtype){
case "PageLikes":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "SocialSignals":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Postlikes":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Photolikes":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Videoviews":
$Followgramnet = new powerlikesproviderapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}


function addbulkmedya($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("bulkmedya.class.php");	
$socialsp=explode("=",$socialtype);
$socialtype=$socialsp[0];
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Like":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Views":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;		
default:
$order_id=0;
break;
}
break;
case "Facebook":
switch($socialtype){
case "PageLikes":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "SocialSignals":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Postlikes":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Photolikes":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Videoviews":
$Followgramnet = new bulkmedyaapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}






function addperfectsmm($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("perfectsmm.class.php");	
$socialsp=explode("=",$socialtype);
$socialtype=$socialsp[0];
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new perfectsmmrapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;
case "Like":
$Followgramnet = new perfectsmmapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Views":
$Followgramnet = new perfectsmmapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;	
case "Comment":
$Followgramnet = new perfectsmmapi();
$order_id = $Followgramnet->order(array('service' => $socialsp[1], 'link' =>$url, 'quantity' =>$count));
break;		
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}




function addfollowgram($socialprovider,$socialtype,$url,$count,$extdata){
require_once("follow.api.class.php");	
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$type="Followers";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;
case "Like":
$type="Likes";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;	
case "Comment":
$type="Comments";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;
case "Views":
$type="Views";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;
case "MentionsPopular":
$type="MentionsPopular";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;	
case "MentionsHashtag":
$type="MentionsHashtag";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;	
case "MentionsUserFollowers":
$type="MentionsUserFollowers";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;
case "MentionsMediaLikers":
$type="MentionsMediaLikers";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count,$extdata);
break;			
default:
$order_id=0;
break;
}
break;
case "Soundcloud":
switch($socialtype){
case "Plays":
$type="Plays";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count);
break;	
case "Downloads":
$type="Downloads";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count);
break;
default:
$order_id=0;
break;
}
break;
case "Vine":
switch($socialtype){
case "Follower":
$type="Followers";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count);
break;	
case "Like":
$type="Likes";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count);
break;
case "Comment":
$type="Comments";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count);
break;
case "Revines":
$type="Reposts";
$Followgramnet = new followapi();
$order_id = $Followgramnet->add_order($socialprovider,$type,$url,$count);
break;
default:
$order_id=0;
break;
}
default:
$order_id=0;
break;
}
return $order_id;
}


function addsharehoot($socialprovider,$socialtype,$url,$count,$extdata){
require_once("sharehoot.class.php");	
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = $Api = new ShareHOOTFollowApi();
$order_id = $Followgramnet->addorder($url,$count);
break;
case "Like":
$Followgramnet = new ShareHOOTLikeApi();
$order_id = $Followgramnet->addorder($url,$count);
break;	
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}


function addsmmhouse($socialprovider,$socialtype,$url,$count){
require_once("smmhouse.php");
switch($socialprovider){
case "Facebook":
switch($socialtype){
case "Page Likes":
$smmhouse = new facebook();
$order_id =$smmhouse->AddPagelikes($url,$count);
break;
case "Social Signals":
$smmhouse = new facebook();
$order_id =$smmhouse->AddSocialSignals($url,$count);
break;	
case "Post Likes":
$smmhouse = new facebook();
$order_id =$smmhouse->AddPostlikes($url,$count);
break;	
case "Photo Likes":
$smmhouse = new facebook();
$order_id =$smmhouse->AddPhotolikes($url,$count);
break;	
default:
$order_id=0;
break;
}
break;

case "Twitter":
switch($socialtype){
case "Follower":
$smmhouse = new twitter();
$order_id = $smmhouse->AddFollowers($url,$count);
break;
case "Retweet":
$smmhouse = new twitter();
$order_id = $smmhouse->AddRetweets($url,$count);
break;
case "Favorite":
$smmhouse = new twitter();
$order_id = $smmhouse->AddFavorites($url,$count);
break;
default:
$order_id=0;
break;
}
break;
	
case "Instagram":
switch($socialtype){
case "Follower":
$smmhouse= new instagram();
$order_id= $smmhouse->AddFollowers($url,$count);
break;
case "Like":
$smmhouse= new instagram();
$order_id=$smmhouse->AddLikes($url,$count);
break;	
case "Comment":
$smmhouse= new instagram();
$order_id= $smmhouse->AddComments($url,$count);
break;	
default:
$order_id=0;
break;
}
break;
case "Soundcloud":
switch($socialtype){
case "Plays":
$smmhouse = new soundcloud();
$order_id = $smmhouse->AddPlays($url,$count);
break;	
case "Downloads":
$smmhouse = new soundcloud();
$order_id = $smmhouse->AddDownloads($url,$count);
break;
case "Followers":
$smmhouse = new soundcloud();
$order_id = $smmhouse->AddFollowers($url,$count);
break;
default:
$order_id=0;
break;
}
break;

case "Vine":
switch($socialtype){
case "Follower":
$smmhouse = new vine();
$order_id = $smmhouse->AddFollowers($url,$count);
break;	
case "Like":
$smmhouse = new vine();
$order_id = $smmhouse->AddLikes($url,$count);
break;
case "Comment":
$smmhouse = new vine();
$order_id = $smmhouse->AddComments($url,$count);
break;
case "Revines":
$smmhouse = new vine();
$order_id = $smmhouse->AddRevines($url,$count);
break;
default:
$order_id=0;
break;
}
break;
case "Youtube":
switch($socialtype){
case "View":
$smmhouse = new youtube();
$order_id = $smmhouse->AddViews($url,$count);
break;	
case "Like":
$smmhouse = new youtube();
$order_id = $smmhouse->AddLikes($url,$count);
break;
case "Dislike":
$smmhouse = new youtube();
$order_id = $smmhouse->AddDislikes($url,$count);
break;
case "Subscriber":
$smmhouse = new youtube();
$order_id = $smmhouse->AddSubscirbers($url,$count);
break;
case "Comment":
$smmhouse = new youtube();
$order_id = $smmhouse->AddComments($url,$count);
break;
case "Reshare":
$smmhouse = new youtube();
$order_id = $smmhouse->AddReshare($url,$count);
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}

function adduksmm($socialprovider,$socialtype,$url,$count){
require_once("uksmm.class.php");
switch($socialprovider){
case "Facebook":
switch($socialtype){
case "UKSMMRLPageLikes275":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>275,'quantity'=>$count));
break;
case "UKSMMR60PageLikes53":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>53,'quantity'=>$count));
break;
case "UKSMMAR60PageLikes448":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>448,'quantity'=>$count));
break;
case "Post share":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>41,'quantity'=>$count));
break;
case "Page share real":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>42,'quantity'=>$count));
break;
case "Photo Likes":
$smmhouse = new facebook();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>44,'quantity'=>$count));
break;	
case "Video Views":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>45,'quantity'=>$count));
break;
case "Group Joins":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>46,'quantity'=>$count));
break;
case "Real Followers":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>47,'quantity'=>$count));
break;
case "Real Friends":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>48,'quantity'=>$count));
break;
case "Real 5***** Ratings":
$smmhouse = new uksmm();
$order_id =$smmhouse->order(array('link'=>$url,'service'=>49,'quantity'=>$count));
break;
default:
$order_id=0;
break;
}
break;

case "Twitter":
switch($socialtype){
case "UKSMMFollowers179":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>179,'quantity'=>$count));
break;
case "UKSMMFollowersnew176":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>176,'quantity'=>$count));
break;
case " Followers Spanish ":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>17,'quantity'=>$count));
break;
case "Followers Russian":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>18,'quantity'=>$count));
break;
case "Followers Indian":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>19,'quantity'=>$count));
break;
case "Followers Japanese":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>20,'quantity'=>$count));
break;
case "UKSMMRetweet197":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>197,'quantity'=>$count));
break;
case "UKSMMRetweetsnew49":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>49,'quantity'=>$count));
break;
case "Retweets USA":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>23,'quantity'=>$count));
break;
case "Retweets Indian":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>27,'quantity'=>$count));
break;
case "Retweets Arab":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>25,'quantity'=>$count));
break;

case "Retweets Spanish":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>28,'quantity'=>$count));
break;

case "Retweets Russian":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>29,'quantity'=>$count));
break;

case "Retweets Japanese":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>30,'quantity'=>$count));
break;

case "UKSMMFavorite184":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>184,'quantity'=>$count));
break;

case "UKSMMFavouritesnew52":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>52,'quantity'=>$count));
break;


case "Favourites USA":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>33,'quantity'=>$count));
break;

case "Favourites Arab ":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>34,'quantity'=>$count));
break;

case "Favourites Indian":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>35,'quantity'=>$count));
break;
default:
$order_id=0;
break;
}
break;
	
case "Instagram":
switch($socialtype){
case "UKSMMR60Follower506":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>506,'quantity'=>$count));
break;
case "UKSMMR20Follower413":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>413,'quantity'=>$count));
break;
case "UKSMMR30Followers457":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>457,'quantity'=>$count));
break;
case "UKSMMR30Followers479":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>479,'quantity'=>$count));
break;
case "Video Views":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>97,'quantity'=>$count));
break;
case "Followers Thailand":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>91,'quantity'=>$count));
break;
case "Followers USA":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>3,'quantity'=>$count));
break;
case "Followers China":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>4,'quantity'=>$count));
break;
case "Followers Turkey":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>92,'quantity'=>$count));
break;
case "Followers Arab":
$smmhouse= new uksmm();
$order_id= $smmhouse->order(array('link'=>$url,'service'=>93,'quantity'=>$count));
break;
case "UKSMMCANCELLike496":
$smmhouse= new uksmm();
$order_id=$smmhouse->order(array('link'=>$url,'service'=>496,'quantity'=>$count));
break;	
case "UKSMM25KLike412":
$smmhouse= new uksmm();
$order_id=$smmhouse->order(array('link'=>$url,'service'=>412,'quantity'=>$count));
break;	
case "UKSMM0.9LIKES469":
$smmhouse= new uksmm();
$order_id=$smmhouse->order(array('link'=>$url,'service'=>469,'quantity'=>$count));
break;	
case "UKSMMSF18kike535":
$smmhouse= new uksmm();
$order_id=$smmhouse->order(array('link'=>$url,'service'=>535,'quantity'=>$count));
break;	
case "UKSMMSF30kike536":
$smmhouse= new uksmm();
$order_id=$smmhouse->order(array('link'=>$url,'service'=>536,'quantity'=>$count));
break;	
case "UKSMMSF70kike537":
$smmhouse= new uksmm();
$order_id=$smmhouse->order(array('link'=>$url,'service'=>537,'quantity'=>$count));
break;	
case "Likes Arab":
$smmhouse= new uksmm();
$order_id=$smmhouse->order(array('link'=>$url,'service'=>96,'quantity'=>$count));
break;	
default:
$order_id=0;
break;
}
break;
case "Vine":
switch($socialtype){
case "Follower":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>58,'quantity'=>$count));
break;	
case "Like":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>59,'quantity'=>$count));
break;
case "Loops":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>89,'quantity'=>$count));
break;
case "Comment":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>60,'quantity'=>$count));
break;
case "Revines":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>61,'quantity'=>$count));
break;
default:
$order_id=0;
break;
}
break;
case "Youtube":
switch($socialtype){
case "View":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>53,'quantity'=>$count));
break;	
case "UKSMMLike237":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>237,'quantity'=>$count));
break;
case "UKSMMLikeRefill246":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>246,'quantity'=>$count));
break;
case "UKSMMDislike249":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>249,'quantity'=>$count));
break;
case "Subscriber":
$smmhouse = new uksmm();
$order_id = $smmhouse->order(array('link'=>$url,'service'=>57,'quantity'=>$count));
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return json_decode($order_id,true);
}


function addautomagram($socialprovider,$socialtype,$url,$count){
require_once("automagram.class.php");	
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$Followgramnet = new automagram();
$order_id = $Followgramnet->addfollowers($url,$count);
break;
case "Like":
$Followgramnet = new automagram();
$order_id = $Followgramnet->addlikes($url,$count);
break;	
case "Views":
$Followgramnet = new automagram();
$order_id = $Followgramnet->addviews($url,$count);
break;	
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}



function addcheapsocials($socialprovider,$socialtype,$url,$count){
require_once("cheapsocials.class.php");	
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$type="6";
$Followgramnet = new cheapsocials();
$order_id = $Followgramnet->add_order($url,$type,$count);
break;
case "Like":
$type="7";
$Followgramnet = new cheapsocials();
$order_id = $Followgramnet->add_order($url,$type,$count);
break;	
case "Views":
$type="8";
$Followgramnet = new cheapsocials();
$order_id = $Followgramnet->add_order($url,$type,$count);
break;	
default:
$order_id=0;
break;
}


break;
default:
$order_id=0;
break;
}

switch($socialprovider){
case "Twitter":
switch($socialtype){
case "Retweet":
$type="4";
$Followgramnet = new cheapsocials();
$order_id = $Followgramnet->add_order($url,$type,$count);
break;
case "Favorite":
$type="5";
$Followgramnet = new cheapsocials();
$order_id = $Followgramnet->add_order($url,$type,$count);
break;	
default:
$order_id=0;
break;
}


break;
default:
$order_id=0;
break;
}

return $order_id;
}

function addautosmo($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("autosmo.class.php");
$socialsp=explode("-",$socialtype);
$smmhouse= new autosmoapi();
if($socialsp[1]==96){
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'quantity'=>$count,'username'=>$extdata));
return json_decode($order_id,true);
}else if($socialsp[1]==3){
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'comments'=>$ccomments));
return json_decode($order_id,true);
}
else{
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'quantity'=>$count));
return json_decode($order_id,true);
}
return 0;
}

function addbulkandcheap($socialprovider,$socialtype,$url,$count,$extdata,$ccomments){
require_once("bulkandcheap.class.php");
$socialsp=explode("-",$socialtype);
$smmhouse= new bulkandcheapapi();
if($socialsp[1]==125){
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'quantity'=>$count,'username'=>$extdata));
return $order_id;
}else if($socialsp[1]==385){
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'comments'=>$ccomments));
return $order_id;
}
else{
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'quantity'=>$count));
return $order_id;
}
return 0;
}

function addskypebot($socialprovider,$socialtype,$url,$count){
require_once("skypebot.class.php");
$socialsp=explode("-",$socialtype);
$smmhouse= new skypebot();
$order_id=$smmhouse->addorder($socialsp[1],$url,$count);
return $order_id;
return 0;
}


function addfastestpanel($socialprovider,$socialtype,$url,$count){
require_once("fastestpanel.class.php");	
$socialsp=explode("-",$socialtype);
$smmhouse= new fastestpanelapi();
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'quantity'=>$count));
return json_decode($order_id,true);
return 0;
}

function addroyalmedia($socialprovider,$socialtype,$url,$count){
require_once("royalmedia.class.php");	
$socialsp=explode("-",$socialtype);
$smmhouse= new royalmediaapi();
$order_id=$smmhouse->order(array('service'=>$socialsp[1],'link'=>$url,'quantity'=>$count));
return $order_id;
return 0;
}

function addstopsocialpanel($socialprovider,$socialtype,$url,$count){
require_once("stopsocial.class.php");	
$socialsp=explode("-",$socialtype);
$smmhouse= new stopsocials();
$order_id=$smmhouse->order($url,$socialsp[1], $count);
return json_decode($order_id,true);
return 0;
}


function addsmartseo($socialprovider,$socialtype,$url,$count){
require_once("smartseo.class.php");
$obj=new smartseo();
switch($socialprovider){
case "Facebook":
return $res=$obj->add_order("fb",$url,$count);
break;

case "Twitter":
return $res=$obj->add_order("tw",$url,$count);
break;

case "Instagram":
return $res=$obj->add_order("ig",$url,$count);
break;

case "Soundcloud":
return $res=$obj->add_order("sc",$url,$count);
break;

case "Vine":
return $res=$obj->add_order("v",$url,$count);

break;

case "Youtube":
return $res=$obj->add_order("yt",$url,$count);

break;

default:
$order_id=0;
break;
}
return $order_id;
}


function addatozsocials($socialprovider,$socialtype,$url,$count){
require_once("atozsocials.class.php");	
switch($socialprovider){
case "Instagram":
switch($socialtype){
case "Follower":
$type="1";
$Followgramnet = new atozsocials();
$order_id = $Followgramnet->order($url,$type,$count);
break;
case "Like":
$type="2";
$Followgramnet = new atozsocials();
$order_id = $Followgramnet->order($url,$type,$count);
break;	
case "Comment":
$type="3";
$Followgramnet = new atozsocials();
$order_id = $Followgramnet->order($url,$type,$count);
break;	
default:
$order_id=0;
break;
}
break;
case "Vine":
switch($socialtype){
case "Follower":
$type="24";
$Followgramnet = new atozsocials();
$order_id = $Followgramnet->order($url,$type,$count);
break;	
case "Like":
$type="31";
$Followgramnet = new atozsocials();
$order_id = $Followgramnet->order($url,$type,$count);
break;
case "Comment":
$type="33";
$Followgramnet = new atozsocials();
$order_id = $Followgramnet->order($url,$type,$count);
break;
case "Revines":
$type="32";
$Followgramnet = new atozsocials();
$order_id = $Followgramnet->order($url,$type,$count);
break;
default:
$order_id=0;
break;
}
default:
$order_id=0;
break;
}
return $order_id;
}


function addpanelhq($socialprovider,$socialtype,$url,$count){
require_once("panelhq.class.php");
switch($socialprovider){
case "Twitter":
switch($socialtype){
case "Follower":
$type="6";
$smmhouse=new panelhq_twitter_api();
$order_id=$smmhouse->place_order($url,$type,$count);
break;
case "Retweet":
$type="7";
$smmhouse = new panelhq_twitter_api();
$order_id=$smmhouse->place_order($url,$type,$count);
break;
case "Favorite":
$type="8";
$smmhouse = new panelhq_twitter_api();
$order_id = $smmhouse->place_order($url,$type,$count);
break;
default:
$order_id=0;
break;
}
break;
default:
$order_id=0;
break;
}
return $order_id;
}


function getpanelhqdetails($orderid){
require_once("panelhq.class.php");
$obj=new panelhq_twitter_api();
$res=json_decode($obj->fetch_details($orderid),true);
}








function getdetailssmmhouse($socialprovider,$socialtype,$orderid){
require_once("smmhouse.php");
switch($socialprovider){
case "Facebook":
$smmhouse = new facebook();
$order_id =$smmhouse->GetOrder($orderid);
break;
case "Twitter":
$smmhouse = new twitter();
$order_id =$smmhouse->GetOrder($orderid);
break;
case "Instagram":
$smmhouse= new instagram();
$order_id =$smmhouse->GetOrder($orderid);
break;
case "Soundcloud":
$smmhouse = new soundcloud();
$order_id =$smmhouse->GetOrder($orderid);
break;	
case "Vine":
$smmhouse = new vine();
$order_id =$smmhouse->GetOrder($orderid);
break;	
case "Youtube":
$smmhouse = new youtube();
$order_id =$smmhouse->GetOrder($orderid);
break;	
default:
$order_id=0;
break;
}
return $order_id;
}

function getfolloworderdetails($orderid){
require_once("follow.api.class.php");	
$obj=new followapi();
$res=$obj->get_status($orderid);
if($res['orderstatus'][$orderid]['status']=="error"){
return array($res['orderstatus'][$orderid]['status'],$res['orderstatus'][$orderid]['error']['message']);	
}else{
return array($res['orderstatus'][$orderid]['status'],$res['orderstatus'][$orderid]['order']['counter']['start'],$res['orderstatus'][$orderid]['order']['counter']['current']);
}
}

function getatozsocialsdetails($orderid){
require_once("atozsocials.class.php");	
$obj=new atozsocials();
return $res=$obj->status($orderid);
}


function refundorder($id){
global $dbh;	
$sql=$dbh->prepare("select * from smme_users_order where id=?");
$sql->execute(array($id));	
$res=$sql->fetch();
$sql=$dbh->prepare("select balance from smme_users_wallet where smmeid=?");
$sql->execute(array($res['smmeid']));
//print_r($sql->errorInfo());
$profiled=$sql->fetch();
$previousamount=$profiled['balance'];
$newbalance=$previousamount+$res['price'];
$sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`,`usernoti`) values(?,?,?,?,?,?,?,?)");
$sql->execute(array($res['smmeid'],$previousamount,$res['price'],$newbalance,'+',$_SERVER['REMOTE_ADDR'],$id,1));
//print_r($sql->errorInfo());
$refundtxno=$dbh->lastInsertId();
$sql=$dbh->prepare("update smme_users_order set rtxno=?,status=? where id=?");
$sql->execute(array($refundtxno,5,$id));	
//print_r($sql->errorInfo());
$sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
$sql->execute(array($newbalance,$res['smmeid']));
//print_r($sql->errorInfo());
}


function pleaceorder(){
global $dbh;
$sql=$dbh->prepare("select a.id as userorderid,a.servicetype as userordertype,a.status as userorderstatus, a.service as userserviceprovider,a.count as userordercount,b.url,b.extdata,b.icomments,b.startcount,b.finishcount, c.service as apitype,g.display,g.api,e.provider as mainprovider,f.apiname from smme_users_order a,smme_users_order_urls b,smme_admin_services_list c, smme_users_order_status d,smme_admin_serviceprovider e,smme_admin_api f,smme_admin_services g where a.id=b.orderid and a.smmeid=b.smmeid and a.servicetype=g.id and g.service=c.id and a.service=e.id and a.status = d.id and f.id=g.api AND d.status!='Processing' AND d.status!='Proceed' AND d.status!='Completed' AND d.status!='Refunded' AND d.status!='Error'");
$sql->execute();
$res=$sql->fetchAll();
foreach($res as $neworders){
if($neworders['apiname']=='Followgram'){
$apiorderid=$this->addfollowgram($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata']);
$siteorderid=$neworders['userorderid'];
$apistatus=$apiorderid['orderadd'][0]['status'];
if($apistatus!="error"){
$orderid=$apiorderid['orderadd'][0]['id'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
$getorderstatus=$this->getfolloworderdetails($orderid);
if(count($getorderstatus)==3){
if($getorderstatus[1]!=0){	
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($getorderstatus[1],$getorderstatus[2],$siteorderid));
}
}else{
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderstart,$apicurrent,$siteorderid));	
	}
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apistatus=$apiorderid['orderadd'][0]['error']['message'],$siteorderid));
$this->refundorder($siteorderid);	
}
}



else if($neworders['apiname']=='Smmhouse'){	
$apiorderid=$this->addsmmhouse($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$orderid=$apiorderid->id;
$ordererror=$apiorderid->error;
if($ordererror==""){
$array=$this->getdetailssmmhouse($neworders['mainprovider'],$neworders['apitype'],$orderid);	
$array = json_decode(json_encode($array), true);
$apiorderid=$array['id'];
$apiorderstart=$array['start'];
$apicurrent=$array['now'];
if($apicurrent==""){
$apicurrent=$apiorderstart;
}
if($array['status']=="Pending"){
$siteorderstatus=1;
$apicurrent=$apiorderstart;
}
else if($array['status']=="Progress"){
$siteorderstatus=2;
$apicurrent=$apiorderstart;
}
if($array['status']=="Done"){
$siteorderstatus=4;
$apicurrent=$apiorderstart+$neworders['userordercount'];
}
else if($array['status']=="Failed"){
$siteorderstatus=6;
$apicurrent=$apiorderstart;
}
if($array['status']!=="Failed"){
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($apiorderid,$apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$apicurrent,$siteorderid));
}else {
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apierror,$siteorderid));
$this->refundorder($siteorderid);
}
}
else {
if($ordererror=="Duplicate"){
}if($ordererror=="Insufficient funds"){
}
else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$sql=$dbh->prepare("update smme_users_order set apipo=? where id=?");
$sql->execute(array($apipo,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($ordererror,$siteorderid));	
$this->refundorder($siteorderid);
}
}
}
else if($neworders['apiname']=='Smartseo'){	
$apiorderid=$this->addsmartseo($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
if(is_array($apiorderid)){
$orderid=$apiorderid[0];
}else{
$orderid=$neworders['userorderid'];	
}
$startcount=$apiorderid['1'];
$ordererror=$apiorderid['3'];
$this->updateorder($siteorderid,$orderid,$startcount,$ordererror,$neworders['apiname']);
}
else if($neworders['apiname']=='Cheapsocials'){
$apiorderid=$this->addcheapsocials($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid['order'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}

else if($neworders['apiname']=='automagram'){
$apiorderid=$this->addautomagram($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$apistatus=2;
if(array_key_exists('Result', $apiorderid)) {
$orderid=$apiorderid['Result'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['Message'],$siteorderid));
$this->refundorder($siteorderid);	
}
}

else if($neworders['apiname']=='sharehoot'){
$apiorderid=$this->addsharehoot($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$apistatus=2;
if(array_key_exists('order_id', $apiorderid)) {
$orderid=$apiorderid['order_id'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}




else if($neworders['apiname']=='Fastestpanel'){
$apiorderid=$this->addfastestpanel($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid['order'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));

$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}
else if($neworders['apiname']=='Stopsocialpanel'){
$apiorderid=$this->addstopsocialpanel($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=trim(str_replace("Order Id :","",$apiorderid['sucess']));
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}
else if($neworders['apiname']=='Autosmo'){
$apiorderid=$this->addautosmo($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid['order'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));

$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}

else if($neworders['apiname']=='smmlite'){
$apiorderid=$this->addsmmlite($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid['order'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}

}




else if($neworders['apiname']=='paneloji'){
$apiorderid=$this->addpaneloji($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
//var_dump ($apiorderid);
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid->order;
//var_dump ($orderid);
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}

}


else if($neworders['apiname']=='prm4u'){
$apiorderid=$this->addprm4u($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
//var_dump ($apiorderid);
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid->order;
//var_dump ($orderid);
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}

}




else if($neworders['apiname']=='perfectsmm'){
$apiorderid=$this->addperfectsmm($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
//var_dump ($apiorderid);
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid->order;
//var_dump ($orderid);
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}

}


else if($neworders['apiname']=='apiseller'){
$apiorderid=$this->addapiseller($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
//var_dump ($apiorderid);
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid->order;
//var_dump ($orderid);
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}

}




else if($neworders['apiname']=='powerlikesprovider'){
$apiorderid=$this->addpowerlikesprovider($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
//var_dump ($apiorderid);
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid->order;
//var_dump ($orderid);
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}

}


else if($neworders['apiname']=='bulkmedya'){
$apiorderid=$this->addbulkmedya($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
//var_dump ($apiorderid);
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid->order;
//var_dump ($orderid);
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}

}


else if($neworders['apiname']=='Bulkandcheap'){
$apiorderid=$this->addbulkandcheap($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount'],$neworders['extdata'],$neworders['icomments']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid['order'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));

$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}

else if($neworders['apiname']=='Skypebot'){
$apiorderid=$this->addskypebot($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(is_array($apiorderid)) {
$orderid=$apiorderid['orderid'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array("",$siteorderid));
$this->refundorder($siteorderid);	
}
}


else if($neworders['apiname']=='atozsocials'){
$apiorderid=$this->addatozsocials($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
if(!array_key_exists('error',$apiorderid)) {
$orderid=$apiorderid['id'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
$getorderstatus=$this->getatozsocialsdetails($orderid);
if($getorderstatus['status']!=4){	
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($getorderstatus['start_count'],$getorderstatus['start_count'],$siteorderid));
}else {
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=6;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array("canceled",$siteorderid));
$this->refundorder($siteorderid);	
}
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=6;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);
}
}
else if($neworders['apiname']=='panelhq'){
$apiorderid=$this->addpanelhq($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
if($apiorderid[0]=="success"){
$orderid=$apiorderid[1];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
$getorderstatus=$this->getpanelhqdetails($orderid);
if($getorderstatus['status']!="error"){	
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($getorderstatus['start_count'],$getorderstatus['end_count'],$siteorderid));
}else {
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=6;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array("canceled",$siteorderid));
$this->refundorder($siteorderid);	
}
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=6;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}
else if($neworders['apiname']=='uksmm'){
$apiorderid=$this->adduksmm($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(!array_key_exists('error', $apiorderid)) {
$orderid=$apiorderid['order'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['error'],$siteorderid));
$this->refundorder($siteorderid);	
}
}
else if($neworders['apiname']=='royalmediaapi'){
$apiorderid=$this->addroyalmedia($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']),$neworders['userordercount']);
$siteorderid=$neworders['userorderid'];
$apistatus=1;
if(array_key_exists('orderid', $apiorderid)) {
$orderid=$apiorderid['orderid'];
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apiorderid=?,apipo=?,status=? where id=?");
$sql->execute(array($orderid,$apipo,$siteorderstatus,$siteorderid));
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
$siteorderstatus=2;
$sql=$dbh->prepare("update smme_users_order set apipo=?,status=? where id=?");
$sql->execute(array($apipo,$siteorderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($apiorderid['message'],$siteorderid));
$this->refundorder($siteorderid);	
}
}


}
}
}

$obj=new autoadd();
$obj->pleaceorder();
?>