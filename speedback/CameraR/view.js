
 function ShowCamera(){
   
    $.post("Controller.php", 
    {
        PrjCode:$("#SelProject").val(),
        ShowCamera:"ShowCamera",  
    })
    .done( function( data ) 
    {   
         $("#BodyShow").html(data);
         
    });
 }
 function CkShow(Code){
    var ckcode="CK"+Code;
    var checkBox = document.getElementById(ckcode);
  
    if (checkBox.checked == true){
        $('#'+Code).show();
    } else {
        $('#'+Code).hide();
    }
 }
 function ShowSubMenu(){
    $.post("Controller.php", 
    {
        PrjCode:$("#SelProject").val(),
        ShowSubMenu:"ShowSubMenu"  
    })
    .done( function( data ) 
    {  
        /*
        $("#SelSubMenu").empty();
        const obj = JSON.parse(data);
        for(var i=0;i<obj.length;i++){
            $('#SelSubMenu').append('<option value="'+obj[i].XVCamCode+'">'+obj[i].XVCamName+'</option>');
        } 
        */
        $("#SelSubMenu").empty();
        const obj = JSON.parse(data);
        for(var i=0;i<obj.length;i++){
            $("#"+obj[i].XVCamCode).hide();
            $('#SelSubMenu').append('<br><input type="checkbox" id="CK'+obj[i].XVCamCode+'" onclick="CkShow(\''+obj[i].XVCamCode+'\')" > <label>'+obj[i].XVCamName+'</label>');
           
        } 
    });
 }
 $("#SelProject").change(function(){
   
     ShowCamera();
     ShowSubMenu();
 });
 $("#SelSubMenu").change(function(){
   
 });
 $(function() {
   
    ShowCamera();
    ShowSubMenu();

 });