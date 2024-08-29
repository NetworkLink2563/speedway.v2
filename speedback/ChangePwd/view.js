function ShowPwd() {
    var x = document.getElementById("pwd");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  $( "#CnangePwd" ).submit(function( event ) {
      event.preventDefault();
      $.post( "Controller.php", 
      {
          UsrPwd:$( "#pwd" ).val(),
          ChamgePwd:"ChamgePwd"  
      })
      .done( function( data ) 
      {   
         
          position = data.search("Success");
          if(data.trim()=="Success"){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'เปลี่ยนรหัส่ผ่านสำเร็จ',
                showConfirmButton: false,
                timer: 1500
              })
             
          }
         
      });
  });
  