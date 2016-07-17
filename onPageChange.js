$(document).on("pagebeforechange", function(e, ob) {
    // Prevent the page from completing the change
    e.preventDefault();
    alert("okkkkk");

    // POST to PHP file
    var values = {
      "toPage": ob.toPage[0].id
    };

    $.POST("database/authorize.php", values, function(data) {
      // On success, redirect to the page echo'd by authorize.php

      window.href.location (ob.toPage = data);
    });
});