(function() {
  const App = {

    // Data constructor for putting in DB
    IsCollected: class {
      constructor(id, collected) {
        this.id = id;
        this.collected = collected;
      }
    },

    // Main object
    leeass: {
      db: null,
      itemsNum: 0,
      openDB: function () {
        //Creating database if not found, else opening existing database
        const request = indexedDB.open("TerrariaItems", 1);
        //Handling errors while opening database
        request.onerror = (event) => {
          console.log(event.target.error);
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
          App.leeass.db = event.target.result;
          App.leeass.getAllChecks();
          App.leeass.getAllQ();
        };
      }
    },

    //Check for presence in browser
    indexedDB:
    window.indexedDB ||
    window.mozIndexedDB ||
    window.webkitIndexedDB ||
    window.msIndexedDB ||
    window.shimIndexedDB,
    }
    
    /* ================================= 
    Triggers on succes of App.leeass.openDB
    ================================= */
    
    App.leeass.getAllChecks = function () {
      const db = App.leeass.db;
      const trans = db.transaction(["collection"], "readwrite");
      const store = trans.objectStore("collection");
    
      // Get everything in the store
      const keyRange = IDBKeyRange.lowerBound(0);
      const cursorRequest = store.openCursor(keyRange);
    
      cursorRequest.onsuccess = function (e) {
        const result = e.target.result;
        if (!!result == false) return;
        App.leeass.renderChecks(result.value.id);
        result.continue();
      };
    };
    
    App.leeass.getAllQ = function () {
      const db = App.leeass.db;
      const trans = db.transaction(["collection"], "readonly");
      const store = trans.objectStore("collection");
    
      store.getAll().onsuccess = function (e) {
        App.leeass.itemsNum = e.target.result.length;
        document.querySelector("#percent-collected").textContent = `${App.leeass.percentage()}% collected`;
        App.leeass.renderStatCircle();
      }
    }
    
    /* ================================= 
    Triggers on event listeners when DOMContent loaded
    ================================= */
    
    App.leeass.uncheck = function (id) {
      const db = App.leeass.db;
      const transaction = db.transaction(["collection"], "readwrite");
      const store = transaction.objectStore("collection");
    
      const request = store.delete(id);
    
      App.leeass.getAllQ();
    
      request.onerror = function (e) {
        console.log("Error Adding: ", e);
      };
    }
    
    App.leeass.check = function (id) {
      const db = App.leeass.db;
      const transaction = db.transaction(["collection"], "readwrite");
      const store = transaction.objectStore("collection");
    
      const data = new IsCollected(id, true);
    
      const request = store.put(data);
    
      App.leeass.getAllQ();
    
      request.onerror = function (e) {
        console.log("Error Adding: ", e);
      };
    }
    
    App.leeass.renderChecks = function (id) {
      const checks = document.querySelectorAll('input[type="checkbox"]');
      checks[id - 1].setAttribute("checked", "");
    }
    
    App.leeass.percentage = function () {
      return Math.round((App.leeass.itemsNum / document.querySelectorAll('input[type="checkbox"').length * 100) * 100) / 100;
    }
    
    App.leeass.renderStatCircle = function () {
      document.querySelector("#stat-circle").style.top = `${100 - App.leeass.percentage()}%`;
    }
  }

  /* ================================= 
DB functions
================================= */
  


  console.log(indexedDB.databases);
})();




// Simple loader
window.addEventListener("load", function () {
  const loader = document.querySelector("#loader");
  loader.classList.add("loader-hidden");

  loader.addEventListener("transitionend", function () {
    document.body.removeChild(this);
  });
});

window.addEventListener("DOMContentLoaded", function () {

  App.leeass.openDB();

  //Checkboxes click event
  document.querySelector("tbody").addEventListener("click", function (e) {
    if (e.target.tagName === "INPUT") {
      if (e.target.checked === true) {
        App.leeass.check(e.target.id);
        App.leeass.getAllQ();
      } else {
        App.leeass.uncheck(e.target.id);
        App.leeass.getAllQ();
      }
    }
  });
});
