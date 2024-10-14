<!-- sidebar menu -->
<?php 
	$admin_sql = "SELECT * From admin WHERE username = '".$_SESSION['login']."'";
	// echo $admin_sql;exit;
	$admin_result = mysqli_query($con, $admin_sql);
	$admin_row = mysqli_fetch_array($admin_result);
	// echo $admin_row['admintype'].' - '.$admin_row['username']; exit;
	?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>General</h3>
		<ul class="nav side-menu">
			<li><a href="dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
			<li><a><i class="fa fa-users"></i> District <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<!-- <li><a href="doctor-specilization">Doctor Specialization</a></li> -->
					<!-- <li><a href="add-doctor">Add Doctor</a></li> -->
					<li><a href="all-district-offices">Offices</a></li>
					<li><a><i class="fa fa-user-md"></i> Leaders <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="manage-international-leaders">International Leaders</a></li>
							<li><a href="manage-past-district-governors">Past District Governors</a></li>
							<li><a href="manage-dgteam">DG's Team</a></li>
							<li><a href="manage-core-officers">Core Officers</a></li>
						</ul>
					</li>
					<li><a href="manage-core-projects">Core Project</a></li>
					<!-- <li><a><i class="fa fa-calendar"></i> Core Projects <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="manage-focus-areas">Focus Areas</a></li>
							<li><a href="manage-core-projects">Core Projects</a></li>
						</ul>
					</li> -->
				</ul>
			</li>
			<li><a><i class="fa fa-users"></i> Region <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="manage-regions-and-zones">Regions/Zones</a></li>
					<li><a href="manage-region-and-zone-chairpersons">Regions/Zone Chairpersons</a></li>
				</ul>
			</li>
			<li><a><i class="fa fa-group"></i> Clubs <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="manage-clubs">Clubs</a></li>
					<li><a href="manage-club-presidents">Club Presidents</a></li>
				</ul>
			</li>
			<li><a><i class="fa fa-trophy"></i> Event <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="manage-category">Events Category</a></li>
					<li><a href="manage-events">Events</a></li>
					<li><a href="manage-events-gallery">Events Gallery</a></li>
				</ul>
			</li>
			<!-- <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="manage-users">Manage Users</a></li>
				</ul>
			</li>
			<li><a><i class="fa fa-user"></i> Patients <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="manage-patient">Manage Patients</a></li>
				</ul>
			</li>
			<li><a href="appointment-history"><i class="fa fa-folder-open"></i> Appointment History</a></li> -->
			<li><a><i class="fa fa-table"></i> Conatct Us Queries <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="unread-queries">Unread Query</a></li>
					<li><a href="read-query">Read Query</a></li>
				</ul>
			</li>
			<!-- <li><a href="doctor-logs"><i class="fa fa-line-chart"></i> Session Logs</a></li> -->
			<li><a href="user-logs"><i class="fa fa-line-chart"></i> User Session Logs</a></li>
			<li><a><i class="fa fa-bar-chart"></i> Other Settings <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<?php
					
					if($admin_row["admintype"] == 'super'){?>
					<li><a href="manage-admin-users">All Users </a></li>
					<?php } ?>
					<li><a href="manage-service-year">Service Year </a></li>
					<li><a href="upload-acceptance-speech">Upload Acceptance-speech </a></li>
					<!-- <li><a href="between-dates-reports">B/w dates reports </a></li> -->
				</ul>
			</li>
			<li><a href="patient-search"><i class="fa fa-hospital-o"></i> Search</a></li>
			

		</ul>
	</div>
	<div class="menu_section">
		<h3>User</h3>
		<ul class="nav side-menu">
			<li><a href="change-password"><i class="fa fa-key"></i> Change Password</a></li>
			<li><a href="logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
		</ul>
	</div>
</div>