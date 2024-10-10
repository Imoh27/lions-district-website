<div class="container body">
	<div class="main_container">
		<!-- page content -->
		<div class="col-md-3 left_col">
			<div class="left_col scroll-view">
				<div class="navbar nav_title justify-content-center" style="border: 0;">
					<a href="dashboard.php"><img style="height: 50px; display:flex" class="mt-3 img-fluid" src="../../images/logo-ion.png" alt=""></a>
				</div>
				<div class="clearfix"></div>
				<!-- menu profile quick info -->
				<div class=" profile clearfix">
					<div class="text-center ml-2 mt-3 text-light">Lions District 404A2</div>
					<div class=" profile_pic">
						<img src="assets/images/img.jpg" alt="..." class="img-circle profile_img">
					</div>
					<div class="profile_info">
						<span>Welcome,</span>
						<h2><?php echo $_SESSION['login']; ?></h2>
					</div>
				</div>
				<!-- /menu profile quick info -->
				<br />
				<?php include('include/sidebar.php');?>
				<!-- /sidebar menu -->
				<!-- /menu footer buttons -->
				<div class="sidebar-footer hidden-small">
					<a data-toggle="tooltip" data-placement="top" title="Settings">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					</a>
					<a data-toggle="tooltip" data-placement="top" title="FullScreen">
						<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
					</a>
					<a data-toggle="tooltip" data-placement="top" title="Lock">
						<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
					</a>
					<a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
						<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
					</a>
				</div>
				<!-- /menu footer buttons -->
			</div>
		</div>
		<!-- top navigation -->
		<div class="top_nav">
			<div class="nav_menu">
				<div class="nav toggle">
					<a id="menu_toggle"><i class="fa fa-bars"></i></a>
				</div>

				<nav class="nav navbar-nav">
					<ul class=" navbar-right">
						<li class="nav-item dropdown open" style="padding-left: 15px;">
							<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
								<img src="assets/images/img.jpg" alt=""><?php echo $_SESSION['login']; ?>
							</a>
							<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item"  href="change-password.php"> Change Password</a>
								<a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
							</div>
						</li>
						<?php
 						$contact_sql="SELECT * FROM  tblcontactus WHERE isRead =0";
						//  echo $contact_sql; exit;
						 $contact_query = mysqli_query($con, $contact_sql);
						
						 $count = mysqli_num_rows($contact_query);
						//  echo $count; exit;

						?>
						<li role="presentation" class="nav-item dropdown open">

							<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-envelope-o"></i>
								<span class="badge bg-red"><?php echo  $count ?></span>
							</a>
							<ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
								<?php 
								while($contact_row = mysqli_fetch_array($contact_query)){

// echo round(abs($to_time - $from_time) / 60,2). " minute";
									// $datetime = date('H:i:s');
									// $totime = strtotime(date('Y-m-d H:i:s')) ;
									// $fromtime = strtotime($contact_row["contactDate"]);
									// $tohr = round(abs($totime - $fromtime));

									// $actutaltime = round(abs($totime - $fromtime) / 60,2). " minute";
									// $actutalhr = ceil($actutaltime / 60). " hrs";
									// echo $dateDiff; exit;

								?>
								<li class="nav-item" >
									<a class="dropdown-item" href="query-details?id=<?php echo $contact_row['id'] ?>">
										
										<span>
											<span><?php echo $contact_row['fullname'] ?></span>
											<span class="time"><?php echo date('d-m-Y H:m:s', strtotime($contact_row['contactDate']))?></span>
										</span>
										<span class="message" style="font-weight:bold !important">
										<?php echo $contact_row['messageSubject'];?>
										</span>
									</a>
								</li>
								<?php } ?>
								<li class="nav-item">
									<div class="text-center">
										<a class="dropdown-item" href="unread-queries">
											<strong>See All Alerts</strong>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- /top navigation -->
		<div class="right_col" role="main">
			<?php if(isset($x_content) && $x_content): ?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="x_panel">
							<div class="x_title">
								<h2><?php echo $page_title??''; ?></h2>
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
									<li><a class="close-link"><i class="fa fa-close"></i></a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
							<?php endif; ?>
							<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
							<?php echo htmlentities($_SESSION['msg']="");?></p>