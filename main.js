$('#sidebar-btn').click(function(){
    $('.sidebar').toggleClass("active")
});

$("#add").click(function() {  
  $("#input_form").toggle("slow");
  return false;
});


  // Geting current date pre filled in the attendance.php form
  var today = new Date().toISOString().split("T")[0];
  
  document.getElementById("date").value = today;



