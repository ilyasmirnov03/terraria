document.addEventListener('DOMContentLoaded', function () {

    class IsCollected {
        constructor(id, collected) {
            this.id = id;
            this.collected = collected;
        }
    }

    const request = indexedDB.open("MyTestDatabase", 3);
    console.log(request);
    
    request.onerror = (event) => {
        console.log(event.target.errorCode);
    };
    request.onsuccess = (event) => {
        console.log("200")
    };
    request.onupgradeneeded = (event) => {
        const db = event.target.result;
        console.log(db);
    }

    
    document.querySelector('tbody').addEventListener('click', function (e) {
        if (e.target.tagName === "INPUT") {
            console.log(e.target);
        }
    });
});