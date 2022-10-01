window.addEventListener('DOMContentLoaded', function () {

    document.querySelector('#menu').addEventListener('click', function (e) {
        if (document.querySelector('#stats').classList.contains("untoggled")) {
            document.querySelector('#stats').style.right = "0%";
            document.querySelector('#stats').classList.remove("untoggled")
        } else {
            document.querySelector('#stats').style.right = "-100%";
            document.querySelector('#stats').classList.add("untoggled");
        }
    });
});