document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function adjustQuantity(productId, action) {
        fetch(`/products/${productId}/adjust/${action}`, {
            method: 'POST', // Use POST with CSRF for safety
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            const quantityEl = document.getElementById('product-quantity');
            if (quantityEl) quantityEl.textContent = data.quantity;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong!');
        });
    }

    const increaseBtn = document.getElementById('increase-btn');
    const decreaseBtn = document.getElementById('decrease-btn');

    if (increaseBtn) {
        const productId = increaseBtn.dataset.productId;
        increaseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            adjustQuantity(productId, 'increase');
        });
    }

    if (decreaseBtn) {
        const productId = decreaseBtn.dataset.productId;
        decreaseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            adjustQuantity(productId, 'decrease');
        });
    }

});
