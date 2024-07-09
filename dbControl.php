<?php


#echo preg_replace("/\[.+\]/","/\[`.+`\]/",$text);



class dataBase {
	public $DBP;
	
	//// get all data base
	public function fetch_data(){
		return json_decode(file_get_contents($this->DBP),1);
	}
	//// get key values
	/// can't key is null
	public function getData($key){
		$fetched      = $this->fetch_data();
		if(($RESPONSE = $fetched[$key])){
			return $RESPONSE;
			exit;
		}
	}
	
	public function setData($data){
		$RESPONSE      = false;
		if(is_array($data)){
			file_put_contents($this->DBP,json_encode($data));
			$RESPONSE      = true;
		}
		return $RESPONSE;
		exit;
	}
	
	//// when starting class
	//// $menu parameter be null or file name
	
	public function __construct($menu='center.json'){
		$this->DBP        = "database/";
		if(!is_dir($this->DBP)){
			mkdir($this->DBP);
		}
		if(!file_exists("{$this->DBP}{$menu}")){
			touch("{$this->DBP}{$menu}");
		}
		$this->DBP        .= $menu;
	}
}

/*
$db      = new database('rutf.json');
$keys   = $db->fetch_data();
$keys['jello'] = 9;
$db->setData($keys);
*/


?>