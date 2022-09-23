// Data constructor for putting in DB
class IsCollected {
  constructor(id, collected) {
    this.id = id;
    this.collected = collected;
  }
}

// Main object
const leeass = {};
leeass.db = null;

//Check for presence in browser
const indexedDB =
  window.indexedDB ||
  window.mozIndexedDB ||
  window.webkitIndexedDB ||
  window.msIndexedDB ||
  window.shimIndexedDB;

leeass.openDB = function () {
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

  // On success of opening database
  request.onsuccess = (event) => {
    leeass.db = event.target.result;
    leeass.getAllChecks();
  };
}

/* ================================= 
Triggers on succes of leeass.openDB
================================= */

leeass.getAllChecks = function () {
  const db = leeass.db;
  const trans = db.transaction(["collection"], "readwrite");
  const store = trans.objectStore("collection");

  // Get everything in the store
  const keyRange = IDBKeyRange.lowerBound(0);
  const cursorRequest = store.openCursor(keyRange);

  cursorRequest.onsuccess = function (e) {
    const result = e.target.result;
    if (!!result == false)
      return;
    leeass.renderChecks(result.value.id);
    result.continue();
  };
}

/* ================================= 
Triggers on event listeners when DOMContent loaded
================================= */

leeass.renderChecks = function (id) {
  const checks = document.querySelectorAll('input[type="checkbox"]');
  checks[id - 1].setAttribute("checked", "");
}

leeass.uncheck = function (id) {
  const db = leeass.db;
  const transaction = db.transaction(["collection"], "readwrite");
  const store = transaction.objectStore("collection");

  const request = store.delete(id);

  request.onerror = function (e) {
    console.log("Error Adding: ", e);
  };
}

leeass.check = function (id) {
  const db = leeass.db;
  const transaction = db.transaction(["collection"], "readwrite");
  const store = transaction.objectStore("collection");

  const data = new IsCollected(id, true);

  const request = store.put(data);

  request.onerror = function (e) {
    console.log("Error Adding: ", e);
  };
}

window.addEventListener("load", function () {
  const loader = document.querySelector("#loader"); 
  loader.classList.add("loader-hidden");

  loader.addEventListener("transitionend", function() {
    document.body.removeChild(this);
  });
});

window.addEventListener("DOMContentLoaded", function () {

  leeass.openDB();

  //Checkboxes click event
  document.querySelector("tbody").addEventListener("click", function (e) {
    if (e.target.tagName === "INPUT") {
      if (e.target.checked === true) {
        leeass.check(e.target.id);
      } else {
        leeass.uncheck(e.target.id);
      }
    }
  });
});
