<?php
$activePage = 'add';
include "includes/header.php";
?>

 
 


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Add Your Product</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="addbk.php" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" name="product-name" placeholder="Product name"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <select class="form-control" id="category" required="required" name="category" data-validation-required-message="Please choose a category">
                                <option>Choose Category</option>
                                <option data-thumbnail="img/phone.png" value="SmartPhones">SmartPhones</option>
                                <option data-thumbnail="img/phone.png">Property</option>
                                <option data-thumbnail="img/phone.png">AutoMobiles</option>
                                <option data-thumbnail="img/phone.png">HomeAppliances</option>
                                <option data-thumbnail="img/phone.png">Computers</option>
                                <option data-thumbnail="img/phone.png">Cameras</option>
                                <option data-thumbnail="img/phone.png">Old_is_Gold</option>
                                <option data-thumbnail="img/phone.png">Electronics</option>
                                <option data-thumbnail="img/phone.png">Toys</option>
                                <option data-thumbnail="img/phone.png">Gaming</option>
                                <option data-thumbnail="img/phone.png">Cosmetics</option>
                                <option data-thumbnail="img/phone.png">Fashion</option>
                            </select>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" name="age" placeholder="Product Age"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">&#8377;</span>
                                </div>
                                <input type="text" class="form-control" id="subject" name="price" placeholder="Product price"
                                    required="required" data-validation-required-message="Please enter a subject"
                                    oninput="formatIndianPrice(this)" /> <!-- Add oninput event -->
                            </div>
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" name="description" placeholder="Description"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <select class="form-control" id="sellOrRent" required="required" name="sell_rent" data-validation-required-message="Please choose to Sell/Rent">
                                <option value="" disabled selected>Choose to Sell/Rent</option>
                                <option value="sell">Sell</option>
                                <option value="rent">Rent</option>
                            </select>
                            <p class="help-block text-danger"></p>
                        </div>
                       <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Details</span></h2>
                       <div class="control-group">
                            <input type="text" class="form-control" id="subject" name="name" placeholder="Name"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" name="email" placeholder="Email"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject"  name="phone" placeholder="Phone Number"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject"  name="contact-way" placeholder="Contact Way"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject"  name="location" placeholder="Location"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton" onclick="checkLogin()">Post it</button>
                        </div>
                  
                    </div>
                </div>
                <div class="square-container">
                    <div class="square-row">
                        <!-- Frame 1 -->
                        <div class="square-frame">
                            <input type="file" name="image[]" accept="image/*" id="image1" class="image-input" onchange="displayImage(this, 'frame1')">
                            <label for="image1" class="image-label" id="frame1">
                            <img src="img/placeholder1.jpg" alt="Frame 2" class="frame-image" style="width: 50px; height: 50px;">                            </label>
                        </div>

                        <!-- Frame 2 -->
                        <div class="square-frame">
                            <input type="file" name="image[]" accept="image/*" id="image2" class="image-input" onchange="displayImage(this, 'frame2')">
                            <label for="image2" class="image-label" id="frame2">
                            <img src="img/placeholder1.jpg" alt="Frame 2" class="frame-image" style="width: 50px; height: 50px;">  
                            </label>
                        </div>
                    </div>

                    <div class="square-row">
                        <!-- Frame 3 -->
                        <div class="square-frame">
                            <input type="file" name="image[]" accept="image/*" id="image3" class="image-input" onchange="displayImage(this, 'frame3')">
                            <label for="image3" class="image-label" id="frame3">
                            <img src="img/placeholder1.jpg" alt="Frame 2" class="frame-image" style="width: 50px; height: 50px;">  
                            </label>
                        </div>

                        <!-- Frame 4 -->
                        <div class="square-frame">
                            <input type="file" name="image[]" accept="image/*" id="image4" class="image-input" onchange="displayImage(this, 'frame4')">
                            <label for="image4" class="image-label" id="frame4">
                            <img src="img/placeholder1.jpg" alt="Frame 2" class="frame-image" style="width: 50px; height: 50px;">  
                            </label>
                        </div>
                    </div>
                    <div style="text-align: center; margin-top: 50px; font-size: 18px; font-weight: bold;">Add the Images</div>
                </div>

        </form>
        </div>
        
    </div>
    <!-- Contact End -->




    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script data-src="https://unpkg.com/popper.js@1.14.7/dist/popper.min.js"></script>
    <script src="https://unpkg.com/bootstrap-select@1.13.8/dist/js/bootstrap-select.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>

    <script>
        const BASE_URL = "http://localhost/swapseeker/";

        const $_SELECT_PICKER = $('#category');

        
        $('#category').find('option').each((idx, elem) => {
            const $OPTION = $(elem);
            const IMAGE_URL = $OPTION.attr('data-thumbnail');

            if (IMAGE_URL) {
                $OPTION.attr('data-content', "<img style='width:50px;height:50px;magin-right:10px;' src='%i'/> %s".replace(/%i/, BASE_URL + IMAGE_URL).replace(/%s/, $OPTION.text()))
            }

            console.warn('option:', idx, $OPTION)
        });

        $('#category').selectpicker();

        function displayImage(input, frameId) {
            const frame = document.getElementById(frameId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const image = document.createElement("img");
                    image.src = e.target.result;
                    image.style.width = "100%"; // Set the image width to 100% of the frame
                    image.style.height = "100%"; // Set the image height to 100% of the frame
                    image.alt = ""; // Remove the alt attribute
                    frame.textContent = ""; // Clear any existing content (including "Image" text)
                    frame.appendChild(image);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
    function checkLogin() {
        // Assuming you have a PHP variable that indicates whether the user is logged in
        <?php if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true): ?>
            // The user is logged in, allow the form submission
            document.getElementById('yourFormId').submit();
        <?php else: ?>
            // The user is not logged in, show a popup message
            alert("You need to be logged in to add products.");
        <?php endif; ?>
    }
   </script>

</body>

</html>





