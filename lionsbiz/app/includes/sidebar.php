  <div class="col-md-4" style=" overflow-y: scroll !important; height:100% !important; padding-bottom:20px !important">

    <!-- Search Widget -->
    <div class="card mb-4">
      <h5 class="card-header">Search</h5>
      <div class="card-body">
        <form name="search" action="search.php" method="post">
          <div class="input-group">

            <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="submit">Go!</button>
            </span>
        </form>
      </div>
    </div>


    <!-- Categories Widget -->
    <div>
      
    </div>
    <div class="card my-2">
      <h5 class="card-header">Categories</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            
            <ul class="list-unstyled mb-0">
              <?php 
              $selectCetegory = "select * from tblcategory";
              $query = mysqli_query($con, $selectCetegory);
              while ($row = mysqli_fetch_array($query)) {
              ?>
                <li>
                  <a href="category.php?catid=<?php echo htmlentities($row['postCatID ']) ?>"><?php echo htmlentities($row['postCategory']); ?></a>
                </li>
              <?php } ?>
            </ul>
          </div>

        </div>
      </div>
    </div>
    

    <!-- Side Widget -->
    <div class="card my-4">
      <h5 class="card-header">Recent News</h5>
      <div class="card-body">
        <ul class="mb-0">
          <?php
          $postSelect = "select * from 
          tblpost p join tblsubcategory s on s.subCatID  =p.postCatID  Inner join  tblcategory c on  
          c.postCatID =s.categoryID  where p.isActive=1 order by p.postID desc LIMIT 6";
          $query = mysqli_query($con, $postSelect);
          while ($row = mysqli_fetch_array($query)) {

          ?>

            <li>
              <a href="news-details.php?nid=<?php echo htmlentities($row['postID']) ?>"><?php echo htmlentities($row['postTitle']); ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>

      <div class="card my-4">
        <h5 class="card-header"></h5>
        <div class="card-body">
          <h4 class="card-header">Advertise Here</h4>
          <img class="img-fluid" src="/../img/ads.png" alt="" srcset=""><hr>
          <img class="img-fluid" src="/../img/skyscrapper.png" alt="" srcset=""><hr>
          <!-- <img class="img-fluid" src="/../img/ads.png" alt="" srcset=""> -->
        </div>
      </div>

    </div>

  </div>
  </div>