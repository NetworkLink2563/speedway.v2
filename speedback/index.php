<?php  session_start(); ?>


<?php  if(isset($_SESSION['premis'])){ echo"<meta http-equiv='refresh' content='0; url=pdmis/".$_SESSION["premis"]."'>"; }
	//unregister all session
    session_destroy();
  
    if(isset($_GET['token'])){ $token=$_GET['token']; }else{ $token = 'default'; }
?>
<!DOCTYPE html>

<html  style="background-color:#242526;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="shortcut icon" href="imgmisscitec/misscitec.jpg">
    <title>E-VA</title>
	<link rel="stylesheet"  href="lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	<style type="text/css">
body {
  margin: 0;
  padding: 0;
/*  Background fallback in case of IE8 & down, or in case video doens't load, such as with slower connections  */
  background: #333;
  background-attachment: fixed;
  background-size: cover;
}

/* The only rule that matters */
#video-background {
/*  making the video fullscreen  */
  position: fixed;
  right: 0; 
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
  width: auto; 
  height: auto;
  z-index: -100;
}

/* These just style the content */
article {
/*  just a fancy border  */
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 10px solid rgba(255, 255, 255, 0.5);
  margin: 10px;
}

h1 {
  position: absolute;
  top: 60%;
  width: 100%;
  font-size: 36px;
  letter-spacing: 3px;
  color: #fff;
  font-family: Oswald, sans-serif;
  text-align: center;
}

h1 span {
  font-family: sans-serif;
  letter-spacing: 0;
  font-weight: 300;
  font-size: 16px;
  line-height: 24px;
}

h1 span a {
  color: #fff;
}
    </style>
 
 
    <link href="lib/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="lib/gentelella/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="lib/gentelella/build/css/custom.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>

<script  type="text/JavaScript"> 
    
    
     $(document).ready(function() {  
 
    ///BTN Reset 
 	$("#btn_reset").click(function(){
		$("#text-info").css("color", "green");
		$("#text-info").empty().text("การ reset ค่าสำเร็จ กรุณาเข้าสู่ระบบ");	 
		$("#uname").val("").removeClass("parsley-error").removeClass("parsley-success").focus();
		$("#pwd").val("").removeClass("parsley-error").removeClass("parsley-success");
		$("#parsley-uname").addClass("ui-disabled");
	});
	//end btn reset
	
	//Enter event
	 //check if search focusted
	  $(document).keypress(function(e) {
    		if(e.which == 13) {
				  $(".btn_login").click();
    		}//end if
	});//end document keypress
 
   
   	 $(".btn_login").click(function () {
		  //  alert('test');
		var uname = $("#uname").val();
		var pwd = $("#pwd").val();
		var token = $("#token").val();
		 
        if (uname == "") {
            $("#uname").removeClass("parsley-success").addClass("parsley-error");
            $("#parsley-uname").removeClass("ui-disabled").text('กรุณาใส่ชื่อผู้ใช้งาน');
			$("#uname").focus();
            return false;
        }else{
			$("#uname").removeClass("parsley-error").addClass("parsley-success");
			$("#parsley-uname").addClass("ui-disabled");
		}
		
		if (pwd == "") {
            $("#pwd").removeClass("parsley-success").addClass("parsley-error");
            $("#parsley-pwd").removeClass("ui-disabled").text('กรุณาใส่รหัสผ่าน');
			$("#pwd").focus();
            return false;
        }else{
			$("#pwd").removeClass("parsley-error").addClass("parsley-success");
			$("#parsley-pwd").addClass("ui-disabled");
		}
		
		
		
		$("#btn_reset").attr("disabled","true");
		$("#uname").attr("disabled", "true");
		$("#pwd").attr("disabled", "true");
	
				var dataString = 'uname=' + uname + '&pwd=' + pwd + '&flag=00001';
				$.ajax({type: "POST", url: "Login/service/ajax_login.php",
					data: dataString, cache: false,
					success: function (html)
					{
						// alert(html);
						var obj = $.parseJSON(html);			  
					    if(obj["RESULT"]=="true"){
									if(obj["status"]==1){ 
									var tg_dir = "Login/component/signurl.php?user_login="+uname+'&pwd_login='+pwd;
									 window.location.replace(tg_dir);
									}else{
										alert("บัญชีผู้ใช้ของคุณถูกยกเลิกสิทธิ์ใช้งาน กรุณาติดต่อหน่วยงาน E-VA");
										$("#btn_reset").removeAttr("disabled");
										$("#uname").removeAttr("disabled");
										$("#uname").removeClass("parsley-success").addClass("parsley-error");
										$("#pwd").removeAttr("disabled");	
										$("#pwd").removeClass("parsley-success").addClass("parsley-error").val("").focus();
										$("#text-info").css("color", "red");
										$("#text-info").empty().text("บัญชีผู้ใช้ถูกระงับใช้งาน");	 
										$("#btn_login").removeAttr("disabled");	
										$("#btn_login").removeClass("btn-default").addClass("btn-success").empty().html("เข้าสู่ระบบ");
										return false;
									}
									 
 
						} else {
						$("#btn_reset").removeAttr("disabled");
						$("#uname").removeAttr("disabled");
						$("#uname").removeClass("parsley-success").addClass("parsley-error");
						$("#pwd").removeAttr("disabled");	
						$("#pwd").removeClass("parsley-success").addClass("parsley-error").val("").focus();
						$("#text-info").css("color", "red");
						$("#text-info").empty().text("ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง");	 
						$("#btn_login").removeAttr("disabled");	
						$("#btn_login").removeClass("btn-default").addClass("btn-success").empty().html("เข้าสู่ระบบ");
						}
					}//end success
				}); //end ajax posted
   		 });//end old pass check

 
  }); 
    </script>


<body>


<!--  Content  0.6-->
<div data-role="page" id="page1" style="text-align: center; margin: auto; background-color:#242526" >  
 
 <div style="max-width: 500px;margin: auto;background: #e5e5e5;margin-top: 100px;-webkit-border-radius: 4px;border-radius: 4px;" class="block"> 
      <div style="height:30px;">      
      </div>    
         <div style="height:30px; text-align:center; padding-top:10px; color:#030;">
         <h3>
<span style="color: #485182;">
    <a>E-VA</a>
   
      
</span>
       
       </h3>
      </div>   

      
    <br/>
    <div data-role="content" style="text-align:center; margin:auto;   height:200px;">
  
    <br/>   
        
        
        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> ชื่อผู้ใช้งาน  
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="token" value="<?php  echo $token; ?>" id="token" type="hidden" />
                           <input  name="uname"  id="uname"  class="form-control  has-feedback-left" value="" type="text" step="any"  data-role="none" placeholder="กรุณาใส่ชื่อผู้ใช้งาน" required  data-parsley-required="true" data-parsley-required-message="กรุณาใส่ชื่อผู้ใช้งาน" />
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            <li class="parsley-required ui-texterror ui-disabled" id="parsley-uname"></li>
                        </div>
                      </div>
                     <div style="height:5px;">&nbsp;</div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> รหัสผ่าน  
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  name="pwd"  id="pwd"  class="form-control   has-feedback-left"  type="password" step="any"  data-role="none" placeholder="กรุณาใส่รหัสผ่าน" required   /> 
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            <li class="parsley-required ui-texterror ui-disabled" id="parsley-pwd"></li> 
                        </div>
                      </div>
                       
                      
                      <div style="height:15px;">&nbsp;</div>
                     
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           
						  <button class="btn  btn-primary" id="btn_reset" type="reset">ตั้งค่าใหม่</button>
                          <button type="button" class="btn btn_login btn-success" id="btn_login">เข้าสู่ระบบ</button>
                        </div>
                      </div>

                    </form>
         
    
        
  </div>
  

  <br/>
  

  </div>
  </div><!--end block div -->
	
</div>
  
<!--  Video is muted & autoplays, placed after major DOM elements for performance & has an image fallback  -->
</body>

</html>
