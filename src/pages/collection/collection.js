document.addEventListener("DOMContentLoaded", function () {
  class IsCollected {
    constructor(id, collected) {
      this.id = id;
      this.collected = collected;
    }
  }

  //Check for presence in browser
  const indexedDB =
    window.indexedDB ||
    window.mozIndexedDB ||
    window.webkitIndexedDB ||
    window.msIndexedDB ||
    window.shimIndexedDB;

  //Creating database if not found, else opening existing database
  const request = indexedDB.open("TerrariaItems", 1);

  //Handling errors while opening database
  request.onerror = (event) => {
    console.log(event.target.errorCode);
  };

  //Runs whenever a new database is created or an existing database ver. number is changed
  request.onupgradeneeded = (event) => {
    const db = request.result;
    // creating table and assigning a primary key "id"
    const objectStore = db.createObjectStore("collection", { keyPath: "id" });
    objectStore.createIndex("isCollected", "isCollected", { unique: "false" });
  };

  // Execute all database operations on success
  request.onsuccess = (event) => {
    const db = request.result;
    const transaction = db.transaction("collection", "readwrite");
    // reference to store created
    const store = transaction.objectStore("collection");
    const itemIndex = store.index("isCollected");

    store.put({ id: 1, IsCollected: true });

    const idQuery = store.get(1);

    idQuery.onsuccess = () => {
      console.log(idQuery.result);
    }

    transaction.oncomplete = () => {
      db.close();
    }
  };

  function uncheck(id) {

  }

  function check(id) {

  }

  //Checkboxes click event
  document.querySelector("tbody").addEventListener("click", function (e) {
    if (e.target.tagName === "INPUT") {
      console.log(e.target);
    }
  });
});
