?<?php
require_once (dirname(__FILE__) . '/houkokusyo_util.php');
require_once(HOME_DIR . 'db/select_houkokusyo.php');

$id="";
$create_date="";
$bukyoku_no="";
$keiri_no="";
$client_name="";
$bukyoku_name="";
$room_no="";
$tel_no="";
$work_start_date="";
$work_start_time="";
$work_end_date="";
$work_end_time="";
$work_hour="";
$support_flg="";
$worker_name="";
$sign_flg="";
$work_status="";
$work_subject="";
$work_wrap_up="";
$work_detail="";
$keep_hardware="";
$keep_software="";
$keep_other="";
$data_shift_flg="";

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$db = new SelectHoukokusyo();
	$hasharr = array('id' => $id);
	$dataarr = $db->getHoukokusyoList($hasharr);
	if(count($dataarr)>0) {
		foreach ($dataarr as $data) {
			$create_date=date('Y-m-d',$data->getCreateDate());
			$bukyoku_no=$data->getBukyokuNo();
			$keiri_no=$data->getKeiriNo();
			$client_name=$data->getClientName();
			$bukyoku_name=$data->getBukyokuName();
			$room_no=$data->getRoomNo();
			$tel_no=$data->getTelNo();
			$work_start_date=date('Y/m/d', $data->getWorkStartTime());
			$work_end_date=date('Y/m/d', $data->getWorkEndTime());
			$work_start_time=date('h:i', $data->getWorkStartTime());
			$work_end_time=date('h:i', $data->getWorkEndTime());
			$work_hour=$data->getWorkHour();
			$support_flg=$data->getSupportFlg();
			$worker_name=$data->getWorkerName();
			$sign_flg=$data->getSingFlg();
			$work_status=$data->getWorkStatus();
			$work_subject=$data->getWorkSubject();
			$work_wrap_up=$data->getWorkWrapUp();
			$work_detail=$data->getWorkDetail();
			$keep_hardware=$data->getKeepHardWare();
			$keep_software=$data->getKeepSoftWare();
			$keep_other=$data->getKeepOther();
			$data_shift_flg=$data->getDataShiftFlg();
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<!--1.CSSの読み込み-->
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<link rel="stylesheet" type="text/css" href="./plugins/jqm-datebox-1.4.5.min.css" />
<link rel="stylesheet" type="text/css" href="./plugins/datetimepicker-master/jquery.datetimepicker.css" />
<!--2.jQueryの読み込み-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

<!--3.jQuery Mobileの読み込み-->
<script type="text/javascript" src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script>

<!--4.jQuery Mobileプラグインの読み込み-->
<script src="./plugins/jquery.mobile.datebox.i8n.jp.js"></script>

<script>
$(document).ready(function(){
	/**
	 * 送信ボタンクリック
	 */
	$('#send').click(function() {
		var form = $('#houkokusyo');
		var param = {};
		$(form.serializeArray()).each(function(i, v){
			param[v.name] = v.value;
		});
		//Ajax
		$.ajax({
			type: 'POST',
			async: true, // 同期通信
			data: param,
			url: 'validate_check.php',
			dataType: 'text',//テキストとして受け取る
			success: function(data,text){
			//処理成功時の動作
			//PHPから返ってきたデータの表示
				$('body').pagecontainer('change', 'houkokusyo_view.php');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				//エラーメッセージの表示
				alert('Error : ' + errorThrown);
			}
		});
		//サブミット後、ページをリロードしないようにする
		return false;
	});
});
</script>

<title>部局支援　作業報告書入力</title>

<style type="text/css">
<!--
	td {
	  width: 400px;
	  vertical-align: middle; 
	}
-->

</style>
</HEAD>
<BODY bgcolor="#ECF9F7">
<div id="input" data-role="page">
	<div data-role="header">
			<h1>
				<?php
					if(isset($_GET['id'])) {
						echo '【編集モード】';
					}
				?>
				部局支援　作業報告書入力
			</h1>
	</div>
	<div class="ui-content" role="main">
		<form id="houkokusyo" method="post">
			<input type="hidden" name="id" value="<?php echo $id ?>">
			
				<div class="ui-grid-a">
					<div class="ui-block-a">
						【部局コード】<input type="text" name="bukyoku_no" value="<?php echo htmlspecialchars($bukyoku_no); ?>">
					</div>
					<div class="ui-block-b">
						【作成日】
						<input name="create_date" id="datepicker" type="text" data-role="datebox" data-options='{"mode": "calbox"}' value="<?php echo htmlspecialchars($create_date); ?>">
					</div>
				</div>
				<div class="ui-grid-b">
					<div class="ui-block-a">
						【経理コード】<input type="text" name="keiri_no" value="<?php echo htmlspecialchars($keiri_no); ?>">
					</div>
					<div class="ui-block-b">
					<!--
						【作業開始時刻】日付<input name="work_start_date" id="date1" type="date" data-role="datebox" data-options='{"mode": "calbox"}' value="<?php echo htmlspecialchars($work_start_date); ?>">
					-->
					【作業開始時刻】日付
						<input name="work_start_date" id="datetimepicker" type="text" data-role="datebox" data-options='{"mode": "calbox"}' value="<?php echo htmlspecialchars($work_start_date); ?>">
					</div>
					<div class="ui-block-c">
						時間<input name="work_start_time" id="date1" type="date" data-role="datebox" data-options='{"mode": "timeflipbox","overrideTimeOutput": "%H:%M"}' value="<?php echo htmlspecialchars($work_start_time); ?>">
					</div>
				</div>
				<div class="ui-grid-b">
					<div class="ui-block-a">
						【ご依頼者名】<input type="text" name="client_name" value="<?php echo htmlspecialchars($client_name); ?>">様
					</div>
					<div class="ui-block-b">
						【作業終了時刻】日付<input name="work_end_date" id="date1" type="date" data-role="datebox" data-options='{"mode": "calbox"}' value="<?php echo htmlspecialchars($work_end_date); ?>">
					</div>
					<div class="ui-block-c">
						時間<input name="work_end_time" id="date1" type="date" data-role="datebox" data-options='{"mode": "timeflipbox","overrideTimeOutput": "%H:%M"}' value="<?php echo htmlspecialchars($work_end_time); ?>">
					</div>
				</div>
				<div class="ui-grid-b">
					<div class="ui-block-a">
						【部局・室名】<input type="text" name="bukyoku_name" value="<?php echo htmlspecialchars($bukyoku_name); ?>">
					</div>
					<div class="ui-block-b">
					【実作業時間】<input type="text" name="work_hour" value="<?php echo htmlspecialchars($work_hour); ?>" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline">h
					</div>
				</div>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						【部屋番号】<input type="text" name="room_no" value="<?php  echo htmlspecialchars($room_no); ?>">
					</div>
					<div class="ui-block-b">
						<fieldset data-role="controlgroup" data-type="horizontal">
							<legend>【サポート契約】</legend>
							<label for="support_flg_yes">有</label>
							<input type="radio" name="support_flg" id="support_flg_yes" value="<?php echo SUPPORT_YES; ?>" <?php if($support_flg==SUPPORT_YES) echo 'checked="checked"';?>>
							<label for="support_flg_no">無</label>
							<input type="radio" name="support_flg" id="support_flg_no" value="<?php echo SUPPORT_NO; ?>"  <?php if($support_flg==SUPPORT_NO) echo 'checked="checked"';?>>
						</fieldset>
					</div>
				</div>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						【内線番号】<input type="text" name="tel_no" value="<?php echo htmlspecialchars($tel_no); ?>">
					</div>
					<div class="ui-block-b">
						【作業担当者名】<input type="text" name="worker_name" value="<?php echo htmlspecialchars($worker_name); ?>">
					</div>
				</div>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<fieldset data-role="controlgroup" data-type="horizontal">
							<legend>【処置後状態】</legend>
							<label for="work_status_compleat">処理完了</label>
							<input type="radio" name="work_status" id="work_status_compleat" value="<?php echo WORK_STATUS_COMPLEAT; ?>" <?php if($work_status==WORK_STATUS_COMPLEAT) echo 'checked="checked"';?>>
							<label for="work_status_continue">継続処理</label>
							<input type="radio" name="work_status" id="work_status_continue" value="<?php echo WORK_STATUS_CONTINUE; ?>" <?php if($work_status==WORK_STATUS_CONTINUE) echo 'checked="checked"';?>>
						</fieldset>
					</div>
					<div class="ui-block-b">
						<fieldset data-role="controlgroup" data-type="horizontal">
							<legend>【確認印】</legend>
							<label for="sign_flg_yes">済</label>
							<input type="radio" name="sign_flg" id="sign_flg_yes" value="<?php echo SIGN_YES; ?>" <?php if($sign_flg==SIGN_YES) echo 'checked="checked"';?>>
							<label for="sign_flg_no">未</label>
							<input type="radio" name="sign_flg" id="sign_flg_no" value="<?php echo SIGN_NO; ?>" <?php if($sign_flg==SIGN_NO) echo 'checked="checked"';?>>
						</fieldset>
					</div>
				</div>
				<div class="ui-grid-solo">
					<div class="ui-block-a">
						【作業内容】<textarea name="work_subject" width="700px"><?php  echo htmlspecialchars($work_subject); ?></textarea>
					</div>
				</div>
				<div class="ui-grid-solo">
					<div class="ui-block-a">
						【作業内容要約】<textarea name="work_wrap_up" width="700px"><?php  echo htmlspecialchars($work_wrap_up); ?></textarea>
					</div>
				</div>
				<div class="ui-grid-solo">
					<div class="ui-block-a">
						【作業内容詳細】<textarea name="work_detail" width="700px" height="400px"><?php  echo htmlspecialchars($work_detail); ?></textarea>
					
					</div>
				</div>
				<h4>▼お預かり品</h4>
				<div class="ui-grid-solo">
					<div class="ui-block-a"></td>
						【ハードウェア】<input type="text" name="keep_hardware" value="<?php  echo htmlspecialchars($keep_hardware); ?>">
					</div>
				</div>
				<div class="ui-grid-solo">
					<div class="ui-block-a">
						【ソフトウェア】<input type="text" name="keep_software" value="<?php  echo htmlspecialchars($keep_software); ?>">
					</div>
				</div>
				<div class="ui-grid-solo">
					<div class="ui-block-a">
						【その他】<input type="text" name="keep_other" value="<?php  echo htmlspecialchars($keep_other); ?>">
					</div>
				</div>
				<div class="ui-grid-solo">
					<div class="ui-block-a">
						<fieldset data-role="controlgroup" data-type="horizontal">
							<legend>【データ移行作業】別紙データ移行依頼書</legend>
							<label for="data_shift_flg_yes">有</label>
							<input type="radio" name="data_shift_flg" id="data_shift_flg_yes" value="<?php echo DATA_SHIFT_YES; ?>" <?php if($data_shift_flg==DATA_SHIFT_YES) echo 'checked="checked"';?>>
							<label for="data_shift_flg_no">無</label>
							<input type="radio" name="data_shift_flg" id="data_shift_flg_no" value="<?php echo DATA_SHIFT_NO; ?>" <?php if($data_shift_flg==DATA_SHIFT_NO) echo 'checked="checked"';?>>
						</fieldset>
					</div>
				</div>
			<input id="send" type="submit" value="登録" data-inline="true" data-icon="action" data-iconpos="right">
			<input id="ichiran" type="button" onclick="location.href='houkokusyo_view.php'" value="作業報告書一覧" data-inline="true" data-icon="bullets" data-iconpos="right">
		</form>
	</div>
</div>

<script src="./plugins/datetimepicker-master/jquery.datetimepicker.js"></script>
<script>
$('#datepicker').datetimepicker({
lang:'ja',
timepicker:false,
format:'Y/m/d H:i',
step:30
});
$('#datetimepicker').datetimepicker({
lang:'ja',
format:'Y/m/d H:i',
step:30
});
</script>
</BODY>
</HTML>
