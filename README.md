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
プログラミングスクールのテックキャンプではRuby on Railsを用いてアプリ作成を学んだので、アプリ2作目は別の言語を独学で学んでアプリ実装にチャレンジしたいと思いました。
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
<img width="1131" alt="promo2" src="https://user-images.githubusercontent.com/66307448/90221509-4336dc80-de45-11ea-8bb5-bada0ac0ce6c.gif">

## 工夫したポイント
- 自分のプログラミング学習のアウトプットようとして、使いやすい様にマークダウン記法の採用は優先順位が高い機能でした。<br>
- メモ用途がメインとなるため、スマホでも閲覧、書き込みが可能になるようレスポンシブデザインにしました。<br>
- ページに接続して直ぐにメモが取れる様に、トップ画面のみで新規投稿と投稿の一覧表示のを両方行える画面構成にしました。<br>
- 学習内容を閲覧しやすい様に、デザインはシンプルにしました。

## 使用技術（開発環境）
PHP/Laravel/Composer/Laravel Valet/Haml/Sass/PostgreSQL/Github/Heroku/Visual Studio Code <br>
- PHP 7.3.20 <br>
- Homebrew	2.4.9 <br>
- Composer　1.10.9 <br>
- Laravel Valet  2.11.0 <br>
- Laravel Mix <br>
- PostgreSQL　12.3 <br>

## 今後実装したい機能
* 検索機能 <br>
* 1つの投稿内で複数の画像を任意の位置に挿入する <br>
* リファクタリング（DRY原則）

## DB設計

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
