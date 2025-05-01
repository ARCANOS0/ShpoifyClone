<?php   
function renderProductCard($product) {
    $rating = $product['rating'] ?? 0;
    $formattedPrice = number_format($product['price'], 2);
    $category = strtolower($product['category_name'] ?? 'uncategorized');

    echo <<<HTML
    <div class="col">
        <div class="product card shadow-sm border-0 h-100">
            <a href="product_details.php?id={$product['id']}">
                <img src="{$product['thumbnail']}" alt="{$product['title']}" class="card-img-top">
            </a>
            <div class="card-body text-center">
                <div>
                    <div class="star mb-2">
HTML;

    // Render stars
    for ($i = 1; $i <= 5; $i++) {
        $class = $i <= round($rating) ? 'fas fa-star text-warning' : 'far fa-star text-secondary';
        echo "<i class='{$class}'></i>";
    }

    echo <<<HTML
                    </div>
                    <h5 class="card-title p-name fs-6 fw-bold">
                        <a href="product_details.php?id={$product['id']}" class="text-decoration-none text-dark">
                            {$product['title']}
                        </a>
                    </h5>
                    <p class="card-text small text-muted mb-2">{$product['brand']}</p>
                    <h4 class="p-price mb-3">\${$formattedPrice}</h4>
                </div>
                <form action="cart_add.php" method="POST" class="d-grid">
                    <input type="hidden" name="product_id" value="{$product['id']}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
HTML;
}
