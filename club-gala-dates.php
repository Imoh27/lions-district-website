<?php

include("assets/main-header.php");
?>
<title>Club Gala Dates - Lions District 404A2</title>

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
          <h3 class="mb-0">Clubs Gala Date </h3>
          <em style="font-size: 14px; margin-top: -30px !important">Dates for Clubs Investiture</em>
        </div>
      </div>
      <!--/ Title row end -->
      <div class="row col-md-8 mt-5 text-left">
        <table class="table table-hover" id="sample-table-1">
         
          <tbody>
            <?php
            $sql = mysqli_query($con, "SELECT * from tblclubgaladates g JOIN tblclubs c ON c.clubID = g.clubID");
            $cnt = 1;
            // echo date('Y-m-d'); exit;
            while ($row = mysqli_fetch_array($sql)) {
            ?>
              <tr>
                <td class="center"><?php echo $cnt; ?>.</td>
                <td><?php echo $row['clubName']; ?></td>
                <td><?php echo $row['galaDate']; ?></td>

                <td><?php if($row['galaDate'] <= date('Y-m-d')){?><i class="fa fa-check-square"></i><?php } ?></td>

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