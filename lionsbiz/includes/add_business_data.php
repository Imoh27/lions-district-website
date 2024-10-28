<?php
error_reporting(0);
include('config.php');

    if (isset($_POST['add_business'])) {
        global $con;
        $ownerName = strip_tags($_POST['ownerName']);
        $lionsID = strip_tags($_POST['lionsID']);
        $bizName = strip_tags($_POST['bizName']);
        $club = strip_tags($_POST['club']);
        $region = strip_tags($_POST['region']);
        $bizcategory = strip_tags($_POST['bizcategory']);
        $yr_incorporated =strip_tags($_POST['yr_incorporated']);
        $cacNO =strip_tags($_POST['cacNO']);
        $email = strip_tags($_POST['email']);
        $phone = strip_tags($_POST['phone']);
        $address = strip_tags($_POST['address']);
        $bizState = strip_tags($_POST['bizState']);
        $city = strip_tags($_POST['city']);
        $bizwebsite = strip_tags($_POST['bizwebsite']);
        $fb = strip_tags($_POST['fb']);
        $ig = strip_tags($_POST['ig']);
        $tw = strip_tags($_POST['tw']);
        $aboutBiz = strip_tags($_POST['aboutBiz']);
        $imgfile = strtolower($_FILES["ownerPhoto"]["name"]);
        $samplePhotos = strtolower($_FILES["sample_photos"]["name"]);
        $samplePhotossize = $_FILES["sample_photos"]["size"];
        // $bizcount = 0;
        // echo $yr_incorporated; exit;
        
                $sumfiles = array_sum($_FILES['sample_photos']['size']);
                // echo $sumfiles; exit;
                 $countFiles = count($_FILES['sample_photos']['name']);
                    // echo $countFiles; exit;
                    if ( $countFiles >3) {
                        echo "<script> 
                        alert('Number of Uploadable Sample Files (3) Exceeded')
                        history.back()
                    </script>";
                    }elseif ( $countFiles <3) {
                        echo "<script> 
                        alert('Please upload a minimum of (3) Sample Files')
                        history.back()
                    </script>";
                    }
                    elseif ( $sumfiles > 2000000) {
                        echo "<script> 
                        alert('Maximum File Size of 2mb Exceeded')
                        history.back()
                    </script>";
                    }else{
         // get the image extension
         $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
         // allowed extensions
         $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
         // Validation for allowed extensions .in_array() function searches an array for a specific value.
         if (!in_array($extension, $allowed_extensions)) {
             $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
             // echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
         } else {
             //rename the image file
             $imgnewfile = $ownerName.' - '.$imgfile;
 
             $select = "SELECT * FROM tblbusineses where lionsID = $lionsID AND categoryID = $bizcategory AND bizName = '$bizName'";
            //  echo $select; exit;
             $fetch = $con->query($select);
             $result = $fetch->fetchAll(PDO::FETCH_ASSOC);
            //  var_dump
             // echo  $calc_date; exit;
             if (!empty($result) || $result != '') {
                 $insert = "INSERT INTO tblbusineses VALUES(NULL, $bizcategory, '$bizName',  '$yr_incorporated',
                 '$cacNO', '$ownerName', $lionsID, $region, '$club', '$imgnewfile', '$address', $bizState,
                  '$city', '$email', '$phone', '$bizwebsite', '$aboutBiz', '$fb', 
                  '$ig', '$tw',  NOW())";
                //  echo $insert; exit;
                 $biz_insert_query = $con->query($insert);
                 
                 //  echo $query; exit;
                 if ($biz_insert_query) {
                     move_uploaded_file($_FILES["ownerPhoto"]["tmp_name"], "../ownersPhoto/". $imgnewfile);
                     $select_bizcount = "SELECT * from tblcategory WHERE categoryID = $bizcategory";
                     // echo $select_bizcount
                     $sth = $con->query($select_bizcount);
                     $resultcount = $sth->fetch(PDO::FETCH_ASSOC);
                 if (!empty($resultcount)) {
                     $bizcount= $resultcount['bizCount'] + 1;
                 }
                     $update_category = "UPDATE tblcategory SET bizCount =  $bizcount WHERE categoryID = $bizcategory";
                     // echo $insert; exit;
                     $countquery = $con->query($update_category);

                    //  INSERT SAMPLE PHOTOS
                   
                    for ($i = 0; $i < $countFiles; $i++) {
                        $samplePhotos = $_FILES["sample_photos"]["name"][$i];
            
                          // get the image extension
                          $extension = substr($samplePhotos, strlen($samplePhotos) - 4, strlen($samplePhotos));
                          // allowed extensions
                          $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
                          // Validation for allowed extensions .in_array() function searches an array for a specific value.
                          if($samplePhotossize[$i] > 2000000){
                              echo "<script>alert('OOP!. Maximum File Size of 2mb Exceeded');</script>"; 
                          }
                          else if (!in_array($extension, $allowed_extensions)) {
                            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>"; 
                        
                        } 
                        else {
                            //rename the image file
                            $uploadPhotos =  $bizName.'_'. $samplePhotos;
                            // Code for move image into directory
                            $status = 1;
                            $select_biz = "SELECT bizID FROM tblbusineses WHERE lionsID = $lionsID";
                            $sth = $con->query($select_biz);
                            $result = $sth->fetch(PDO::FETCH_ASSOC);
                            if (!empty($result)) {
                                $bizID = $result['bizID'];
                                // echo $bizID; exit;
                            }
                            $insert = "INSERT into tblsamplephotos values(NULL, $bizID,'$uploadPhotos', NOW())";
                            // echo $insert; exit;
                            $query = $con->query($insert);
            
                            if ($query) {
                                move_uploaded_file($_FILES["sample_photos"]["tmp_name"][$i], "../samplePhotos/" . $uploadPhotos);
                               
                            } else {
                                // $error = "Something went wrong . Please try again.";
                                echo "<script> 
                        alert('Something went wrong . Sample photos not uploaded')
                        history.back()
                    </script>";
                            }
                        }
                    }
                  
                        echo "<script> 
                        alert('Hurray! Business Successfully Added')
                        history.back()
                    </script>";
                 } else {
                    echo "<script> 
                    alert('Something went wrong. Business not Added')
                    history.back()
                </script>";
                    //  $error = "Something went wrong . Please try again.";
                 }
                
             } else{
                echo "<script> 
                alert('Sorry, Seems Entry Already Exists')
                history.back()
                </script>";
            } 

         }
                    }
       

    }
    
    ?>