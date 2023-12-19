<?php

require_once 'task_1-2.php';

class Product {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }
}

function searchCategory($categories, $key) {
    foreach ($categories as $category):
        if ($category->getCategoryName() === $key) return $category;
    endforeach;
    return null;
}

session_start();
if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addCategory'])) {
        $newCategoryName = $_POST['categoryName'] ?? '';
        $categoryExists = false;
        foreach ($_SESSION['categories'] as $category) {
            if ($category->getCategoryName() === $newCategoryName) {
                $categoryExists = true;
                break;
            }
        }
        if (!empty($newCategoryName) && !$categoryExists) {
            $newCategory = new Category($newCategoryName, array());
            $_SESSION['categories'][] = $newCategory;
        }
    } elseif (isset($_POST['searchCategory'])) {
        $searchKey = $_POST['searchKey'] ?? '';
        $foundCategory = searchCategory($_SESSION['categories'], $searchKey);
        $performedSearch = true;
    }
    elseif (isset($_POST['addProduct'])) {
        $productName = $_POST['productName'] ?? '';
        $productPrice = $_POST['productPrice'] ?? 0;

        if (!empty($productName) && is_numeric($productPrice) && isset($_SESSION['categories'][count($_SESSION['categories']) - 1])) {
            $lastCategory = $_SESSION['categories'][count($_SESSION['categories']) - 1];
            $newProduct = new Product($productName, $productPrice);
            $productExists = false;
            foreach ($lastCategory->getCategoryProducts() as $product) {
                if ($product->getName() === $productName) {
                    $productExists = true;
                    break;
                }
            }
            if (!$productExists) $lastCategory->addProduct($newProduct);
        }
    }
}

$selectedCategory = null;
if (isset($_GET['category'])) {
    $selectedCategory = searchCategory($_SESSION['categories'], $_GET['category']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
</head>
<body>

<form method="post">
    <label for="categoryName">Category Name:</label>
    <input type="text" id="categoryName" name="categoryName" required>
    <button type="submit" name="addCategory">Add Category</button>
</form>

<hr>

<form method="post">
    <label for="searchKey">Search Category:</label>
    <input type="text" id="searchKey" name="searchKey" required>
    <button type="submit" name="searchCategory">Search</button>
</form>

<?php if (isset($foundCategory)): ?>
    <?php if ($foundCategory): ?>
        <p>Category '<?php echo $foundCategory->getCategoryName(); ?>' found!</p>
    <?php else: ?>
        <p>Category not found.</p>
    <?php endif; ?>
<?php endif; ?>

<hr>

<form method="post">
    <label for="productName">Product Name:</label>
    <input type="text" id="productName" name="productName" required>
    <label for="productPrice">Product Price:</label>
    <input type="number" id="productPrice" name="productPrice" step="0.01" required>
    <button type="submit" name="addProduct">Add Product</button>
</form>

<hr>

<h1>Categories</h1>

<?php foreach ($_SESSION['categories'] as $category): ?>
    <h2>
        <a href="?category=<?php echo urlencode($category->getCategoryName()); ?>">
            <?php echo $category->getCategoryName(); ?>
        </a>
    </h2>
    <?php if ($selectedCategory === $category): ?>
        <ul>
            <?php foreach ($category->getCategoryProducts() as $product): ?>
                <li><?php echo $product->getName(); ?> - $<?php echo $product->getPrice(); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endforeach; ?>

</body>
</html>