<?php
require_once(dirname(__FILE__) . '/../houkokusyo_util.php');
require_once(HOME_DIR . 'output/pdf_driver.php');
require_once(HOME_DIR . 'db/select_houkokusyo.php');
class CreateReport {

	/*
	 * レポート出力
	 * 対象レコードのIDを指定してレポートを出力
	 */
	public function getReport($id) {
		
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
		/*
		 * レコードから値を取得して表示形式に変換
		 */
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
		
		if ($data->getCreateDate()!='') {
			$intWareki = intval(date('Y', $data->getCreateDate())) - HEISEI_BIGIN;
			$create_date = NENGOU . $intWareki . '年　' . date('n月　j日', $data->getCreateDate());
		}else{
			$create_date = '';
		}
		
		$work_start_time = date('n月　j日　H:i', $data->getWorkStartTime());
		$work_end_time = date('n月　j日　H:i', $data->getWorkEndTime());
		$work_hour = number_format($data->getWorkHour(),2,'.','');
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
		// initiate PDF
		$pdf = new MyPDF();
		$pdf->myInit();
		$pdf->setFontSubsetting(true);	// true:フォントを部分埋め込み	false:全埋め込み
	
		// ページ追加
		$pdf->AddPage();
	
		// テンプレートファイルの読み込み
		$template_pdf_path = HOME_DIR .'output/houkokusyo_tmpl.pdf';
		$pdf->myUseTemplate($template_pdf_path, 1);
	
		$font_path = HOME_DIR . 'lib/ipag00303/ipag.ttf';
		if (file_exists($font_path)) {
			$font = new TCPDF_FONTS();
			$font_name = $font->addTTFfont($font_path, 'TrueTypeUnicode');
			$pdf->SetFont($font_name, '', 10);
		}
		// PDFへテキスト書き込み
		$indent1 = 48;
		$pdf->Text($indent1,41,$client_name);
		$pdf->Text($indent1,49,$bukyoku_name);
		$pdf->Text($indent1,57,$room_no);
		$pdf->Text($indent1,65,$tel_no);
		$pdf->Text($indent1,76,$work_status);
		
		$indent2 = 155;
		$pdf->Text($indent2,24,$create_date);
		$pdf->Text($indent2,33,$work_start_time);
		$pdf->Text($indent2,41,$work_end_time);
		$pdf->Text($indent2,49,$work_hour);
		$pdf->Text($indent2,57,$support_flg);
		
		$pdf->Text(130,76,$worker_name);
		
		$indent3 = 15;
		$this->whiteMultipleLines($indent3,93,str_replace("\r\n","\n",$work_subject),$pdf);
		$this->whiteMultipleLines($indent3,120,str_replace("\r\n","\n",$work_wrap_up),$pdf);
		$this->whiteMultipleLines($indent3,135,str_replace("\r\n","\n",$work_detail),$pdf);
		
		$indent4 = 81;
		$this->whiteMultipleLines($indent4,215,str_replace("\r\n","\n",$keep_hardware),$pdf);
		$this->whiteMultipleLines($indent4,224,str_replace("\r\n","\n",$keep_software),$pdf);
		$this->whiteMultipleLines($indent4,233,str_replace("\r\n","\n",$keep_other),$pdf);

		// 第2引数の説明
		// TCPDF::Output($filename, $desc)
		// I: send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
		// D: send to the browser and force a file download with the name given by name.
		// F: save to a local server file with the name given by name.
		// S: return the document as a string (name is ignored).
		// FI: equivalent to F + I option
		// FD: equivalent to F + D option
		// E: return the document as base64 mime multi-part email attachment (RFC 2045)
		// tcpdf.phpのOutput()は第2引数にFが含まれていないとき、ファイル名から英数字以外の
		// 文字を削除してしまうので、いったんFIかFDでサーバーにも保存してすぐに削除してしまうのがいい。

		$fileName = 'houkokusyo' . date('YmdHis') . '_id_' . $id . '.pdf';
		//出力したファイルをブラウザに送るとき（引数：D）には下記「ob_end_clean();」を入れる。
		//ob_end_clean();
		$pdf->Output(HOME_DIR . REPORT_SAVE_DIR . $fileName, 'F');

		return $fileName;
	}
	
	/*
	 * 複数行の文章を改行してPDFに書き出す
	 * $x,$y=スタート座標 $strval=文章文字列 $pdf=PDFオブジェクト
	 */
	function whiteMultipleLines($x,$y,$strval,$pdf){
		$lineSeparater = "\n";
		$nextLineY = 5;
		
		$lineArray = explode($lineSeparater, $strval);
		
		foreach ($lineArray as $line) {
			$pdf->Text($x,$y,$line);
			$y += $nextLineY;
		}
	}
}
?>
