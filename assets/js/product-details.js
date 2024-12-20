document.querySelectorAll('.dropdown-item').forEach(function(item) {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const selectedSize = e.target.getAttribute('data-size');
        const sizeDropdownButton = document.getElementById('sizeDropdown');
        sizeDropdownButton.textContent = selectedSize;
        document.getElementById('selectedSize').value = selectedSize;
        
        const sizeTextElement = document.getElementById('selectedSizeText');
        sizeTextElement.textContent = "Selected size: " + selectedSize;
        sizeTextElement.style.display = 'block'; // Ensure it's visible after selection
    });
});

// Hide selected size text if no size is selected
function updateSizeVisibility() {
    const sizeTextElement = document.getElementById('selectedSizeText');
    sizeTextElement.style.display = document.getElementById('selectedSize').value ? 'block' : 'none';
}

// Quantity update function with limits
function changeQuantity(amount) {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    var newQuantity = currentQuantity + amount;
    if (newQuantity >= 1 && newQuantity <= 100) {
        quantityInput.value = newQuantity;
    }
}

// Modal functionality for the size guide
document.addEventListener('DOMContentLoaded', function() {
    var modal = new bootstrap.Modal(document.getElementById("size-guide-modal"));
    var btn = document.getElementById("size-guide-btn");
    var span = document.getElementById("close-size-guide");

    btn.onclick = function() {
        modal.show();
    };

    span.onclick = function() {
        modal.hide();
    };

    window.onclick = function(event) {
        if (event.target == modal._element || event.target == modal._element.querySelector('.close-btn')) {
            modal.hide();
        }
    };
});
