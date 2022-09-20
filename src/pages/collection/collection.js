document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[type="checkbox"]').forEach((check) => {
        check.addEventListener("click", function() {
            console.log(this.checked);
            console.log(this.id);
        });
    });
});