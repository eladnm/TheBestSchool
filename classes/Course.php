<?php
require_once 'conn.php';
class Course {
public $id;
public $name;
public $descr;
public $image;
	public static function find_all() {
		global $database;
		return self::find_by_sql("SELECT * FROM courses");
  }
  public static function find_by_id($id=0) {
  	global $database;
    $result_array = self::find_by_sql("SELECT * FROM courses WHERE id={$id} LIMIT 1");
    	return !empty($result_array) ? array_shift($result_array) : false;
  }
    public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }
    public function full_details() {
    if(isset($this->id) && isset($this->name)&& isset($this->descr)&& isset($this->image)) {
      return  " id: " . $this->id . " name: " . $this->name . " descr: " . $this->descr . " image: " . $this->image;
    } else {
      return "";
    }
  }
  	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
    //$object->id 				= $record['id'];
    //$object->name 				= $record['name'];
    //$object->phone 				= $record['phone'];
    //$object->email 				= $record['email'];
    //$object->role 				= $record['role'];
    //return $object;
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // get_object_vars returns an associative array with all attributes 
	  // (incl. private ones!) as the keys and their current values as the value
	  $object_vars = get_object_vars($this);
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $object_vars);
	}

}
