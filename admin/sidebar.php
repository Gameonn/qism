 <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="#"><img src="<?php echo BASE_PATH; ?>assets/img/ui-danro.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Admin
              	  <?#php echo $_SESSION['admin']['username']; ?> </h5>
              	  	
                  <li class="mt">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"dashboard.php")) echo 'class="active"'; ?> href="dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <?php if($_SESSION['admin']['type']==1){ ?> 
                    <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"sub_admin.php")) echo 'class="active"'; ?> href="sub_admin.php" >
                          <i class="fa fa-user"></i>
                          <span>Create Sub Admin</span>
                      </a>
                    </li>

		    <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"community.php")) echo 'class="active"'; ?> href="community.php" >
                          <i class="fa fa-tasks"></i>
                          <span>Community</span>
                      </a>
                    </li>
                    
                     <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"occupation.php")) echo 'class="active"'; ?> href="occupation.php" >
                          <i class="fa fa-university"></i>
                          <span>Occupation</span>
                      </a>
                    </li>
                    
                     <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"industry.php")) echo 'class="active"'; ?> href="industry.php" >
                          <i class="fa fa-cogs"></i>
                          <span>Industry</span>
                      </a>
                    </li>
                    
                     <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"ethnic_origins.php")) echo 'class="active"'; ?> href="ethnic_origins.php" >
                          <i class="fa fa-life-ring"></i>
                          <span>Ethnic Origins</span>
                      </a>
                    </li>
                    
                     <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"education.php")) echo 'class="active"'; ?> href="education.php" >
                          <i class="fa fa-book"></i>
                          <span>Education</span>
                      </a>
                    </li>
                    
                     <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"sects.php")) echo 'class="active"'; ?> href="sects.php" >
                          <i class="fa fa-th-large"></i>
                          <span>Sects</span>
                      </a>
                    </li>
                    
                        <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"reports.php")) echo 'class="active"'; ?> href="reports.php" >
                          <i class="fa fa-briefcase"></i>
                          <span>Reports</span>
                      </a>
                    </li>
                    
                        <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"suggestions.php")) echo 'class="active"'; ?> href="suggestions.php" >
                          <i class="fa fa-archive"></i>
                          <span>Suggestions</span>
                      </a>
                    </li>
                    <?php } ?>
                     <li class="sub-menu">
                      <a <?php if(stripos($_SERVER['REQUEST_URI'],"users.php")) echo 'class="active"';  ?>  href="users.php">
                          <i class="fa fa-users"></i>
                          <span>Users</span>
                      </a>
                    <!--  <ul class="sub">
                          <li <?php if(stripos($_SERVER['REQUEST_URI'],"users.php")) echo 'class="active"'; ?> href="users.php"><a href="users.php" >All Users</a></li>
                           <li <?php if(stripos($_SERVER['REQUEST_URI'],"verify_user.php")) echo 'class="active"'; ?> href="verify_user.php"><a href="verify_user.php">Verify Users</a></li>
                        <li <?php if(stripos($_SERVER['REQUEST_URI'],"report_users.php")) echo 'class="active"'; ?> href="report_users.php" ><a href="report_users.php">Report Users</a></li>
                      </ul> -->
                    </li>

               <!--   <li class="sub-menu">
                      <a class="" href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>UI Elements</span>
                      </a>
                      <ul class="sub">
                          <li class=""><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="panels.html">Panels</a></li>
                      </ul>
                  </li> -->
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->