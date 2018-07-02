<?php
	namespace App;

	use App\sql as sql;

	class orm{
		private $concat;

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
			$table = str_replace("Model", "", end($parsing));

			$part = "SELECT $param FROM $table ";
			$this->concat = $part;
			return $this;
		}

		static function delete($table = null) {

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "DELETE FROM $table ";
			$this->concat = $part;
			return $this;
		}

		static function destroy($table = null) { // ALIAS OF delete function

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "DELETE FROM $table ";
			$this->concat = $part;
			return $this;
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

			$this->concat = $part;
			return $this;
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

			$this->concat = $part;
			return $this;
		}

		static function insert($param, $table = null) {

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "INSERT INTO $table VALUES ($param)";

			$this->concat = $part;
			return $this;
		}

		static function create($param, $table = null) { // ALIAS OF insert function

			if($table == null){
				$parsing = explode("\\", get_called_class());
				$table = str_replace("Model", "", end($parsing));
			}

			$part = "INSERT INTO $table VALUES ($param)";

			$this->concat = $part;
			return $this;
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

			$this->concat = $part;
			return $this;
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

			$this->concat = $part;
			return $this;
		}

		static function find($param = "*") { // ALIAS OF select function
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			$part = "SELECT $param FROM $table ";
			$this->concat .= $part;
			return $this;
		}

		static function read($param = "*") { // ALIAS OF select function
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			$part = "SELECT $param FROM $table ";
			$this->concat .= $part;
			return $this;
		}

		static function retrieve($param = "*") { // ALIAS OF select function
			$parsing = explode("\\", get_called_class());
			$table = str_replace("Model", "", end($parsing));

			$part = "SELECT $param FROM $table ";
			$this->concat .= $part;
			return $this;
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
			$this->concat .= $part;
			return $this;
		}

		static function like($param) {
			$part = "LIKE $param ";
			$this->concat .= $part;
			return $this;
		}

		static function between($param1, $param2) {
			$part = "BETWEEN $param1 AND $param2 ";
			$this->concat .= $part;
			return $this;
		}

		static function notBetween($param1, $param2) {
			$part = "NOT BETWEEN $param1 AND $param2 ";
			$this->concat .= $part;
			return $this;
		}

		static function andWhere($param) {
			$part = "AND $param ";
			$this->concat .= $part;
			return $this;
		}

		static function orWhere($param) {
			$part = "OR $param ";
			$this->concat .= $part;
			return $this;
		}

		static function limit($param) {
			$part = "LIMIT $param ";
			$this->concat .= $part;
			return $this;
		}

		static function groupBy($param) {
			$part = "GROUP BY $param ";
	    $this->concat .= $part;
			return $this;
		}

		static function orderBy($param, $order = "ASC") {
			$part = "ORDER BY $param $order ";
	    $this->concat .= $part;
			return $this;
		}

		static function exec() {
			$resultData = sql::request($this->concat);

			if($resultData == "00000")
				$resultData = true;

			$this->concat = "";
			return $resultData;
		}
	}
?>
