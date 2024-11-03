安裝
=
資料庫名稱預設為 simple

修改後請執行
```
bash build.sh
```
結束後再執行
```
php artisan simple:install
```
以上安裝完以後便會有基礎的資料方便測試

說明
=
#### 這是一個展示後端技能的專案

### API相關文件
參考連結：

### 資料庫

1. Item為要買賣的書籍, 目前可存取內容包括書名、首張圖片、描述、書本簡介等
2. Image為個書籍圖片, 透過關聯每本書籍可以擁有數張圖片, 用以輔助買家查看書本情況
3. User為會員, 可透過UserGroup來設定相關權限, 日後此處可能改為管理員使用, 並將會員存至名為Member的表

### 主要文件(Contorller、Models、Service、Resource)

1. Controller 會呼叫對應的Service 如 ItemService 與 ImageService 輔助CRUD的操作
2. Service 的BaseService 為Service文件最原始樣式, 可重複利用的功能會放在這裡, 目前只有上傳與刪除圖片檔案並回傳路徑的功能
3. Models 資料表關聯為每個商品可以有數張圖片(Item vs Image), 每個群組可以有多個會員, 每個會員可以出售多項產品
4. Resource 用來處理回傳的資料, 如ItemResource會回傳Item的資料以及相關會用到的資料
5. 文件路徑<br>
App/Http/Controller<br>
App/Http/Resource<br>
App/Service<br>
App/Models<br>

### 輔助文件(Seeder、Command)
1. Seeders 資料夾有json 裡面的資料皆是要存入資料庫中, 若有需求也可自行加入
2. Command 主要負責安裝seeders/json內的檔案, 將相關資料寫入資料庫中
3. 文件路徑<br>
Database/seeders<br>
App/Console/Commands<br>
