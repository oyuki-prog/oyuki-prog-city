# Sumeba ― 我が街自慢サイト

## About This App
* 自分の街の自慢ができるアプリ

## テーブル定義
* 県名テーブル･･･県名
* カテゴリーテーブル･･･カテゴリー名
* 記事テーブル･･･記事情報
* ユーザーテーブル･･･ユーザー情報
* イメージテーブル･･･記事に添付する画像パス
https://docs.google.com/spreadsheets/d/1X0cjk493kWx-3MrJRX8Xl4ieKYd9baKEe6p3OPlFIZw/edit#gid=0

## 実装機能
* CRUD
  * 記事情報のCRUD機能
  * ユーザー情報のCRUD機能
* 検索
  * フリーワード検索
  * タイトル、本文、県名、市町村名から検索
* ファイルアップロード
  * メイン画像、記事画像、ユーザーアイコンを登録可能
  * 記事削除の際にストレージから画像削除

## 工夫した点
* カテゴリー、地名リンク
  * 記事のカテゴリーや地名をクリックすると、絞り込んだ結果を表示
* 詳細画面
  * メイン画像を背景として表示
  * 記事画像を複数アップロードし、表示できるようにした
* ユーザーページ
  * ユーザーアイコンのプレビュー機能
  * ユーザーの記事一覧を表示
* ユーザー認証
  * 記事の投稿は登録ユーザーでないとできない
  * 編集、削除は自分の記事のときのみ表示

## 画面

### 一覧画面
<img width="1680" alt="スクリーンショット 2021-10-06 22 29 23" src="https://user-images.githubusercontent.com/89429515/136211970-69c914b1-6cf3-4d56-9306-ad7e36f9ae13.png">

### 検索後画面
<img width="1679" alt="スクリーンショット 2021-10-06 22 25 52" src="https://user-images.githubusercontent.com/89429515/136211759-b9ba9353-666f-4f5d-bac8-93ffa4010d0a.png">

### 投稿画面
<img width="842" alt="スクリーンショット 2021-10-06 22 20 01" src="https://user-images.githubusercontent.com/89429515/136212091-2ecafe0d-9209-40b5-8b0f-24e8aa891cb2.png">

### 詳細画面
<img width="1680" alt="スクリーンショット 2021-10-06 22 20 40" src="https://user-images.githubusercontent.com/89429515/136212315-e50ff2e1-6cd0-4dcb-9ad9-edc54f8957a7.png">

### 編集画面
<img width="1680" alt="スクリーンショット 2021-10-06 22 25 24" src="https://user-images.githubusercontent.com/89429515/136212180-eec2889e-6e59-4995-b140-b006f3129556.png">

### ユーザーページ
<img width="1680" alt="スクリーンショット 2021-10-06 22 24 23" src="https://user-images.githubusercontent.com/89429515/136212475-195c564f-0d37-4b33-b658-b58a88fd188f.png">
