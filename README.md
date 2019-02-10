# qs-backupper
コマンドライン実行によるシンプルなｐバックアップスクリプト  
1台のサーバから複数台のクライアントに対してpullでバックアップできる  
処理対象をプロファイル単位で管理可能  
  
まだバリデーションとかチェック機能が全然足りてないアルファ版  
  
# 使い方
① サーバ上で git clone https://github.com/qkotsudo/qs-backupper.git  
② ssh-keygen -t rsa で keys ディレクトリ内に専用のキーペアを作る  
③ 専用キーペアの公開鍵をクライアントの対象ユーザの .ssh/authorized_keys に追記  
④ profile/sample.profile.php を複製&編集してプロファイル用意  
⑤ php backup.php を cron にでも仕込む  
⑥ 安心して寝る  
  
# 動作環境
CentOS 6.x / 7.x 上の php 5.4 & 7.3 で挙動確認済み  
レポートメールを送信する場合は別途設定済みなこと  
鍵によるパスワードなし接続なので、サーバのセキュリティ対策は各自しっかり  
  
# ToDo
・レポートメール送信時の外部SMTPやSES等の利用  
・postgres 対応  
・rsync の ignore 対応  
・レポート方法に slack や Typetalk を追加  