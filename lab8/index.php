<style>
	@import url(style.css); 
</style>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            function validateForm() {
                
                return false;
           
            }
            
        </script>
        
        
        <script>
        //Counties: http://itcdland.csumb.edu/~milara/ajax/countyList.php?
            //document ready event is ignored till the whole page loads
            $(document).ready(function(){
                
                $("#submitBtn").click(function(){
                    if($("#pass1").val() == "" && $("#pass2").val() == ""){
                        $("#isMatch").html("Enter a Password");
                        $("#isMatch").css("color","red");
                    }
                    else if($("#pass2").val() != $("#pass1").val()){
                        $("#isMatch").html(" Passwords do not Match");
                        $("#isMatch").css("color","red");
                    }
                    else{
                        $("#isMatch").html(" Passwords Match");
                        $("#isMatch").css("color","green");
                    }
                })
                
                // $("#pass2").change(function() {
                //      //alert(  $("#username").val() );
                   
                // })
                
                $("#userName").change(function() {
                     //alert(  $("#username").val() );
                    $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#userName").val() },
                        success: function(data,status) {
                            
                            if (!data) {  //data == false
                                
                                $("#isTaken").html(" Username Available");
                                 $("#isTaken").css("color","green");
                                
                            } else if(data){
                                
                                $("#isTaken").html("Username Taken");
                                $("#isTaken").css("color","red");
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                })
                
                  $("#state").change(function() {
                      $.ajax({
                    
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php?",
                        dataType: "json",
                        data: { "state": $("#state").val()},
                        success: function(data,status) {
                            //alert(data[0].county)
                            $("#county").html("<option id = 'selectTag'>- Select One -</option>")

                           for (var i =0; i < data.length;i++) {
                                $("#county").append("<option>" + data[i].county + "</option>")
                           }
                            
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    
                    });//ajax
                  })
                
                $("#zipCode").change(function(){
                    //alert($("#zipCode").val()
                    $.ajax({
                    
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php?",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val()},
                        success: function(data,status) {
                            //alert(data.city);
                        if(data){ 
                            $("#isZipcode").html("");
                            $("#city").html(data.city)
                            $("#lati").html(data.latitude)
                            $("#long").html(data.longitude)
                        }
                        else{
                            $("#isZipcode").html("Zip Code not found");
                            $("#isZipcode").css("color","red");
                            $("#city").html("")
                            $("#lati").html("")
                            $("#long").html("")
                        }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    
                    });//ajax
                    
                })
            })
            
        </script>

    </head>

    <body>
    
       <div id = "title"><h1> Sign Up Form </h1></div>
       <hr>
    <div id="wrap">
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text" placeholder="Enter First Name"><br> 
                Last Name:   <input type="text" placeholder="Enter Last Name"><br> 
                Email:       <input type="text" placeholder="Email"><br> 
                Phone Number:<input type="text" placeholder="Enter Phone Number"><br><br>
                Zip Code:    <input type="text" id = "zipCode" placeholder="Enter Zip Code"><strong><span id="isZipcode"></span></strong><br>
                City: <strong><span id ="city"></span></strong>
                <br>
                Latitude:<strong><span id = "lati"></span></strong>
                <br>
                Longitude:<strong><span id = "long"></span></strong>
                <br><br>
                State: 
                <select id = "state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id = "county"></select><br>
                
                Desired Username: <input type="text" id = "userName" placeholder="Enter Username"><strong><span id="isTaken"></span></strong><br>
                
                Password: <input type="password" id ="pass1" placeholder="Enter Password"><br>
                
                Re-type Password : <input type="password" id ="pass2"><strong><span id ="isMatch"></span></strong><br>
                <input type="submit" value="Sign Up!" id="submitBtn">
            </fieldset>
        </form>
    </div>
    </body>
    <hr>
    <footer>@Ramirez Disclaimer: Used for educational purposes only</footer>
</html>