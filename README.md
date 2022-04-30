# kakeibo
家計簿アプリをPHPで作っていくよ

#開発環境
・サーバー：Xserver(レンタル)
・DB：SQL

#SSH接続(ターミナル接続)
ssh -i ~/.ssh/id__rsa(ローカル秘密鍵) -l サーバーID(契約時に決めたID) -p 10022 サーバーID.xsrv.jp

#サブドメインの設定方法はXserverでGUI操作で設定可能
ドメインを１つWordpress用に持っているが、新たにドメイン取得せずに開発できるということでサブドメイン下でLaravelを構築する

