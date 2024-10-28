<?php
include "config.php";
if(!empty($_POST["stateID"])) 
{
 $stateID=intval($_POST['stateID']);
 $select = "SELECT * FROM tbllga WHERE stateID = $stateID";
 $sth = $con->query($select);
 $results = $sth->FetchAll(PDO::FETCH_ASSOC);
?>
<option value="">Select LGA</option>
<?php
 foreach ($results as $lga) {?>
  <option value="<?php echo htmlentities($lga['lgaID']); ?>"><?php echo htmlentities($lga['lgaName']); ?></option>
  <?php
 }
}
?>