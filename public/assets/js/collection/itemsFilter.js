window.addEventListener('DOMContentLoaded', function () {

    const tbody = document.querySelector('tbody');

    // Sorts uncompleted first
    document.querySelector("#up-arrow").addEventListener('click', function () {
        document.querySelectorAll('input[type="checkbox"]:not(:checked)').forEach(uncompleted => {
            tbody.prepend(uncompleted.parentNode.parentNode);
        });
    });

    // Sorts completed first
    document.querySelector("#down-arrow").addEventListener('click', function () {

        document.querySelectorAll("input:checked").forEach(completed => {
            tbody.prepend(completed.parentNode.parentNode);
        });;
    });
});