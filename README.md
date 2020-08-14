# README

## アプリ名
myblog

## 概要
### 2作目の個人開発　ブログアプリ
主な機能： <br>
- ユーザー登録機能 <br>
- ブログ記事の投稿/編集/削除 <br>
- 記事入力テキストにマークダウン記法を採用 <br>
- ページネーション機能（１ページに5件の記事を表示） <br>
- 各種バリデーション（作成者のみ記事の編集/削除が可能）

## 制作背景
営業職からITエンジニアに転職することを目指して、プログラミング学習を始めて最初に作った２作目のアプリです。<br>
現在はテックキャンプでの短期転職コースを卒業して転職活動中。<br>

自身が日々学習している内容をメモに書き留めておきたいが、Twitterでは文字制限があり書ききれない。 <br>
Qiitaなどの技術ブログは、技術情報の共有、発信の目的として利用されており、個人のメモ書きには適切では無い。 <br>
自身が日々学んだことをディテールに拘らず、自由に書き留めておけるメモアプリが欲しくて作りました。

### 制作前の構想
テックキャンプではRuby on Railsを用いてアプリ作成を学んだので、アプリ2作目は別の言語を独学で学んでアプリ実装にチャレンジしたいと思いました。
- プログラミング言語は求人募集の多いものを選ぶ ->　PHPを採用 <br>
- 実戦で生かせるようにフレームワークを使用する <br>
- フレームワークはWEB制作アプリとして人気の高いものを選ぶ <br>
- Ruby on Rails のMVCやCRUDの概念を継承しているため、制作工程が理解しやすそうという理由で、Laravelを採用 <br>
- Laravelはバージョンアップの頻度が高い。今後実戦でも常に新しい情報を取り入れ成長する必要があるので、現時点での最新バージョンを使う <br>
- 環境構築方法はDockerを利用して開発環境を流用しやすい方法や、Homestead/VirtualBoxといった仮想OSを構築してWindows環境でも <br>
使えるものがありましたが、個人がノートPCでアプリ制作することを考慮してPCへの負荷が少ない方法と思い、Laravel Valetを利用しました。 <br>
- 同様の理由でDBはPostgreSQL、本番環境はHerokuに決定

## DEMO


<img width="1131" alt="promo1" src="https://user-images.githubusercontent.com/66307448/90219453-0b2d9a80-de41-11ea-9438-06c031334243.png">
![promo2 mov](https://user-images.githubusercontent.com/66307448/90219730-aaeb2880-de41-11ea-8e35-5968af913f58.gif)

## 工夫したポイント
全体公開チャットは2ch等の掲示板を意識していますが、キーワードやタイトルだけで記事の魅力を伝えるよりも、<br>
記事に関連する特徴的な画像をピックアップ画面としてトップページに表示することで、利用者に魅力が伝わりやすく、見た目も華やかになると思い実装しました。<br>
同様の観点からユーザーのアバター画像も付けました。

## 使用技術（開発環境）
Ruby/Ruby on Rails/JavaScript/jQuery/Haml/Sass/MySQL/Github/AWS/Visual Studio Code <br>
* Ruby 2.6.5 <br>
* Ruby on Rails 6.0.0 <br>
* gem 'devise' <br>
* gem 'Capistrano' 3.14.1 <br>
* gem 'acts-as-taggable-on'

## 今後実装したい機能
* 検索機能の拡張<br>
* 動画の投稿<br>
* 見た目を格好良くJavaScriptで装飾する<br>
* リファクタリング（DRY原則）

## DB設計

### user_groupsテーブル

|Column|Type|Options|
|------|----|-------|
|user_id|integer|null: false, foreign_key: true|
|group_id|integer|null: false, foreign_key: true|

#### Association
- belongs_to :group
- belongs_to :user

### usersテーブル

|Column|Type|Options|
|------|----|-------|
|email|integer|null: false|
|password|integer|null: false|
|name|string|null: false|
|password confirmation|integer|null: false|
|image|text|

#### Association
- has_many :group_users
- has_many :tag_users
- has_many :groups, through: :group_users
- has_many :tags, through: :tag_users
- has_many :messages

### groupsテーブル

|Column|Type|Options|
|------|----|-------|
|name|string|null: false|

#### Association
- has_many :group_users
- has_many :tag-groups
- has_many :users, through: :group_users
- has_many :tags, through: :tag-groups
- has_many :messages

### messagesテーブル

|Column|Type|Options|
|------|----|-------|
|text|text||
|image|text||
|user_id|integer|null: false, foreign_key: true|
|group_id|integer|null: false, foreign_key: true|

#### Association
- belongs_to :group
- belongs_to :user

### all_users_chatsテーブル

|Column|Type|Options|
|------|----|-------|
|name|string||
|image|string||
|user_id|integer|null: false, foreign_key: true|

#### Association
- has_many :comments
- belongs_to :user

### commentsテーブル

|Column|Type|Options|
|------|----|-------|
|content|string||
|image|string||
|user_id|integer|null: false, foreign_key: true|
|all_users_chat_id|integer|null: false, foreign_key: true|

#### Association
- belongs_to :all_users_chat
- belongs_to :user

### tag_usersテーブル

|Column|Type|Options|
|------|----|-------|
|user_id|integer|null: false, foreign_key: true|
|tag_id|integer|null: false, foreign_key: true|

#### Association
- belongs_to :tag
- belongs_to :user

### taggingsテーブル
|Column|Type|Options|
|------|----|-------|
|tag_id|integer|null: false, foreign_key: true|
|taggable_id|integer|null: false, foreign_key: true|

#### Association
- belongs_to :tag
- belongs_to :all_users_chat

### tagsテーブル
|Column|Type|Options|
|------|----|-------|
|name|string|null: false|

#### Association
- has_many :taggings
- has_many :all_users_chats, through: :taggings
