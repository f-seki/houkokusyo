<?php
require_once(dirname(__FILE__) . '/../houkokusyo_util.php');
require_once(HOME_DIR . 'db/db_connecter.php');

class RegistHoukokusyo {

	public function insertDB($data) {
		$db = new DBconnecter();
		$pdo = $db -> dbConnect();
		$sql = 'insert into houkokusyo (
			regist_date,
			update_date,
			create_date,
			bukyoku_no,
			keiri_no,
			client_name,
			bukyoku_name,
			room_no,
			tel_no,
			work_start_time,
			work_end_time,
			work_hour,
			support_flg,
			worker_name,
			sign_flg,
			work_status,
			work_subject,
			work_wrap_up,
			work_detail,
			keep_hardware,
			keep_software,
			keep_other,
			data_shift_flg,
			memo,
			del_flg
			) values (
			:regist_date,
			:update_date,
			:create_date,
			:bukyoku_no,
			:keiri_no,
			:client_name,
			:bukyoku_name,
			:room_no,
			:tel_no,
			:work_start_time,
			:work_end_time,
			:work_hour,
			:support_flg,
			:worker_name,
			:sign_flg,
			:work_status,
			:work_subject,
			:work_wrap_up,
			:work_detail,
			:keep_hardware,
			:keep_software,
			:keep_other,
			:data_shift_flg,
			:memo,
			:del_flg
			)';
		$stmt = $pdo -> prepare($sql);
		$stmt->bindValue(':regist_date',date('Y-m-d H:i:s'), PDO::PARAM_STR);
		$stmt->bindValue(':update_date',date('Y-m-d H:i:s'), PDO::PARAM_STR);
		$stmt->bindValue(':create_date',date('Y-m-d',$data->getCreateDate()), PDO::PARAM_STR);
		$stmt->bindValue(':bukyoku_no',$data->getBukyokuNo(), PDO::PARAM_INT);
		$stmt->bindValue(':keiri_no',$data->getKeiriNo(), PDO::PARAM_INT);
		$stmt->bindValue(':client_name',$data->getClientName(), PDO::PARAM_STR);
		$stmt->bindValue(':bukyoku_name',$data->getBukyokuName(), PDO::PARAM_STR);
		$stmt->bindValue(':room_no',$data->getRoomNo(), PDO::PARAM_INT);
		$stmt->bindValue(':tel_no',$data->getTelNo(), PDO::PARAM_INT);
		$stmt->bindValue(':work_start_time',date('Y-m-d H:i:s',$data->getWorkStartTime()), PDO::PARAM_STR);
		$stmt->bindValue(':work_end_time',date('Y-m-d H:i:s',$data->getWorkEndTime()), PDO::PARAM_STR);
		$stmt->bindValue(':work_hour',$data->getWorkHour(), PDO::PARAM_STR);
		$stmt->bindValue(':support_flg',$data->getSupportFlg(), PDO::PARAM_STR);
		$stmt->bindValue(':worker_name',$data->getWorkerName(), PDO::PARAM_STR);
		$stmt->bindValue(':sign_flg',$data->getSingFlg(), PDO::PARAM_STR);
		$stmt->bindValue(':work_status',$data->getWorkStatus(), PDO::PARAM_STR);
		$stmt->bindValue(':work_subject',$data->getWorkSubject(), PDO::PARAM_STR);
		$stmt->bindValue(':work_wrap_up',$data->getWorkWrapUp(), PDO::PARAM_STR);
		$stmt->bindValue(':work_detail',$data->getWorkDetail(), PDO::PARAM_STR);
		$stmt->bindValue(':keep_hardware',$data->getKeepHardWare(), PDO::PARAM_STR);
		$stmt->bindValue(':keep_software',$data->getKeepSoftWare(), PDO::PARAM_STR);
		$stmt->bindValue(':keep_other',$data->getKeepOther(), PDO::PARAM_STR);
		$stmt->bindValue(':data_shift_flg',$data->getDataShiftFlg(), PDO::PARAM_STR);
		$stmt->bindValue(':memo','', PDO::PARAM_STR);
		$stmt->bindValue(':del_flg','0', PDO::PARAM_STR);
/*
echo 'insert create_date:'.date('Y-m-d',$data->getCreateDate()).'<p>';
echo 'insert work_start_time:'.date('Y-m-d H:i:s',$data->getWorkStartTime()).'<p>';
echo 'insert work_end_time:'.date('Y-m-d H:i:s',$data->getWorkEndTime()).'<p>';
*/
		$stmt->execute();
		
		$pdo = null;
	}
	
	public function updateDB($data) {
		$db = new DBconnecter();
		$pdo = $db -> dbConnect();
		$sql = 'update houkokusyo set 
					regist_date = :regist_date,
					update_date = :update_date,
					create_date = :create_date,
					bukyoku_no = :bukyoku_no,
					keiri_no = :keiri_no,
					client_name = :client_name,
					bukyoku_name = :bukyoku_name,
					room_no = :room_no,
					tel_no = :tel_no,
					work_start_time = :work_start_time,
					work_end_time = :work_end_time,
					work_hour = :work_hour,
					support_flg = :support_flg,
					worker_name = :worker_name,
					sign_flg = :sign_flg,
					work_status = :work_status,
					work_subject = :work_subject,
					work_wrap_up = :work_wrap_up,
					work_detail = :work_detail,
					keep_hardware = :keep_hardware,
					keep_software = :keep_software,
					keep_other = :keep_other,
					data_shift_flg = :data_shift_flg,
					memo = :memo,
					del_flg = :del_flg
				 where 
					id = :id';
		$stmt = $pdo -> prepare($sql);
		$stmt->bindValue(':regist_date',date('Y-m-d H:i:s'), PDO::PARAM_STR);
		$stmt->bindValue(':update_date',date('Y-m-d H:i:s'), PDO::PARAM_STR);
		$stmt->bindValue(':create_date',date('Y-m-d',$data->getCreateDate()), PDO::PARAM_STR);
		$stmt->bindValue(':bukyoku_no',$data->getBukyokuNo(), PDO::PARAM_INT);
		$stmt->bindValue(':keiri_no',$data->getKeiriNo(), PDO::PARAM_INT);
		$stmt->bindValue(':client_name',$data->getClientName(), PDO::PARAM_STR);
		$stmt->bindValue(':bukyoku_name',$data->getBukyokuName(), PDO::PARAM_STR);
		$stmt->bindValue(':room_no',$data->getRoomNo(), PDO::PARAM_INT);
		$stmt->bindValue(':tel_no',$data->getTelNo(), PDO::PARAM_INT);
		$stmt->bindValue(':work_start_time',date('Y-m-d H:i:s',$data->getWorkStartTime()), PDO::PARAM_STR);
		$stmt->bindValue(':work_end_time',date('Y-m-d H:i:s',$data->getWorkEndTime()), PDO::PARAM_STR);
		$stmt->bindValue(':work_hour',$data->getWorkHour(), PDO::PARAM_STR);
		$stmt->bindValue(':support_flg',$data->getSupportFlg(), PDO::PARAM_STR);
		$stmt->bindValue(':worker_name',$data->getWorkerName(), PDO::PARAM_STR);
		$stmt->bindValue(':sign_flg',$data->getSingFlg(), PDO::PARAM_STR);
		$stmt->bindValue(':work_status',$data->getWorkStatus(), PDO::PARAM_STR);
		$stmt->bindValue(':work_subject',$data->getWorkSubject(), PDO::PARAM_STR);
		$stmt->bindValue(':work_wrap_up',$data->getWorkWrapUp(), PDO::PARAM_STR);
		$stmt->bindValue(':work_detail',$data->getWorkDetail(), PDO::PARAM_STR);
		$stmt->bindValue(':keep_hardware',$data->getKeepHardWare(), PDO::PARAM_STR);
		$stmt->bindValue(':keep_software',$data->getKeepSoftWare(), PDO::PARAM_STR);
		$stmt->bindValue(':keep_other',$data->getKeepOther(), PDO::PARAM_STR);
		$stmt->bindValue(':data_shift_flg',$data->getDataShiftFlg(), PDO::PARAM_STR);
		$stmt->bindValue(':memo','', PDO::PARAM_STR);
		$stmt->bindValue(':del_flg','0', PDO::PARAM_STR);
		$stmt->bindValue(':id',$data->getId(), PDO::PARAM_INT);
		$stmt->execute();
		
		$pdo = null;
	}
}
?>
