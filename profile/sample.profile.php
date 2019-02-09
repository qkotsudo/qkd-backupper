<?php
$objProfile	= new QSBackUpperProfile( "www.example.com" );

$objProfile->setHost( "192.168.100.100" );

$objProfile->setUser( "root" );

$objProfile->setKey( "example.id_rsa.pub" );

$objProfile->addReportMail( "main" )
				->setFrom( "backupper@storage.example.com", "Example BackUp Process" )
				->addTo( "john.smith@example.com" );

$objProfile->addTargetDir( "main" )
				->setSrc( "/data/app/com/example/www/htdocs" )
				->addIgnore( "log" )
				->addIgnore( "tmp" )
				->setDst( "/backup/app/com/example/www/htdocs" );

$objProfile->addTargetDB( "main" )
				->setHost( "localhost" )
				->setPort( 3360 )
				->setUser( "root" )
				->setPassword( "password" )
				->setDataBase( "com_example_www" )
				->setDepth( 7 )
				->setDst( "/backup/app/com/example/www/mysql" );

$objProfile->load();
?>