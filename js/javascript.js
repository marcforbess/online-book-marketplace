const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})

function showPasswordLogIn() {
  var reveal = document.getElementById("password");
  if (reveal.type === "password") {
    reveal.type = "text";
  } else {
    reveal.type = "password";
  }
}

function showPasswordSignUp() {
  var reveal = document.getElementById("passwordsignup");
  if (reveal.type === "password") {
    reveal.type = "text";
  } else {
    reveal.type = "password";
  }
} 




function uploadBookPicTrigger(){
  document.querySelector('#bookImage').click();
}

function displayPicture(e){
  if(e.files[0]){
    
    var reader = new FileReader();

    reader.onload = function(e){
      document.querySelector('#picPlaceholder').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  } else{
    alert("Error unable to upload image");
  }
}


function uploadBookPicTrigger2(){
  document.querySelector('#bookImage2').click();
}

function displayPicture2(e){
  if(e.files[0]){
    
    var reader = new FileReader();

    reader.onload = function(e){
      document.querySelector('#picPlaceholder2').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  } else{
    alert("Error unable to upload image");
  }
}



function uploadBookPicTrigger3(){
  document.querySelector('#bookImage3').click();
}

function displayPicture3(e){
  if(e.files[0]){
    
    var reader = new FileReader();

    reader.onload = function(e){
      document.querySelector('#picPlaceholder3').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  } else{
    alert("Error unable to upload image");
  }
}



function uploadBookPicTrigger4(){
  document.querySelector('#bookImage4').click();
}

function displayPicture4(e){
  if(e.files[0]){
    
    var reader = new FileReader();

    reader.onload = function(e){
      document.querySelector('#picPlaceholder4').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  } else{
    alert("Error unable to upload image");
  }
}



function uploadBookPicTrigger5(){
  document.querySelector('#bookImage5').click();
}

function displayPicture5(e){
  if(e.files[0]){
    
    var reader = new FileReader();

    reader.onload = function(e){
      document.querySelector('#picPlaceholder5').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  } else{
    alert("Error unable to upload image");
  }
} 


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

    



/*function displayToast(){

  const toastTrigger = document.getElementById('liveToastBtn')
  const toastLiveExample = document.getElementById('liveToast')
  if (toastTrigger) {
    toastTrigger.addEventListener('click', () => {
    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}

} */









/*$(document).ready(function() {

  $("button").click(function(){

    $.get("test.txt", function(data, status) {

          $("#text").html(data);
          alert(status);
    })

  });

}); */



/*  $(document).ready(function (){
    $('#signup-btn').submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var submit = $('#signup-btn');
    var course = $('#user-course');
    var firstname = $('#firstname');
    var lastname = $('#lastname');
    var phonenum = $('#phonenum');
    var email = $('#signup-email');
    var password = $('#passwordsignup');
    $('.error-message').load('process_signup.php', {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      'submit':submit,
      'course':course,
      'firstname':firstname,
      'lastname':lastname,
      'phonenum':phonenum,
      'email':email,
      'password':password 

      submit:submit,
      course:course,
      firstname:firstname,
      lastname:lastname,
      phonenum:phonenum,
      email:email,
      password:password 

    });

  });
});  */



/*$(document).ready(function (){
  $("form").submit(function(event) {

    //Prevent default action of form
    event.preventDefault();

    //Get variables from input field
    
    var submit = $("#login-btn");
    var course = $("#user-course");
    var firstname = $("#firstname");
    var lastname = $("#lastname");
    var phonenum = $("#phonenum");
    var email = $("#signup-email");
    var password = $("#passwordsignup");
    $(".error-message").load("process_signup.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      'submit':submit,
      'course':course,
      'firstname':firstname,
      'lastname':lastname,
      'phonenum':phonenum,
      'email':email,
      'password':password

    });

  });
}); */


/*(function () {
'use strict'
const forms = document.querySelectorAll('.requires-validation')
Array.from(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})() */

