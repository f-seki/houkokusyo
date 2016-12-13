<?php
require_once(dirname(__FILE__) . '/../houkokusyo_util.php');
require_once(HOME_DIR . 'db/select_houkokusyo.php');
class CreateReport {
	public function getReport($id) {
		set_include_path(PHPEXCEL_LIB_DIR);
		include 'PHPExcel.php';
		
		$db = new SelectHoukokusyo();
		$hasharr = array('id' => $id);
		$dataarr = $db->getHoukokusyoList($hasharr);
		/* idを指定して1件のレコードを取得してくることが前提。
		 * ・レコードがない場合はNG。
		 * ・レコードが複数の場合はNG。
		 */
		if (!isset($dataarr) or count($dataarr)<1) {
			echo 'エラー：レコード抽出に失敗しました。';
			break;
		}
		if (count($dataarr)>1) {
			echo 'エラー：複数レコードがあります。';
			break;
		}
		$data = $dataarr[0];
		$client_name = $data->getClientName() . '様';
		$bukyoku_name = $data->getBukyokuName();
		$room_no = $data->getRoomNo();
		$tel_no = $data->getTelNo();
		if ($data->getWorkStatus() == WORK_STATUS_COMPLEAT){
			$work_status = '継続作業';
		}elseif($data->getWorkStatus() == WORK_STATUS_CONTINUE){
			$work_status = '処理完了';
		}else{
			$work_status = '';
		}
		
		$intWareki = intval(date('Y', $data->getCreateDate())) - HEISEI_BIGIN;
		$create_date = NENGOU . $intWareki . '年　' . date('n月　j日', $data->getCreateDate());
		$work_start_time = date('n月　j日　H:i', $data->getWorkStartTime());
		$work_end_time = date('n月　j日　H:i', $data->getWorkEndTime());
		$work_hour = $data->getWorkHour();
		$support_flg = $data->getSupportFlg();
		if ($data->getSupportFlg() == SUPPORT_NO){
			$support_flg = 'サポート契約無し';
		}elseif($data->getSupportFlg() == SUPPORT_YES){
			$support_flg = 'サポート契約有り';
		}else{
			$support_flg = '';
		}
		$work_subject = $data->getWorkSubject();
		$work_wrap_up = $data->getWorkWrapUp();
		$work_detail = $data->getWorkDetail();

		$worker_name = $data->getWorkerName();
		
		$keep_hardware = $data->getKeepHardWare();
		$keep_software = $data->getKeepSoftWare();
		$keep_other = $data->getKeepOther();
		
		/*
		 *レポート出力
		 */
		// テンプレートファイルの読み込み
		$objPHPExcel = PHPExcel_IOFactory::load(HOME_DIR .'output/201601.xls');

		// エクセルの書き出し
		$objPHPExcel->setActiveSheetIndex(0);
		$objSheet = $objPHPExcel->getActiveSheet();

		$objSheet->getDefaultStyle()->getFont()->setName('ＭＳ ゴシック');

		$objSheet->setCellValue('C6', $client_name);
		$objSheet->setCellValue('C8', $bukyoku_name);
		$objSheet->setCellValue('C10', $room_no);
		$objSheet->setCellValue('C12', $tel_no);
		$objSheet->setCellValue('C14', $work_status);
		
		$objSheet->setCellValue('F2', $create_date);
		$objSheet->setCellValue('H4', $work_start_time);
		$objSheet->setCellValue('H6', $work_end_time);
		$objSheet->setCellValue('H8', $work_hour);
		$objSheet->setCellValue('H10', $support_flg);
		
		$objSheet->setCellValue('F13', $worker_name);
		
		$objSheet->setCellValue('A18', $work_subject);
		$objSheet->setCellValue('A23', $work_wrap_up);
		$objSheet->setCellValue('A26', $work_detail);
		
		$objSheet->setCellValue('D41', $keep_hardware);
		$objSheet->setCellValue('D43', $keep_software);
		$objSheet->setCellValue('D45', $keep_other);
		
		$objSheet->getStyle( 'A22:J22' )->getFill()->setFillType( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor()->setARGB( '0000FFFF' );

		// "Excel2007" 形式で保存する
		$fileName = 'houkokusyo' . date('YmdHis') . '_id_' . $id . '.xls';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save(HOME_DIR . REPORT_SAVE_DIR . $fileName);
		return $fileName;
	}
}
?>
