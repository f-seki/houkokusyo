<?php
require_once(dirname(__FILE__) . '/houkokusyo_util.php');
require_once(HOME_DIR.'db/select_houkokusyo.php');
require_once(HOME_DIR.'data/data_houkokusyo.php');
require_once(HOME_DIR.'output/create_houkokusyo_excel.php');
// require_once(HOME_DIR.'output/create_houkokusyo_phpexcel_pdf.php');
// require_once(HOME_DIR.'output/create_houkokusyo_pdf.php');

$id = isset($_POST['id']) ? $_POST['id'] : null;
$worker_name = isset($_POST['worker_name']) ? $_POST['worker_name'] : null;
$client_name = isset($_POST['client_name']) ? $_POST['client_name'] : null;
$bukyoku_name = isset($_POST['bukyoku_name']) ? $_POST['bukyoku_name'] : null;

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<!--1.CSSの読み込み-->
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<!--2.jQueryの読み込み-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<!--3.jQuery Mobileの読み込み-->
<script type="text/javascript" src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script>

<title>作業報告書一覧</title>
</head>
<body bgcolor="#ECF9F7">
<div id="input" data-role="page">
	<div data-role="header">
		<h1>作業報告書一覧</h1>
	</div>
	<div class="ui-content" role="main">
		<h2>【抽出条件】</h2>
		<form method = "POST" action = "./houkokusyo_view.php">
		<table border="1" bgcolor="#FFFFF7">
		<tr>
		<th>ID</th>
		<th>作業担当者名</th>
		<th>ご依頼者名</th>
		<th>部局・室名</th>
		</tr>
		<tr>
		<th><input type="text" name="id" value="<?php echo htmlspecialchars($id) ?>"></th>
		<th><input type="text" name="worker_name" value="<?php echo htmlspecialchars($worker_name) ?>"></th>
		<th><input type="text" name="client_name" value="<?php echo htmlspecialchars($client_name) ?>"></th>
		<th><input type="text" name="bukyoku_name" value="<?php echo htmlspecialchars($bukyoku_name) ?>"></th>
		</tr>
		</table>
		<input type="submit" value="抽出">
		</form>
		
		<form method = "POST" action = "./houkokusyo_view.php">
		<table border="1" bgcolor="#FFFFF7">
		<tr>
		<th>出力</th>
		<th>ID</th>
		<th>作業担当者名</th>
		<th>ご依頼者名</th>
		<th>部局・室名</th>
		<th>依頼内容</th>
		<th>依頼内容詳細</th>
		<th>変更</th>
		</tr>
		
		<?php
		$db = new SelectHoukokusyo();
		
		$hasharr = array();
		if(isset($id) and $id != '') $hasharr += array('id' => $id);
		if(isset($worker_name) and $worker_name != '') $hasharr += array('worker_name' => $worker_name);
		if(isset($client_name) and $client_name != '') $hasharr += array('client_name' => $client_name);
		if(isset($bukyoku_name) and $bukyoku_name != '') $hasharr += array('bukyoku_name' => $bukyoku_name);
			$dataarr = $db->getHoukokusyoList($hasharr);
			if(count($dataarr)>0) {
				foreach ($dataarr as $data) {
				  echo '<tr>'
				   . '<td><input type="checkbox" name="index[]" value="' . $data->getId() . '"></td>'
				   . '<td>' . $data->getId() . '</td>'
				   . '<td>' . $data->getWorkerName() . '</td>'
				   . '<td>' . $data->getClientName() . '</td>'
				   . '<td>' . $data->getBukyokuName() . '</td>'
				   . '<td>' . nl2br($data->getWorkSubject()) . '</td>'
				   . '<td>' . nl2br($data->getWorkDetail()) . '</td>'
				   . '<td><input type="button" onclick="location.href=\'input_houkokusyo.php?id=' . $data->getId() . '\'" value="編集" /></td>'
				   . "</td></tr>\n";
				}
			}
		?>
		
		</table>
		<input type="submit" value="作業報告書出力">
		<input type="button" onclick="location.href='input_houkokusyo.php'" value="新規作成" />
		</form>
		
		<?php
		/* エクセル出力 */
		if (@$_POST['index']) {
			$index =$_POST['index'];
			for ($i=0; $i < count($index); $i++) {
				$createReport = new CreateReport();
				$fileName = $createReport->getReport($index[$i]);
				echo '作業報告書ID' . $index[$i] . ' ' . '<a href="http://' . $_SERVER["SERVER_NAME"] . '/bukyoku/' . REPORT_SAVE_DIR . $fileName . '">' . $fileName . '</a><br>';
			}
			//	header("location: ./houkokusyo01.xlsx");
		}
		?>
	</div>
</div>
</body>
</html>