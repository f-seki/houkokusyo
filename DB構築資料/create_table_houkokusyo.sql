部局コード
経理コード
ご依頼者名
部局・室名
部屋番号
内線番号
作業開始時刻
作業終了時刻
実作業時間
サポート契約
作業担当者名
確認印
処置後状態
依頼内容
作業内容要約
作業内容詳細
create table houkokusyo(
id bigint auto_increment not null,primary key(id),
create_date datetime,
update_date datetime,
bukyoku_no int,
keiri_no int,
client_name text,
bukyoku_name text,
room_no int,
tel_no int,
work_start_time timestamp,
work_end_time timestamp,
work_hour float,
support_flg char(1),
worker_name text,
sign char(1),
work_status char(1),
work_subject text,
work_wrap_up text);

insert into houkokusyo (
create_date,
update_date,
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
sign,
work_status,
work_subject,
work_wrap_up,
work_detail,
keep_hardware,
keep_software,
keep_other,
memo,
del_flg
) value (
now(),
now(),
null,
null,
'島田',
'技術局計画部',
'1832',
'5234',
'2014/3/30 11:00',
'2014/3/30 12:00',
'1',
'1',
'関',
'0',
'1',
'PC設定作業',
null,
'PC設定を以下の通り実施しました。
▼糸川様PC対応
PC設定作業　　　　　　　　　　13:30～14:30 1.0ｈ
・NHK-ADアカウントのPC管理者権限設定
・LotusNotesインストール
→インストール後、正常に起動できなかったため再インストールし復旧。
・データ移行（LotusNotesワークスペースデータ）',
null,
null,
null,
null,
'0'
);