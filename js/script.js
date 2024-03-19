$("#bt_register").click(function () {
    signup();
});

function signup() {
    if (!$("#regname").val()) {
        alert("Please enter correct name.");
        return false;
    }

    if (!isEmail($("#regemail").val())) {  // Corrected isEmail usage
        alert("Please enter a valid email.");
        return false;
    }

    if (!isphone_no($("#regmobile").val())) {
        alert("Please enter correct mobile no.");
        return false;
    }

    if (!$("#regpassword").val()) {
        alert("Please enter password.");
        return false;
    }

    if (!$("#regconfirmpassword").val()) {
        alert("Password confirmation is required.");
        return false;
    }

    // Corrected FormData creation
    var data_frm = new FormData($("#register")[0]);

    $.ajax({
        url: "api/common.php",
        type: "POST",
        data: data_frm,
        processData: false,
        contentType: false,
        success: function (data) {
            var details = JSON.parse(data);

            if (details["status"] == "200") {
                alert(details["message"]);
                window.location.replace("login.php");
            } else {
                alert(details["message"]);
            }
        },
        error: function () {
            alert("E1: Signup Error.");
            return false;
        }
    });
}

// Move the isEmail function declaration to the top of your script
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$("#bt_login").click(function () {
    login();
});

function login() {
    if (!isEmail($("#username").val())) {
        alert("Please enter correct email.");
        return false;
    }

    if (!$("#password").val()) {
        alert("Please enter password.");
        return false;
    }

    var data_frm = new FormData($("form#login")[0]);
    $.ajax({
        url: "api/common.php",
        type: "POST",
        data: data_frm,
        processData: false,
        contentType: false,
        success: function (data) {
            var details = JSON.parse(data);
    
            if (details["status"] == "200") {
                alert(details["message"]);
                if (details["user_role"] == "admin") {
                    window.location.replace("admin/admin.php"); // Redirect to admin dashboard
                } else {
                    window.location.replace("index.php"); // Redirect to regular user dashboard
                }
            } else {
                alert(details["message"]);
            }
        },
        error: function () {
            alert("E2: Login Error.");
            return false;
        }
    });
}

function isphone_no(value) {
    var numericValue = parseInt(value);
    return !isNaN(numericValue) && value.length === 10;
}



// Update this block in your JavaScript
$("#searchInput").on("input", function () {
     dynamicSearch();
 });
 
 function dynamicSearch() {
     var searchTerm = $("#searchInput").val();
 
     $.ajax({
         url: "path/to/search.php",  // Update this path to match the correct location
         type: "POST",
         data: { query: searchTerm },
         success: function (data) {
             displaySearchResults(data);
         },
         error: function () {
             console.error("Error during dynamic search.");
         }
     });
 }

 $('#profilepic').change(function(){
    const file = this.files[0];
    if (file){
      let reader = new FileReader();
      reader.onload = function(event){
        $('#profile_pic').attr('src', event.target.result);
      }
      reader.readAsDataURL(file);
    }
});


function showContent(section) {
    // Hide all content sections
    $(".content-section").hide();
    
    // Show the selected content section
    $("#" + section + "Content").show();
  }



  function saveChanges() {
    var formData = new FormData(document.getElementById('profileForm'));

    $.ajax({
        url: 'save_changes.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response);
        },
        error: function() {
            alert('Error occurred while saving changes.');
        }
    });
}

$('.edit-button').on('click', function() {
    var formGroup = $(this).closest('.form-group');
    var inputField = formGroup.find('input');

    inputField.prop('readonly', !inputField.prop('readonly'));

    var saveButton = formGroup.closest('form').find('.btn-primary');
    saveButton.toggle();
});



// Trigger click event on the "My Profile" link when the page loads
$(document).ready(function() {
    $("#homeContent").click();
});



//script to remove user,product (admin)

// JavaScript function to remove a user
function removeUser(userId) {
    $.ajax({
        type: 'POST',
        url: 'remove_user.php',
        data: { uid: uid },
        success: function (response) {
            alert(response);
            // You can also update the UI or perform other actions as needed
        },
        error: function (error) {
            console.log('Error removing user: ' + error);
        }
    });
}

// JavaScript function to remove a product
function removeProduct(productId) {
    $.ajax({
        type: 'POST',
        url: 'remove_product.php',
        data: { id: id },
        success: function (response) {
            alert(response);
            // You can also update the UI or perform other actions as needed
        },
        error: function (error) {
            console.log('Error removing product: ' + error);
        }
    });
}
