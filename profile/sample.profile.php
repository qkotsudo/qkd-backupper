<?php
// プロファイルオブジェクト生成、引数はプロファイル名
$objProfile	= new QSBackUpperProfile( "www.example.com" );

// レポート設定の追加、引数は任意の設定名
$objProfile->addReportMail( "main" )
				// レポートメールの送信元を設定、引数は Fromアドレス, From名
				->setFrom( "backupper@example.com", "QS-BackUpper" )
				// レポートメールの送信先を設定
				->addTo( "report@example.com" );

// ディレクトリ設定の追加、引数は任意の設定名
$objProfile->addTargetDir( "main" )
				// ssh接続先IP
				->setSSHHost( "192.168.254.101" )
				// ssh接続のユーザ名
				->setSSHUser( "root" )
				// ssh接続で使用するキーペアの秘密鍵のファイル名、このファイル名をkeyディレクトリから探して使う
				->setSSHKey( "backupper.pem" )
				// rsyncバックアップしたいデータがあるリモートディレクトリ
				->setSrc( "/var/www/html" )
				// rsyncバックアップを保存するローカルディレクトリ、事前に作成しておく
				->setDst( "/backup/com/example/www/DocumentRoot" );

// DB設定の追加、引数は任意の設定名
$objProfile->addTargetDB( "main" )
				// ssh接続先IP
				->setSSHHost( "192.168.254.101" )
				// ssh接続のユーザ名
				->setSSHUser( "root" )
				// ssh接続で使用するキーペアの秘密鍵のファイル名、このファイル名をkeyディレクトリから探して使う
				->setSSHKey( "backupper.pem" )
				// mysqldumpの接続先ホスト
				->setDBHost( "localhost" )
				// mysqldumpの接続先ポート番号
				->setDBPort( 3360 )
				// mysqldumpの接続ユーザ名
				->setDBUser( "root" )
				// mysqldumpの接続パスワード
				->setDBPass( "password" )
				// mysqldumpで取得するデータベース名
				->setDBName( "com_example_www" )
				// ローカルで保持する最大世代
				->setDepth( 7 )
				// ローカルで月次保持するフラグ(月末のぶんを保持)
				->setMonthly( true )
				// バックアップを保存するローカルディレクトリ、事前に作成しておく
				->setDst( "/backup/com/example/www/SnapShot" );

// プロファイルを実行処理に反映
$objProfile->load();
?>