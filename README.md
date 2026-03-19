# Kyanon-KFresh-Trainee-Test-2026

Bài kiểm tra đầu vào cho vị trí **Magento/Drupal Trainee** tại **Kyanon Digital**.

---

##  Cấu Trúc Repository

```
Kyanon-KFresh-Trainee-Test-2026/
├── Report.md       # Câu 1 – Báo cáo nghiên cứu so sánh Magento/Drupal & Headless CMS
├── Solution.php    # Câu 2 – Giải pháp PHP xử lý dữ liệu sản phẩm (OOP)
└── README.md       # File này – Hướng dẫn và mô tả dự án
```

---

##  Mô Tả Nội Dung

### Câu 1 – `Report.md`
Báo cáo nghiên cứu khoảng 300–500 chữ, bao gồm:
- So sánh Magento (E-commerce) vs Drupal (CMS) về mục đích sử dụng, điểm mạnh/yếu.
- 3 thành phần Tech Stack quan trọng: Web Server (Nginx), Database (MySQL/MariaDB), Caching (Redis/Varnish).
- Giải thích khái niệm **Headless CMS** và lợi thế trong phát triển web hiện đại.

### Câu 2 – `Solution.php`
Mã nguồn PHP 
- Lớp `Product` với các thuộc tính: `id`, `name`, `price`, `category`.
- Hàm `filterProductsByCategory($products, $categoryName)` – lọc sản phẩm theo danh mục.
- Hàm `applyDiscount($products, $percent)` – giảm giá toàn bộ sản phẩm, trả về danh sách mới (immutable).
- Demo chạy thực tế: lọc Laptop, Phụ kiện, Điện thoại; áp dụng giảm giá 15% và 20%.

---

## Cách Chạy File PHP

### Yêu cầu
- PHP >= 8.0 đã được cài đặt và thêm vào PATH.

### Kiểm tra phiên bản PHP
```bash
php -v
```

### Chạy Solution.php
```bash
php Solution.php
```

### Kết quả mong đợi
Script sẽ in ra console:
1. Toàn bộ 7 sản phẩm ban đầu
2. Danh sách sản phẩm lọc theo từng danh mục (Laptop, Phụ kiện, Điện thoại)
3. Danh sách sản phẩm sau khi áp dụng các mức giảm giá

---

##  Các Bước Thực Hiện

1. Nghiên cứu đề bài và tìm hiểu về Magento, Drupal, Headless CMS.
2. Viết báo cáo nghiên cứu vào `Report.md`.
3. Xây dựng giải pháp PHP với tư duy OOP vào `Solution.php`.
4. Khởi tạo Git repository, commit và push lên GitHub.
