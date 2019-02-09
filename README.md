# qs-backupper
コマンドライン実行によるシンプルなｐバックアップスクリプト  
1台のサーバから複数台のクライアントに対してpullでバックアップできる  
  
まだバリデーションとかチェック機能全然ないアルファ版  
  
# 使い方
① サーバ上で git clone https://github.com/qkotsudo/qs-backupper.git  
② ssh-key-gen -t rsa で keys に専用の鍵を作る  
③ 専用の鍵をクライアントの対象ユーザの .ssh/authorized_keys に追記
④ profile/sample.profile.php を複製&編集してプロファイル用意  
⑤ php backup.php を cron にでも仕込む  
⑥ 安心して寝る  