# kakeibo
家計簿アプリをPHPで作っていくよ

# 開発環境
・サーバー：Xserver(レンタル)
・DB：SQL

# SSH接続(ターミナル接続)
ssh -i ~/.ssh/id__rsa(ローカル秘密鍵) -l サーバーID(契約時に決めたID) -p 10022 サーバーID.xsrv.jp

# サブドメインの設定方法はXserverでGUI操作で設定可能
ドメインを１つWordpress用に持っているが、新たにドメイン取得せずに開発できるということでサブドメイン下でLaravelを構築する

# XserverのPHPバージョンアップ方法
https://yama-itech.net/xserver-laravel-install

# Xserverでのcomposerのインストール方法
Xserverは/usr/binの直下にphpバージョン毎にディレクトリが切られているので、そのディレクトリにcomposerをインストールする
sudo curl -s https://getcomposer.org/installer | /usr/bin/phpバージョンフォルダ

# composer.jsonファイルが必要なのでホームディレクトリに作成する
中身は以下にする
{
  "require": {
    "monolog/monolog":"1.0.*"
  }
}

# composerをインストールする
./composer.phar install

# フォルダ作成とリネーム
mkdir -p $HOME/bin
mv composer.phar $HOME/bin/composer

# .bashrc編集
export PATH=$HOME/bin:$PATH
