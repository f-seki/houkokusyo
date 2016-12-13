<?php

class DBconnecter {
	public $pdo;
	public function dbConnect() {
		$db = 'mysql:dbname=bukyoku;host=localhost;charset=utf8';
		$user = 'root';
		$password = '';
		try {
			$this->pdo = new PDO($db , $user ,$password, array(PDO::ATTR_EMULATE_PREPARES => false));
		} catch (PDOException $e) {
			 exit('データベース接続失敗。'.$e->getMessage());
		}
		return $this->pdo;
	}

	public function dbClose() {
		$this->pdo = null;
	/*
		$con = mysql_close($con);
		if (!$con) {
		  exit('データベースとの接続を閉じられませんでした。');
		}
	*/
	}
}
?>
