// Function to change the quantity
function changeQuantity(amount) {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    var newQuantity = currentQuantity + amount;

    // Ensure the quantity is between 1 and 100
    if (newQuantity >= 1 && newQuantity <= 100) {
        quantityInput.value = newQuantity;
    }
}


// Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get the modal and button elements
    var modal = new bootstrap.Modal(document.getElementById("size-guide-modal"), {
        keyboard: true
    });
    var btn = document.getElementById("size-guide-btn");
    var span = document.getElementById("close-size-guide");

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.show();  // Using Bootstrap's method to show the modal
    }

    // When the user clicks the "x" button (close icon), close the modal
    span.onclick = function() {
        modal.hide();  // Using Bootstrap's method to hide the modal
    }

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        if (event.target == modal._element) {
            modal.hide();  // Using Bootstrap's method to hide the modal
        }
    }
});
