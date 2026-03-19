<?php

/**
 * Solution.php
 * Câu 2: Xử lý dữ liệu sản phẩm bằng PHP (OOP)
 *
 * Tác giả: Kyanon KFresh Trainee - 2026
 */

// ============================================================
// 1. Định nghĩa lớp Product (OOP)
// ============================================================

class Product
{
    public int $id;
    public string $name;
    public float $price;
    public string $category;

    public function __construct(int $id, string $name, float $price, string $category)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->price    = $price;
        $this->category = $category;
    }

    /**
     * Hiển thị thông tin sản phẩm dạng chuỗi.
     */
    public function __toString(): string
    {
        return sprintf(
            "[ID: %d] %-30s | Giá: %10s VNĐ | Danh mục: %s",
            $this->id,
            $this->name,
            number_format($this->price, 0, ',', '.'),
            $this->category
        );
    }
}

// ============================================================
// 2. Khởi tạo danh sách sản phẩm (ít nhất 5 sản phẩm)
// ============================================================

$products = [
    new Product(1, 'MacBook Pro 14 inch M3',     45_000_000, 'Laptop'),
    new Product(2, 'Dell XPS 15',                35_000_000, 'Laptop'),
    new Product(3, 'iPhone 15 Pro Max',           32_000_000, 'Điện thoại'),
    new Product(4, 'Samsung Galaxy S24 Ultra',    28_000_000, 'Điện thoại'),
    new Product(5, 'Sony WH-1000XM5',             8_500_000,  'Phụ kiện'),
    new Product(6, 'Apple AirPods Pro 2',          6_000_000,  'Phụ kiện'),
    new Product(7, 'iPad Pro 12.9 inch M2',       26_000_000, 'Máy tính bảng'),
];

// ============================================================
// 3. Hàm lọc sản phẩm theo danh mục
// ============================================================

/**
 * Lọc danh sách sản phẩm theo tên danh mục (không phân biệt hoa thường).
 *
 * @param  Product[] $products     Danh sách sản phẩm đầu vào
 * @param  string    $categoryName Tên danh mục cần lọc
 * @return Product[]               Danh sách sản phẩm thuộc danh mục đó
 */
function filterProductsByCategory(array $products, string $categoryName): array
{
    return array_values(
        array_filter($products, function (Product $product) use ($categoryName): bool {
            return strcasecmp($product->category, $categoryName) === 0;
        })
    );
}

// ============================================================
// 4. Hàm áp dụng giảm giá
// ============================================================

/**
 * Giảm giá tất cả sản phẩm theo phần trăm và trả về danh sách mới
 * (không làm thay đổi danh sách gốc – immutable approach).
 *
 * @param  Product[] $products Danh sách sản phẩm gốc
 * @param  float     $percent  Phần trăm giảm giá (ví dụ: 10 = giảm 10%)
 * @return Product[]           Danh sách sản phẩm mới với giá đã cập nhật
 * @throws InvalidArgumentException Nếu phần trăm không hợp lệ (< 0 hoặc > 100)
 */
function applyDiscount(array $products, float $percent): array
{
    if ($percent < 0 || $percent > 100) {
        throw new InvalidArgumentException("Phần trăm giảm giá phải nằm trong khoảng 0 - 100.");
    }

    $multiplier = 1 - ($percent / 100);

    return array_map(function (Product $product) use ($multiplier): Product {
        // Tạo bản sao để giữ nguyên object gốc
        $discounted        = clone $product;
        $discounted->price = round($product->price * $multiplier, 0);
        return $discounted;
    }, $products);
}

// ============================================================
// 5. Hàm tiện ích: In danh sách sản phẩm
// ============================================================

/**
 * In danh sách sản phẩm ra màn hình.
 *
 * @param Product[] $products    Danh sách sản phẩm cần in
 * @param string    $title       Tiêu đề hiển thị
 */
function printProductList(array $products, string $title = 'Danh sách sản phẩm'): void
{
    echo "\n" . str_repeat('=', 80) . "\n";
    echo "  {$title}\n";
    echo str_repeat('=', 80) . "\n";

    if (empty($products)) {
        echo "  (Không có sản phẩm nào.)\n";
    } else {
        foreach ($products as $index => $product) {
            echo "  " . ($index + 1) . ". {$product}\n";
        }
    }

    echo str_repeat('-', 80) . "\n";
    echo "  Tổng số: " . count($products) . " sản phẩm\n";
}

// ============================================================
// 6. DEMO – Chạy thử các chức năng
// ============================================================

echo "\n";
echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║          XỬ LÝ DỮ LIỆU SẢN PHẨM BẰNG PHP - KYANON KFRESH 2026            ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n";

// --- Hiển thị tất cả sản phẩm ---
printProductList($products, 'TẤT CẢ SẢN PHẨM');

// --- Lọc theo danh mục: Laptop ---
$laptops = filterProductsByCategory($products, 'Laptop');
printProductList($laptops, 'SẢN PHẨM DANH MỤC: Laptop');

// --- Lọc theo danh mục: Phụ kiện ---
$accessories = filterProductsByCategory($products, 'Phụ kiện');
printProductList($accessories, 'SẢN PHẨM DANH MỤC: Phụ kiện');

// --- Áp dụng giảm giá 15% cho toàn bộ sản phẩm ---
$discountPercent   = 15;
$discountedProducts = applyDiscount($products, $discountPercent);
printProductList($discountedProducts, "SẢN PHẨM SAU KHI GIẢM GIÁ {$discountPercent}%");

// --- Kết hợp: Lọc Điện thoại rồi giảm 20% ---
$phones           = filterProductsByCategory($products, 'Điện thoại');
$discountedPhones = applyDiscount($phones, 20);
printProductList($discountedPhones, 'ĐIỆN THOẠI ĐƯỢC GIẢM GIÁ 20%');

echo "\nHoàn thành!\n\n";
