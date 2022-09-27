window.addEventListener('DOMContentLoaded', function () {
    const search = document.querySelector('#items-search');
    const items = document.querySelectorAll('.search-info');

    let timer;

    search.addEventListener('input', function () {
        clearTimeout(timer);

        // Executes only after 500 ms
        timer = setTimeout(() => {
            // Searches for matching through all elements and if found, hides the not matching
            items.forEach(item => {
                const found = item.children[1].textContent.toLocaleLowerCase().includes(this.value.toLowerCase());
                item.classList.toggle("item-hidden", !found);
            });
        }, 500);
    });
});