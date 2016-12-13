<?php
class DataHoukokusyo {
		private $id;
		private $regist_date;
		private $update_date;
		private $create_date;
		private $bukyoku_no;
		private $keiri_no;
		private $client_name;
		private $bukyoku_name;
		private $room_no;
		private $tel_no;
		private $work_start_time;
		private $work_end_time;
		private $work_hour;
		private $support_flg;
		private $worker_name;
		private $sign_flg;
		private $work_status;
		private $work_subject;
		private $work_wrap_up;
		private $work_detail;
		private $keep_hardware;
		private $keep_software;
		private $keep_other;
		private $data_shift_flg;
		private $memo;
		private $del_flg;
/* 初期化 */
	public function init() {
		$this->id = null;
		$this->regist_date = time();
		$this->update_date = time();
		$this->create_date = time();
		$this->bukyoku_no = 0;
		$this->keiri_no = 0;
		$this->client_name = null;
		$this->bukyoku_name = null;
		$this->room_no = 0;
		$this->tel_no = 0;
		$this->work_start_time = time();
		$this->work_end_time = time();
		$this->work_hour = null;
		$this->support_flg = null;
		$this->worker_name = null;
		$this->sign_flg = null;
		$this->work_status = null;
		$this->work_subject = null;
		$this->work_wrap_up = null;
		$this->work_detail = null;
		$this->keep_hardware = null;
		$this->keep_software = null;
		$this->keep_other = null;
		$this->data_shift_flg = null;
		$this->memo = null;
		$this->del_flg = null;
	}
/* setter */
	public function setId($val) {
		$this->id = $val;
	}
	public function setRegistDate($val) {
		if(isset($val) and $val != "") {
			$this->regist_date = strtotime($val);
		}else{
			$this->regist_date = time();
		}
	}
	public function setUpdateDate($val) {
		if(isset($val) and $val != "") {
			$this->update_date = strtotime($val);
		}else{
			$this->update_date = time();
		}
	}
	public function setCreateDate($val) {
		if(isset($val) and $val != "") {
			$this->create_date = $val;
		}else{
			$this->create_date = "";
		}
	}
	public function setBukyokuNo($val) {
		$this->bukyoku_no = $val;
	}
	public function setKeiriNo($val) {
		$this->keiri_no = $val;
	}
	public function setClientName($val) {
		$this->client_name = $val;
	}
	public function setBukyokuName ($val) {
		$this->bukyoku_name = $val;
	}
	public function setRoomNo($val) {
		$this->room_no = $val;
	}
	public function setTelNo ($val) {
		$this->tel_no = $val;
	}
	public function setWorkStartTime($val) {
		if(isset($val) and $val != "") {
			$this->work_start_time = $val;
		}else{
			$this->work_start_time = time();
		}
	}
	public function setWorkEndTime($val) {
		if(isset($val) and $val != "") {
			$this->work_end_time = $val;
		}else{
			$this->work_end_time = time();
		}
	}
	public function setWorkHour($val) {
		$this->work_hour = $val;
	}
	public function setSupportFlg($val) {
		$this->support_flg = $val;
	}
	public function setWorkerName($val) {
		$this->worker_name = $val;
	}
	public function setSingFlg($val) {
		$this->sign_flg = $val;
	}
	public function setWorkStatus($val) {
		$this->work_status = $val;
	}
	public function setWorkSubject($val) {
		$this->work_subject = $val;
	}
	public function setWorkWrapUp($val) {
		$this->work_wrap_up = $val;
	}
	public function setWorkDetail($val) {
		$this->work_detail = $val;
	}
	public function setKeepHardWare($val) {
		$this->keep_hardware = $val;
	}
	public function setKeepSoftWare($val) {
		$this->keep_software = $val;
	}
	public function setKeepOther($val) {
		$this->keep_other = $val;
	}
	public function setDataShiftFlg($val) {
		$this->data_shift_flg = $val;
	}
	public function setMemo($val) {
		$this->memo = $val;
	}
	public function setDelFlg($val) {
		$this->del_flg = $val;
	}
/* getter */
	public function getId() {
		return $this->id;
	}
	public function getRegistDate() {
		return $this->regist_date;
	}
	public function getUpdateDate() {
		return $this->update_date;
	}
	public function getCreateDate() {
		return $this->create_date;
	}
	public function getBukyokuNo() {
		return $this->bukyoku_no;
	}
	public function getKeiriNo() {
		return $this->keiri_no;
	}
	public function getClientName() {
		return $this->client_name;
	}
	public function getBukyokuName() {
		return $this->bukyoku_name;
	}
	public function getRoomNo() {
		return $this->room_no;
	}
	public function getTelNo() {
		return $this->tel_no;
	}
	public function getWorkStartTime() {
		return $this->work_start_time;
	}
	public function getWorkEndTime() {
		return $this->work_end_time;
	}
	public function getWorkHour() {
		return $this->work_hour;
	}
	public function getSupportFlg() {
		return $this->support_flg;
	}
	public function getWorkerName() {
		return $this->worker_name;
	}
	public function getSingFlg() {
		return $this->sign_flg;
	}
	public function getWorkStatus() {
		return $this->work_status;
	}
	public function getWorkSubject() {
		return $this->work_subject;
	}
	public function getWorkWrapUp() {
		return $this->work_wrap_up;
	}
	public function getWorkDetail() {
		return $this->work_detail;
	}
	public function getKeepHardWare() {
		return $this->keep_hardware;
	}
	public function getKeepSoftWare() {
		return $this->keep_software;
	}
	public function getKeepOther() {
		return $this->keep_other;
	}
	public function getDataShiftFlg() {
		return $this->data_shift_flg;
	}
	public function getMemo() {
		return $this->memo;
	}
	public function getDelFlg() {
		return $this->del_flg;
	}
	
	public function setArrayData($arr) {
		$this->init();
		$this->id = $arr['id'];
		$this->regist_date = strtotime($arr['regist_date']);
		$this->update_date = strtotime($arr['update_date']);
		$this->create_date = strtotime($arr['create_date']);
		$this->bukyoku_no = $arr['bukyoku_no'];
		$this->keiri_no = $arr['keiri_no'];
		$this->client_name = $arr['client_name'];
		$this->bukyoku_name = $arr['bukyoku_name'];
		$this->room_no = $arr['room_no'];
		$this->tel_no = $arr['tel_no'];
		$this->work_start_time = strtotime($arr['work_start_time']);
		$this->work_end_time = strtotime($arr['work_end_time']);
		$this->work_hour = $arr['work_hour'];
		$this->support_flg = $arr['support_flg'];
		$this->worker_name = $arr['worker_name'];
		$this->sign_flg = $arr['sign_flg'];
		$this->work_status = $arr['work_status'];
		$this->work_subject = $arr['work_subject'];
		$this->work_wrap_up = $arr['work_wrap_up'];
		$this->work_detail = $arr['work_detail'];
		$this->keep_hardware = $arr['keep_hardware'];
		$this->keep_software = $arr['keep_software'];
		$this->keep_other = $arr['keep_other'];
		$this->data_shift_flg = $arr['data_shift_flg'];
		$this->memo = $arr['memo'];
		$this->del_flg = $arr['del_flg'];
	}
}
?>
