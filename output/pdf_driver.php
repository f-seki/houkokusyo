<?php
require_once(dirname(__FILE__) . '/../houkokusyo_util.php');
require_once(HOME_DIR . 'lib/tcpdf/tcpdf.php');
require_once(HOME_DIR . 'lib/fpdi/fpdi.php');

/**
 * TCPDF＋FPDIを簡単に使えるようにするためのクラス
 */
class MyPDF extends FPDI {
    protected $templates;       // 読み込んだテンプレートのリスト

	/**
	 * 好みの設定を行う
	 */
	function myInit() {
        $this->SetMargins(0, 0, 0);		// 用紙の余白を設定
        $this->SetCellPadding(0);		// セルのパディングを設定
        $this->SetAutoPageBreak(false);	// 自動改ページ
           
		$this->setDisplayMode('default');	// ズーム設定
        $this->setPrintHeader(false);	// ヘッダを使用しない
        $this->setPrintFooter(false);	// フッタを使用しない
	}
        
    /** 
     * テンプレートPDFファイルをロードする。
	 *
	 * @param string	$filepath	PDFファイルのパス
     */
    function myLoadTemplate($filepath) {
        $page_count = $this->setSourceFile($filepath);
        $template_id = array();
        for ($i = 0; $i < $page_count; $i++) {
            $template_id[] = $this->importPage($i + 1);
        }
        $this->templates = array(
            $filepath => array(
                'page_count'    => $page_count,
                'template_id'   => $template_id,
            )
        );
    }   
        
    /** 
     * 指定したPDFファイルの指定したページをテンプレートとして使用する。
     *  
     * @param string    $filepath   PDFファイルのパス
     * @param int       $page       ページ番号（1から）
     */ 
    function myUseTemplate($filepath, $page) {
        if (!isset($this->templates[$filepath])) {
            $this->myLoadTemplate($filepath);
        }

		if (1 <= $page && $page <= $this->templates[$filepath]['page_count']) {
			$this->useTemplate($this->templates[$filepath]['template_id'][$page - 1]);
		}
		else {
			throw new Exception('PDF template not found');
		}
    }

	/**
	 * 日本語ファイル名でダウンロードさせるためのエスケープを行う
	 *
	 * 参考：
	 * http://fgin.seesaa.net/article/30073826.html
	 */
	function escapeFilename($filename) {
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($user_agent, 'MSIE') !== false) {
            // 生SJIS
            $ret = mb_convert_encoding($filename, 'CP932', 'UTF-8');
        }
		elseif (strpos($user_agent, 'Firefox') !== false) {
            // base64
            $ret = '=?UTF-8?B?' . base64_encode($filename) . '?=';
        }
		elseif (strpos($user_agent, 'Chrome') !== false) {
            // base64
            $ret = '=?UTF-8?B?' . base64_encode($filename) . '?=';
        }
		elseif (strpos($user_agent, 'Safari') !== false) {
            // 生UTF-8
            $ret = $filename;
        }
		elseif (strpos($user_agent, 'Opera') !== false) {
            // 生UTF-8
            $ret = $filename;
        }
		else {
			$ret = urlencode($filename);
		}

		return $ret;
	}

}
?>