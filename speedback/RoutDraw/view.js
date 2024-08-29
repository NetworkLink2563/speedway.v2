

 function ShowSubMenu(){
    $.post("Controller.php", 
    {
        PrjCode:$("#SelProject").val(),
        ShowSubMenu:"ShowSubMenu"  
    })
    .done( function( data ) 
    {  
        $("#SelSubMenu").empty();
        const obj = JSON.parse(data);
        for(var i=0;i<obj.length;i++){ 
            $('#SelSubMenu').append('<option value="'+obj[i].XVVmsCode+'">'+obj[i].XVVmsName+'</option>');
        } 
    });
 }
 $("#SelProject").change(function(){
     ShowSubMenu();
 });
 $("#SelSubMenu").change(function(){
   
    $.post( "Controller.php", 
    {
        VmsCode:$( "#SelSubMenu option:selected" ).val(),
        ShowRout:"ShowRout"  
    })
    .done( function( data ) 
    {   console.log(data);
        $("#Sel_RouteCode").empty();
        $("#Sel_RouteCode").html(data);
    });  
    ShowDataTable($( "#SelSubMenu option:selected" ).val());  
    ShowDataTableTableGTime($( "#SelSubMenu option:selected" ).val());   
    ShowDataTableImage($( "#SelSubMenu option:selected" ).val()); 
 });
 $(function() {
    ShowSubMenu();
    
 });

 //-----------------
 function EditPointXy(Id,X,Y,Select){
    
    $( "#TxtSelect" ).val(Select);
    $( "#TxtId" ).val(Id);
    $( "#TxtX" ).val(X);
    $( "#TxtY" ).val(Y);

    $("#Modal1").modal('toggle');
}
$( "#FormT1" ).submit(function( event ) {
    event.preventDefault();
    $.post( "Controller.php", 
    {
        Select:$("#TxtSelect").val(),
        XYID:$("#TxtId").val(),
        X:$("#TxtX").val(),
        Y:$("#TxtY").val(),
        EditXY:"EditXY"  
    })
    .done( function( data ) 
    {   $("#Modal1").modal('toggle');
        ShowDataTable($( "#SelSubMenu option:selected" ).val());  
        ShowDataTableTableGTime($( "#SelSubMenu option:selected" ).val());   
        ShowDataTableImage($( "#SelSubMenu option:selected" ).val()); 
    });   
});

const color = ["#ff0000", "#0000ff", "#ffff00","#00ff00","#ff00ff"];
async function DrawRoad(ctx){
  
    var myTab = document.getElementById('TableRout');
    var X=0;
    var Y=0;
    var color="";
    ctx.beginPath();
    ctx.fillStyle = "#000000";
    ctx.fillRect(0, 0, 384, 288);
    
    newgrid(ctx, "gray");
    for (xi = 1; xi < myTab.rows.length; xi++) {
        var objCells = myTab.rows.item(xi).cells;
        Xe=objCells.item(3).innerHTML;
        Ye=objCells.item(4).innerHTML;
        color=objCells.item(5).innerHTML; 
        ctx.beginPath();
        ctx.fillStyle = color;
        ctx.fill();
        ctx.arc(Xe, Ye, 3, 0, 2 * Math.PI);
        ctx.stroke();
        
        if(xi>1){
            var objCellsBefore = myTab.rows.item(xi-1).cells;
            Xs=objCellsBefore.item(3).innerHTML;
            Ys=objCellsBefore.item(4).innerHTML;
            color=objCells.item(5).innerHTML; 

            ctx.beginPath();
            ctx.lineCap = "round";
            ctx.strokeStyle = color;
            ctx.moveTo(Xs, Ys);
            ctx.lineTo(Xe, Ye);
            ctx.lineWidth = 3;
            ctx.stroke();
        }
        
        ctx.beginPath();
        ctx.fillStyle = color;
        ctx.fill();
        ctx.arc(Xe, Ye, 5, 0, 2 * Math.PI);
        ctx.stroke();
    }
    
}
async function ShowDataTable(VmsCode){
    $.post( "Controller.php", 
    {
      ShowDataTable:'ShowDataTable',
      VmsCode:VmsCode
    })
    .done(async function( data ) 
    {   
        $( "#TableBody" ).empty();
        $( "#TableBody" ).html(data);
    });
} 
function createImageNode(images) {
    var imgs = document.createElement('img');
    imgs.src = images;
    imgs.width = "300";
    imgs.style.margin = "15px";
    return img;
  }
function DrawImage(ctx1){
    var canvas = document.getElementById("CanvasRout");
    var ctx = canvas.getContext("2d");
  
    var myTab = document.getElementById('TableImage');
    
    var frames = [];
    for (xi = 1; xi < myTab.rows.length; xi++) {
        var objCells = myTab.rows.item(xi).cells;
        var imagename=objCells.item(1).innerHTML;
        var X=objCells.item(2).innerHTML;
        var Y=objCells.item(3).innerHTML;
        var imgpath= $( "#SelSubMenu option:selected" ).val()+"/ImageLabel/"+imagename;
        frames[xi-1] = new Image();
        frames[xi-1].src=imgpath;
        ctx.drawImage(frames[xi-1], X, Y);    
    }
}
function DrawGtime(ctx1){
    var myTab2 = document.getElementById('TableGTime');
    var frames = [];
    for (xi = 1; xi < myTab2.rows.length; xi++) {
        var objCells = myTab2.rows.item(xi).cells;
        var X=objCells.item(2).innerHTML;
        var Y=objCells.item(3).innerHTML;
        var imgpath= "IMG/TimeG2.jpg";
        frames[xi-1] = new Image();
        frames[xi-1].src=imgpath;
        ctx.drawImage(frames[xi-1], X, Y);       
    }
}
function ShowDataTableImage(VmsCode){
    $.post( "Controller.php", 
    {
      ShowDataTableImage:'ShowDataTableImage',
      VmsCode:VmsCode
    })
    .done(async function( data ) 
    {   
        $( "#TableBodyImage" ).empty();
        $( "#TableBodyImage" ).html(data);
    });
} 
function ShowDataTableTableGTime(VmsCode){

    $.post( "Controller.php", 
    {
        ShowDataTableTableGTime:'ShowDataTableTableGTime',
        VmsCode:VmsCode
    })
    .done(async function( data ) 
    {   
        $( "#TableBodyGTime" ).empty();
        $( "#TableBodyGTime" ).html(data);
    });
}
function DeleteImageXy(p){
    Swal.fire({
        title: 'ต้องการลบใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
          actions: 'my-actions',
          confirmButton: 'order-2',
          denyButton: 'order-3',
        }
      }).then((result) => {
        if (result.isConfirmed) {
            $.post( "Controller.php", 
            {
                DeletePointImageXy:'DeletePointImageXy',
                RoutePointXyImageID:p
            })
            .done(async function( data ) 
            {   
               
                ShowDataTableImage($( "#SelSubMenu option:selected" ).val());  
            });
            
       
        }
      })
}
function DeletePointXy(p){
    Swal.fire({
        title: 'ต้องการลบใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
          actions: 'my-actions',
          confirmButton: 'order-2',
          denyButton: 'order-3',
        }
      }).then((result) => {
        if (result.isConfirmed) {
            $.post( "Controller.php", 
            {
                DeletePointXy:'DeletePointXy',
                RoutePointXyID:p
            })
            .done(async function( data ) 
            {   
        
                ShowDataTable($( "#SelSubMenu option:selected" ).val());     
            });
             //Swal.fire('Saved!', '', 'success')
       
        }
      })
  
}

function DeleteGMapXy(p){
    Swal.fire({
        title: 'ต้องการลบใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
          actions: 'my-actions',
          confirmButton: 'order-2',
          denyButton: 'order-3',
        }
      }).then((result) => {
        if (result.isConfirmed) {
            $.post( "Controller.php", 
            {
                DeleteXPointGMapXy:'DeletePointImageXy',
                RoutePointGMapID:p
            })
            .done(async function( data ) 
            {   
                ShowDataTableTableGTime($( "#SelSubMenu option:selected" ).val());   
            });
        }
      })
}


//set up the canvas and context
var canvas = document.getElementById("CanvasRout");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "rgba(1,1,1,1)";
ctx.fillRect(0, 0, 384, 288);

async function newgrid(ctx, gcolor) {
    x = 384/8
    xi = 0
    for (i = 0; i < x-1; i++) {
        if(i==23){
            gcolor="red";
        }
        xi = xi + 8;
        ctx.beginPath();
        ctx.moveTo(xi, 0);
        ctx.lineWidth = 1;
        ctx.lineTo(xi, 288);
        ctx.strokeStyle = gcolor;
        ctx.stroke();
        gcolor="gray";
    }
    //Draw Grid Y
    y = 288/ 8
    yi = 0
    for (i = 0; i < y-1; i++) {
        if(i==17){
            gcolor="red";
        }
        yi = yi + 8;
        ctx.beginPath();
        ctx.moveTo(0, yi);
        ctx.lineWidth = 1;
        ctx.lineTo(384, yi);
        ctx.strokeStyle = gcolor;
        ctx.stroke();
        gcolor="gray";
    }
    
}
newgrid(ctx, "gray");

canvas.addEventListener("click", function(evt) {
    var mousePos = getMousePos(canvas, evt);
    if ((mousePos.x < 384) &&  (mousePos.y < 288)) {
      
       
        var ColorIndex=document.getElementById("Sel_RouteCode").selectedIndex;
        if($("#SelectDraw" ).val()==1){
            if($("#Sel_RouteCode" ).val()==""){
                SmsBoxShow("กรุณาเลือกเส้นทาง");
                return false;
            }
            InsertUpdatePoint(mousePos.x.toFixed(0),mousePos.y.toFixed(0),color[ColorIndex]);
        }else if($("#SelectDraw" ).val()==2){
           $("#TxtImageX" ).val(mousePos.x.toFixed(0));
           $("#TxtImageY" ).val(mousePos.y.toFixed(0));
        }else if($("#SelectDraw" ).val()==3){
           if($( "#Sel_RouteCode" ).val()==""){
             SmsBoxShow("กรุณาเลือกเส้นทาง");
             return false
           }
           InsertTimeGmap(mousePos.x.toFixed(0),mousePos.y.toFixed(0));
        }

        ctx.beginPath();
        ctx.strokeStyle = "white";
        ctx.arc(mousePos.x, mousePos.y, 3, 0, 2 * Math.PI);
        ctx.stroke();
        ctx.font = "14px Arial";
        // Create gradient
        var gradient = ctx.createLinearGradient(0, 0, 384, 0);
        gradient.addColorStop("1.0", "white");
        // Fill with gradient
        ctx.fillStyle = gradient;
        ctx.fillText(mousePos.x.toFixed(0) + "," + mousePos.y.toFixed(0), mousePos.x, mousePos.y);
    }
}, false);

function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: evt.clientX - rect.left,
        y: evt.clientY - rect.top
    };
}

function InsertUpdatePoint(PointX,PointY,Color){
    $.post( "Controller.php", 
    {
        RouteCode:$( "#Sel_RouteCode" ).val(),
        PointX:PointX,
        PointY:PointY,
        Color:Color,
        InsertUpdatePoint:'InsertUpdatePoint'
    })
    .done(async function( data ) 
    {   
        ShowDataTable($( "#SelSubMenu option:selected" ).val());    
    
    });
}

function InsertTimeGmap(PointX,PointY){
    $.post( "Controller.php", 
    {
        VmsCode:$( "#SelSubMenu option:selected" ).val(),
        RouteCode:$( "#Sel_RouteCode" ).val(),
        PointX:PointX,
        PointY:PointY,
        InsertTimeGmap:'InsertTimeGmap'
    })
    .done(async function( data ) 
    {  
        
        ShowDataTableTableGTime($( "#SelSubMenu option:selected" ).val());     
    });
}
$("#BtnUpPicTure").click(function() {
    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file', files);
    fd.append('PointX', $("#TxtImageX").val());
    fd.append('PointY', $("#TxtImageY").val());
    fd.append('VMSC', $( "#SelSubMenu option:selected" ).val());
    fd.append('UploadFile', 'UploadFile');
    $.ajax({
        url: 'Controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {

          
            ShowDataTableImage($( "#SelSubMenu option:selected" ).val()); 
        },
    });
});
$("#BtnShowLael").click(function() {
    DrawImage(ctx);
    DrawGtime(ctx);
});
$("#BtnShowRoute").click(function() {
    newgrid(ctx, "gray");
    DrawRoad(ctx);
});
