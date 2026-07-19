# Disable All Comments (關閉所有留言)

完全禁用 WordPress 網站的所有留言功能，包括 REST API、XML-RPC 與 RSS Feed。

## 說明

**Disable All Comments** 是一款輕量且高效的 WordPress 外掛，可完全禁用網站上所有的原生留言功能。它特別適用於不需要留言功能的網站（例如企業官網、產品展示頁、登陸頁）或使用第三方留言系統（如 Facebook Comments、Disqus）的部落格，能有效減少垃圾留言並節省伺服器資源。

### 主要功能
- **禁用留言支援：** 自所有文章類型（文章、頁面與自訂文章類型）中移除留言及引用（Trackbacks）支援。
- **隱藏現有留言：** 在前端範本中隱藏所有已存在的留言，不影響資料庫中的任何原始紀錄。
- **防止直接提交：** 阻擋直接對 `wp-comments-post.php` 發送的 HTTP POST 請求，並回應 `403 Forbidden`。
- **停用 API 與 XML-RPC：** 移除 WordPress REST API 留言端點（`/wp/v2/comments`），並停用 XML-RPC 的留言相關方法（例如 `wp.newComment`）。
- **清理 Feeds 與 Pingbacks：** 將留言的 RSS Feeds 重新導向至網站首頁，並移除 Pingback 的 HTTP 標頭（`X-Pingback`）及連結。
- **美化管理後台：** 隱藏管理選單中的「留言」選項、上方管理工具列的留言圖示、儀表板的近期留言小工具，以及文章/頁面列表的留言統計欄位。

## 安裝步驟

1. 將 `disable-all-comments` 資料夾上傳至網站的 `/wp-content/plugins/` 目錄，或直接透過 WordPress 後台的「外掛 > 安裝外掛」功能進行上傳安裝。
2. 在 WordPress 的「外掛」頁面中啟用此外掛。
3. 啟用後，全站的留言功能將立即被完全禁用。

## 常見問題

### 此外掛會刪除我資料庫中的舊留言嗎？
不會。此外掛僅會隱藏前端顯示並阻擋新的留言寫入，絕不會修改或刪除資料庫中已有的留言數據。

### 停用外掛後，留言功能會恢復嗎？
會的。一旦停用此功能，WordPress 原生的留言功能將立即恢復正常運作。

## 授權條款

本專案採用 Apache License 2.0 授權。詳情請參閱 [LICENSE](LICENSE) 檔案。
