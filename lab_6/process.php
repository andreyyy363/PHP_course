<?php

interface AccountInterface
{
    public function deposit(float $amount): void;
    public function withdraw(float $amount): void;
    public function getBalance(): float;
}

class BankAccount implements AccountInterface
{
    const MIN_BALANCE = 0;

    protected float $balance;
    protected string $currency;

    public function __construct(string $currency)
    {
        $this->balance = self::MIN_BALANCE;
        $this->currency = $currency;
    }

    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new Exception("Некоректна сума для поповнення");
        }
        $this->balance += $amount;
    }

    public function withdraw(float $amount): void
    {
        if ($amount <= 0) {
            throw new Exception("Некоректна сума для зняття");
        }
        if ($amount > $this->balance) {
            throw new Exception("Недостатньо коштів");
        }
        $this->balance -= $amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}

class SavingsAccount extends BankAccount
{
    public static float $interestRate;

    public static function setInterestRate(float $rate): void
    {
        self::$interestRate = $rate;
    }

    public function applyInterest(): void
    {
        $interest = $this->balance * (self::$interestRate / 100);
        $this->balance += $interest;
    }
}


// Створення об'єктів
$account1 = new BankAccount("USD");
$account2 = new SavingsAccount("USD");

// Встановлення відсоткової ставки для накопичувального рахунку
SavingsAccount::setInterestRate(5.0);

// Поповнення рахунків
$account1->deposit(100);
$account2->deposit(200);

// Зняття коштів
$account1->withdraw(50);
$account2->withdraw(100);

// Застосування відсотків
$account2->applyInterest();

// Виведення балансу
echo "Баланс рахунку 1: " . $account1->getBalance() . " USD<br>";
echo "Баланс накопичувального рахунку 2: " . $account2->getBalance() . " USD<br>";

// Виклик винятків

// Поповнення на від'ємну суму
try {
    $account1->deposit(-10);
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

// Зняття від'ємної суми
try {
    $account1->withdraw(-10);
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

// Зняття більшої суми, ніж є на рахунку
try {
    $account2->withdraw(200);
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}
