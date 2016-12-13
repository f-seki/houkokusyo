<?php
require_once (dirname(__FILE__) . '/houkokusyo_util.php');
require_once(HOME_DIR . 'db/select_houkokusyo.php');
/* include "validate_check.php";
session_start();
$mode = isset($_SESSION['mode']) ? $_SESSION['mode'] : "";
$create_date = isset($_SESSION['create_date']) ? $_SESSION['create_date'] : "";
$bukyoku_no = isset($_SESSION['bukyoku_no']) ? $_SESSION['bukyoku_no'] : "";
$keiri_no = isset($_SESSION['keiri_no']) ? $_SESSION['keiri_no'] : "";
$client_name = isset($_SESSION['client_name']) ? $_SESSION['client_name'] : "";
$bukyoku_name = isset($_SESSION['bukyoku_name']) ? $_SESSION['bukyoku_name'] : "";
$room_no = isset($_SESSION['room_no']) ? $_SESSION['room_no'] : "";
$tel_no = isset($_SESSION['tel_no']) ? $_SESSION['tel_no'] : "";
$work_start_time = isset($_SESSION['work_start_time']) ? $_SESSION['work_start_time'] : "";
$work_end_time = isset($_SESSION['work_end_time']) ? $_SESSION['work_end_time'] : "";
$work_hour = isset($_SESSION['work_hour']) ? $_SESSION['work_hour'] : "";
$support_flg = isset($_SESSION['support_flg']) ? $_SESSION['support_flg'] : "";
$worker_name = isset($_SESSION['worker_name']) ? $_SESSION['worker_name'] : "";
$sign_flg = isset($_SESSION['sign']) ? $_SESSION['sign'] : "";
$work_status = isset($_SESSION['work_status']) ? $_SESSION['work_status'] : "";
$work_subject = isset($_SESSION['work_subject']) ? $_SESSION['work_subject'] : "";
$work_wrap_up = isset($_SESSION['work_wrap_up']) ? $_SESSION['work_wrap_up'] : "";
*/
/*
$mode = isset($_POST['mode']) ? $_POST['mode'] : "";
$create_date = isset($_POST['create_date']) ? date('Y年　m月　d日', $_POST['create_date']) : "";
$bukyoku_no = isset($_POST['bukyoku_no']) ? $_POST['bukyoku_no'] : "";
$keiri_no = isset($_POST['keiri_no']) ? $_POST['keiri_no'] : "";
$client_name = isset($_POST['client_name']) ? $_POST['client_name'] : "";
$bukyoku_name = isset($_POST['bukyoku_name']) ? $_POST['bukyoku_name'] : "";
$room_no = isset($_POST['room_no']) ? $_POST['room_no'] : "";
$tel_no = isset($_POST['tel_no']) ? $_POST['tel_no'] : "";
$work_start_time = isset($_POST['work_start_time']) ? date('Y-m-d H:i', $_POST['work_start_time']) : "";
$work_end_time = isset($_POST['work_end_time']) ? date('Y-m-d H:i', $_POST['work_end_time']) : "";
$work_hour = isset($_POST['work_hour']) ? $_POST['work_hour'] : "";
$support_flg = isset($_POST['support_flg']) ? $_POST['support_flg'] : "";
$worker_name = isset($_POST['worker_name']) ? $_POST['worker_name'] : "";
$sign_flg = isset($_POST['sign']) ? $_POST['sign'] : "";
$work_status = isset($_POST['work_status']) ? $_POST['work_status'] : "";
$work_subject = isset($_POST['work_subject']) ? $_POST['work_subject'] : "";
$work_wrap_up = isset($_POST['work_wrap_up']) ? $_POST['work_wrap_up'] : "";
$work_detail = isset($_POST['work_detail']) ? $_POST['work_detail'] : "";
*/
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
//			$work_start_time=date('Y-m-d h:i', $data->getWorkStartTime());
//			$work_end_time=date('Y-m-d h:i', $data->getWorkEndTime());
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

<!--2.jQueryの読み込み-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

<!--3.jQuery Mobileの読み込み-->
<script type="text/javascript" src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script>

<!--4.jQuery Mobileプラグインの読み込み-->
<script src="./plugins/jquery.mobile.datebox.i8n.jp.js"></script>
    <script>

	$(document).ready(function()
    {
        /**
         * 送信ボタンクリック
         */
        $('#send').click(function()
        {
		var form = $('#houkokusyo');
		var param = {};
		$(form.serializeArray()).each(function(i, v) {
		    param[v.name] = v.value;
		});
		//Ajax
		$.ajax({
			type: 'POST',
			async: false, // 同期通信
			data: param,
			url: 'validate_check.php',
			dataType: 'text',//テキストとして受け取る
			success: function(data,text){
			//処理成功時の動作
			//PHPから返ってきたデータの表示
				$('body').pagecontainer('change', 'houkokusyo_view.php');
			},
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    //通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

                    //this;
                    //thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

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
			
			<table  width="800px" border="1" bgcolor="#FFFFF7">
				<tr>
					<td width="400px">
						<div class="ui-field-contain">
							<label for="bukyoku_no">【部局コード】</label>
							<input type="text" name="bukyoku_no" value="<?php echo htmlspecialchars($bukyoku_no); ?>">
						</div>
					</td>
					<td>【作成日】<input name="create_date" id="date1" type="date" data-role="datebox" data-options='{"mode": "calbox"}' value="<?php echo htmlspecialchars($create_date); ?>"></td>
				</tr>
				<tr>
					<td>【経理コード】<input type="text" name="keiri_no" value="<?php echo htmlspecialchars($keiri_no); ?>"></td>
					<td>【作業開始時刻】日付<input name="work_start_date" id="date1" type="date" data-role="datebox" data-options='{"mode": "calbox"}' value="<?php echo htmlspecialchars($work_start_date); ?>"></td>
					<td>時間<input name="work_start_time" id="date1" type="date" data-role="datebox" data-options='{"mode": "timeflipbox","overrideTimeOutput": "%H:%M"}' value="<?php echo htmlspecialchars($work_start_time); ?>">
					</td>
				</tr>
				<tr>
					<td>【ご依頼者名】<input type="text" name="client_name" value="<?php echo htmlspecialchars($client_name); ?>">様</td>
					<td>【作業終了時刻】日付<input name="work_end_date" id="date1" type="date" data-role="datebox" data-options='{"mode": "calbox"}' value="<?php echo htmlspecialchars($work_end_date); ?>"></td>
					<td>時間<input name="work_end_time" id="date1" type="date" data-role="datebox" data-options='{"mode": "timeflipbox","overrideTimeOutput": "%H:%M"}' value="<?php echo htmlspecialchars($work_end_time); ?>">
				</tr>
				<tr>
					<td>【部局・室名】<input type="text" name="bukyoku_name" value="<?php echo htmlspecialchars($bukyoku_name); ?>"></td>
					<td>【実作業時間】<input type="text" name="work_hour" value="<?php echo htmlspecialchars($work_hour); ?>">ｈ</td>
				</tr>
				<tr>
					<td>【部屋番号】<input type="text" name="room_no" value="<?php  echo htmlspecialchars($room_no); ?>"></td>
					<td>【サポート契約】有<input type="radio" name="support_flg" value="<?php echo SUPPORT_YES; ?>" <?php if($support_flg==SUPPORT_YES) echo 'checked="checked"';?>>　／　無<input type="radio" name="support_flg" value="<?php echo SUPPORT_NO; ?>"  <?php if($support_flg==SUPPORT_NO) echo 'checked="checked";'?>></td>
				</tr>
				<tr>
					<td>【内線番号】<input type="text" name="tel_no" value="<?php echo htmlspecialchars($tel_no); ?>"></td>
					<td>【作業担当者名】<input type="text" name="worker_name" value="<?php echo htmlspecialchars($worker_name); ?>"></td>
				</tr>
				<tr>
					<td>【処置後状態】処理完了<input type="radio" name="work_status" value="<?php echo WORK_STATUS_COMPLEAT; ?>" <?php if($work_status==WORK_STATUS_COMPLEAT) echo 'checked="checked"';?>>　／　継続処理<input type="radio" name="work_status" value="<?php echo WORK_STATUS_CONTINUE; ?>" <?php if($work_status==WORK_STATUS_CONTINUE) echo 'checked="checked"';?>></td>
					<td>【確認印】済<input type="radio" name="sign_flg" value="<?php echo SIGN_YES; ?>" <?php if($sign_flg==SIGN_YES) echo 'checked="checked"';?>>　／　未<input type="radio" name="sign_flg" value="<?php echo SIGN_NO; ?>" <?php if($sign_flg==SIGN_NO) echo 'checked="checked"';?>></td>
				</tr>
				<tr>
					<td colspan="2">【作業内容】<textarea name="work_subject" width="700px"><?php  echo htmlspecialchars($work_subject); ?></textarea></td>
				</tr>
				<tr>
					<td colspan="2">【作業内容要約】<textarea name="work_wrap_up" width="700px"><?php  echo htmlspecialchars($work_wrap_up); ?></textarea></td>
				</tr>
				<tr>
					<td colspan="2">【作業内容詳細】<textarea name="work_detail" width="700px" height="400px"><?php  echo htmlspecialchars($work_detail); ?></textarea></td>
				</tr>
				<tr>
					<td width="100px" rowspan="3">【お預かり品】</td>
					<td>【ハードウェア】<input type="text" name="keep_hardware" value="<?php  echo htmlspecialchars($keep_hardware); ?>"></td>
				</tr>
				<tr>
					<td>【ソフトウェア】<input type="text" name="keep_software" value="<?php  echo htmlspecialchars($keep_software); ?>"></td>
				</tr>
				<tr>
					<td>【その他】<input type="text" name="keep_other" value="<?php  echo htmlspecialchars($keep_other); ?>"></td>
				</tr>
				<tr>
					<td>【データ移行作業】別紙データ移行依頼書</td>
					<td>有<input type="radio" name="data_shift_flg" value="<?php echo DATA_SHIFT_YES; ?>" <?php if($data_shift_flg==DATA_SHIFT_YES) echo 'checked="checked"';?>>　／　無<input type="radio" name="data_shift_flg" value="<?php echo DATA_SHIFT_NO; ?> <?php if($data_shift_flg==DATA_SHIFT_NO) echo 'checked="checked"';?>" checked="checked"></td>
				</tr>
			</table>
			<input id="send" type="submit" value="登録" data-inline="true">
			<input id="ichiran" type="button" onclick="location.href='houkokusyo_view.php'" value="作業報告書一覧" data-inline="true">
		</form>
	</div>
</div>
</BODY>
</HTML>
