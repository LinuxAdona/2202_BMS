function refreshTable() {
    var searchValue = document.querySelector('input[name="search"]').value;
    window.location.href = window.location.pathname + '?search=' + encodeURIComponent(searchValue);
    return false;
}

function resetSearch() {
    document.querySelector('input[name="search"]').value = '';
    window.location.href = window.location.pathname;
}
