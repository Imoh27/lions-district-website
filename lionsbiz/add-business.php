<?php
include "includes/header.php";
?>
</head>

<body>
    
<?php
include "includes/navbar.php";
include "app/includes/alt_config.php";
?>
<script>
    function getLga(val) {
        $.ajax({
            type: "POST",
            url: "app/get_lga.php",
            data: 'stateID=' + val,
            beforeSend: function() {
                $("#lga").html('Fetching, Please Wait...');
            },
            success: function(data) {
                $("#lga").html(data);
            }
        });
    }
    </script>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Add Business</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Business Form Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Add Business Details</span></h2>
        <div class="row px-xl-5 ">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <!-- <div id="success"></div> -->
                    <form  action="includes/add_business_data.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                           
                            <div class="control-group col-lg-6">
                                <input type="text" class="form-control" id="bizName" name="ownerName" placeholder="Your Name"
                                    required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-6">
                                <input type="text" class="form-control" name="bizName" id="bizName" placeholder="Business Name"
                                    required="required" data-validation-required-message="Please enter your business name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-3">
                                <input type="text" class="form-control" id="lionsID" name="lionsID" placeholder="Enter Lions ID"
                                    required="required" data-validation-required-message="Please enter your Lions ID" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-5">
                                <input type="text" class="form-control" id="club" name="club" placeholder="Your Club"
                                    required="required" data-validation-required-message="Please enter your club" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-4">
                            <?php
                                        $select = "SELECT * FROM tblregion";
                                        //  echo $select; exit;
                                        $sth = $con->query($select);
                                        $results = $sth->FetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                    <select class="form-control" name="region" id="region"
                                        required="required" data-validation-required-message="region">
                                       
                                        <option value="" selected>Select region </option>
                                        <?php 
                                            foreach ($results as $region) {
                                                ?>
                                        <option value="<?php echo htmlentities($region['regionID']); ?>">
                                          Region  <?php echo htmlentities($region['region']); ?></option>
                                        <?php } ?>
                                    </select>
                                <p class="help-block text-danger"></p>
                            </div>
                            
                            <div class="control-group col-lg-4">
                            <?php
                                        $select = "SELECT * FROM tblcategory";
                                        //  echo $select; exit;
                                        $sth = $con->query($select);
                                        $results = $sth->FetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                    <select class="form-control" name="bizcategory" id="bizcategory"
                                        required data-validation-required-message="Please enter bizcategory">
                                       
                                        <option value="" selected>Select Category </option>
                                        <?php 
                                            foreach ($results as $category) {
                                                ?>
                                        <option value="<?php echo htmlentities($category['categoryID']); ?>">
                                            <?php echo htmlentities($category['categoryName']); ?></option>
                                        <?php } ?>
                                    </select>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-4">
                                <input type="text" class="form-control" id="yr_incorporated" name="yr_incorporated" placeholder="Year Incorporated"
                                    />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-4">
                                <input type="text" class="form-control" id="cacNO" name="cacNO" placeholder="CAC NO"
                                    />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Contact Email"
                                    required="required" data-validation-required-message="Please enter your business email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-6">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact Phone"
                                    required="required" data-validation-required-message="Please enter your contact number" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-6">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address"
                                    required="required" data-validation-required-message="Please enter your Address" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-3">
                            <?php
                                        $select = "SELECT * FROM tblstates";
                                        //  echo $select; exit;
                                        $sth = $con->query($select);
                                        $results = $sth->FetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                    <select class="form-control" name="bizState" id="bizState"
                                        onChange="getLga(this.value);" required="required" data-validation-required-message="Enter Business State">
                                       
                                        <option value="" selected>Select State </option>
                                        <?php 
                                            foreach ($results as $states) {
                                                ?>
                                        <option value="<?php echo htmlentities($states['stateID']); ?>">
                                            <?php echo htmlentities($states['stateName']); ?></option>
                                        <?php } ?>
                                    </select>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-3">
                                <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                    required="required" data-validation-required-message="Please enter your city" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-12">
                                <input type="url" class="form-control" id="bizwebsite" name="bizwebsite" placeholder="Website"
                                    />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-4">
                                <input type="text" class="form-control" id="fb" name="fb" placeholder="Facebook"
                                    />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-4">
                                <input type="text" class="form-control" id="ig" name="ig" placeholder="Instagram"
                                    />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-4">
                                <input type="text" class="form-control" id="tw" name="tw" placeholder="Twitter"
                                    />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-6">
                              <label for="ownerPhoto">Owner Photo <strong class="text-danger">(Only 1 required)</strong></label>

                                <input type="file" class="form-control" id="ownerPhoto" name="ownerPhoto" placeholder="Owners Photo"
                                    required="required" data-validation-required-message="Upload Your Photo" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-6">
                              <label for="sample_photos">Sample Photos <strong class="text-danger">(Not more/less than 3)</strong></label>
 
                                <input style="display: inline !important" type="file" class="form-control" id="sample_photos" name="sample_photos[]" multiple  placeholder="Sample Photos"
                                    required="required" data-validation-required-message="Upload business sample photos" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-lg-12">
                                <textarea class="form-control" rows="8" id="aboutBiz" name="aboutBiz" placeholder="About your business"
                                    required="required"
                                    data-validation-required-message="Please enter your Business Description"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="add_business">Add Business</button>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
    <!-- Business form End -->

    <?php
include "includes/footer.php";
?>
</body>

</html>