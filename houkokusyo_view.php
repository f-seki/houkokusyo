<?php
require_once(dirname(__FILE__) . '/houkokusyo_util.php');
require_once(HOME_DIR.'db/select_houkokusyo.php');
require_once(HOME_DIR.'data/data_houkokusyo.php');
/* テスト用サンプル機能 */
$output_type = isset($_POST['output_type']) ? $_POST['output_type'] : null;
if($output_type=="excel"){
	require_once(HOME_DIR.'output/create_houkokusyo_excel.php');
}elseif($output_type=="excelpdf"){
	require_once(HOME_DIR.'output/create_houkokusyo_phpexcel_pdf.php');
}elseif($output_type=="pdf"){
	require_once(HOME_DIR.'output/create_houkokusyo_pdf.php');
}else{
	require_once(HOME_DIR.'output/create_houkokusyo_pdf.php');
}
/* */
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
		
		<form method = "POST" action = "./houkokusyo_view.php">

			<h2>【抽出条件】</h2>
			<div class="ui-grid-c">
				<div class="ui-block-a">
					▼ID
					<input type="text" name="id" value="<?php echo htmlspecialchars($id) ?>">
				</div>
				<div class="ui-block-b">
					▼作業担当者名
					<input type="text" name="worker_name" value="<?php echo htmlspecialchars($worker_name) ?>">
				</div>
				<div class="ui-block-c">
					▼ご依頼者名
					<input type="text" name="client_name" value="<?php echo htmlspecialchars($client_name) ?>">
				</div>
				<div class="ui-block-d">
					▼部局・室名
					<input type="text" name="bukyoku_name" value="<?php echo htmlspecialchars($bukyoku_name) ?>">
				</div>
			</div>
			<input type="submit" value="抽出" data-icon="search">
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
						   . '<td><input type="button" onclick="location.href=\'input_houkokusyo.php?id=' . $data->getId() . '\'" value="編集" data-icon="edit" data-iconpos="right"/></td>'
						   . "</td></tr>\n";
						}
					}
				?>
				
			</table>
		<!--テスト用サンプル機能-->
			<div data-role="fieldcontain">
				<fieldset data-role="controlgroup" data-type="horizontal">
					<legend>【出力形式】</legend>
					<label for="output_excel">Excel</label>
					<input type="radio" name="output_type" id="output_excel" value="excel" <?php if($output_type=="excel") echo 'checked="checked"';?>>
					<label for="output_excelpdf">Excel->PDF</label>
					<input type="radio" name="output_type" id="output_excelpdf" value="excelpdf" <?php if($output_type=="excelpdf") echo 'checked="checked"';?>>
					<label for="output_pdf">PDF</label>
					<input type="radio" name="output_type" id="output_pdf" value="pdf" <?php if($output_type=="pdf") echo 'checked="checked"';?>>
				</fieldset>
			</div>
		<!--ここまで-->	
			<input type="submit" value="作業報告書出力" data-icon="action" data-iconpos="right">
			<input type="button" onclick="location.href='input_houkokusyo.php'" value="新規作成" data-icon="edit" data-iconpos="right">
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