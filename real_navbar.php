<script type="text/javascript">

$(document).ready(function (){
    $("#form-signup").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var submit = $("#signup-btn").val();
    var course = $("#user-course").val();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var phonenum = $("#phonenum").val();
    var email = $("#signup-email").val();
    var password = $("#passwordsignup").val();
    $(".error-message-signup").load("validate_signup.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      submit:submit,
      course:course,
      firstname:firstname,
      lastname:lastname,
      phonenum:phonenum,
      email:email,
      password:password 

    })

  });
});   


//AJAX FOR LOGIN
$(document).ready(function (){
    $("#form-login").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var submit = $("#login-btn").val();
    var usertype = $("#user-type").val();
    var useremail = $("#login-email").val();
    var password = $("#password").val();
    
    $(".error-message-login").load("validate_login.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      submit:submit,
      usertype:usertype,
      useremail:useremail,
      password:password

    })

  });
});

//AJAX FOR CLEARING NOTIFICATIONS
$(document).ready(function (){
    $("#clear-noti").click(function() {

    //Prevent default action of form
    //e.preventDefault();

    //Get variables from input field
    
    $(".notifications").load("load_noti.php?cm=<?php echo urlencode(base64_encode('clear')); ?>", {

    })

  });
});





  

  function loadDoc(){

    setInterval(function(){

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("noti_count").innerHTML = this.responseText;

        }

      };
      xhttp.open("GET", "getNoti.php", true);
      xhttp.send();


    },1000);

}
  loadDoc();

  $(document).ready(function (){
    $("#dropdownMenuButton1").click(function() {
      
    
    $(".notifications").load("load_noti.php", {
       
    })

  });
});



</script>






<!-- NAVBAR -->
<?php 
  
  if(isset($_SESSION['adminID'])){

    echo '<nav class="navbar navbar-dark navbar-admin">';

  } else {

    echo '<nav class="navbar navbar-dark navbar-custom">';
  }
?>
<!--<nav class="navbar navbar-dark navbar-custom"> -->
  <div class="container-fluid" id="aights"> 
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">  </span>
    </button>

    <?php 
      if(isset($_SESSION['adminID'])){

        echo '<a class = "navbar-brand" href="admin_index.php"><img src="somepics/new-logo.svg" alt="Logo" width="120" height="60" class="align-text-bottom logo-sizing"></a> ';


      } else {

         echo '<a class = "navbar-brand" href="index.php"><img src="somepics/new-logo.svg" alt="Logo" width="120" height="60" class="align-text-bottom logo-sizing"></a>'; 


      }
    ?>
   


<?php 
  
  //btn btn-outline-info rounded-pill
  if(isset($_SESSION['userID'])){
  echo '<div class="dropdown">
      <button class="btn border-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell bell-color"></i><span class="badge bg-danger" id="noti_count"></span>
      </button>
      <div class="dropdown-menu dropdown-width overflow-auto" aria-labelledby="dropdownMenuButton1">
        <p class="noti-head"><i class="bi bi-bell-fill"></i>Notifications<p>
        <div class="px-3">
        <button class="clear-noti btn btn-outline-info rounded-pill w-100" id="clear-noti"><i class="bi bi-trash icon-mr"></i>Clear</button></div>
        <hr class="dropdown-divider"></hr>
        <div class="notifications"></div>
       
      


      </div>

      </div>';
    }


  ?>


    <!--</div> -->


    <!--Search Bar -->
     <form action="searchresult.php" method="GET" class="form-width">
      <div class="input-group input-group-mod">
        <input type="text" name="search-query" class="form-control border-0" placeholder="Search by Title/Author/Subject Code or ISBN (ISBN No. Format: XXX-X-XX-XXXXXX-X)" aria-label="search" aria-describedby="button-addon2" required>
        <select class="search-by" name="search-by">
          <option value="title">Title</option>
          <option value="isbn">ISBN</option>
        </select>

        <?php 
          if(isset($_SESSION['adminID'])){

           echo '<button class="btn btn-search-admin" type="submit" id="button-addon2"><i class="bi bi-search"></i>';

          } else {

              echo '<button class="btn search-btn" type="submit" id="button-addon2"><i class="bi bi-search text-white"></i>';


          }

        ?>
        <!--<button class="btn btn-primary" type="submit" id="button-addon2"><i class="bi bi-search"></i>-->
        </button>
      </div>
    </form>

    
    <!--<p class="navbar-brand">TEST LOGO PLACEMENT</p> -->
   <!-- <button type="button" class="btn btn-danger login-btn">Log in</button> -->

   <!--Login Form-->
   <div class="modal fade" id="loginForm" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h1 class="modal-title fs-5 w-100" id="login-header">Login</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!--Body of login form -->
          <form method="POST" id="form-login">
          <div class="modal-body">
            <select class="form-select form-select-sm" id="user-type" aria-label=".form-select-sm example">
              <option value="users">User</option>
              <option value="admin">Admin</option>
              
            </select>
            <?php
              //Error messages
            ?>
            <p class="error-message-login"></p>
            <input class="form-control form-control-mod form-control-lg border-0 bg-grey" id="login-email" type="text" placeholder="E-Mail Address" required>

            <input class="form-control form-control-mod form-control-lg border-0 bg-grey" type="password" placeholder="Password" id="password" required>

            <input type="checkbox" id="show-password"  onclick="showPasswordLogIn()"> Show Password


          </div>
          <div class="modal-footer">
             <button type="submit" class="btn btn-success" id="login-btn">Login</button>

          </div>

        </form>
        </div>
      </div>
    </div>
    <!--END OF LOGIN FORM -->








    <!--SIGN UP FORM -->
      <div class="modal fade" id="signupForm" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h1 class="modal-title fs-5 w-100" id="login-header">Sign Up</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!--Body of signup form -->
          <form id="form-signup" method="POST" class="needs-validation">
          <div class="modal-body has-validation">
            <select class="form-select form-select-md" id="user-course" name="user-course" required>
              <option value="" selected>--Select your course--</option>
              
              <?php 

              /*  $getcourse = "SELECT * FROM course";
                $result = mysqli_query($connect, $getcourse);
                while($fetchedrows = mysqli_fetch_array($result)){
                  echo "<option value = '".$fetchedrows[0]."'>".$fetchedrows[2]."</option>";
                } */

                $getcourse = getAllCourse($connect);
                foreach ($getcourse as $fetchedrows) {
                  
                  echo "<option value = '".$fetchedrows['course_id']."'>".$fetchedrows['course_name']."</option>";

                } 

              ?>
              
            </select> 
            <?php
              //Here is the error message
            /*if(isset($script)){
              echo $script;
            } */
            ?> 

            <p class="error-message-signup"></p>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control form-control-mod form-control-lg border-0 bg-grey" placeholder="First name" aria-label="First name" id="firstname" name="firstname" required>
                <div class="invalid-feedback">
                  Please provide a valid input.
                </div>
              </div>
              <div class="col">
                <input type="text" class="form-control form-control-mod form-control-lg border-0 bg-grey" placeholder="Last name" aria-label="Last name" id="lastname" name="lastname" required>
              </div>
            </div>

            <input class="form-control form-control-mod form-control-lg border-0 bg-grey" type="tel" pattern="[0-9]{10}" placeholder="Phone Number Format: 01XXXXXXXX" id="phonenum" name="phonenum" required>

            <input class="form-control form-control-mod form-control-lg border-0 bg-grey" type="text" placeholder="E-Mail Address" name="email" id="signup-email" required>

            <input class="form-control form-control-mod form-control-lg border-0 bg-grey" type="password" placeholder="Password" id="passwordsignup" name="password" required>

            <input type="checkbox" id="show-password"  onclick="showPasswordSignUp()"> Show Password


          </div>
          <div class="modal-footer">
             <button class="btn btn-success" type="submit" id="signup-btn" name="submit-register">Sign Up</button>

          </div>

        </form>
        </div>
      </div>
    </div>

  </div>
</nav>

<!--MENU-->
<div class="offcanvas offcanvas-start hide" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
  <div class="offcanvas-header" style="color:white">
   <h2 class="offcanvas-title" id="offcanvasLabel"></h2>
    <button type="button" style="color:white" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div> 
  <div class="offcanvas-body">
    <div class="user-container"> 

      <?php 
          if(isset($_SESSION['userID'])){
           /*   $userid = $_SESSION['userID'];
              $userprofilepic = "";

              //If user has no profile picture, then set to default profile picture
              $checkprofilepicstatus = "SELECT * FROM profilepic WHERE user_id = '$userid' LIMIT 1";
              $checkprofilepicstatusresult = mysqli_query($connect, $checkprofilepicstatus);


              if(mysqli_num_rows($checkprofilepicstatusresult) == 1){
                $fetchedStatus = mysqli_fetch_assoc($checkprofilepicstatusresult);
                $_SESSION['userpicpath'] = $fetchedStatus['pic_path'];

                //If user hasnt set profile pic
                if($fetchedStatus['status'] == 0){
                  $userprofilepic = 0;
                  echo '<img src="profile/'.$_SESSION['userpicpath'].'" class="user-pic">';


                } else{

                  $userprofilepic = 1;
                 // echo "<img src='profile/profile".$userid.".jpg?'".mt_rand()." class='user-pic'>";
                  echo '<img src="profile/'.$_SESSION['userpicpath'].'" class="user-pic">';

                  //echo "<img src='profile/profile".$userid.".'"$userext".mt_rand()." class='user-pic'>";
                  //echo '<img src = "profile/profile"'.$userid.'"."'.$userext.'"?"'.mt_rand().'" class = "user-pic">"';

                }

              }    */
              echo '<img src="profile/'.$_SESSION['userpicpath'].'" class="user-pic">';
              echo '<label>Welcome,</label>';
                  echo '<div class="dropdown dropdown-settings">
                            <button class="btn btn-secondary dropdown-toggle border-0 text-truncate" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              '.$_SESSION['userfname'].' '.$_SESSION['userlname'].'
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="process_logout.php">Log out</a></li>
                              
                            </ul>
                      </div>';     


          } else if(isset($_SESSION['adminID'])){

            echo '<img src="adminprofile/'.$_SESSION['adminpicpath'].'" class="user-pic">';

             echo '<label>Welcome,</label>';
                  echo '<div class="dropdown dropdown-settings">
                            <button class="btn btn-secondary dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              '.$_SESSION['adminfname'].' '.$_SESSION['adminlname'].'
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="process_logout.php">Log out</a></li>
                              
                            </ul>
                      </div>';     


          } else {

            echo '<label>Greetings, </label>';
            echo '<div class="dropdown dropdown-settings">
                  <button class="btn btn-secondary dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style = "margin-left: 10px">
                    Login/Sign Up
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php" data-bs-toggle="modal" data-bs-target="#loginForm">Login</a></li>
                    <li><hr class="dropdown-divider"></hr></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupForm">Sign Up</a></li>
                  </ul>
            </div>';

          }
      ?>
      <!--<img class = "user-pic" src="somepics/avatar.png"> -->
      <!--<label>Welcome,</label> -->
      <!--<label>Hello World</label>
      <label>Dropdown </label> -->
     <!-- <div class="dropdown dropdown-settings">
          <button class="btn btn-secondary dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            User
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="test_index.php" data-bs-toggle="modal" data-bs-target="#loginForm">Login</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupForm">Sign Up</a></li>
          </ul>
    </div> -->
    </div>


	<div class="list-group menu">

    <?php 
      if(isset($_SESSION['adminID'])){

        echo '<a href="admin_index.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-columns-gap"></i>Dashboard</a>';

        if($_SESSION['adminType']==1){

           echo '<a href="newAdmin.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-person-plus"></i>New Admin</a>';

        }

        echo '<a href="newCourse.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-clipboard2-plus"></i>Courses</a>';

        echo '<a href="newCategory.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-list-columns-reverse"></i>Categories</a>';




      } else {

        echo ' <a href="index.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-house-door-fill"></i>Home</a>';
      }
    ?>

    <?php 

    if(isset($_SESSION['userID'])){
      $getInOfferCount = getInOfferCount($connect, $_SESSION['userID']);
      echo '<a href="history_profile.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-person-fill"></i>My Profile</a>
    <a href="book_profiling.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-journal-plus"></i>Sell My Book</a>';

      if($getInOfferCount == 0){

          echo '<a href="offers.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-inboxes-fill"></i></i>Offers</a>';


      } else {

          echo '<a href="offers.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-inboxes-fill"></i></i>Offers<span class=" add-margin-left badge rounded-pill bg-danger">'.$getInOfferCount.'</span></a>';

      }

      echo '<a href="transactions.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-arrow-left-right"></i>Transactions</a>';

      echo '<a href="mywishlist.php" class="list-group-item list-group-item-action border-0"><i class="bi bi-bookmark-heart-fill"></i>My Wishlist</a>';

      

      
    }
    ?>
	  <!--<a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-person-fill"></i>History Profile</a>
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-journal-plus"></i>Book Profiling</a>
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-star-fill"></i>Rate</a>
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-bookmark-heart-fill"></i>My Wishlist</a> -->

    

	</div>


  </div>
</div>


<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/javascript.js"></script> -->