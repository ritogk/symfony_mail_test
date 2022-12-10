■symfony のメール送信のしかたがわかんね。
公式ドキュメント通り動かしたらテーブルがないっていわれる
そのテーブルどこで作るの?
公式の migration あたりになにか書いてないか?
https://symfony.com/doc/current/doctrine.html#installing-doctrine
書いてない。手動でエンティティ作って DB に反映させる方法しか書いてない。

worker を動かさないといけないっぽい?
php bin/console messenger:consume async
インストール方法はどこに書いてある?
カルテットだとなんで動いている?

メッセンジャーを使うと勝手にテーブルが作成されるらしい?
https://github.com/symfony/symfony/issues/46609

トランスポート、ディスパッチってなんだ?

symfony の sendmail ってなんなんだ?
→ https://symfony.com/doc/current/mailer.html#installation
symfony に内蔵されたメーラー?滋賀さんとか菱田さんが言ってたのはこれか?
よくわかんね。

メッセンジャー経由でメール送信処理を委託しているからエラーがでているっぽい
https://github.com/symfony/symfony/discussions/46556

こいつを実行すれば必要なテーブルが作られるっぽい. auto_setup=0(false)だから作られないのか?そうでしたー。
bin/console messenger:setup-transports

ワーカーを動かす
php bin/console messenger:consume async

これでメール送信はいけた

次はファイルの添付や!
form entity 使ってないからかふつうに普通に送信できちゃった。

次は無限の処理をマネてみよう。
フォーム作って送信までやりたいな
→ https://symfony.com/doc/current/reference/forms/types/file.html

メールテンプレの twig に画像ファイルを送ってるのが問題っぽい
https://symfony.com/doc/current/mailer.html#text-content
→templateEmail で twig にわたす context は serialize 可能である必要ありらしい。(非同期でメールを送信するときのみ)

.env いじれば同期的にメールをおくれるのか?

シリアライズと json の違い
https://9-bb.com/serialize-json/
シリアライズだとエンコードできない場合があるらしい、ただし速度は早い。

## symfony 初心者が添付ファイル付きのメール送信で苦戦した話
