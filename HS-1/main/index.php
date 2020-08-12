<?php session_start(); 
if($_SESSION['username']==null){
header("Location: /HS-1/HS-1/index.php");
}
?>


<?php
include "addons/db_conn.php";
?>

<!-- Header -->
<?php
include "addons/header.php";
?>
    
<!-- Navigation -->
<?php
include "addons/nav.php";
?>


<h1 class="page-header">
    Welcome  
                   
    <small><?php echo $_SESSION['username'] ?></small>
 </h1>


 <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Members -->
            
            <div class="col-md-8">
            
                

                <!--bxhbcbB-->

    <div class="container">
        
        <img src="images/door.png" alt="">
               
    </div>
    
   
    <div class = "camera">
         <img src="images/cam_bg.png" alt="" width="90px" height="90px" id="camera">
    
         <br>
        <p id="camera_p">Last Active
          </p>  

       
        <p id="camCount">Status
                    </p>  
 
  
    </div> 
    
    
    <div class = "lock">
        
        <img src="images/door_lock.png" alt="" width="70px" height="70px" id="lock">
        
 
       <br>
        <p id="lock_p">Last Active
          </p>  

       
        <p id="doorCount">Status
                    </p>    
    </div>        
    
       
    <div class = "motion">
         <img src="images/foot_bg.png" alt="" id="motion">   
         
   <br>
        <p id="motion_p">Last Active
          </p>  

       
        <p id="viewCount">Status
                    </p>  
    
    </div> 
         
     
        

<!--bxhjbhsvh-->
   
              </div>
            <div class="col-md-1">        </div>  
			<div class="col-md-2">
				<div class="row">
					<h1> Notification Center</h1>
					<div class="card" style="width: 18rem;">
  						<strong id="image2">  </strong>
  						<div class="card-body">
    						<h5 id="time2" class="card-title"></h5>
    						<p id="message2" class="card-text"></p>
    						<strong id="allow">  </strong><strong id="deny">  </strong>
							
  						</div>
					</div>
				</div>
				<div class="row">
					<div class="card" style="width: 18rem;">
  						<strong id="image">  </strong>
  						<div class="card-body">
    						<h5 id="time" class="card-title"></h5>
    						<p id="message" class="card-text"></p>
    						<strong id="all">  </strong>
							
  						</div>
					</div>
				</div>
			</div>  

            </div>
<hr>

<?php
include "addons/footer.php";
?>
<script>

 function liveDataUpdate () {
	
	const textViewCount = document.getElementById('viewCount');
	
	setInterval(function () {
		
		fetch("viewCount.php").then(function(response){
			return response.json();
		}).then(function(data){
			if(data.viewCount == 1){
			textViewCount.textContent = "Active Movement";
		}else{
			textViewCount.textContent = "No Movement";
			}
						

		}).catch(function(error){
			console.log(error);
		})
		
	}, 1000);
	
	
}

function liveCamDataUpdate () {
	
	const textViewCount = document.getElementById('camCount');
	
	setInterval(function () {
		
		fetch("camCount.php").then(function(response){
			return response.json();
		}).then(function(data){
			if(data.viewCount == 1){
			textViewCount.textContent = "ON";
		}else{
			textViewCount.textContent = "OFF";
			}
						

		}).catch(function(error){
			console.log(error);
		})
		
	}, 1000);
	
	
}
	
function liveLockDataUpdate () {
	
	const textViewCount = document.getElementById('doorCount');
	
	setInterval(function () {
		
		fetch("doorCount.php").then(function(response){
			return response.json();
		}).then(function(data){
			if(data.viewCount == 1){
			textViewCount.textContent = "Unlocked";
		}else{
			textViewCount.textContent = "Locked";
			}
						

		}).catch(function(error){
			console.log(error);
		})
		
	}, 1000);
	
	
}
	
function liveNotifUpdate () {
	
	const time = document.getElementById('time');
	const image = document.getElementById('image');
	const message = document.getElementById('message');
	const link = document.getElementById('all');
	
	setInterval(function () {
		
		fetch("notifs.php").then(function(response){
			return response.json();
		}).then(function(data){
			
			time.textContent = data.time;
			image.innerHTML =  data.img;
			message.textContent = data.message;
			link.innerHTML= data.link;
						

		}).catch(function(error){
			console.log(error);
		})
		
	}, 1000);
	
	
}

function liveRequestUpdate () {
	
	const time = document.getElementById('time2');
	const image = document.getElementById('image2');
	const message = document.getElementById('message2');
	const allow = document.getElementById('allow');
	const deny = document.getElementById('deny');
	
	setInterval(function () {
		
		fetch("requests.php").then(function(response){
			return response.json();
		}).then(function(data){
			
			time.textContent = data.time;
			image.innerHTML =  data.img;
			message.textContent = data.message;
			deny.innerHTML = data.deny;
			allow.innerHTML = data.allow;
						
		}).catch(function(error){
			console.log(error);
		})
		
	}, 1000);
	
	
}
	
function liveLastUpdate () {
	
	const camera = document.getElementById('camera_p');
	const lock = document.getElementById('motion_p');
	const motion = document.getElementById('lock_p');

	
	setInterval(function () {
		
		fetch("lastActive.php").then(function(response){
			return response.json();
		}).then(function(data){
			
			camera.innerHTML = data.camera;
			lock.innerHTML =  data.lock;
			motion.textContent = data.motion;
						
		}).catch(function(error){
			console.log(error);
		})
		
	}, 1000);
	
	
}
	
document.addEventListener("DOMContentLoaded", function(){
	liveDataUpdate();
	liveCamDataUpdate();
	liveLockDataUpdate();
	liveNotifUpdate();
	liveRequestUpdate();
	liveLastUpdate();
});
	

</script>

