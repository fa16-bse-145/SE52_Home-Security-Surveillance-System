   <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#0099CC">
        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <!-- minimize screen to see navbar collapse toggle -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="#" style="color: white">Home Security Surveillance</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                    
                    <li>
                        <a href="index.php" style="color: white">Security</a>
                    </li>
                    
                     
                    
                    <li>
                        <a href="members.php" style="color: white">Members</a>
                    </li>

                </ul>
                

                <?php 
                $get_count = "SELECT * from securitynotifications WHERE Status = 0";
                
                $result = mysqli_query($connection, $get_count);
                
                $count = mysqli_num_rows($result);
                
                ?>
               
                  <ul class="nav navbar-nav navbar-right">
                   
                   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:white"><i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge badge-light" id="count"><?php echo $count; ?></span> <b class="caret"></b></a>
                    
                      <ul class="dropdown-menu alert-dropdown">
                         
                         
                        

                <li class="divider"></li>
                        <li>
                            <a href="unread_notifs.php">Unread Notifications</a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="notifications.php">View All</a>
                        </li>
                    </ul>
                </li>
              
                 
                 
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white"><i class="fa fa-user"></i> 
                    Options<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                       
                        
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                    
                 
                    
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        
                        
                        
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        -->
                </li>
                
                </ul>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>