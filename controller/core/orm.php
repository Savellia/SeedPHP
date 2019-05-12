<?php
	namespace App;

	use App\sql as sql;

	class orm{
		static public $concat;

		function __construct() {
			$concat = "";
		}

		function __call($method,$arguments) {
			return "ERROR #ORM_01 :: Cette fonction n'existe pas !";
		}

		function __get($nom) {
			return "ERROR #ORM_02 :: Cette variable n'existe pas !";
		}

		static function findAll(){
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			return sql::request("SELECT * FROM ".$table);
		}

		static function getCount(){
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			return sql::request("SELECT count(*) as count FROM ".$table);
		}

		static function getAll(){ // ALIAS OF findAll function
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			return sql::request("SELECT * FROM ".$table);
		}

		static function select($param = "*") {
			$class = get_class();

			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model2", "", end($parsing));
			$part = "SELECT $param FROM $table ";

			self::$concat .= $part;
			return self::$concat;
		}

		static function delete($table = null) {

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "DELETE FROM $table ";
			self::$concat .= $part;
			return self::$concat;
		}

		static function destroy($table = null) { // ALIAS OF delete function

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "DELETE FROM $table ";
			self::$concat .= $part;
			return self::$concat;
		}

		static function update($array, $table = null) {

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "UPDATE $table SET ";
			$dataKey = "";
			$dataValue = "";

			foreach($array AS $key => $value){
				$dataKey = $dataKey.$key.",";
				$dataValue = $dataValue."'".$value."',";


				$part = $part.$key." = '".$value."', ";

			}
			$part = substr($part, 0, -2)." ";

			self::$concat .= $part;
			return self::$concat;
		}

		static function modify($array, $table = null) { // ALIAS OF update function

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "UPDATE $table SET ";
			$dataKey = "";
			$dataValue = "";

			foreach($array AS $key => $value){
				$dataKey = $dataKey.$key.",";
				$dataValue = $dataValue."'".$value."',";


				$part = $part.$key." = '".$value."', ";

			}
			$part = substr($part, 0, -2)." ";

			self::$concat .= $part;
			return self::$concat;
		}

		static function insert($param, $table = null) {

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "INSERT INTO $table VALUES ($param)";

			self::$concat .= $part;
			return self::$concat;
		}

		static function create($param, $table = null) { // ALIAS OF insert function

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "INSERT INTO $table VALUES ($param)";

			self::$concat .= $part;
			return self::$concat;
		}

		static function insertByColumn($array, $table = null) {

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "INSERT INTO $table ";
			$dataKey = "";
			$dataValue = "";

			foreach($array AS $key => $value){
				$dataKey = $dataKey.$key.",";
				$dataValue = $dataValue."'".$value."',";
			}
			$dataKey = substr($dataKey, 0, -1);
			$dataValue = substr($dataValue, 0, -1);

			$part = $part."($dataKey) VALUES ($dataValue)";

			self::$concat .= $part;
			return self::$concat;
		}

		static function createByColumn($array, $table = null) { // ALIAS OF insertByColumn function

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "INSERT INTO $table ";
			$dataKey = "";
			$dataValue = "";

			foreach($array AS $key => $value){
				$dataKey = $dataKey.$key.",";
				$dataValue = $dataValue."'".$value."',";
			}
			$dataKey = substr($dataKey, 0, -1);
			$dataValue = substr($dataValue, 0, -1);

			$part = $part."($dataKey) VALUES ($dataValue)";

			self::$concat .= $part;
			return self::$concat;
		}

		static function find($param = "*") { // ALIAS OF select function
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			$part = "SELECT $param FROM $table ";

			self::$concat .= $part;
			return self::$concat;
		}

		static function read($param = "*") { // ALIAS OF select function
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			$part = "SELECT $param FROM $table ";

			self::$concat .= $part;
			return self::$concat;
		}

		static function retrieve($param = "*") { // ALIAS OF select function
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			$part = "SELECT $param FROM $table ";

			self::$concat .= $part;
			return self::$concat;
		}

		/**function count($param = "*") {
			$part = "COUNT($param) ";
			$this->concat .= $part;
			return $this;
		}

		function avg($param = "*") {
			$part = "AVG($param) ";
			$this->concat .= $part;
			return $this;
		}

		function moy($param = "*") { // ALIAS OF avg function
			$part = "AVG($param) ";
			$this->concat .= $part;
			return $this;
		}

		function max($param = "*") {
			$part = "MAX($param) ";
			$this->concat .= $part;
			return $this;
		}

		function min($param = "*") {
			$part = "MIN($param) ";
			$this->concat .= $part;
			return $this;
		}

		function sum($param = "*") {
			$part = "SUM($param) ";
			$this->concat .= $part;
			return $this;
		}

		function from($table = null) {

			if($table == null)
				$table = get_called_class();

			$part = "FROM $table ";
			$this->concat .= $part;
			return $this;
		}**/

		static function where($param) {
			$part = "WHERE $param ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function like($param) {
			$part = "LIKE $param ";

			self::$concat .= $part;
			return self::$concat;
		}

		static function between($param1, $param2) {
			$part = "BETWEEN $param1 AND $param2 ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function notBetween($param1, $param2) {
			$part = "NOT BETWEEN $param1 AND $param2 ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function andWhere($param) {
			$part = "AND $param ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function orWhere($param) {
			$part = "OR $param ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function limit($param) {
			$part = "LIMIT $param ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function groupBy($param) {
			$part = "GROUP BY $param ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function orderBy($param, $order = "ASC") {
			$part = "ORDER BY $param $order ";
			
			self::$concat .= $part;
			return self::$concat;
		}

		static function exec() {

			echo self::$concat;
			$resultData = sql::request(self::$concat);

			if($resultData == "00000")
				$resultData = true;

			self::$concat = "";
			return $resultData;
		}
	}
?>
