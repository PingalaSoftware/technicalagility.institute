function subscribeToAPI(e) {
    e.preventDefault();


    
    if ($("#email").val() == "") {
        alert("Please enter your email id");
        return;
    }

    var reeamil = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
    if (!reeamil.test($("#email").val())) {
        alert("Please enter valid email address");
        return;
    }


    var email = $("#email").val();
    var data = {
       email : email,
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
        alert("Thank You Successfully Subscribed..");
        document.getElementById("sub-form").reset();
        location.reload();
      },
      error: function () {
        // show an error message
        alert("Something Went Worng...");
      }});
  }