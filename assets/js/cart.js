document.addEventListener('DOMContentLoaded', function() {
    const cartTotalElement = document.getElementById('cart-total');
    const checkoutButton = document.getElementById('checkout-btn');

    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            const quantity = parseInt(item.querySelector('input').value);
            total += price * quantity;
        });
        cartTotalElement.textContent = total.toFixed(2);
    }

    window.decrementQuantity = function(productId, productColor) {
        const item = document.querySelector(`.cart-item[data-cart-id="${productId}"][data-product-color="${productColor}"]`);
        const quantityInput = item.querySelector('input');
        if (quantityInput.value > 1) {
            quantityInput.value--;
            updateCartTotal();
        }
    }

    window.incrementQuantity = function(productId, productColor) {
        const item = document.querySelector(`.cart-item[data-cart-id="${productId}"][data-product-color="${productColor}"]`);
        const quantityInput = item.querySelector('input');
        quantityInput.value++;
        updateCartTotal();
    }

    // checkoutButton.addEventListener('click', function() {
    //     const orderItems = [];
    //     document.querySelectorAll('.cart-item').forEach(item => {
    //         const productId = item.getAttribute('data-cart-id');
    //         const productColor = item.getAttribute('data-product-color');
    //         const quantity = item.querySelector('input').value;
    //         // const price = item.getAttribute('data-cart-price');
    //         orderItems.push({ product_id: productId, product_color: productColor, quantity: quantity, price: cartTotalElement.textContent });
    //     });

    //     // Save order items to session storage
    //     const xhr = new XMLHttpRequest();
    //     xhr.open('POST', '../user_actions/save_order_items.php', true);
    //     xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    //     xhr.onload = function() {
    //         if (xhr.status === 200) {
    //             console.log('Order items saved');
    //             window.location.href = '../view/order.php';
    //         } else {
    //             console.error('Error saving order items:', xhr.responseText);
    //         }
    //     };
    //     xhr.send(JSON.stringify({ orderItems }));
    // });
});