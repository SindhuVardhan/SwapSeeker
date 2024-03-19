<?php
include "includes/header.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swapseeker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userID = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;

$name = $email = $phone = $country = $image = '';
$defaultCountry = "India";

if ($userID) {
    $query = "SELECT * FROM signup WHERE id = $userID";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
        $name = $userDetails['username'];
        $email = $userDetails['email'];
        $phone = $userDetails['phone'];
        $country = isset($userDetails['country']) ? $userDetails['country'] : $defaultCountry;
        $image = $userDetails['image'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];

    $country = empty($country) ? $defaultCountry : $country;

    // Handle file upload
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
        $targetDir = "uploads/";
        $uniqueFilename = uniqid() . "_" . basename($_FILES["profile_image"]["name"]);
        $targetPath = $targetDir . $uniqueFilename;

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetPath)) {
            // Update profile picture path in the database
            $updateImageQuery = "UPDATE signup SET image = '$targetPath' WHERE id = $userID";
            $conn->query($updateImageQuery);
            $image = $targetPath;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update other user details if needed
    $updateUserQuery = "UPDATE signup SET username = '$name', email = '$email', phone = '$phone' WHERE id = $userID";
    $conn->query($updateUserQuery);
}

?>

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">My Profile</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form id="profileForm" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="username" placeholder="John" value="<?php echo isset($userDetails['username']) ? $userDetails['username'] : ''; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" name="email" placeholder="example@email.com" value="<?php echo isset($userDetails['email']) ? $userDetails['email'] : ''; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Mobile No</label>
                        <input class="form-control" type="text" name="phone" placeholder="+123 456 789" value="<?php echo isset($userDetails['phone']) ? $userDetails['phone'] : ''; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Country</label>
                        <input class="form-control" type="text" name="country" placeholder="Country" value="<?php echo isset($defaultCountry) ? $defaultCountry : ''; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input type="file" name="profile_image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-primary edit-button">Edit</button>
                        <button type="submit" name="save_changes" class="btn btn-primary" style="display: none;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5 mb-5">
    <div class="bg-light p-30 mb-30 mx-auto" style="width: 350px; height: 350px; border: 2px solid gray; overflow: hidden; position: relative;">
        <img id="profileImage" src="<?php echo !empty($image) ? $image : 'img/logo.jpg'; ?>" alt="Profile Image" style="width: 100%; height: auto; max-width: 350px; max-height: 350px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" />
    </div>
</div>


    </div>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function () {
        $(".edit-button").on("click", function () {
            $("form input").prop("readonly", function (i, readonly) {
                return !readonly;
            });

            $(".edit-button").toggle();
            $("[name='save_changes']").toggle();
        });

        // Function to update image preview
        $("input[name='profile_image']").change(function () {
            readURL(this);
        });

        // Function to read and display the image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profileImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // Read the image file as a data URL.
            }
        }
    });
</script>


</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
