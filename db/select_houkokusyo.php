<?php
require_once(dirname(__FILE__).'/db_connecter.php');
require_once(dirname(__FILE__).'/../data/data_houkokusyo.php');
class SelectHoukokusyo {
	
	public function select_houkokusyo_id($id) {
		$table = 'houkokusyo';
		$db = new DBconnecter();
		$pdo = $db->dbConnect();
		$sql = 'SELECT * FROM ' . $table . ' where id = ' . $id;
		$stmt = $pdo->query($sql);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$pdo = null;
		return $result;
	}
	
	public function getHoukokusyoList($hasharr) {
		$table = 'houkokusyo';
		$db = new DBconnecter();
		$pdo = $db -> dbConnect();
		$sql = 'SELECT * FROM ' . $table;
		if (count($hasharr)>0) {
			$sql = $sql . ' where ';
		}
		$cnt = 0;
		foreach($hasharr as $column => $value) {
			if ($cnt > 0) {
				$sql = $sql . ' and ';
			}
			$sql = $sql . $column .'=\'' . $value .'\'';
			$cnt += 1;
		}
		$stmt = $pdo->query($sql);
		$dataarr = null;
		while ($result = $stmt -> fetch(PDO::FETCH_ASSOC)) {
			$data = new DataHoukokusyo();
			$data -> setArrayData($result);
			$dataarr[] = $data;
		}
		$pdo = null;
		$data = new DataHoukokusyo();
		$data -> setArrayData($result);
		
		return $dataarr;
	}
}
?>
