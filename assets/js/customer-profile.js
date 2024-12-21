function toggleProfileInputs(disable) {
    document.querySelectorAll(".profile-input").forEach(el => el.disabled = disable);
    document.getElementById("updateButton").disabled = disable;
    document.getElementById("editButton").disabled = !disable;
}


function enableEdit() {
    const inputs = document.querySelectorAll('.profile-input');
    inputs.forEach(input => input.disabled = false);
    document.getElementById('updateButton').disabled = false;
}