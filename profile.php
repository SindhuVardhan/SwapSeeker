
<?php
include "includes/header.php";

function UploadImageFile($folder, $image)
{
    try {
        $uploadDirectory = "../$folder/";
        $uploadURL = $folder . '/';
        $image_file_path = "";

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $file_ext = pathinfo($_FILES["$image"]['name'], PATHINFO_EXTENSION);
        $file_name = $_FILES["$image"]["name"];
        $file_tmp = $_FILES["$image"]["tmp_name"];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif', 'PNG', 'jfif'])) {
            $newFileName = date("YmdHis") . "." . $file_ext;
            $uploadPath = $uploadDirectory . $newFileName;

            if (move_uploaded_file($file_tmp, $uploadPath)) {
                $image_file_path = $uploadURL . $newFileName;
            }
        }

        return $image_file_path;
    } catch (Exception $ex) {
        return "Upload Error: " . $ex->getMessage();
    }
}

?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"></h5>
            <div class="p-4 mb-30" style="background-color: #45b6fead; height: 500px;">
            <form id="profileForm" method="post" action="" enctype="multipart/form-data">
            
                <div class="square position-relative display-2 mb-3" style="display: flex; justify-content: center; align-items: center; ">
                    <?php if (!empty($ProfilePic)) : ?>
                        <img id="profile_pic" src="<?php echo '../' . $ProfilePic; ?>" style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #fff;">
                    <?php else : ?>
                        <img id="profile_pic" src="img/logo.jpg " style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #fff;">
                    <?php endif; ?>
                </div>

                <input type="hidden" id="profile_pic_path" name="profile_pic_path" value="<?php echo $ProfilePic; ?>">
                <input type="file" id="profilepic" name="profilepic" hidden="">
                <label class="btn btn-success-soft btn-block" for="profilepic">Upload</label>

                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3" style="color: #fff;">
                        <a href="#homeSubmenu" id="homeConten" data-toggle="collapse" aria-expanded="false" onclick="showContent('home')" style="text-decoration: none;">Profile </a>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <a href="#" onclick="showContent('about')" style="text-decoration: none;">My Products</a>
                    </div>
                    <!-- <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" onclick="showContent('pages')" style="text-decoration: none;">Orders</a>
                    </div> -->
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <a href="#" onclick="showContent('portfolio')" style="text-decoration: none;">Saved Address</a>
                    </div>
                </form>
            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->




        <div class="col-lg-9 col-md-8">
            <!-- Your main content goes here -->

            <!-- profile content start -->
            <div id="homeContent" class="content-section" style="display: block;">
                <!-- <h2 class="mb-4">Your Profile</h2> -->
                <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                    // Include your database connection
                    $user_id = $_SESSION["uid"];

                    // Fetch user details from the 'signup' table
                    $getUserDetailsQuery = "SELECT * FROM signup WHERE id = '$user_id'";
                    $getUserDetailsResult = mysqli_query($conn, $getUserDetailsQuery);

                    if ($getUserDetailsResult && mysqli_num_rows($getUserDetailsResult) > 0) {
                        $userDetails = mysqli_fetch_assoc($getUserDetailsResult);
                        // Now you have user details in the $userDetails variable
                    }

                    // Set default country to India
                    $defaultCountry = 'India';
                }

                // Handle the form submission
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
                    // Get the updated values from the form
                    $updatedUsername = mysqli_real_escape_string($conn, $_POST['username']);
                    $updatedEmail = mysqli_real_escape_string($conn, $_POST['email']);
                    $updatedPhone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $profile_pic_path = mysqli_real_escape_string($conn, $_POST['profile_pic_path']);  // Retrieve the profile pic path
                
                    // Update the user details in the 'signup' table
                    $updateUserQuery = "UPDATE signup SET username = '$updatedUsername', email = '$updatedEmail', phone = '$updatedPhone', profile_pic = '$profile_pic_path' WHERE id = '$user_id'";
                    $updateUserResult = mysqli_query($conn, $updateUserQuery);
                
                    if ($updateUserResult) {
                        // Successful update
                        echo "User details updated successfully!";
                    } else {
                        // Failed update
                        echo "Error updating user details: " . mysqli_error($conn);
                    }
                }
                ?>
                <div class="container-fluid">
                    <div class="row justify-content-center px-xl-5">
                        <div class="col-lg-4">
                            <h5 class="section-title position-relative text-uppercase mb-3">
                                <span class="bg-secondary pr-3">MY Profile</span>
                            </h5>
                            <div class="profile-container bg-light p-30 mb-5">
                            <form id="profileForm" method="post" action="">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="username" placeholder="John" value="<?php echo isset($userDetails['username']) ? $userDetails['username'] : ''; ?>" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-link edit-button">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="email" placeholder="example@email.com" value="<?php echo isset($userDetails['email']) ? $userDetails['email'] : ''; ?>" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-link edit-button">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile No</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="phone" placeholder="+123 456 789" value="<?php echo isset($userDetails['phone']) ? $userDetails['phone'] : ''; ?>" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-link edit-button">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="country" placeholder="Country" value="<?php echo isset($defaultCountry) ? $defaultCountry : ''; ?>" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-link edit-button">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <button type="submit" name="save_changes" class="btn btn-primary" style="display: none;">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- profile content ends  -->



            <!-- my product content start -->
            <div id="aboutContent" class="content-section" style="display:none;">
                <div class="container-fluid">
                    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4" style="font-size: 1.5rem;">
                        <span class="bg-secondary pr-3">Product Details</span>
                    </h2>

                
                </div>
            </div>




            <!-- your orders content start -->
            <div id="pagesContent" class="content-section" style="display: none;">
                <h2 class="mb-4">Your Orders</h2>
                
            
            </div>
            <!--  your orders content ends-->



            <div id="portfolioContent" class="content-section" style="display: none;">
                <h2 class="mb-4">Saved Address</h2>
                
            </div>
            
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/pmain.js"></script>
<script src="js/script.js"></script>
</body>

</html>



















