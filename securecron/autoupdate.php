<?php include("config/smmeconfig.php");
class autoupdate{
function getfolloworderdetails($orderid){
require_once("follow.api.class.php");	
$obj=new followapi();
$res=$obj->get_status($orderid);
if($res['orderstatus'][$orderid]['status']=="error"){
return array($res['orderstatus'][$orderid]['status'],$res['orderstatus'][$orderid]['error']['message']);	
}else{
return array($res['orderstatus'][$orderid]['status'],$res['orderstatus'][$orderid]['order']['counter']['start'],$res['orderstatus'][$orderid]['order']['counter']['current'],$res['orderstatus'][$orderid]['order']['status']);
}
}

function getsharehootdetails($orderid){
require_once("sharehoot.class.php");	
$obj=new ShareHOOTstatusApi();
$res=(array)$obj->getorderstatus($orderid);
return $res;
}

function getsmmlitedetails($orderid){
require_once("smmlite.class.php");		
$obj=new smmliteapi();
$res=(array)$obj->status($orderid);
return $res;
}



function getpanelojidetails($orderid){
require_once("paneloji.class.php");		
$obj=new panelojiapi();
$res=(array)$obj->status($orderid);
return $res;
}

function getprm4udetails($orderid){
require_once("prm4u.class.php");		
$obj=new panelojiapi();
$res=(array)$obj->status($orderid);
return $res;
}



function getapisellerdetails($orderid){
require_once("apiseller.class.php");		
$obj=new apisellerapi();
$res=(array)$obj->status($orderid);
return $res;
}

function getpowerlikesproviderdetails($orderid){
require_once("powerlikesprovider.class.php");		
$obj=new powerlikesproviderapi();
$res=(array)$obj->status($orderid);
return $res;
}

function getbulkmedyadetails($orderid){
require_once("bulkmedya.class.php");
$obj=new bulkmedyaapi();
$res=(array)$obj->status($orderid);
return $res;
}

function getperfectsmmdetails($orderid){
require_once("perfectsmm.class.php");		
$obj=new perfectsmmapi();
$res=(array)$obj->status($orderid);
return $res;
}

function getcheapsocialsdetails($orderid){
require_once("cheapsocials.class.php");	
$obj=new cheapsocials();
$res=(array)$obj->get_status($orderid);
return $res;
}

function getskypebotdetails($orderid){
require_once("skypebot.class.php");	
$obj=new skypebot();
$res=$obj->getstatus($orderid);
return $res;
}



function getautomagramdetails($orderid){
require_once("automagram.class.php");	
$obj=new automagram();
$res=$obj->getstatus($orderid);
return $res;
}

function getroyalmediadetails($orderid){
require_once("royalmedia.class.php");	
$obj=new royalmediaapi();
$res=$obj->status($orderid);
return $res;	
	
	}

function getuksmmdetails($orderid){
require_once("uksmm.class.php");	
$obj=new uksmm();
$res=(array)$obj->status($orderid);
return $res;
}

function getfastestpaneldetails($orderid){
require_once("fastestpanel.class.php");		
$obj=new fastestpanelapi();
$res=(array)$obj->status($orderid);
return $res;
}

function getstopsocialpaneldetails($orderid){
require_once("stopsocial.class.php");		
$obj=new stopsocials();
$res=json_decode($obj->status($orderid),true);
return $res;
}

function getstopsocialpanelstartcountdetails($orderid){
require_once("stopsocial.class.php");		
$obj=new stopsocials();
$res=json_decode($obj->start($orderid),true);
return $res;
}


function getautosmodetails($orderid){
require_once("autosmo.class.php");		
$obj=new autosmoapi();
$res=(array)$obj->status($orderid);
return $res;
}

function getbulkandcheapdetails($orderid){
require_once("bulkandcheap.class.php");		
$obj=new bulkandcheapapi();
$res=(array)$obj->status($orderid);
return $res;
}


function addsmmhouse($socialprovider,$socialtype,$orderid){
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

function getatozsocialsdetails($orderid){
require_once("atozsocials.class.php");	
$obj=new atozsocials();
return $res=$obj->status($orderid);
}


function getpanelhqdetails($orderid){
require_once("panelhq.class.php");
$obj=new panelhq_twitter_api();
return json_decode($obj->fetch_details($orderid),true);
}


function refundorder($id){
global $dbh;	
$sql=$dbh->prepare("select * from smme_users_order where id=?");
$sql->execute(array($id));	
$res=$sql->fetch();

$sql=$dbh->prepare("select balance from smme_users_wallet where smmeid=?");
$sql->execute(array($res['smmeid']));
$profiled=$sql->fetch();
$previousamount=$profiled['balance'];
$newbalance=$previousamount+$res['price'];

$sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`,`usernoti`) values(?,?,?,?,?,?,?,?)");
$sql->execute(array($res['smmeid'],$previousamount,$res['price'],$newbalance,'+',$_SERVER['REMOTE_ADDR'],$id,1));
$refundtxno=$dbh->lastInsertId();
$sql=$dbh->prepare("update smme_users_order set rtxno=?,status=? where id=?");
$sql->execute(array($refundtxno,5,$id));


	
$sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
$sql->execute(array($newbalance,$res['smmeid']));
}


function pleaceorder(){
global $dbh;
$sql=$dbh->prepare("select a.id as userorderid,a.servicetype as userordertype,a.apiorderid,a.status as userorderstatus,
a.service as userserviceprovider,a.count as userordercount,b.url,b.startcount,b.finishcount, c.service as apitype,
g.api,e.provider as mainprovider,f.apiname from smme_users_order a,smme_users_order_urls b,smme_admin_services_list c,
smme_users_order_status d,smme_admin_serviceprovider e,smme_admin_api f,
smme_admin_services g where a.id=b.orderid and a.smmeid=b.smmeid and a.servicetype=g.id and g.service=c.id and a.service=e.id
and a.status = d.id and f.id=g.api AND a.apiorderid!='-0' and a.apipo!=0 and d.status!='Pending' AND d.status!='Completed' AND d.status!='Refunded' AND d.status!='Error'");
$sql->execute();
$res=$sql->fetchAll();
foreach($res as $neworders){
if($neworders['apiname']=='Followgram'){
$getorderstatus=$this->getfolloworderdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if($getorderstatus[0]=="error"){
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus[1],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus[3]=="complete"){
$finishcount=$neworders['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}else{
$finishcount=$getorderstatus[2];		
$orderstatus=2;
}
if($getorderstatus[1]==0){
$apiorderstart=$neworders['startcount'];
}else{
$apiorderstart=$getorderstatus[1];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}else if($neworders['apiname']=='Smmhouse'){	
$apiorderid=$this->addsmmhouse($neworders['mainprovider'],$neworders['apitype'],$neworders['apiorderid']);	
$array = json_decode(json_encode($apiorderid), true);
$siteorderid=$neworders['userorderid'];
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
else if($neworders['apiname']=='Cheapsocials'){
$getorderstatus=$this->getcheapsocialsdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Completed" || $getorderstatus['status']=="Partial"){
$apiorderstart=$getorderstatus['start_count'];    
$finishcount=$getorderstatus['start_count']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled" || $getorderstatus['status']=="Refunded"){
$apiorderstart=$getorderstatus['start_count'];    
$finishcount=$getorderstatus['start_count']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=5;
$this->refundorder($siteorderid);
}
else{
$apiorderstart=$getorderstatus['start_count'];    
$finishcount=$getorderstatus['start_count']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}

else if($neworders['apiname']=='automagram'){
$getorderstatus=$this->getautomagramdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(!array_key_exists('Result',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$erstatus=$getorderstatus['Result'];
$errstatus=explode(";",$erstatus);
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($errstatus[0]=="Complete"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}else{
$finishcount=$errstatus[2];		
$orderstatus=2;
}
if($errstatus[0]=="Pending" || $errstatus[0]=="Running" || $errstatus[0]=="NeedReview"){
$apiorderstart=$errstatus[1];
}else{
$apiorderstart=$errstatus[1];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}





else if($neworders['apiname']=='uksmm'){
$getorderstatus=$this->getuksmmdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}

else if($neworders['apiname']=='Fastestpanel'){
$getorderstatus=$this->getfastestpaneldetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}
if($neworders['apiname']=='Stopsocialpanel'){
$getorderstatus=$this->getstopsocialpaneldetails($neworders['apiorderid']);
$getorderstartcount=$this->getstopsocialpanelstartcountdetails($neworders['apiorderid']);
$startcount=$getorderstartcount['startcount'];
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Completed"){
$apiorderstart=$startcount;	
$finishcount=$startcount+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Decline"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=2;
$apiorderstart=$startcount;
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}
else if($neworders['apiname']=='Autosmo'){
$getorderstatus=$this->getautosmodetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}



else if($neworders['apiname']=='Bulkandcheap'){
$getorderstatus=$this->getbulkandcheapdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}

else if($neworders['apiname']=='Skypebot'){
$getorderstatus=$this->getskypebotdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(is_array($getorderstatus)) {
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="done"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="refunded" || $getorderstatus['status']=="invalid" || $getorderstatus['status']=="canceled" || $getorderstatus['status']=="not found" || $getorderstatus['status']=="deleted manually"){
$this->refundorder($siteorderid);
$finishcount=0;
$orderstatus=5;
}
else if($getorderstatus['status']=="checking" || $getorderstatus['status']=="in progress"){
$apiorderstart=$getorderstatus['startcount'];
$finishcount=0;
$orderstatus=2;
}
$apiorderstart=$getorderstatus['startcount'];
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}

else if($neworders['apiname']=='smmlite'){
$getorderstatus=$this->getsmmlitedetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}



else if($neworders['apiname']=='paneloji'){
$getorderstatus=$this->getpanelojidetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}



else if($neworders['apiname']=='prm4u'){
$getorderstatus=$this->getprm4udetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}



else if($neworders['apiname']=='apiseller'){
$getorderstatus=$this->getapisellerdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}



else if($neworders['apiname']=='powerlikesprovider'){
$getorderstatus=$this->getpowerlikesproviderdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}



else if($neworders['apiname']=='bulkmedya'){
$getorderstatus=$this->getbulkmedyadetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}



else if($neworders['apiname']=='perfectsmm'){
$getorderstatus=$this->getperfectsmmdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('error',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="Partial" || $getorderstatus['status']=="Completed"){
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['status']=="Canceled"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
else{
$finishcount=$getorderstatus['startcount']+$neworders['userordercount'];		
$finishcount=$finishcount-$getorderstatus['remains'];		
$orderstatus=2;
}
if($getorderstatus['status']=="Pending" || $getorderstatus['status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}



else if($neworders['apiname']=='royalmediaapi'){
$getorderstatus=$this->getroyalmediadetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if(array_key_exists('message',$getorderstatus)) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['order_status']=="Partial" || $getorderstatus['order_status']=="Completed"){
$finishcount=$getorderstatus['start_count']+$neworders['userordercount'];		
$orderstatus=4;
}
else if($getorderstatus['order_status']=="Refunded"){
$this->refundorder($siteorderid);
$apiorderstart=0;
$finishcount=0;
$orderstatus=5;
}
if($getorderstatus['order_status']=="Pending" || $getorderstatus['order_status']=="Processing"){
$apiorderstart=$getorderstatus['start_count'];
$finishcount=$getorderstatus['start_count'];
}else{
$apiorderstart=$getorderstatus['start_count'];
$finishcount=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}

}


else if($neworders['apiname']=='atozsocials'){
$getorderstatus=$this->getatozsocialdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if($getorderstatus['status']==4) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="2" || $getorderstatus['status']=="3"){
$finishcount=$neworders['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}else{
$finishcount=$getorderstatus['start_count'];		
$orderstatus=2;
}
if($getorderstatus['start_count']==0){
$apiorderstart=$neworders['startcount'];
}else{
$apiorderstart=$getorderstatus[1];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}
else if($neworders['apiname']=='panelhq'){
$getorderstatus=$this->getpanelhqdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if($getorderstatus['status']=="error") {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['status'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']=="complete" || $getorderstatus['status']=="partial"){
$finishcount=$neworders['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}else{
$finishcount=$getorderstatus['end_count'];		
$orderstatus=2;
}
if($getorderstatus['start_count']==0){
$apiorderstart=$neworders['startcount'];
}else{
$apiorderstart=$getorderstatus['start_count'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}

else if($neworders['apiname']=='sharehoot'){
$getorderstatus=$this->getsharehootdetails($neworders['apiorderid']);
$siteorderid=$neworders['userorderid'];
if($getorderstatus['status']==6) {
$sql=$dbh->prepare("update smme_users_order_urls set refundreason=? where orderid=?");
$sql->execute(array($getorderstatus['error'],$siteorderid));
$this->refundorder($siteorderid);	
}else{
$sql=$dbh->prepare("select id from smme_admin_api where apiname=?");
$sql->execute(array($neworders['apiname']));
$spiprovider=$sql->fetch();
$apipo=$spiprovider['id'];
if($getorderstatus['status']==2){
$finishcount=$neworders['startcount']+$neworders['userordercount'];		
$orderstatus=4;
}else{
$finishcount=$getorderstatus['end_count'];		
$orderstatus=2;
}
if($getorderstatus['startcount']==0){
$apiorderstart=$neworders['startcount'];
}else{
$apiorderstart=$getorderstatus['startcount'];
}
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($orderstatus,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($apiorderstart,$finishcount,$siteorderid));	
}
}


}
}

function normalupdatefunction($service,$case,$url){
require_once("getservicecountapi.php");
switch($service){
case "Facebook":
switch ($case){
case "Followers":
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_followers($url);
break;
case "Page Likes":
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_fanpagelikes($url);
break;
case "Photo Likes":
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_photolikes($url);
break;
case "Group Join":
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_groupmember($url);
break;	
default:
$scounts=0;
break;
}
break;


case "Twitter":
switch($case){
case "Follower":
$Followgram=new twitter_without_api();
$scounts=$Followgram->get_twitter_followers($url);	
break;	
case "Retweet":
$Followgram=new twitter_without_api();
$scounts=$Followgram->get_twitter_retweets($url);	
break;
case "Favorite":
$Followgram=new twitter_without_api();
$scounts=$Followgram->get_twitter_favorites($url);	
break;	
default:
$scounts=0;	
break;
}
break;
case "Instagram":
switch($case){
case "Follower":	
$Followgramnet = new instagram_without_api();
$scounts=$Followgramnet->get_instagram_followers($url);
break;	
case "Like":
$Followgramnet = new instagram_without_api();
$scounts=$Followgramnet->get_instagram_likes($url);
break;
case "Comment":	
$Followgramnet = new instagram_without_api();
$scounts = $Followgramnet->get_instagram_comments($url);
break;
default:
$scounts=0;
break;
}
break;
case "Vine":
switch($case){
case "Follower":
$obj=new vine_without_api();	
$scounts=$obj->get_vine_followers($url);
break;
case "Like":
$obj=new vine_without_api();	
echo $scounts=$obj->get_vine_likes($url);
break;
case "Comment":
$obj=new vine_without_api();	
$scounts=$obj->get_vine_comments($url);
break;
case "Revine":
$obj=new vine_without_api();	
$scounts=$obj->get_vine_revines($url);
break;
default:
$scounts=0;
break;	
}
break;
case "Soundcloud":
switch($case){
case "Plays":	
$Followgramnet = new soundcloud_without_api();
$scounts=$Followgramnet->get_soundcloud_plays($url);
break;
case "Downloads":		
$Followgramnet = new soundcloud_without_api();
$scounts=$Followgramnet->get_soundcloud_downloads($url);
break;
case "Followers":	
$Followgramnet=new soundcloud_without_api();
$scounts=$Followgramnet->get_soundcloud_followers($url);
break;
default:
$scounts=0;
break;	
}
break;

case "Youtube":
switch($case){
case "View":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$patterns[5]='/youtube/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$replacements[5] = '';
$url=preg_replace($patterns, $replacements,$clean);  
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_views($url);
break;
case "Like":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$patterns[5]='/youtube/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$replacements[5] = '';
$url=preg_replace($patterns, $replacements,$clean);  
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_likes($url);
break;
case "Dislike":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$patterns[5]='/youtube/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$replacements[5] = '';
$url=preg_replace($patterns, $replacements,$clean);  
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_dislikes($url);
break;
case "Comment":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$patterns[5]='/youtube/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$replacements[5] = '';

$url=preg_replace($patterns, $replacements,$clean);  
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_comment($url);
break;
case "Subscriber":
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_subscribers($url);
break;
default:
$scounts=0;
break;
}
break;
default:
$scounts=0;
break;
}
if($scounts==""){
$scounts=0;
}
return $scounts;

}

function normalupdate(){
global $dbh;
$sql=$dbh->prepare("select a.id as userorderid,a.servicetype as userordertype,a.apiorderid,a.status as userorderstatus,
a.service as userserviceprovider,a.count as userordercount,b.url,b.startcount,b.finishcount, c.service as apitype,
g.api,e.provider as mainprovider,f.apiname from smme_users_order a,smme_users_order_urls b,smme_admin_services_list c,
smme_users_order_status d,smme_admin_serviceprovider e,smme_admin_api f,
smme_admin_services g where a.id=b.orderid and a.smmeid=b.smmeid and a.servicetype=g.id and g.service=c.id and a.service=e.id
and a.status = d.id and f.id=1 and a.apipo=0 and d.status!='Completed' AND d.status!='Refunded' AND d.status!='Error'");
$sql->execute();
$res=$sql->fetchAll();
foreach($res as $neworders){
$currentcount=$this->normalupdatefunction($neworders['mainprovider'],$neworders['apitype'],str_replace(' ','',$neworders['url']));	
$siteorderid=$neworders['userorderid'];
$startcount=$neworders['startcount'];
$ordercount=$neworders['userordercount'];
$maxreachcount=$startcount+$ordercount;
if($currentcount!=0){
if($maxreachcount<=$currentcount){
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array(4,$siteorderid));
$sql=$dbh->prepare("update smme_users_order_urls set finishcount=? where orderid=?");
$sql->execute(array($maxreachcount,$siteorderid));	
}else{
$sql=$dbh->prepare("update smme_users_order_urls set finishcount=? where orderid=?");
$sql->execute(array($currentcount,$siteorderid));		
}
}
}
}
}
$obj=new autoupdate();
$obj->pleaceorder();
$obj->normalupdate();
?>