

<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "service/privilege.php";

$menucode="012";
$pri=pri_($_SESSION['user'],$menucode);  
$pri_w=$pri[0]['pri_w'];  // สิทธิ์การเขียน
$pri_r=$pri[0]['pri_r'];  // สิทธิ์การอ่าน
$pri_del=$pri[0]['pri_del'];  // สิทธิ์การลบ
$pri_contr=$pri[0]['pri_del'];  // สิทธิ์การควบคุม


/*
include "permission.php";

if(checkmenu($user,'001')==0)
{
    session_destroy();
    header( "location: index.php" );
    exit(0);
}
if(checkmenu($user,'006')==0){
   
    header( "location: dashboard.php" );
    exit(0);
}else{
    if($_SESSION["XBDmnIsRead"]==0){
        header( "location: dashboard.php" );
        exit(0);
    }
}
    */
?>

<style>
@mixin modal-fullscreen() {
  padding: 0 !important; // override inline padding-right added from js
  
  .modal-dialog {
    width: 90%;
    max-width: none;
    height: 100%;
    margin: 0;
  }
  
  .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
  }
  
  .modal-body {
    overflow-y: auto;
  }
 
}

@each $breakpoint in map-keys($grid-breakpoints) {
  @include media-breakpoint-down($breakpoint) {
    $infix: breakpoint-infix($breakpoint, $grid-breakpoints);
    
    .modal-fullscreen#{$infix} {
      @include modal-fullscreen();
    }
  
  }
}


// Styles for codepen
html {
  display: flex;
  height: 100%;
}

body {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.btn-open-modal {
  margin-bottom: 0.5em;
}
</style>
<style>
    .Neon {
        font-family: sans-serif;
        font-size: 14px;
        color: #494949;
        position: relative;


    }
    .Neon * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .Neon-input-dragDrop {
        display: block;
        width: 343px;
        margin: 0 auto 25px auto;
        padding: 25px;
        color: #8d9499;
        color: #97A1A8;
        background: #fff;
        border: 2px dashed #C8CBCE;
        text-align: center;
        -webkit-transition: box-shadow 0.3s, border-color 0.3s;
        -moz-transition: box-shadow 0.3s, border-color 0.3s;
        transition: box-shadow 0.3s, border-color 0.3s;
    }
    .Neon-input-dragDrop .Neon-input-icon {
        font-size: 48px;
        margin-top: -10px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    .Neon-input-text h3 {
        margin: 0;
        font-size: 18px;
    }
    .Neon-input-text span {
        font-size: 12px;
    }
    .Neon-input-choose-btn.blue {
        color: #008BFF;
        border: 1px solid #008BFF;
    }
    .Neon-input-choose-btn {
        display: inline-block;
        padding: 8px 14px;
        outline: none;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        white-space: nowrap;
        font-size: 12px;
        font-weight: bold;
        color: #8d9496;
        border-radius: 3px;
        border: 1px solid #c6c6c6;
        vertical-align: middle;
        background-color: #fff;
        box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }
    ol.menu {
        list-style-type:none;
        display:table;
        float:none;
        margin:0 auto;
    }
    .menu li {
        display:inline;
        white-space:nowrap;
    }
    .menu span {
        float:left;
        display:table;
        padding:2px;
        cursor:pointer;
    }
    .button { /* ปุ่มเลือกสี ปกติ */
        margin:1px;
    }
    .hover { /* ปุ่มเลือกสี เมื่อเมาส์อยู่บน */
        background:#D3E4F5;
        border:1px solid #167FB2;
        margin:0;
    }
    .current { /* ปุ่มเลือกสี เมื่อเลือก */
        background:#D3E4F5;
        border:1px solid #167FB2;
        margin:0;
    }
    @font-face {
        font-family: SarunThangLuang;
        src: url(fonts/SarunThangLuang.ttf);
    }
</style>
<style>
.Neon {
    font-family: sans-serif;
    font-size: 14px;
    color: #494949;
    position: relative;


}

.Neon * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.Neon-input-dragDrop {
    display: block;
    width: 343px;
    margin: 0 auto 25px auto;
    padding: 25px;
    color: #8d9499;
    color: #97A1A8;
    background: #fff;
    border: 2px dashed #C8CBCE;
    text-align: center;
    -webkit-transition: box-shadow 0.3s, border-color 0.3s;
    -moz-transition: box-shadow 0.3s, border-color 0.3s;
    transition: box-shadow 0.3s, border-color 0.3s;
}

.Neon-input-dragDrop .Neon-input-icon {
    font-size: 48px;
    margin-top: -10px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.Neon-input-text h3 {
    margin: 0;
    font-size: 18px;
}

.Neon-input-text span {
    font-size: 12px;
}

.Neon-input-choose-btn.blue {
    color: #008BFF;
    border: 1px solid #008BFF;
}

.Neon-input-choose-btn {
    display: inline-block;
    padding: 8px 14px;
    outline: none;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
    font-size: 12px;
    font-weight: bold;
    color: #8d9496;
    border-radius: 3px;
    border: 1px solid #c6c6c6;
    vertical-align: middle;
    background-color: #fff;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.05);
    -webkit-transition: all 0.2s;
    -moz-transition: all 0.2s;
    transition: all 0.2s;
}

ol.menu {
    list-style-type: none;
    display: table;
    float: none;
    margin: 0 auto;
}

.menu li {
    display: inline;
    white-space: nowrap;
}

.menu span {
    float: left;
    display: table;
    padding: 2px;
    cursor: pointer;
}

.button {
    /* ปุ่มเลือกสี ปกติ */
    margin: 1px;
}

.hover {
    /* ปุ่มเลือกสี เมื่อเมาส์อยู่บน */
    background: #D3E4F5;
    border: 1px solid #167FB2;
    margin: 0;
}

.current {
    /* ปุ่มเลือกสี เมื่อเลือก */
    background: #D3E4F5;
    border: 1px solid #167FB2;
    margin: 0;
}

.drop-container {
    position: relative;
    display: flex;
    gap: 10px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 200px;
    padding: 20px;
    border-radius: 10px;
    border: 2px dashed #555;
    color: #444;
    cursor: pointer;
    transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
    background: #eee;
    border-color: #111;
}

.drop-container:hover .drop-title {
    color: #222;
}

.drop-title {
    color: #444;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    transition: color .2s ease-in-out;
}

::-webkit-file-upload-button {
    display: none;
}
input[type='file'] { font-size: 0; }
::file-selector-button { font-size: initial; }

*{
    box-sizing: border-box;
}

.container{
    background-color: white;
}

.frame{
transition: transform .2s;
}

.frame:hover{
    transform: scale(1.3);
}

.box-color{
    transition: 0.3s;
}

.box-color:hover{
    background-color: #e4e4e4cc;
}

table td{
        transition: 0.5s;
    }

.shadow{
    box-shadow: 3px 3px 3px #aaaaaa!important;
}

table th{
        background-color: #e8f4ff!important;
    }

.container{
        height: 100vh;
    }

/* .flex-table{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
} */

input .btnsearch{
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 12px top 10px;
 text-indent: 20px;
}

table{
    text-align: center;
}

.box-color img{
    position: relative;
    z-index: 99;
}

.box-color p {
    font-size: 1.3rem;
}

.flex-header{
    display: flex;
}

*{
    box-sizing: border-box;
}

.container{
    background-color: white;
}

body {
    background: #e1f0fa;
}

.flex-table{
    display: flex;
    flex-direction: column;
}

input.btnsearch{
 background-image: url('img/icon/mag.png');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 12px top 10px;
 text-indent: 20px;
 opacity: 0.7;
}

#iframe{
    height: 550px!important;
}

.dt-search input{
background-image: url('img/icon/mag.png');
 background-repeat: no-repeat;
 background-size: 18px;
 background-position: left 12px top 5px;
 text-indent: 30px;
 opacity: 0.7;
 margin: 0rem 0rem 0.3rem 0rem;
    }

    #dt-search-0{
        width: 255px;
        font-size: .9rem;
    }
     .search{
        display: none;
     }

     table tr td {
        border: 1px solid #cccc;
    }

    table tr th {
        border: 1px solid #cccc;
    }
     /* #myModal .modal-backdrop{
        display: none;
     } */
</style>



<div class="container" style="position: relative; top: 75; height: auto;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem; display: flex;">

            <div class="next-btn col-4"  style="text-align: left; padding: 0; ">
            <a href='./messagepublicrelations.php' class="btn btn-warning btn-hover shadow" style="">กลับ Step1 ข้อความพื้นฐาน <<</a>
            </div>
            
            <div class="col-4" style="text-align: center;">
            <img src="./img/icon/edit.png" height="25" alt="Responsive image"> Step 2 จัดรูปแบบข้อความ
            </div>

            
            <div class="next-btn col-4"  style="text-align: right; padding: 0; ">
            <a href='./messagepublicrelationsframegroup.php' class="btn btn-success btn-hover shadow" style="">>> Step3 ชุดข้อความ</a>
            </div>

        </div>

        <?php if($pri_r != 0){?>
        
        <input type="hidden" id="framenumber" >
        <input type="hidden" id="framesmsid" >
        <input type="hidden" id="framewidth" >
        <input type="hidden" id="frameheight" >
        <input type="hidden" id="XVMssCode" >
            

<div class="flex-header" style="">


            <div class="col-3" style="padding: 0; margin-right: .5rem;">
            <div class="flex-btn" style="border: 5px double #DCDCDC; ">

                        
                       <div class="box-color col-12" style="cursor: pointer;text-align: center; border-bottom: 5px double #cccc;cursor: pointer;text-align: center;padding: 1rem 0.5rem;" ><p style="maring:0px;padding:0px;">แบบข้อความเดี่ยว</p><img class=" frame shadow"  src="img/f1.png" alt="" width="100%" height="100">
                        
                       <?php if($pri_w != 0){ ?>
                       <div style="margin : 1rem;">
                       <button class="btn shadow btn-success" onclick="showframe1()"><i class="fa fa-plus" aria-hidden="true"></i> กดสร้างรูปแบบข้อความ</button>
                       </div>
                       <?php } ?>
                        </div>

                       <div class="box-color col-12"  style="cursor: pointer;text-align: center; border-bottom: 5px double #cccc;cursor: pointer;text-align: center;padding: 1rem 0.5rem;" ><p style="maring:0px;padding:0px;">แบบ 2 ข้อความ 3 ช่อง</p><img class=" frame hover shadow"  src="img/f2.png" alt="" width="100%" height="100">
                    
                       <?php if($pri_w != 0){ ?>
                        <div style="margin : 1rem;">
                       <button class="btn shadow btn-success" onclick="showframe2()"><i class="fa fa-plus" aria-hidden="true"></i> กดสร้างรูปแบบข้อความ</button>
                       </div>
                       <?php } ?>
                        </div>
                       
                       <div class="box-color col-12"  style="cursor: pointer;text-align: center; border-bottom: 5px double #cccc;cursor: pointer;text-align: center;padding: 1rem 0.5rem;" ><p style="maring:0px;padding:0px;">แบบ 1 ข้อความ 2 ช่อง</p><img class=" frame hover shadow"  src="img/f3.png" alt="" width="100%" height="100">
                    
                       <?php if($pri_w != 0){ ?>
                       <div style="margin : 1rem;">
                       <button class="btn shadow btn-success" onclick="showframe3()"><i class="fa fa-plus" aria-hidden="true"></i> กดสร้างรูปแบบข้อความ</button>
                       </div>
                       <?php } ?>

                       
                </div>

                </div>
                </div>
             




                <div class="col" style="padding: 0;">

                <div class="flex-table">
                    
                    <div class="col-12" style="width: 100%;">
                <div  class="search"  style="width: 255px; padding: 0; float: right; padding-right: 15px;padding-left: 15px;">

<!-- <img style="margin: 0 0.5rem; " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s" width="15" alt=""> -->
<input type="text" class="form-control btnsearch" name="" style="width: 100%; font-size: 0.9rem;" placeholder="กรอกข้อความที่ต้องการค้นหา..." id="dt-search-0" aria-controls="VMSTable"></input>
</div>
</div>

                        <div class="col" style="">
                        <table id="VMSTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm">รหัส
                                    </th>
                                    <th style="text-align:left;" class="th-sm">ชื่อข้อความ
                                    </th>
                                    <!--
                                    <th>ตัวอย่าง
                                    </th>

-->
                                    <th>ขนาด
                                    </th>
                                    
                                    <th>ลบ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $stmt = "SELECT   dbo.TMstMMessageFrame.XVMsfCode, dbo.TMstMMessageFrame.XVMsfName, dbo.TMstMMessageFrame.XVMssCode, dbo.TMstMMessageFrame.XVMsfFormat, dbo.TMstMMessageFrame.XVMsgCodeF1, 
                                                        dbo.TMstMMessageFrame.XVMsgCodeF2, dbo.TMstMMessageFrame.XVMsgCodeF3, dbo.TMstMMessageFrame.XVMsgCodeF4, dbo.TMstMMessageFrame.XVMsgCodeF5, dbo.TMstMMessageFrame.XVMsfType, 
                                                        dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel
                                FROM            dbo.TMstMMessageFrame INNER JOIN
                                                        dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode
                                WHERE        (dbo.TMstMMessageFrame.XVMsfType = N'1') 
                                ORDER BY dbo.TMstMMessageFrame.XVMsfCode DESC";
                        $query = sqlsrv_query($conn, $stmt);
                        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                        {
                        
                        ?>
                                <tr id="XVMsfCode<?php echo $result['XVMsfCode']; ?>" style="font-size: 10pt">
                                    <td><?php echo $result['XVMsfCode']; ?></td>
                                    <td style="text-align:left;"><?php echo $result['XVMsfName']; ?></td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center"><?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel']; ?></td>
                                   
                                    <td>
                                                <?php if($pri_del != 0){ ?>
                                                <i title="ลบ" style="cursor: -webkit-grab; cursor: grab;" class="fa fa-trash-o" aria-hidden="true" onclick="deleteMSG('<?php echo $result['XVMsfCode']; ?>');" <?php echo $Disable;?>></i>
                                                <?php } ?>
                                    </td>
                                    <td>
                                                <?php if($pri_w != 0){ ?>
                                                 <i title="แก้ไข" style="cursor: -webkit-grab; cursor: grab;" class="fa fa-pencil-square-o"
                                                aria-hidden="true"
                                                onclick="SearchEdit('<?php echo $result['XVMsfCode'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $result['XIMssHPixel'];?>');"></i>
                                                <?php } ?>
                                    </td>
                
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>


                    </div>
                    </div>
                    </div>

                    <?php }else{echo '<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';} ?>
                </div>
                </div>
            <!-- div flex header -->


<?php include 'footer.php' ?>


            <div class="modal " id="modal-frame1" tabindex="-1" role="dialog" aria-hidden="true">
  
  <div class="modal-dialog  modal-xl" role="document">
      <div class="modal-content">
  
        <div class="modal-header" style="display: flex; background-color: #c6e9ff;">
         
        <div class="col-12" style="display: flex; justify-content: center; text-align: center; padding: .5rem;" >
                      <div class="col-11 ">
                      <img src="img/icon/edit.png" height="25" alt="Responsive image"> <span style="font-size: 1.2rem;" >สร้างข้อความประชาสัมพันธ์แสดงบนป้าย/รูปแบบข้อความเดี่ยว</span>
                      </div>
                      <div class="col-1">
                      <button id="closef1" type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"></span>
                      </button>
                      </div>
        </div>
        </div>
  
  
        <div class="modal-body">
  
             <input type="hidden" id="frame1_section3_XVMsgCode" >
            
             <div class="box col-12" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
  <!-- fm1 -->
                      
               
  <div class="row" style="justify-content: center;">
  
                  
                          
                             <div class=" col-4">
                                  <label for="XVMsfCodeF1" style="">รหัสรูปภาพ:</label>
                                  <input type="text" id="XVMsfCodeF1"  class="form-control" value="" readonly>
                              </div>
  
                              <div class="  col-5" style="">
                                  <label for="XVMsfNameF1" style="">ชื่อข้อความประชาสัมพันธ์:</label>
                                  <input type="text" id="XVMsfNameF1"  class="form-control" value="">
                              </div>
  
      
                  
                      <div class="col-12" style="margin: 10px; display: flex; justify-content: center;">
                         
                         <div class="col-12" id="frame1_section3" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                            
                                     <button  style="position: absolute; left: 92px;top: 90px;z-index:1000;" onclick="addsms(1)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                    
                                     <iframe id="frame1_section3_show" src="" style="border:none;"></iframe>
                                    
                                    
                                    
                          </div>
                      </div>
                  
                  
                      <div class="col-12 text-center" style="margin: 1rem;">
                         <button type="button"  id="btn_saveframe1" class="btn" style="background-color:#009933;color:white" >บันทึก<i style="margin-left: 10px;color:white;font-size: 30px;" class="fa fa-save"></i></button>
                         
                      </div>
                  </div>
            
             
  
        </div>
        <div class="modal-footer" >
          <button type="button" id="hidef1" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
     
        </div>
      </div>
    </div>
  </div>
  </div>



  <div class="modal" id="modal-frame2" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog  modal-xl" role="document">
<div class="modal-content">
      <div class="modal-header" style="display: flex; background-color: #c6e9ff;">
       
      <div class="col-12" style="display: flex; justify-content: center; text-align: center;  padding: .5rem;" >
                    <div class="col-11 ">
                    <img src="img/icon/computer.png" height="25" alt="Responsive image"> <span style="font-size: 1.2rem;" >สร้างข้อความประชาสัมพันธ์แสดงบนป้าย/แบบ 2 ข้อความ 3 ช่อง</span>
                    </div>
                    <div class="col-1">
                    <button id="closef2" type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                    </div>
                    
                </div>

      </div>

      
      <div  class="modal-body" style="">
          
            
           <input type="hidden" id="frame2_section1_XVMsgCode" >
           <input type="hidden" id="frame2_section2_XVMsgCode" >
           <input type="hidden" id="frame2_section3_XVMsgCode" >
           <input type="hidden" id="frame2_section4_XVMsgCode" >
           <input type="hidden" id="frame2_section5_XVMsgCode" >

           <!-- fm2 -->
           


    
               
           <div class="row" style="justify-content: center;">

                
                        
                    <div class=" col-4">
                        <label for="XVMsfCodeF2" style="">รหัสข้อความป้าย:</label>
                        <input type="text" id="XVMsfCodeF2"  class="form-control" value="" readonly>
                    </div>

                    <div class="  col-5" style="">
                        <label for="XVMsfNameF2" style="">ชื่อข้อความป้าย:</label>
                        <input type="text" id="XVMsfNameF2"  class="form-control" value="">
                    </div>

                    

                </div>

                        <div style="display: flex; justify-content: center; padding-left: 3%;"> 

                <div class="box" style="display: flex; flex-direction: column; justify-content: center;  padding-left: 0%;">
                    
                <div class="row col" style="box-sizing: border-box;  flex-direction: column; margin: 1rem; justify-content: center; align-items:center;" >

                    <div class="col" style="">
                        <div id="frame2_section1" style="border-style: solid;border-color:#DCDCDC;">
                                <button  style="position: absolute; z-index:1000;" onclick="addsms(1)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                <iframe id="frame2_section1_show" src="" style="border:none;"></iframe>  
                        </div>
                    </div>

                    <div class="row">

                        <div id="frame2_section3" class="" style="border-style: solid;border-color:#DCDCDC;    padding: 0px;">
                    
                            <button style="position: absolute; z-index:1000;" onclick="addsms(3)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame2_section3_show" src="" style="border:none;"></iframe>
                            
                       </div>
                       

                       
                        <div id="frame2_section4" class="float-left" style="border-style: solid;border-color:#DCDCDC;   height: 249px!important;  padding: 0px;">
                    
                            <button style="position: absolute; z-index:1000;"  onclick="addsms(4)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame2_section4_show" src="" style="border:none;"></iframe>
                            
                        </div>
                       

                        
                        <div id="frame2_section5" class="float-left" style="border-style: solid;border-color:#DCDCDC;  height: 249px!important;  padding: 0px;">
                            <button style="position: absolute; z-index:1000;" onclick="addsms(5)"  class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe  id="frame2_section5_show" src="" style="border:none;"></iframe>
                        </div>
                   
                   

                    
                        <div id="frame2_section2" style="border-style: solid;border-color:#DCDCDC;margin:0px;  padding: 0px;">
                   
                    
                                <button  style="position: absolute; z-index:1000;"  onclick="addsms(2)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                  
                                <iframe id="frame2_section2_show" src="" style="border:none;"></iframe>
                             
                        </div>
                    
                
                        </div>
                
        
                <div class="row col-10" style="margin: 1rem;">
                   
                    <div class="col-sm-12 text-center pt-1" >
                      <button type="button"  id="btn_saveframe2" class="btn" style="background-color:#009933;color:white" >บันทึก<i style="margin-left: 10px;color:white;font-size: 30px;" class="fa fa-save"></i></button>
                       
                    </div>
                </div>
                <br>
            </div>
           

      </div>




      </div>
      <div class="modal-footer">
        <button type="button" id="hidef2" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
      </div>
    </div>
  </div>
</div>
</div>
</div>




<div class="modal " id="modal-frame3" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header" style="display: flex; background-color: #c6e9ff;">

                    <div class="col-11" style="text-align: center;">
                    <img src="./img/icon/computer.png" height="25" alt="Responsive image"><span style="font-size: 1.2rem;" > สร้างข้อความประชาสัมพันธ์แสดงบนป้าย/แบบ 1 ข้อความ 2 ช่อง</span>
                    </div>

                    <div class="col-1" style="text-align: center;">
                    <button id="close-modal" type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                    </div>
                    </div>
      


      <div class="modal-body" style="">
           <input type="hidden" id="frame3_section1_XVMsgCode" >
           <input type="hidden" id="frame3_section3_XVMsgCode" >
           <input type="hidden" id="frame3_section4_XVMsgCode" >


           <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center ; background-color: white;">

                    

                
                            <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                     
                            <div class="row col-12" style="justify-content: center; margin: 1rem;">

                
                        
                    <div class=" col-4">
                        <label for="XVMsfCodeF3" style="">รหัสข้อความป้าย:</label>
                        <input type="text" id="XVMsfCodeF3"  class="form-control" value="" readonly>
                    </div>

                    <div class="  col-5" style="">
                        <label for="XVMsfNameF3" style="">ชื่อข้อความป้าย:</label>
                        <input type="text" id="XVMsfNameF3"  class="form-control" value="">
                    </div>

                    

                </div>

                                    <div class="col-12" style="padding: 0;">
                        <div id="frame3_section1" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                            
                                    <button onclick="addsms(1)"  style="position: absolute;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                    <iframe id="frame3_section1_show" src="" style="border:none;"></iframe>
                                   
                            </div>
                        </div>
 
                   <div class="col-12" style="padding: 0; ">
                        <div id="frame3_section3" class="float-left"  style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px; display: inline-block;">

                            <button  onclick="addsms(3)" style="position: absolute;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame3_section3_show" src="" style="border:none;"></iframe>
                           
                        </div>
                    
                        <div id="frame3_section4"  class="float-left col-12" style="display: inline-block; border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px; position: relative; left: -4px;">

                            <button  onclick="addsms(4)" style="position: absolute;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame3_section4_show" src="" style="border:none;"></iframe>
                           
                        </div>
                    </div>
                    </div>
                    
                   

                    <div class="col-8 text-center" style="margin: 1rem;">
                      <button type="button"  id="btn_saveframe3" class="btn" style="background-color:#009933;color:white" >บันทึก<i style="margin-left: 5px;color:white;font-size: 15px;" class="fa fa-save"></i></button>
                      <!-- <button type="button"  id="btn_saveframe3" class="btn btn-danger" style="color:white" >ล้าง<i style="margin-left: 5px;color:white;font-size: 15px;" class="fa fa-delete"></i></button> -->
                    </div>

                    </div>

      <div class="modal-footer col-12">
        <button type="button" class="btn btn-secondary" id="hide-modal" data-dismiss="modal">ปิด</button>
      </div>





      
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                            
            
                    

  <!-- The Modal -->
<div class="modal modal-fullscreen" id="myModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="display: flex;">
        <div class="col-11" style="text-align: center;">
        <h4 class="modal-title">เลือกข้อความ</h4>
        </div>
        <div class="col-1" style="text-align: center;">
        <button type="button" id="closemymodal" class="btn-close" data-dismiss="modal"></button>
        </div>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="ShowSel">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" id="hidemymodal" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>

    </div>
  </div>
</div>

<div class="modal " id="ModalExample">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="display: flex; background-color: #dee2e6;">
      <div class="col-11" style="text-align: center;">
      <h5 id="Example_Title" class="modal-title"></h5>
                                                </div>
        <div class="col-1">
        <button type="button" id="hidemodalex" class="btn-close" data-dismiss="modal"></button>
        </div>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div style="text-align: center;">                                  
                <iframe id="iframe" style="border: 0;" src=""></iframe>
                </div>  
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" id="closemodalex" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>

    </div>
  </div>
</div>

<!-- <div class="modal py-5" id="ModalExample" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" id="hidemodalex" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                 <div>                                    
                <iframe id="iframe" style="border: 0;" src=""></iframe>
                </div>       
            </div>
        </div>
    </div>
</div> -->

<div class="modal " id="modal-MsgSize" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center; justify-content: center;">
        <div class="col-11">
        <h5 class="modal-title">เลือกขนาดป้าย</h5>
        </div>
<!-- ** -->
        <div calss="col">
        <button type="button" id="hidemodal" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
        </div>

      </div>
      <div class="modal-body text-center">
         
                <select  id="SelMsgSize" class="input">
                        <?php
                               include "lib/DatabaseManage.php";
                               $stmt = "SELECT  [XVMssCode]
                                               ,[XVMssName]
                                               ,[XIMssWPixel]
                                               ,[XIMssHPixel]
                                               ,[XVWhoCreate]
                                               ,[XVWhoEdit]
                                               ,[XTWhenCreate]
                                               ,[XTWhenEdit]
                               FROM [NWL_SpeedWayTest2].[dbo].[TMstMMsgSize]";
                               $query = sqlsrv_query($conn, $stmt);
                              // echo '<option value="0">เลือกขนาดป้าย</option>';
                               while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                               {
                                  echo '<option value="'.$result["XVMssCode"].','.$result["XIMssWPixel"].','.$result["XIMssHPixel"].'">'.$result["XIMssWPixel"].'x'.$result["XIMssHPixel"].' PX</option>';
                               }
                               sqlsrv_close( $conn );
                        ?>
                       
                        
                </select>
                <div style="margin-top:10px;">
                    <button type="button"  id= "btn_next" class="btn btn-primary" >ถัดไป<i style="margin-left: 10px;color:#ffff00;font-size: 30px;" class="fa fa-forward"></i></button>
                  
                </div>
      
         
      </div>
      <div class="modal-footer">
        <button type="button" id="closemodal" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/dataTables.js"></script>
<script src="dist/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="Ckeditor/ckeditor/ckeditor.js"></script>
<script>

function showframe1(){
    $('#framenumber').val(1);
    $('#XVMsfCodeF1').val('MSFYYMM-####');
    $('#XVMsfNameF1').val('');
    $('#modal-MsgSize').modal('show');
}

function showframe2(){
    $('#framenumber').val(2);
    $('#XVMsfCodeF2').val('MSFYYMM-####');
    $('#XVMsfNameF2').val('');
    $('#modal-MsgSize').modal('show');
}
function showframe3(){
    $('#framenumber').val(3);
    $('#XVMsfCodeF3').val('MSFYYMM-####');
    $('#XVMsfNameF3').val('');
    $('#modal-MsgSize').modal('show');
}



$("#btn_next").click(function(){
    var optionSelected = $("#SelMsgSize").val();
        
        const SizeArray =optionSelected.split(",");
        var XVMssCode=SizeArray[0];
        var w=SizeArray[1];
        var h=SizeArray[2];
      
    var framenumber=$('#framenumber').val();
    $('#XVMssCode').val(XVMssCode); 
    $('#framewidth').val(w);
    $('#frameheight').val(h);
    if(framenumber==1){
        
        $('#modal-MsgSize').modal('hide');
        $('#modal-frame1').modal('show');
        document.getElementById("frame1_section3_show").src = "";
        document.getElementById("frame1_section3").style.width = w+"px";
        document.getElementById("frame1_section3").style.height = h+"px";
        document.getElementById("frame1_section3_show").style.width = w+"px";
        document.getElementById("frame1_section3_show").style.height = h+"px";    
        
    }else if(framenumber==2){
      
        $('#modal-MsgSize').modal('hide');
        $('#modal-frame2').modal('show');
        document.getElementById("frame2_section1_show").src = "";
        document.getElementById("frame2_section2_show").src = "";
        document.getElementById("frame2_section3_show").src = "";
        document.getElementById("frame2_section4_show").src = "";
        document.getElementById("frame2_section5_show").src = "";

        document.getElementById("frame2_section1").style.width = "965px";
        document.getElementById("frame2_section1").style.height = "px";
        document.getElementById("frame2_section1_show").style.width = w+"px";
        document.getElementById("frame2_section1_show").style.height = "px";

        document.getElementById("frame2_section2").style.width = "965px";
        document.getElementById("frame2_section2").style.height = "px";
        document.getElementById("frame2_section2_show").style.width = w+"px";
        document.getElementById("frame2_section2_show").style.height = "100px";

        // document.getElementById("frame2_section3").style.width = (w/3)+"px";
        document.getElementById("frame2_section3").style.width = "322px";
        document.getElementById("frame2_section3").style.height = (h-135)+"px";
     
        document.getElementById("frame2_section3_show").style.width =  ((w/3)-2)+"px";
        document.getElementById("frame2_section3_show").style.height = ((h-110)-30)+"px";

        // document.getElementById("frame2_section4").style.width = (w/3)+"px";
        document.getElementById("frame2_section4").style.width = "322px";
        document.getElementById("frame2_section4").style.height = (h-135)+"px";
        document.getElementById("frame2_section4_show").style.width =  ((w/3)-2)+"px";
        document.getElementById("frame2_section4_show").style.height = ((h-110)-30)+"px";

        // document.getElementById("frame2_section5").style.width = (w/3)+"px";
        document.getElementById("frame2_section5").style.width = "322px";
        document.getElementById("frame2_section5").style.height = (h-135)+"px";
        document.getElementById("frame2_section5_show").style.width =  ((w/3)-2)+"px";
        document.getElementById("frame2_section5_show").style.height = ((h-110)-30)+"px";

        
    }else if(framenumber==3){
        document.getElementById("frame3_section1_show").src = "";
        document.getElementById("frame3_section3_show").src = "";
        document.getElementById("frame3_section4_show").src = "";

        document.getElementById("frame3_section1").style.width = w+"px";
        document.getElementById("frame3_section1").style.height = "100px";
        document.getElementById("frame3_section1_show").style.width = (w-4)+"px";
        document.getElementById("frame3_section1_show").style.height = "100px";


        document.getElementById("frame3_section3").style.width = (w/2)+"px";
        document.getElementById("frame3_section3").style.height = (h-135)+"px";
     
        document.getElementById("frame3_section3_show").style.width =  ((w/2)-5)+"px";
        document.getElementById("frame3_section3_show").style.height = ((h-110)-30)+"px";

        document.getElementById("frame3_section4").style.width = (w/2)+"px";
        document.getElementById("frame3_section4").style.height = (h-135)+"px";
     
        document.getElementById("frame3_section4_show").style.width =  ((w/2)-5)+"px";
        document.getElementById("frame3_section4_show").style.height = ((h-110)-30)+"px";
      
        $('#modal-MsgSize').modal('hide');
        $('#modal-frame3').modal('show');
    }
});

function examplesms(url, h, w, vmsmame) {
  
    $('#ModalExample').modal('show');
    document.getElementById("Example_Title").innerText = vmsmame + " ขนาด กว้าง=" + w + " สูง=" + h;
    document.getElementById("iframe").width = parseInt(980);
    document.getElementById("iframe").height = parseInt(530);
    document.getElementById("iframe").src = url;


   
}   
 
function SelSms(XVMsgTyp,XVMsgCode){
  
    var framenumber=$('#framenumber').val();
    var framesmsid=$('#framesmsid').val();
    var url='ifarmeimg.php?msg='+XVMsgCode+'&type='+XVMsgTyp;


    if(framenumber==1){ 
       document.getElementById("frame1_section3_show").src = url;
       $('#frame1_section3_XVMsgCode').val(XVMsgCode);
    }else if(framenumber==2){
        if(framesmsid==1){
            document.getElementById("frame2_section1_show").src = url;
            $('#frame2_section1_XVMsgCode').val(XVMsgCode);
        }else if(framesmsid==2){
            document.getElementById("frame2_section2_show").src = url;
            $('#frame2_section2_XVMsgCode').val(XVMsgCode);
        }else if(framesmsid==3){
            document.getElementById("frame2_section3_show").src = url;
            $('#frame2_section3_XVMsgCode').val(XVMsgCode);
        }else if(framesmsid==4){
            document.getElementById("frame2_section4_show").src = url;
            $('#frame2_section4_XVMsgCode').val(XVMsgCode);
        }else if(framesmsid==5){   
            document.getElementById("frame2_section5_show").src = url; 
            $('#frame2_section5_XVMsgCode').val(XVMsgCode);    
        }
    }else if(framenumber==3){
        if(framesmsid==1){
            document.getElementById("frame3_section1_show").src = url;
            $('#frame3_section1_XVMsgCode').val(XVMsgCode);
        }else if(framesmsid==3){
            document.getElementById("frame3_section3_show").src = url;
            $('#frame3_section3_XVMsgCode').val(XVMsgCode);
        }else if(framesmsid==4){
            document.getElementById("frame3_section4_show").src = url;
            $('#frame3_section4_XVMsgCode').val(XVMsgCode);
         
        }
   
    }
    $('#myModal').modal('hide');
}
   
function addsms(smsid){
   
    $('#framesmsid').val(smsid);
    $('#ShowSel').empty();
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsframefunction.php",
        data: {
            'showsmssel': 'showsmssel'
        },
        success: function(result) {     
            $('#myModal').modal('show');
            $('#ShowSel').html(result);
        }
    });
}  
$("#btn_saveframe1").click(function(){
    var XVMsfCode= $('#XVMsfCodeF1').val();
    var XVMssCode=$('#XVMssCode').val();
    var XVMsfNameF1= $('#XVMsfNameF1').val();
    var frame1_section3_XVMsgCode= $('#frame1_section3_XVMsgCode').val();

    if(XVMsfNameF1==''){
            Swal.fire("กรุณาใส่ชื่อข้อความป้าย", "", "warning");
            return false;
    }
    if(frame1_section3_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความ", "", "warning");
            return false;
    }
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsframefunction.php",
        data: {
                    'saveframe1': 'saveframe1',
                    'XVMsfCode':XVMsfCode,
                    'XVMssCode':XVMssCode,
                    'XVMsgCodeF3':frame1_section3_XVMsgCode,
                    'XVMsfName':XVMsfNameF1
        },
        success: function(result) {    
            const obj = JSON.parse(result);
            $Return=obj.Return;
            if($Return!='InsertError'){
                $('#XVMsfCodeF1').val($Return);
                Swal.fire({
                        icon: "success",
                        title: "",

                        text: "บันทึกสำเร็จ",
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: "Save",
                        denyButtonText: `Don't save`
                        }).then((result) => {
                    
                            if (result.isConfirmed) {
                            
                                window.location.href = 'messagepublicrelationsframe.php';
                            }
                        });
               
            }else{
                Swal.fire("ไม่สามรถบันทึกได้", "", "warning");
            }
        }
    });
});
$("#btn_saveframe2").click(function(){
    var XVMsfCode= $('#XVMsfCodeF2').val();
    var XVMssCode=$('#XVMssCode').val();
    var XVMsfNameF2= $('#XVMsfNameF2').val();
    var frame2_section1_XVMsgCode= $('#frame2_section1_XVMsgCode').val();
    var frame2_section2_XVMsgCode= $('#frame2_section2_XVMsgCode').val();
    var frame2_section3_XVMsgCode= $('#frame2_section3_XVMsgCode').val();
    var frame2_section4_XVMsgCode= $('#frame2_section4_XVMsgCode').val();
    var frame2_section5_XVMsgCode= $('#frame2_section5_XVMsgCode').val();

    if(XVMsfNameF2==''){
            Swal.fire("กรุณาใส่ชื่อข้อความป้าย", "", "warning");
            return false;
    }
    if(frame2_section1_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
    if(frame2_section2_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
    if(frame2_section3_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
    if(frame2_section4_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
    if(frame2_section2_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsframefunction.php",
        data: {
                    'saveframe2': 'saveframe2',
                    'XVMsfCode':XVMsfCode,
                    'XVMssCode':XVMssCode,
                    'XVMsgCodeF1':frame2_section1_XVMsgCode,
                    'XVMsgCodeF2':frame2_section2_XVMsgCode,
                    'XVMsgCodeF3':frame2_section3_XVMsgCode,
                    'XVMsgCodeF4':frame2_section4_XVMsgCode,
                    'XVMsgCodeF5':frame2_section5_XVMsgCode,
                    'XVMsfName':XVMsfNameF2
        },
        success: function(result) {      
            const obj = JSON.parse(result);
            $Return=obj.Return;
            if($Return!='InsertError'){
                $('#XVMsfCodeF1').val($Return);
                Swal.fire({
                        icon: "success",
                        title: "",

                        text: "บันทึกสำเร็จ",
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: "Save",
                        denyButtonText: `Don't save`
                        }).then((result) => {
                    
                            if (result.isConfirmed) {
                            
                                window.location.href = 'messagepublicrelationsframe.php';
                            }
                        });
               
            }else{
                Swal.fire("ไม่สามรถบันทึกได้", "", "warning");
            }
        }
    });
});




$("#btn_saveframe3").click(function(){
    
    var XVMsfCode= $('#XVMsfCodeF3').val();
    var XVMssCode=$('#XVMssCode').val();
    var XVMsfNameF3= $('#XVMsfNameF3').val();
    var frame3_section1_XVMsgCode= $('#frame3_section1_XVMsgCode').val(); 
    var frame3_section3_XVMsgCode= $('#frame3_section3_XVMsgCode').val();
    var frame3_section4_XVMsgCode= $('#frame3_section4_XVMsgCode').val();
   
    if(XVMsfNameF3==''){
            Swal.fire("กรุณาใส่ชื่อข้อความป้าย", "", "warning");
            return false;
    }
    if(frame3_section1_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
 
    if(frame3_section3_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
    if(frame3_section4_XVMsgCode==''){
            Swal.fire("กรุณาเลือกข้อความให้ครบ", "", "warning");
            return false;
    }
   
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsframefunction.php",
        data: {
                    'saveframe3': 'saveframe3',
                    'XVMsfCode':XVMsfCode,
                    'XVMssCode':XVMssCode,
                    'XVMsgCodeF1':frame3_section1_XVMsgCode,
                    'XVMsgCodeF3':frame3_section3_XVMsgCode,
                    'XVMsgCodeF4':frame3_section4_XVMsgCode,
                    'XVMsfName':XVMsfNameF3
        },
        success: function(result) {      
            const obj = JSON.parse(result);
            $Return=obj.Return;
            if($Return!='InsertError'){
                $('#XVMsfCodeF1').val($Return);
                Swal.fire({
                        icon: "success",
                        title: "",

                        text: "บันทึกสำเร็จ",
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: "Save",
                        denyButtonText: `Don't save`
                        }).then((result) => {
                    
                            if (result.isConfirmed) {
                            
                                window.location.href = 'messagepublicrelationsframe.php';
                            }
                        });
               
            }else{
                Swal.fire("ไม่สามรถบันทึกได้", "", "warning");
            }
        }
    });
    



});
function deleteMSG(XVMsfCode) {

    Swal.fire({
                            title: "คุณต้องการลบข้อมูลหรือไม่?<br>",
                            text: XVMsfCode,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#198754",
                            cancelButtonColor: "#d33",
                            cancelButtonText:"ยกเลิก",
                            confirmButtonText: "ใช่"
                            }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "messagepublicrelationsframefunction.php",
               data: {
                    'Delete': 'Delete',
                    'XVMsfCode': XVMsfCode
                },
                success: function(result) {
                     console.log(result);
                     const obj = JSON.parse(result);
                     var Return=obj.Return;
                   
                     if(Return=='DeleteSuccess'){
                                Swal.fire({
                                title: "ลบสำเร็จ!",
                                text: "ข้อความของคุณถูกลบแล้ว",
                                icon: "success",
                                confirmButtonText: "ตกลง"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'messagepublicrelationsframe.php';
                                    }
                                })
                            }else{
                                Swal.fire({
                                icon: "error",
                                title: "ไม่สามรถลบได้มีการใช้อยู่ที่ป้าย<br>" +Return,
                                confirmButtonText: "ตกลง"
                                // text: "Something went wrong!",
                                // footer: '<a href="#">Why do I have this issue?</a>'
                                });
                            //  Swal.fire("ไม่สามรถลบได้มีการใช้อยู่ที่ป้าย "+Return, "", "warning");
                            }
                            }
                            });
                        
            
                        }
                                                    
             });
   
//    Swal.fire({
//        title: "",
//        text: "ต้องการลบ " + XVMsfCode + " ใช่หรือไม่?",
//        icon: "warning",
//        showCancelButton: true,
//        confirmButtonColor: "#3085d6",
//        cancelButtonColor: "#d33",
//        confirmButtonText: "ใช่",
//        cancelButtonText: "ไม่",
//    }).then((result) => {
//        if (result.isConfirmed) {
//            $.ajax({
//                type: "POST",
//                url: "messagepublicrelationsframefunction.php",
//                data: {
//                    'Delete': 'Delete',
//                    'XVMsfCode': XVMsfCode
//                },
//                success: function(result) {
//                     console.log(result);
//                     const obj = JSON.parse(result);
//                     var Return=obj.Return;
                   
//                     if(Return=='DeleteSuccess'){
//                         Swal.fire({
//                                 icon: "success",
//                                 title: "",

//                                 text: "ลบสำเร็จ",
//                                 showDenyButton: false,
//                                 showCancelButton: false,
//                                 confirmButtonText: "Save",
//                                 denyButtonText: `Don't save`
//                                 }).then((result) => {
                            
//                                     if (result.isConfirmed) {
                                    
//                                         window.location.href = 'messagepublicrelationsframe.php';
//                                     }
//                                 });
                    
//                     }else{
//                         if(Return=='DeleteError'){
//                            Swal.fire("ไม่สามรถลบได้", "", "warning");
//                         }else{
//                             Swal.fire("ไม่สามรถลบได้มีการใช้อยู่ที่ชุดการแสดงป้าย "+Return, "", "warning"); 
//                         }
//                     }
//                }
//            });
//        }
//    });
   
}

function SearchEdit(XVMsfCode,w,h){
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsframefunction.php",
        data: {
            'SearchEdit': 'SearchEdit',
            'XVMsfCode': XVMsfCode
        },
        success: function(result) {
            //console.log(result);
            const obj = JSON.parse(result);
            var XVMsfFormat=obj.XVMsfFormat;
            if(XVMsfFormat=='001'){
                
                document.getElementById("frame1_section3").style.width = w+"px";
                document.getElementById("frame1_section3").style.height = h+"px";
                document.getElementById("frame1_section3_show").style.width = w+"px";
                document.getElementById("frame1_section3_show").style.height = h+"px";
                var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF3);
    
                document.getElementById("frame1_section3_show").src = url;
                $('#framenumber').val(1);
                $('#XVMsfCodeF1').val(XVMsfCode);
                $('#XVMsfNameF1').val(obj.XVMsfName);
                $('#frame1_section3_XVMsgCode').val(obj.XVMsgCodeF3);
                
            
                $('#modal-frame1').modal('show');
            }else if(XVMsfFormat=='002'){
                document.getElementById("frame2_section1").style.width = w+"px";
                document.getElementById("frame2_section1").style.height = "100px";
                document.getElementById("frame2_section1_show").style.width = w+"px";
                document.getElementById("frame2_section1_show").style.height = "100px";

                document.getElementById("frame2_section2").style.width = w+"px";
                document.getElementById("frame2_section2").style.height = "100px";
                document.getElementById("frame2_section2_show").style.width = w+"px";
                document.getElementById("frame2_section2_show").style.height = "100px";

                document.getElementById("frame2_section3").style.width = (w/3)+"px";
                document.getElementById("frame2_section3").style.height = (h-100)+"px";
     
                document.getElementById("frame2_section3_show").style.width =  ((w/3)-5)+"px";
                document.getElementById("frame2_section3_show").style.height = ((h-110)-30)+"px";

                document.getElementById("frame2_section4").style.width = (w/3)+"px";
                document.getElementById("frame2_section4").style.height = (h-100)+"px";
                document.getElementById("frame2_section4_show").style.width =  ((w/3)-5)+"px";
                document.getElementById("frame2_section4_show").style.height = ((h-110)-30)+"px";

                document.getElementById("frame2_section5").style.width = (w/3)+"px";
                document.getElementById("frame2_section5").style.height = (h-100)+"px";
                document.getElementById("frame2_section5_show").style.width =  ((w/3)-5)+"px";
                document.getElementById("frame2_section5_show").style.height = ((h-110)-30)+"px";
                
                var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF1);
                document.getElementById("frame2_section1_show").src = url;
                var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF2);
                document.getElementById("frame2_section2_show").src = url;
                var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF3);
                document.getElementById("frame2_section3_show").src = url;
                var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF4);
                document.getElementById("frame2_section4_show").src = url;
                var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF5);
                document.getElementById("frame2_section5_show").src = url;
                $('#framenumber').val(2);
                $('#XVMsfCodeF2').val(XVMsfCode);
                $('#XVMsfNameF2').val(obj.XVMsfName);
                $('#frame2_section1_XVMsgCode').val(obj.XVMsgCodeF1);          
                $('#frame2_section2_XVMsgCode').val(obj.XVMsgCodeF2);
                $('#frame2_section3_XVMsgCode').val(obj.XVMsgCodeF3);
                $('#frame2_section4_XVMsgCode').val(obj.XVMsgCodeF4);
                $('#frame2_section5_XVMsgCode').val(obj.XVMsgCodeF5);
                
            
                $('#modal-frame2').modal('show');
            }else if(XVMsfFormat=='003'){   
                

               document.getElementById("frame3_section1").style.width = w+"px";
               document.getElementById("frame3_section1").style.height = "100px";
               document.getElementById("frame3_section1_show").style.width = w+"px";
               document.getElementById("frame3_section1_show").style.height = "100px";


               document.getElementById("frame3_section3").style.width = (w/2)+"px";
               document.getElementById("frame3_section3").style.height = (h-100)+"px";
     
               document.getElementById("frame3_section3_show").style.width =  ((w/2)-5)+"px";
               document.getElementById("frame3_section3_show").style.height = ((h-110)-30)+"px";

               document.getElementById("frame3_section4").style.width = (w/2)+"px";
               document.getElementById("frame3_section4").style.height = (h-100)+"px";
     
               document.getElementById("frame3_section4_show").style.width =  ((w/2)-5)+"px";
               document.getElementById("frame3_section4_show").style.height = ((h-110)-30)+"px";
               $('#framenumber').val(3);
               $('#XVMsfCodeF3').val(XVMsfCode);
               $('#XVMsfNameF3').val(obj.XVMsfName);
               var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF1);
               document.getElementById("frame3_section1_show").src = url;
               var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF3);
               document.getElementById("frame3_section3_show").src = url;
               var url='ifarme.php?msg='+btoa(obj.XVMsgCodeF4);
               document.getElementById("frame3_section4_show").src = url;
               $('#modal-frame3').modal('show');
               $('#frame3_section1_XVMsgCode').val(obj.XVMsgCodeF1);          
               $('#frame3_section3_XVMsgCode').val(obj.XVMsgCodeF3);
               $('#frame3_section4_XVMsgCode').val(obj.XVMsgCodeF4);
            }
                   
         }
    });
}



// $(document).ready(function() {
// new DataTable('#VMSTable', {
//     order: [[0, 'desc']],
    
//     layout: {
//          topEnd: {
//              search: {
//                  placeholder: 'กรอกข้อความที่ต้องการค้นหา...'
//              }
//          }
//      },
//      language: {
//         zeroRecords: '" ไม่พบข้อมูลที่ค้นหา "',
//         info: 'แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ',
//         infoFiltered: 'จาก _MAX_ รายการ',
//         infoEmpty: 'ไม่พบรายการ'
//     }
             
// });
// });

$(document).ready(function() {
new DataTable('#VMSTable', {
    order: [[0, 'desc']],
    
    layout: {
         topEnd: {
             search: {
                 placeholder: 'กรอกข้อความที่ต้องการค้นหา...'
             }
         }
     },
     language: {
        zeroRecords: '" ไม่พบข้อมูลที่ค้นหา "',
        info: 'แสดง _END_ รายการ จากทั้งหมด _MAX_ รายการ',
        infoFiltered: '',
        infoEmpty: 'ไม่พบรายการ'
    }
             
});
});

</script>

<script>
    $("#closemodal").click(function(){
    $("#modal-MsgSize").modal("hide");
    });
    $("#hidemodal").click(function(){
    $("#modal-MsgSize").modal("hide");
    });
    $("#close-modal").click(function(){
    $("#modal-frame3").modal("hide")
    })
    $("#hide-modal").click(function(){
    $("#modal-frame3").modal("hide")
    })
    $("#closemymodal").click(function(){
        $("#myModal").modal("hide")
    })
    $("#hidemymodal").click(function(){
        $("#myModal").modal("hide")
    })
    $("#closef1").click(function(){
        $("#modal-frame1").modal("hide")
    })
    $("#hidef1").click(function(){
        $("#modal-frame1").modal("hide")
    })
    $("#hidef2").click(function(){
        $("#modal-frame2").modal("hide")
    })
    $("#closef2").click(function(){
        $("#modal-frame2").modal("hide")
    })
    $("#hidemodalex").click(function(){
    $("#ModalExample").modal("hide")
    })
    $("#closemodalex").click(function(){
    $("#ModalExample").modal("hide")
    })
</script>
 

<script>
    
    </script>

</body>

</html>

<script src="./dist/js/jquery-3.7.1.js"></script>