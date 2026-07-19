=== Disable All Comments ===
Contributors: ivanlin
Tags: comments, disable comments, remove comments, spam, security
Requires at least: 4.7
Tested up to: 6.5
Requires PHP: 7.0
Stable tag: 1.1.0
License: Apache-2.0
License URI: https://www.apache.org/licenses/LICENSE-2.0
Donate link: https://yblog.org

完全禁用 WordPress 網站的所有留言功能，包括 REST API、XML-RPC 與 RSS Feed。

== Description ==

「Disable All Comments」是一個簡單而高效的外掛，它能夠完全禁用 WordPress 網站上的所有 WordPress 官方版本程式中預設的留言功能。

主要功能：

* 禁用所有文章類型的留言支援（文章、頁面與自訂文章類型）
* 關閉所有現有文章的留言功能
* 隱藏所有已存在的留言，不影響資料庫數據
* 阻擋直接發送到 wp-comments-post.php 的 POST 請求（回應 403 Forbidden）
* 移除 REST API 中的留言端點（/wp/v2/comments）
* 停用 XML-RPC 的留言相關方法（如 wp.newComment）
* 將留言 RSS Feeds 導向至首頁，並移除 Pingback 標頭與連結
* 移除管理選單、管理工具列、儀表板小工具以及列表中的留言欄位

此外掛適合：

* 不需要留言功能的公司網站或產品展示網站
* 使用第三方留言系統的部落格（如 Facebook 留言小工具、Disqus 等）
* 需要完全關閉留言功能以減少垃圾訊息與提升效能的網站

== Installation ==

1. 將 'disable-all-comments' 目錄上傳至 '/wp-content/plugins/' 目錄，或直接在後台安裝
2. 在 WordPress 的「外掛」選單中啟用外掛
3. 啟用後，所有留言功能將立即被禁用

== Frequently Asked Questions ==

= 此外掛會刪除我資料庫中的留言嗎？ =

不會。此外掛只會隱藏和禁用留言功能，但不會刪除資料庫中已有的留言數據。

= 停用此外掛後，留言功能會恢復嗎？ =

是的。停用此外掛後，WordPress 的原生留言功能將會恢復。

= 這個外掛與其他外掛相容嗎？ =

此外掛與大多數 WordPress 主題和外掛相容。

== Changelog ==

= 1.1.0 =
* 新增：完整阻擋直接 POST 至 wp-comments-post.php 的功能
* 新增：停用 REST API 留言端點與 XML-RPC 留言方法
* 新增：移除 Pingback 標頭與連結，留言 feeds 重新導向
* 優化：移除 register_uninstall_hook 改用標準 uninstall.php 進行清理
* 優化：程式碼重構與繁體中文/英文語系標準化

= 1.0.0 =
* 初始版本發布
