$("#bt_register").click(function(){
    signup();
});

function signup(){
    var data_frm = new FormData($("form#register")[0]);
    $.ajax({
         url: "api/common.php",
         type: "POST",
         data: data_frm,
         processData: false,
         contentType: false,
         success: function(data) {
            var details = JSON.parse(data);

            if (details["status"] == "200") {
                  alert(details["message"]);
                  window.location.replace("login.php");

            } else {
                 alert(details["message"]);
            }
         },
         error: function() {
              alert("E1: Signup Error.");
              return false;
         }
    });
}


$("#bt_login").click(function(){
    login();
});

function login(){
    var data_frm = new FormData($("form#login")[0]);
    $.ajax({
         url: "api/common.php",
         type: "POST",
         data: data_frm,
         processData: false,
         contentType: false,
         success: function(data) {
              var details = JSON.parse(data);

              if (details["status"] == "200") {
                    alert(details["message"]);
                    window.location.replace("index.php");

              } else {
                   alert(details["message"]);
              }
         },
         error: function() {
              alert("E2: Login Error.");
              return false;
         }
    });
}

