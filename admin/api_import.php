<?php
require_once __DIR__ . '/../admin/config/db.php';

try {
    // Fetch API data with error handling
    $api_url = 'https://dummyjson.com/products?limit=100';
    $response = file_get_contents($api_url);

    if ($response === false) {
        throw new Exception("Failed to fetch data from API");
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON response: " . json_last_error_msg());
    }

    // Prepare category map
    $stmt = $pdo->query("SELECT id, slug FROM categories");
    $categories = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    // Prepare product insert statement
    $product_stmt = $pdo->prepare("
        INSERT INTO products (
            title, description, price, discount_percentage, 
            rating, stock, brand, category_id, thumbnail, images
        ) VALUES (
            :title, :description, :price, :discountPercentage,
            :rating, :stock, :brand, :category_id, :thumbnail, :images
        )
    ");

    $category_mapping = [
        'smartphones'    => 'phones',
        'laptops'        => 'electrical',
        'fragrances'     => 'makeup',
        'skincare'       => 'makeup',
        'groceries'      => 'groceries',
        'home-decoration' => 'home-decoration',
        'furniture'      => 'furniture',
        'tops'           => 'clothes',
        'womens-dresses' => 'clothes',
        'womens-shoes'   => 'shoes',
        'mens-shirts'    => 'clothes',
        'mens-shoes'     => 'shoes',
        'mens-watches'   => 'watches',
        'womens-watches' => 'watches',
        'womens-bags'    => 'clothes',
        'womens-jewellery' => 'makeup',
        'sunglasses'     => 'watches',
        'automotive'     => 'electrical',
        'motorcycle'     => 'electrical',
        'lighting'       => 'furniture'
    ];

    $import_count = 0;
    $error_count = 0;

    foreach ($data['products'] ?? [] as $product) {
        try {
            // Validate required fields
            if (empty($product['title']) || !isset($product['price'])) {
                throw new Exception("Missing required fields for product");
            }

            // Map category with fallbacks
            $api_category = strtolower($product['category'] ?? 'unknown');
            $category_slug = $category_mapping[$api_category] ?? 'other';
            
            if (!isset($categories[$category_slug])) {
                error_log("Category not found: {$api_category} (mapped to: {$category_slug})");
                $error_count++;
                continue;
            }

            $category_id = array_search($category_slug, $categories);

            // Prepare values with defaults
            $product_data = [
                ':title' => $product['title'],
                ':description' => $product['description'] ?? 'No description available',
                ':price' => $product['price'],
                ':discountPercentage' => $product['discountPercentage'] ?? 0.00,
                ':rating' => $product['rating'] ?? 0.00,
                ':stock' => $product['stock'] ?? 0,
                ':brand' => $product['brand'] ?? 'Generic Brand',
                ':category_id' => $category_id,
                ':images' => json_encode($product['images'] ?? [])
            ];

            $product_stmt->execute($product_data);
            $import_count++;

        } catch (Exception $e) {
            error_log("Product import error: " . $e->getMessage());
            $error_count++;
            continue;
        }
    }

    echo "Import completed. Success: {$import_count}, Errors: {$error_count}";

} catch (Exception $e) {
    error_log("Fatal import error: " . $e->getMessage());
    die("Error: " . $e->getMessage());
}