<?php
require_once(dirname(__FILE__) . '/houkokusyo_util.php');
require_once(HOME_DIR . 'db/regist_houkokusyo.php');
require_once(HOME_DIR . 'data/data_houkokusyo.php');

/*
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
$sign = isset($_SESSION['sign']) ? $_SESSION['sign'] : "";
$work_status = isset($_SESSION['work_status']) ? $_SESSION['work_status'] : "";
$work_subject = isset($_SESSION['work_subject']) ? $_SESSION['work_subject'] : "";
$work_wrap_up = isset($_SESSION['work_wrap_up']) ? $_SESSION['work_wrap_up'] : "";
	if ($bukyoku_no == ""){
		$bukyoku_no = "入力がありません。";
		$mode = "reject";
	};
*/
$data = new DataHoukokusyo();
/*
$arr = array(
	'create_date' => $_POST['create_date'],
	'bukyoku_no' => intval($_POST['bukyoku_no']),
	'keiri_no' => (int)$_POST['keiri_no'],
	'client_name' => $_POST['client_name'],
	'bukyoku_name' => $_POST['bukyoku_name'],
	'room_no' => (int)$_POST['room_no'],
	'tel_no' => (int)$_POST['tel_no'],
	'work_start_time' => $_POST['work_start_time'],
	'work_end_time' => $_POST['work_end_time'],
	'work_hour' => $_POST['work_hour'],
	'support_flg' => $_POST['support_flg'],
	'worker_name' => $_POST['worker_name'],
	'sign' => $_POST['sign'],
	'work_status' => $_POST['work_status'],
	'work_subject' => $_POST['work_subject'],
	'work_wrap_up' => $_POST['work_wrap_up'],
	'work_detail' => $_POST['work_detail'],
	'keep_hardware' => $_POST['keep_hardware'],
	'keep_software' => $_POST['keep_software'],
	'keep_other' => $_POST['keep_other'],
	'memo' => '',
	'del_flg' => '0'
);
$data->setData($arr);
*/
/*
echo 'validate_check $_POST[\'create_date\']:'.$_POST['create_date'].'<p>';
echo 'validate_check $_POST[\'work_start_time\']:'.$_POST['work_start_time'].'<p>';
echo 'validate_check $_POST[\'work_end_time\']:'.$_POST['work_end_time'].'<p>';
echo 'validate_check strtotime create_date:'.strtotime($_POST['create_date']).'<p>';
echo 'validate_check strtotime work_start_time:'.strtotime($_POST['work_start_time']).'<p>';
echo 'validate_check strtotime work_end_time:'.strtotime($_POST['work_end_time']).'<p>';
*/
$data->init();
$data->setId (intval($_POST['id']));
$data->setCreateDate (strtotime($_POST['create_date']));
$data->setBukyokuNo (intval($_POST['bukyoku_no']));
$data->setKeiriNo (intval($_POST['keiri_no']));
$data->setClientName ($_POST['client_name']);
$data->setBukyokuName ($_POST['bukyoku_name']);
$data->setRoomNo (intval($_POST['room_no']));
$data->setTelNo (intval($_POST['tel_no']));
$data->setWorkStartTime (strtotime($_POST['work_start_date'].' '.$_POST['work_start_time']));
$data->setWorkEndTime (strtotime($_POST['work_end_date'].' '.$_POST['work_end_time']));
$data->setWorkHour ($_POST['work_hour']);
$data->setSupportFlg ($_POST['support_flg']);
$data->setWorkerName ($_POST['worker_name']);
$data->setSingFlg ($_POST['sign_flg']);
$data->setWorkStatus ($_POST['work_status']);
$data->setWorkSubject ($_POST['work_subject']);
$data->setWorkWrapUp ($_POST['work_wrap_up']);
$data->setWorkDetail ($_POST['work_detail']);
$data->setKeepHardWare ($_POST['keep_hardware']);
$data->setKeepSoftWare ($_POST['keep_software']);
$data->setKeepOther ($_POST['keep_other']);
$data->setDataShiftFlg ($_POST['data_shift_flg']);
/*
echo 'validate_check $data->setCreateDate:'.$data->getCreateDate().'<p>';
echo 'validate_check $data->setWorkStartTime:'.$data->getWorkStartTime().'<p>';
echo 'validate_check $data->setWorkEndTime:'.$data->getWorkEndTime().'<p>';
*/
$db = new RegistHoukokusyo();
if(isset($_POST['id']) and $_POST['id']!="") {
	echo "update!";
	$db->updateDB($data);
}else{
	echo "insert!";
	$db->insertDB($data);
}
//header("location: ./houkokusyo_view.php");
?>
