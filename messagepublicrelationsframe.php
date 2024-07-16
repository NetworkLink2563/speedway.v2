<?php
include 'header.php';
include "lib/DatabaseManage.php";
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

.dt-search{
    display: none;
}

.flex-table{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

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
    z-index: 9999;
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
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 12px top 10px;
 text-indent: 20px;
 opacity: 0.7;
}

</style>



<div class="container" style="position: relative; top: 75;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> สร้างข้อความประชาสัมพันธ์แสดงบนป้าย
        </div>

        
        <input type="hidden" id="framenumber" >
        <input type="hidden" id="framesmsid" >
        <input type="hidden" id="framewidth" >
        <input type="hidden" id="frameheight" >
        <input type="hidden" id="XVMssCode" >
            

<div class="flex-header" style="padding: 0;">


            <div class="col-3" style="padding: 0;">
            <div class="flex-btn" style="border: 5px double #DCDCDC; padding: 0.5rem; top: 43;border-bottom: none; position: relative;">

                       <div class="box-color col-12" onclick="showframe1()"   style="cursor: pointer;text-align: center; border-bottom: 5px double #cccc;cursor: pointer;text-align: center;padding: 1rem 0.5rem;" ><p style="maring:0px;padding:0px;">แบบข้อความเดี่ยว</p><img class=" frame hover shadow"  src="img/f1.png" alt="" width="100%" height="100"></div>

                       <div class="box-color col-12" onclick="showframe2()" style="cursor: pointer;text-align: center; border-bottom: 5px double #cccc;cursor: pointer;text-align: center;padding: 1rem 0.5rem;" ><p style="maring:0px;padding:0px;">แบบ 2 ข้อความ 3 ช่อง</p><img class=" frame hover shadow"  src="img/f2.png" alt="" width="100%" height="100"></div>
                       
                       <div class="box-color col-12" onclick="showframe3()" style="cursor: pointer;text-align: center; border-bottom: 5px double #cccc;cursor: pointer;text-align: center;padding: 1rem 0.5rem;" ><p style="maring:0px;padding:0px;">แบบ 1 ข้อความ 2 ช่อง</p><img class=" frame hover shadow"  src="img/f3.png" alt="" width="100%" height="100"></div>

                </div>
                </div>




                <div class="col" style="padding: 0;">

                <div class="flex-table">
                    
                    <div class="col-12" style="padding: 0;">
                <div  class="search"  style="width: 255px; padding: 0; float: right; padding-right: 15px;padding-left: 15px;">

<!-- <img style="margin: 0 0.5rem; " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s" width="15" alt=""> -->
<input type="text" class="form-control btnsearch" name="" style="width: 100%; font-size: 0.9rem;" placeholder="กรอกข้อความที่ต้องการค้นหา..." id="dt-search-0" aria-controls="VMSTable"></input>
</div>
</div>

                        <div class="col">
                        <table id="VMSTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="th-sm">รหัส
                                    </th>
                                    <th class="th-sm">ชื่อข้อความ
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
                                    <td><?php echo $result['XVMsfName']; ?></td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center"><?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel']; ?></td>
                                   
                                    <td>
 
                                                <i title="ลบ" style="cursor: -webkit-grab; cursor: grab;" class="fa fa-trash-o" aria-hidden="true" onclick="deleteMSG('<?php echo $result['XVMsfCode']; ?>');" <?php echo $Disable;?>></i>
                                            
                                    </td>
                                    <td>
                                                 <i title="แก้ไข" style="cursor: -webkit-grab; cursor: grab;" class="fa fa-pencil-square-o"
                                                aria-hidden="true"
                                                onclick="SearchEdit('<?php echo $result['XVMsfCode'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $result['XIMssHPixel'];?>');"></i>
                                    </td>
                
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>


                    </div>
                    </div>
                    </div>

                </div>
            <!-- div flex header -->





<div class="modal modal-fullscreen" id="modal-frame1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
      
      </div>
      <div class="modal-body" style="background-color:rgb(225, 240, 250)!important;">
          

           <input type="hidden" id="frame1_section3_XVMsgCode" >
          
           <div class="box" style="margin-top: 30;padding-left: 20%;padding-right: 20%;" align="left">
                <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
                    <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;สร้างข้อความประชาสัมพันธ์แสดงบนป้าย/รูปแบบข้อความเดี่ยว
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <div style="margin-top:-5;"><hr></div>
                </div>
                <div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;">
                            <div class="form-group form-inline">
                                <label style="margin-right: 5px;" for="XVMsfCodeF1">หรัสข้อความป้าย:</label>
                                <input type="text" class="form-control" id="XVMsfCodeF1" readonly>
                            </div>
                            <div class="form-group form-inline">
                                <label style="margin-right: 15px;" for="XVMsfNameF1">ชื่อข้อความป้าย:</label>
                                <input style="width:50%" type="text" class="form-control" id="XVMsfNameF1">
                            </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style="">
                       
                       <div id="frame1_section3" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                          
                                   <button  style="position: absolute;left: 20px;top:5px;z-index:1000;" onclick="addsms(1)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                  
                                   <iframe id="frame1_section3_show" src="" style="border:none;"></iframe>
                                  
                                  
                                  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center pt-1" >
                       <button type="button"  id="btn_saveframe1" class="btn" style="background-color:#009933;color:white" >บันทึก<i style="margin-left: 10px;color:white;font-size: 30px;" class="fa fa-save"></i></button>
                       
                    </div>
                </div>
                <br>
            </div>
           

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
   
      </div>
    </div>
  </div>
</div>



<div class="modal modal-fullscreen" id="modal-frame2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
      
      </div>
      <div class="modal-body" style="background-color:rgb(225, 240, 250)!important;">
          

           <input type="hidden" id="frame2_section1_XVMsgCode" >
           <input type="hidden" id="frame2_section2_XVMsgCode" >
           <input type="hidden" id="frame2_section3_XVMsgCode" >
           <input type="hidden" id="frame2_section4_XVMsgCode" >
           <input type="hidden" id="frame2_section5_XVMsgCode" >
           <div class="box" style="margin-top: 30;padding-left: 20%;padding-right: 20%;" align="left">
                <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;margin-buttom: 10;">
                    <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;สร้างข้อความประชาสัมพันธ์แสดงบนป้าย/แบบ 2 ข้อความ 3 ช่อง
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <div style="margin-top:-5;"><hr></div>
                </div>
              
               
                <div class="row">
                    <div class="col-sm-12">
                       <div style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:5px;border-width: 2px;">
                            <div class="form-group form-inline">
                                <label style="margin-right: 5px;" for="XVMsfCodeF2">หรัสข้อความป้าย:</label>
                                <input type="text" class="form-control" id="XVMsfCodeF2" readonly>
                            </div>
                            <div class="form-group form-inline">
                                <label style="margin-right: 15px;" for="XVMsfNameF2">ชื่อข้อความป้าย:</label>
                                <input style="width:50%" type="text" class="form-control" id="XVMsfNameF2">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div id="frame2_section1" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                   
                    
                                <button  style="position: absolute;left: 20px;top:5px;z-index:1000;" onclick="addsms(1)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                  
                                <iframe id="frame2_section1_show" src="" style="border:none;"></iframe>
                                
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="frame2_section3" class="float-left" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                    
                            <button  onclick="addsms(3)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame2_section3_show" src="" style="border:none;"></iframe>
                            
                       </div>
                        <div id="frame2_section4" class="float-left" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                    
                            <button   onclick="addsms(4)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame2_section4_show" src="" style="border:none;"></iframe>
                            
                        </div>
                        <div id="frame2_section5" class="float-left" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                            
                            <button onclick="addsms(5)"  class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe  id="frame2_section5_show" src="" style="border:none;"></iframe>
                            
                            
                            
                        </div>
                    </div>
                   
                    <div class="col-sm-12" style="">
                        <div id="frame2_section2" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                   
                    
                                <button  style="position: absolute;left: 20px;top:5px;z-index:1000;" onclick="addsms(2)" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                  
                                <iframe id="frame2_section2_show" src="" style="border:none;"></iframe>
                             
                        </div>
                    </div>
                
                </div>
                
        
                <div class="row">
                   
                    <div class="col-sm-12 text-center pt-1" >
                      <button type="button"  id="btn_saveframe2" class="btn" style="background-color:#009933;color:white" >บันทึก<i style="margin-left: 10px;color:white;font-size: 30px;" class="fa fa-save"></i></button>
                       
                    </div>
                </div>
                <br>
            </div>
           

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
      </div>
    </div>
  </div>
</div>

<div class="modal modal-fullscreen" id="modal-frame3" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
      
      </div>
      <div class="modal-body" style="background-color:rgb(225, 240, 250)!important;">
           <input type="hidden" id="frame3_section1_XVMsgCode" >
           <input type="hidden" id="frame3_section3_XVMsgCode" >
           <input type="hidden" id="frame3_section4_XVMsgCode" >
           <div class="box" style="margin-top: 30;padding-left: 20%;padding-right: 20%;" align="left">
                <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
                    <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;สร้างข้อความประชาสัมพันธ์แสดงบนป้าย/แบบ 1 ข้อความ 2 ช่อง
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <div style="margin-top:-5;"><hr></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 border">
                                    <div class="form-group form-inline">
                                        <label style="margin-right: 5px;" for="XVMsfCodeF3">หรัสข้อความป้าย:</label>
                                        <input type="text" class="form-control" id="XVMsfCodeF3" readonly>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label style="margin-right: 15px;" for="XVMsfNameF3">ชื่อข้อความป้าย:</label>
                                        <input style="width:50%" type="text" class="form-control" id="XVMsfNameF3">
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="frame3_section1" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                            
                                    <button onclick="addsms(1)"  style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                                    <iframe id="frame3_section1_show" src="" style="border:none;"></iframe>
                                   
                            </div>
                        </div>
                </div>
                <div class="row">
                   <div class="col-sm-12">
                        <div id="frame3_section3" class="float-left"  style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                            <button  onclick="addsms(3)" style="margin:5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame3_section3_show" src="" style="border:none;"></iframe>
                           
                        </div>
                    
                        <div id="frame3_section4"  class="float-left" style="border-style: solid;border-color:#DCDCDC;margin:0px;padding:0px;border-width: 2px;">
                            <button  onclick="addsms(4)" style="margin:5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button>
                            <iframe id="frame3_section4_show" src="" style="border:none;"></iframe>
                           
                        </div>
                    </div>
                </div>
             
        
                <div class="row">
                   
                    <div class="col-sm-12 text-center pt-1" >
                      <button type="button"  id="btn_saveframe3" class="btn" style="background-color:#009933;color:white" >บันทึก<i style="margin-left: 10px;color:white;font-size: 30px;" class="fa fa-save"></i></button>
                       
                    </div>
                </div>
                <br>
            </div>
           

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
      </div>
    </div>
  </div>
</div>
  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">เลือกข้อความ</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="ShowSel">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal py-5" id="ModalExample" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">

                <iframe id="iframe" style="border: 0;" src=""></iframe>

            </div>
        </div>
    </div>
</div>

<div class="modal " id="modal-MsgSize" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">เลือกขนาดป้าย</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
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
        document.getElementById("frame1_section3_show").src = "";
        document.getElementById("frame1_section3").style.width = w+"px";
        document.getElementById("frame1_section3").style.height = h+"px";
        document.getElementById("frame1_section3_show").style.width = w+"px";
        document.getElementById("frame1_section3_show").style.height = h+"px";    
        $('#modal-MsgSize').modal('hide');
        $('#modal-frame1').modal('show');
    }else if(framenumber==2){
      
        document.getElementById("frame2_section1_show").src = "";
        document.getElementById("frame2_section2_show").src = "";
        document.getElementById("frame2_section3_show").src = "";
        document.getElementById("frame2_section4_show").src = "";
        document.getElementById("frame2_section5_show").src = "";

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

        $('#modal-MsgSize').modal('hide');
        $('#modal-frame2').modal('show');
    }else if(framenumber==3){
        document.getElementById("frame3_section1_show").src = "";
        document.getElementById("frame3_section3_show").src = "";
        document.getElementById("frame3_section4_show").src = "";

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
      
        $('#modal-MsgSize').modal('hide');
        $('#modal-frame3').modal('show');
    }
});

function examplesms(url, h, w, vmsmame) {
  
    document.getElementById("Example_Title").innerText = vmsmame + " ขนาด กว้าง=" + w + " สูง=" + h;

    document.getElementById("iframe").width = parseInt(w);
    document.getElementById("iframe").height = parseInt(h);
    document.getElementById("iframe").src = url;


    $('#ModalExample').modal('show');
}   
 
function SelSms(XVMsgTyp,XVMsgCode){
  
    var framenumber=$('#framenumber').val();
    var framesmsid=$('#framesmsid').val();
    var url='ifarme.php?msg='+btoa(XVMsgCode);
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
            $('#ShowSel').html(result);
        }
    });
    
    $('#myModal').modal('show');
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
       title: "",
       text: "ต้องการลบ " + XVMsfCode + " ใช่หรือไม่?",
       icon: "warning",
       showCancelButton: true,
       confirmButtonColor: "#3085d6",
       cancelButtonColor: "#d33",
       confirmButtonText: "ใช่",
       cancelButtonText: "ไม่",
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
                                icon: "success",
                                title: "",

                                text: "ลบสำเร็จ",
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
                        if(Return=='DeleteError'){
                           Swal.fire("ไม่สามรถลบได้", "", "warning");
                        }else{
                            Swal.fire("ไม่สามรถลบได้มีการใช้อยู่ที่ชุดการแสดงป้าย "+Return, "", "warning"); 
                        }
                    }
               }
           });
       }
   });
   
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
// Basic example
$(document).ready(function() {

    //  new DataTable('#UserTable');
    // new DataTable('#VMSTable');

    new DataTable('#VMSTable', {
        ordering: false,
        "oLanguage": {
            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
        }
    });
});








</script>
</body>

</html>