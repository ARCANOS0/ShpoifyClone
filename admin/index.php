<?php
// admin/add_product.php

session_start();
require_once __DIR__ . '/config/db.php';

// Fetch categories for the dropdown (optional)
$stmt = $pdo->query("SELECT id, name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. sanitize inputs
    $name        = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price       = filter_input(INPUT_POST,'price',FILTER_VALIDATE_FLOAT);
    $category_id = filter_input(INPUT_POST,'category_id',FILTER_VALIDATE_INT);

    // 2. validate
    if ($name === '' || $price === false || !$category_id || !isset($_FILES['image'])) {
        $message = "Please fill in all fields and choose an image.";
    } else {
        // 3. handle upload
        $img       = $_FILES['image'];
        $ext       = strtolower(pathinfo($img['name'],PATHINFO_EXTENSION));
        $allowed   = ['jpg','jpeg','png','gif'];
        if ($img['error']===0 && in_array($ext,$allowed)) {
            // generate unique filename
            $newName = uniqid('prod_',true) . "." . $ext;
            $target  = __DIR__ . "/../pic/" . $newName;
            if (move_uploaded_file($img['tmp_name'],$target)) {
                // 4. insert into DB
                $sql = "INSERT INTO products 
                          (name, description, price, category_id, image, is_available) 
                        VALUES 
                          (:n,:d,:p,:c,:i,1)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                  'n'=>$name,
                  'd'=>$description,
                  'p'=>$price,
                  'c'=>$category_id,
                  'i'=>$newName
                ]);
                $message = "Product “{$name}” added successfully.";
            } else {
                $message = "Failed to move uploaded file.";
            }
        } else {
            $message = "Invalid image. Allowed: jpg, png, gif.";
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Product</title>
  <link rel="stylesheet" href="../all.css">
  <style> body{padding:2rem;font-family:sans-serif;} form{max-width:400px;} label{display:block;margin-top:1rem;} </style>
</head>
<body>
  <h1>Add New Product</h1>
  <?php if($message): ?>
    <div style="padding:0.5rem;background:#efe; border:1px solid #cfc; margin-bottom:1rem;">
      <?=htmlspecialchars($message)?>
    </div>
  <?php endif; ?>

  <form action="" method="POST" enctype="multipart/form-data">
    <label>
      Name
      <input type="text" name="name" required value="<?=htmlspecialchars($_POST['name']??'')?>">
    </label>

    <label>
      Description
      <textarea name="description" rows="4"><?=htmlspecialchars($_POST['description']??'')?></textarea>
    </label>

    <label>
      Price (e.g. 19.99)
      <input type="number" name="price" step="0.01" required value="<?=htmlspecialchars($_POST['price']??'')?>">
    </label>

    <label>
      Category
      <select name="category_id" required>
        <option value="">– choose –</option>
        <?php foreach($categories as $c): ?>
          <option value="<?=$c['id']?>" <?=isset($_POST['category_id']) && $_POST['category_id']==$c['id']?'selected':''?>>
            <?=htmlspecialchars($c['name'])?>
          </option>
        <?php endforeach;?>
      </select>
    </label>

    <label>
      Image
      <input type="file" name="image" accept="image/*" required>
    </label>

    <button type="submit" style="margin-top:1rem;">Save Product</button>
  </form>

  <p><a href="shop.php">← Back to Shop</a></p>
</body>
</html>
