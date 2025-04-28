document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const productId = params.get("id");
  
    const productDetail = document.getElementById("product-detail");
  
    if (productId && productDetail) {
      productDetail.innerHTML = `
        <h2>منتج ${productId}</h2>
        <p>هذا وصف تفصيلي للمنتج رقم ${productId}.</p>
        <button onclick="alert('تمت إضافة المنتج إلى السلة')">أضف إلى السلة</button>
      `;
    }
  });
