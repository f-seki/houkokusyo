<?php
/* 
 * 定数定義クラス
 */

define( 'HOME_DIR' , dirname(__FILE__).'/');						// ホームディレクトリ（このファイルをincludeするときのパスには使えない）
define( 'REPORT_SAVE_DIR' , 'output/');						// 報告書保存ディレクトリー
define( 'PHPEXCEL_LIB_DIR' , $_SERVER["DOCUMENT_ROOT"].'/Classes/');
/* 一般 */
define( 'NENGOU' , '平成');						// 和暦年号
define( 'HEISEI_BIGIN' , 1988);					// 平成0年の西暦（現在の西暦-平成0年の西暦=現在の和暦）

/* 作業報告書　項目 */
define( 'SIGN_NO' , '0');						// 確認印 -> 無し
define( 'SIGN_YES' , '1');						// 確認印 -> 有り
define( 'SUPPORT_NO' , '0');					// サポート契約 -> 無し
define( 'SUPPORT_YES' , '1');					// サポート契約 -> 有り
define( 'WORK_STATUS_CONTINUE' , '0');			// 処理状態 -> 継続作業
define( 'WORK_STATUS_COMPLEAT' , '1');			// 処理状態 -> 処理完了
define( 'DATA_SHIFT_NO' , '0');					// サポート契約 -> 無し
define( 'DATA_SHIFT_YES' , '1');					// サポート契約 -> 有り
?>