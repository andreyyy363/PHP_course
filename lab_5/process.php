<?php

// Базовий клас Product
class Product
{
    public string $name;    
    public string $description;
    protected float $price;

    public function __construct(string $name, float $price, string $description)
    {
        if ($price < 0) {
            throw new InvalidArgumentException("Ціна не може бути від'ємною.");
        }
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getInfo(): string
    {
        return "Назва: {$this->name}<br>Ціна: {$this->price}<br>Опис: {$this->description}<br>";
    }
}

// Похідний клас DiscountedProduct
class DiscountedProduct extends Product
{
    public float $discount;

    public function __construct(string $name, float $price, string $description, float $discount)
    {
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }

    public function getDiscountedPrice(): float
    {
        return $this->price * (1 - $this->discount / 100);
    }

    public function getInfo(): string
    {
        $discountedPrice = $this->getDiscountedPrice();
        return parent::getInfo() . "Знижка: {$this->discount}%<br>Нова ціна: {$discountedPrice}<br>";
    }
}

// Додатковий клас Category
class Category
{
    public string $name;
    public array $products;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->products = [];
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProductsInfo(): string
    {
        $info = "Категорія: {$this->name}<br>";
        foreach ($this->products as $product) {
            $info .= $product->getInfo() . "<br>";
        }
        return $info;
    }
}

// Створення об'єктів класу Product
$product1 = new Product("Ноутбук", 1500.00, "Потужний ноутбук для роботи та ігор.");
$product2 = new Product("Планшет", 500.00, "Компактний планшет для розваг та роботи.");

// Створення об'єктів класу DiscountedProduct
$discountedProduct1 = new DiscountedProduct("Телефон", 1000.00, "Сучасний смартфон з великим екраном.", 10);
$discountedProduct2 = new DiscountedProduct("Навушники", 200.00, "Безпровідні навушники з шумозаглушенням.", 15);

// Виведення інформації про кожен товар
echo $product1->getInfo() . "<br>";
echo $product2->getInfo() . "<br>";
echo $discountedProduct1->getInfo() . "<br>";
echo $discountedProduct2->getInfo() . "<br>";

// Створення об'єкта класу Category та додавання товарів
$category = new Category("Електроніка");
$category->addProduct($product1);
$category->addProduct($product2);

// Виведення інформації про всі товари в категорії
echo $category->getProductsInfo();

// Створення об'єкта класу Category та додавання товарів зі знижкою
$discountCategory = new Category("Товари зі знижкою");
$discountCategory->addProduct($discountedProduct1);
$discountCategory->addProduct($discountedProduct2);

// Виведення інформації про всі товари в категорії
echo $discountCategory->getProductsInfo();

?>