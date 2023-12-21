<?php
require_once 'SoldProduct.php';
class User
{
    private int $id;
    private string $name;
    private string $email;
    private array $boughtProducts = [];

    public function __construct($id,$name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addBoughtProduct(SoldProduct $product): void
    {
        $this->boughtProducts[] = $product;
    }

    public function getUser(): string
    {
        return "$this->name - $this->email";
    }

    public function getBoughtProducts(): array
    {
        return $this->boughtProducts;
    }
}