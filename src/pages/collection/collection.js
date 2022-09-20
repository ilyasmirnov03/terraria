document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('tbody').addEventListener('click', function (e) {
        if (e.target.tagName === "INPUT") {
            console.log(e.target);
        }
    });
});