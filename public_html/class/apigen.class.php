<?php require_once("userprofile.class.php");
class apikey extends profile{
private static $_empty = array("00000000", "0000", "0000", "0000", "000000000000");
private static $_parseFormats = array(
"D" => "/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i",
"N" => "/^[a-f\d]{8}([a-f\d]{4}){4}[a-f\d]{8}$/i",
"B" => "/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i",
"P" => "/^(\()?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\))$/i",
"X" => "/^(\{0x)[a-f\d]{8}((,0x)[a-f\d]{4}){2}(,\{0x)[a-f\d]{2}((,0x)[a-f\d]{2}){7}(\}\})$/i"
);
public static function newapikey() {
$data = openssl_random_pseudo_bytes(32).rand();
$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
$data[8] = chr(ord($data[8]) & 0x3f | 0x80);
$parts = str_split(bin2hex($data), 4);
$guid = new apikey();
$guid->_parts = array(
$parts[0] . $parts[1],
$parts[2],
$parts[3],
$parts[4],
$parts[5] . $parts[6] . $parts[7]
);
return $guid;
}
public static function TryParse($asString, &$out_guid) {
$out_guid = NULL;
foreach (self::$_parseFormats as $format) {
if (1 == preg_match($format, $asString)) {
$clean = strtolower(str_replace(array("-", "{", "}", "(", ")", "0x", ","), "", $asString));
$out_guid = new Guid();
$out_guid->_parts = array(
substr($clean, 0, 8),
substr($clean, 8, 4),
substr($clean, 12, 4),
substr($clean, 16, 4),
substr($clean, 20, 12),
);
return true;
}
}
return false;
}
public static function Parse($asString) {
if (self::TryParse($asString, $out_guid)) {
return $out_guid;
}
throw new Exception("Invalid Guid: " . $asString);
}
private $_parts;
public function __construct() {
$this->_parts = self::$_empty;
}
private static function _comparer(Guid $guid1, Guid $guid2) {
return $guid1->_parts == $guid2->_parts;
}
public function Equals(ObjectBase $obj) {
return self::_comparer($this, $obj);
}
public function ToString($format = NULL) {
switch ($format) {
case "";
case "D";
return implode("-", $this->_parts);
case "N";
return implode("", $this->_parts);
case "B";
return "{" . implode("-", $this->_parts) . "}";
case "P";
return "(" . implode("-", $this->_parts) . ")";
case "X";
$tmp = array(
"0x" . $this->_parts[0],
"0x" . $this->_parts[1],
"0x" . $this->_parts[2],
"{0x" . implode(",0x", str_split($this->_parts[3] . $this->_parts[4], 2)) . "}"
);
return "{" . implode(",", $tmp) . "}";
default:
throw new \Exception("Invalid Guid format" . $format);
}
}
public function __toString() {
return $this->ToString("D");
}
function keycheck(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$userid=$profile['smmeid'];
$apikey=$this->newapikey();
$sql=$dbh->prepare("select * from smme_users_api where api=?");
$sql->execute(array($apikey));
if($sql->rowCount()==0){
return $apikey;	
}else {
$this->keycheck();	
}	
}

function createapi($securecode){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$userid=$profile['smmeid'];
if($this->getapidetails()==0){
$apikey=$this->keycheck();	
$sql=$dbh->prepare("insert into smme_users_api(`smmeid`,`secrecode`,`api`)values(?,?,?)");	
$sql->execute(array($userid,$securecode,$apikey));	
}
}
function regentapi(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$userid=$profile['smmeid'];
if($this->getapidetails()!=0){	
$apikey=$this->keycheck();	
$sql=$dbh->prepare("update smme_users_api set `api`=? where `smmeid`=?");	
$sql->execute(array($apikey,$userid));	
}
}

function updatesecurecode($securecode){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$userid=$profile['smmeid'];
if($this->getapidetails()!=0){
$sql=$dbh->prepare("update smme_users_api set `secrecode`=? where smmeid=?");	
$sql->execute(array($securecode,$userid));	
}
}


function getapidetails(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select * from smme_users_api where smmeid=?");
$sql->execute(array($userid));
if($sql->rowCount()==0){
return 0;	
}else {
return $sql->fetch();	
}
}
}