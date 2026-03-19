<?php

// =============================================
// Câu 2: Xử lý dữ liệu sản phẩm bằng PHP (OOP)
// =============================================

// 1. Định nghĩa lớp Product
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
}

// 2. Khởi tạo danh sách sản phẩm (ít nhất 5 sản phẩm)
$products = [
    new Product(1, 'MacBook Pro M3',        45000000, 'Laptop'),
    new Product(2, 'Dell XPS 15',           35000000, 'Laptop'),
    new Product(3, 'iPhone 15 Pro Max',     32000000, 'Điện thoại'),
    new Product(4, 'Samsung Galaxy S24',    28000000, 'Điện thoại'),
    new Product(5, 'Sony WH-1000XM5',        8500000, 'Phụ kiện'),
    new Product(6, 'Apple AirPods Pro 2',    6000000, 'Phụ kiện'),
    new Product(7, 'iPad Pro M2',           26000000, 'Máy tính bảng'),
];

// 3. Hàm lọc sản phẩm theo danh mục
function filterProductsByCategory(array $products, string $categoryName): array
{
    return array_values(
        array_filter($products, fn($p) => strtolower($p->category) === strtolower($categoryName))
    );
}

// 4. Hàm áp dụng giảm giá (trả về danh sách mới, không thay đổi danh sách gốc)
function applyDiscount(array $products, float $percent): array
{
    if ($percent < 0 || $percent > 100) {
        throw new InvalidArgumentException('Phần trăm giảm giá phải từ 0 đến 100.');
    }

    return array_map(function ($p) use ($percent) {
        $new        = clone $p;
        $new->price = round($p->price * (1 - $percent / 100));
        return $new;
    }, $products);
}

// Hàm tiện ích: in danh sách sản phẩm
function printProducts(array $products, string $title): void
{
    echo "\n--- $title ---\n";
    if (empty($products)) {
        echo "Không có sản phẩm nào.\n";
        return;
    }
    foreach ($products as $p) {
        echo '[' . $p->id . '] ' . $p->name . ' | ' . number_format($p->price, 0, ',', '.') . ' VND | ' . $p->category . "\n";
    }
}

// =============================================
// Demo chạy thử
// =============================================

printProducts($products, 'Tất cả sản phẩm');

$laptops = filterProductsByCategory($products, 'Laptop');
printProducts($laptops, 'Sản phẩm danh mục: Laptop');

$accessories = filterProductsByCategory($products, 'Phụ kiện');
printProducts($accessories, 'Sản phẩm danh mục: Phụ kiện');

$discounted = applyDiscount($products, 15);
printProducts($discounted, 'Tất cả sản phẩm sau khi giảm giá 15%');
