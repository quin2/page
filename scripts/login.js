"use strict";

(function(){
  window.onload = function(){
    document.getElementById("password_newuser").oninput = checkPasswordLength;
    document.getElementById("password_newuser_reenter").oninput = checkPasswordMatch;
    document.getElementById("email_newuser").oninput = checkValidEmail;
    document.getElementById("uname").oninput = checkValidUsername;
  }

  function checkPasswordLength(){
    var thisTextBox = document.getElementById("password_newuser");
    if(thisTextBox.value.length < 6){
      thisTextBox.labels[0].innerHTML = "password: must be 6 characters or more";
      return false;
    }
    thisTextBox.labels[0].innerHTML = "password:";
    return true;
  }

  function checkPasswordMatch(){
    var passwordTextBox = document.getElementById("password_newuser");
    var confirmTextBox = document.getElementById("password_newuser_reenter");

    if(passwordTextBox.value === confirmTextBox.value){
      confirmTextBox.labels[0].innerHTML = "confirm password:";
      return true;
    }

    confirmTextBox.labels[0].innerHTML = "confirm password: must match";
    return false;
  }

  function checkValidEmail(){
    var emailBox = document.getElementById("email_newuser");

    if(emailBox.value.lastIndexOf(".") > emailBox.value.lastIndexOf("@") && emailBox.value.lastIndexOf("@") != -1){
      emailBox.labels[0].innerHTML = "email address:";
      return true;
    }
    emailBox.labels[0].innerHTML = "email address: must be valid";
    return false;
  }

  function checkValidUsername(){
    var userNameBox = document.getElementById("uname");
    if(userNameBox.value.length < 1){
      return false;
    }
    enableButton();
    return true;
  }


  function enableButton(){
    console.log('hi');
    if(checkPasswordLength() && checkValidEmail() && checkPasswordMatch()){
      document.getElementById("submitButton").disabled = false;
    }
  }
}());
