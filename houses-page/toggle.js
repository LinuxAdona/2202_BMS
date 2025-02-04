function toggleFamilies() {
    const checkbox = document.getElementById('no_families');
    const familiesLabel = document.querySelector('label[for="families"]');
    const familiesSelect = document.getElementById('families');

    if (checkbox.checked) {
        familiesSelect.disabled = true;
    } else {
        familiesLabel.style.display = 'block';
        familiesSelect.disabled = false;
    }
}