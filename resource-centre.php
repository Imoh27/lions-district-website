<?php

include("assets/main-header.php");
?>
<title>Resource Center - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/topbar.php");
  include("assets/navbar.php");
  $sql = mysqli_query($con, "SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
  $lsyrow = mysqli_fetch_array($sql);
  $serviceYrID = $lsyrow['serviceYrID'];
  ?>

  <!--/ Navigation end -->
  </header>
  <!--/ Header end -->
  <section id="main-container" class="main-container pb-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 text-left">
          <h3 class="mb-0">Resource Center </h3>
          <em style="font-size: 14px; margin-top: -30px !important">Download all training materials here</em>
        </div>
      </div>
      <!--/ Title row end -->
      <div class="row col-md-8 mt-5 text-left">
        <table class="table table-hover" id="sample-table-1">
         
          <tbody>
            <?php
            $sql = mysqli_query($con, "SELECT * from tblresources");
            $cnt = 1;
            while ($row = mysqli_fetch_array($sql)) {
            ?>
              <tr>
                <td class="center"><?php echo $cnt; ?>.</td>
                <!-- <td><?php echo $row['trainingTitle']; ?></td> -->
                <td><a href="resources/<?php echo $row['fileName']; ?>"  onClick="return confirm('You are about to Download resource for <?php echo $row['trainingTitle']; ?>?')" ><?php echo $row['trainingTitle']; ?></a></td>
                <td class="user-profile img-fluid">
                  <?php if ($row['fileType'] == 'ppt' || $row['fileType'] == 'pptx') { ?>
                    <img src="../images/ppt.png" height="50" width="30" class="img-fluid"> <?php } else if ($row['fileType'] == 'pdf') { ?>
                    <img src="../images/pdf.webp" height="50" width="30" class="img-fluid"> <?php } ?>
                </td>
                <td><?php echo $row['fileSize']; ?></td>

                </td>
                 <td>Added on: <?php echo date('d-m-Y', strtotime($row['dateUpdated'])); ?></td>
                <td>
                    <a href="resources/<?php echo $row['fileName']; ?>" 
                    onClick="return confirm('You are about to Download resource for <?php echo $row['trainingTitle']; ?>?')" 
                    class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Download Now">
                    <img src="images/download-button.png" height="30" width="30" class="img-fluid" style="margin-top: -10px">
                    </a>
                
                </td>
              </tr>
            <?php
              $cnt = $cnt + 1;
            } ?>
          </tbody>
        </table>
      </div>
    </div><!-- Container end -->
  </section><!-- Main container end -->

  <?php

  include("assets/footer.php");
  ?>
</body>

</html>