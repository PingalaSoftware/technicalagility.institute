function submitToAPI(e) {
    e.preventDefault();


    var Namere = /[A-Za-z]{1}[A-Za-z]/;
    if (!Namere.test($("#name-input").val())) {
        alert("Name can not less than 2 char");
        return;
    }
    if ($("#email-input").val() == "") {
        alert("Please enter your email id");
        return;
    }

    var reeamil = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
    if (!reeamil.test($("#email-input").val())) {
        alert("Please enter valid email address");
        return;
    }


    var name = $("#name-input").val();
    var email = $("#email-input").val();
    var mobileNumber = $("#phone-input").val();
    var message = $("#description-input").val();
    var data = {
       name : name,
       email : email,
       mobileNumber : mobileNumber,
       message : message,
       website : "technicalagility-contact"
       
     };

    $.ajax({
      type: "POST",
      url : "https://j2cjf2ifhg.execute-api.us-east-2.amazonaws.com/prod/contact-form-email",
      dataType: "json",
      crossDomain: "true",
      contentType: "application/json; charset=utf-8",
      data: $.param(data),

      
      success: function () {
        // clear form and show a success message
        alert("Thank You Successfully Sent..");
        document.getElementById("contact-form").reset();
        location.reload();
      },
      error: function () {
        // show an error message
        alert("Something Went Worng...");
      }});
  }