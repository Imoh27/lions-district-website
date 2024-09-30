<?php

require_once("../include/config.php");
if(!empty($_POST["region"])) 
{
 $region=intval($_POST['region']);
$query=mysqli_query($con,"SELECT * FROM tblzone WHERE regionID =$region");
?>
<option value="">Select Zone</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['zoneID']); ?>">Zone <?php echo htmlentities($row['zoneName']); ?></option>
  <?php
 }
}
?>