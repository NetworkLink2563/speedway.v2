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
    width: 100%;
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
.modal-lg {
    max-width: 1000px !important;
  
}

table td{
    font-size: 0.9rem;
    transition: 0.5s;
    font-weight: 300;
}

table th{
    font-size: 1rem;
    font-weight: 500;
}

table {
    text-align: center;
}

*{
    box-sizing: border-box;
}

.dt-search{
        display: none;
    }

    body {
        background: #e1f0fa;
    }

    .container{
        background-color: white;
    }

    .flex-btn{
            display: flex;
            flex-direction: column;
            align-items: center;
    }
    
.flex-header{
    display: flex;

}

.flex-table{
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .shadow{
    box-shadow: 3px 3px 3px #aaaaaa!important;
}

.btn-hover:hover{
        opacity: 0.8;
        transition: 0.5s;
    }

    table th{
        background-color: #e8f4ff!important;
    }
    
    input.btnsearch{
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 12px top 10px;
 text-indent: 20px;
}

</style>


<div class="container" style="position: relative; top: 75;">

<div style=" text-align: center;  border-bottom: 3px double #cccc; padding: 1rem; margin: .4rem;">
            <img src="img/icon/setting.png" height="25" alt="Responsive image"> สร้างข้อความสภาพการจราจรพื้นฐาน
        </div>

    
        <div class="flex-header">
       


        <div class="flex-btn col-2" id="message" id="container" style="border-right: 3px double #cccc; background-color: #f8f7f7cc; padding: 0;">

                                <div class="col-12" style="margin: .5rem 0rem; padding: 0rem 0.6rem;">
                               <button style="width: 100%; padding: 1rem 0rem; background-color: #006eb4; margin: 0;" type="button" id="btn_addtext" class="btn btn-primary btn-hover btn-open-modal shadow"><i style="width: 15%;" class="fa fa-file-text"></i> สร้างข้อความตัวอักษร</button>
                               </div>
                               <div class="col-12" style="margin: .5rem 0rem; padding: 0rem 0.6rem;">
                               <button style="width: 100%; padding: 1rem 0rem; background-color: #006eb4;" type="button" id="btn_addpicture"  class="btn btn-success shadow btn-hover"><i style="width: 15%;" class="fa fa-image"></i> สร้างข้อความรูปภาพ</button>
                               </div>
                               <div class="col-12" style="margin: .5rem 0rem; padding: 0rem 0.6rem;">
                               <button style="width: 100%; padding: 1rem 0rem; background-color: #006eb4;" type="button" id="btn_addvdo"  class="btn btn-primary shadow btn-hover"><img src="img/icon/vdo.png" width="20" alt=""> สร้างข้อความวีดีโอ</button>
                            </div>
    
                        </div>
                    <!-- end div flex-btn -->

              
                    <div class="flex-table col" style="padding: 0;">

                    <div  class="search"  style="width: 255px; padding: 0; float: right; padding-right: 15px;padding-left: 15px;">

                    <!-- <img style="margin: 0 0.5rem; " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s" width="15" alt=""> -->
                    <input type="text" class="form-control btnsearch" name="" style="width: 100%; font-size: 0.9rem;" placeholder="กรอกข้อความที่ต้องการค้นหา..." id="dt-search-0" for="dt-search-0" aria-controls="VMSTable" value=""></input>
                    </div>

                    
                        <div class="table-content col">
                        <table id="VMSTable" class="table table-striped table-hover" style="width:100%;">
                            <thead>
                                <tr style="font-size: 10pt">
                                    <th class="th-sm">รหัสข้อความ
                                    </th>
                                    <th class="th-sm">ชื่อข้อความ
                                    </th>
                                    <th class="th-sm" style="text-align: center">ตัวอย่าง
                                    </th>
                                    <th class="th-sm" style="text-align: center">ขนาด
                                    </th>
                                    <th class="th-sm" style="text-align: center">ประเภท
                                    </th>
                                    <th class="th-sm" style="text-align: center"></th>
                                    <th class="th-sm" style="text-align: center">ลบ</th>
                                    <th class="th-sm" style="text-align: center">แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $stmt = "SELECT   dbo.TMstMMessage.XVMsgCode, dbo.TMstMMessage.XVMsgName, dbo.TMstMMessage.XVWhoCreate, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, 
                                                        dbo.TMstMMessage.XVMsgType, dbo.TMstMMessage.XVMsgInfoType
                                FROM            dbo.TMstMMessage INNER JOIN
                                                        dbo.TMstMMsgSize ON dbo.TMstMMsgSize.XVMssCode = dbo.TMstMMessage.XVMssCode
                                WHERE        (dbo.TMstMMessage.XVMsgInfoType = N'2')
                                ORDER BY dbo.TMstMMessage.XTWhenCreate DESC";
                        $query = sqlsrv_query($conn, $stmt);
                        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                        {
                        if($result['XVMsgType']==1){
                            $XVMsgType='<i class="fa fa-text-width" aria-hidden="true" title="ข้อความ"></i>';
                        }elseif($result['XVMsgType']==2){
                            $XVMsgType='<i class="fa fa-picture-o" aria-hidden="true" title="รูปภาพ"></i>';
                 }elseif($result['XVMsgType']==3){
                            $XVMsgType='<i class="fa fa-video-camera" aria-hidden="true" title="ภาพเคลื่อนไหว"></i>';
                        }
                        ?>
                                <tr id="MSGcode<?php echo $result['XVMsgCode']; ?>" style="font-size: 10pt">
                                    <td><?php echo $result['XVMsgCode']; ?></td>
                                    <td><?php echo $result['XVMsgName']; ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                      $XIMssWPixel=$result['XIMssWPixel'];
                                      $XIMssHPixel=$result['XIMssHPixel'];
                                      $url="ifarme.php?msg=".base64_encode($result['XVMsgCode']);
                                      $url."&wp=".base64_encode($result['XIMssWPixel']);
                                      $url."&hp=".base64_encode($result['XIMssHPixel']);
                                      $XVMsgName=$result['XVMsgName'];

                                     
                                    ?>
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('<?php echo $url;?>','<?php echo $result['XIMssHPixel'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $XVMsgName;?>');"></i>
                                       

                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel']; ?></td>
                                    <td style="text-align: center;">
                                        <div style=" margin-top: 5px"><?php echo $XVMsgType; ?></div>
                                    </td>
                                    <td>
                    </div>
                    <td>
                    <?php
                       $Disable="pointer-events: none;";
                       if($_SESSION["XBDmnIsDelete"]==1){
                          $Disable="";
                       }
                    ?>
                        <div style="margin-top: 5px">
                           
                                <i title="ลบ" style="cursor: -webkit-grab; cursor: grab;" class="fa fa-trash-o" aria-hidden="true" onclick="deleteMSG('<?php echo $result['XVMsgCode']; ?>');" <?php echo $Disable;?>></i>
                            
                        </div>
                    </td>
                    <td>
                        <?php
                           if($result['XVMsgType']==1){ 
                        ?>
                         <i title="แก้ไข" style="cursor: -webkit-grab; cursor: grab;margin-top:5px;" class="fa fa-pencil-square-o"
                                            aria-hidden="true"
                                            onclick="SearchEdit('<?php echo $result['XVMsgCode'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $result['XIMssHPixel'];?>');"></i>
                         <?php
                           }
                        ?>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>

                    </div>
                    <!-- end div flex-table -->

                </div>
<!-- end div flex-header -->

</div>
<!-- end div container -->

<div class="modal modal-fullscreen" id="modal-addtext" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i style="color:#09C703;width: 20%;" class="fa fa-file-text"></i>สร้างข้อความตัวอักษร</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          

           
           <div class="box" style="margin-top: 30;" align="left">
               
                <input type="hidden" id="idmsgSize" value="<?php echo $result_row['XVMssCode'];?>">
                
                <div class="row">
                    
                    
                    <div class="col-sm-12 text-center" style="padding-left: 50px;">
                        <ol class="menu" style="width:1000px">
                            <div class="form-inline">
                                <label for="TxtXVMsgCode" style="padding-right:12px;">รหัสข้อความ:</label>
                                <input type="text" id="TxtXVMsgCode"  class="form-control" value="" readonly>
                            </div>
                            <div class="form-inline" style="padding-top:5px;">
                                <label for="msgName" style="padding-right:20px;" >ชื่อข้อความ:</label>
                                <input type="text" id="msgName" name="msgName" class="form-control w-75" value="" >
                            </div>
                            <div class="form-inline pt-1" style="width:100%">
                                <p>สีพื้นหลัง:</p>
                                <?php
                                //กำหนดโค้ดสีที่ต้องการลงใน array
                                $color= array("#0a0a0a", "maroon", "#F60310", "#E76E14", "#E7C514", "#1DDC12", "#148CE7", "#6C1CEA");
                                for ($i = 0; $i < count($color); $i++) {
                                    echo "<li><span id=\"color$i\" title=\"$color[$i]\" class=\"button\"><font class=\"btncolor\" style=\"background-color:$color[$i];color:$color[$i]; \" >Yy</font></span></li>";
                                }
                                ?>
                            </div>
                            

                        </ol>
                    </div>
                
                </div>
                
            
                <div class="row" style="margin-top: 10" >
                    
                   
                    <div class="col-sm-12" style="margin-left: -170">
                        <ol class="menu">
                        
                        
                        </ol>
                        <!--input รับค่าสีที่เลือกสำหรับการส่งต่อผ่านฟอร์ม-->
                        <input type="hidden" id="bgcolor" name="bgcolor" />
                    </div><div class="col-sm-1" style="margin-left: -75px;margin-top: px"><input type="hidden" class="input"  id="usercolor" name="usercolor" style="height:30;color: #fff;text-align: center; font-weight: 50; background: " disabled/>
                    </div>

                </div>
                <div class="row" style="margin-top: 10;">
                    
                       
                    <div class="col-sm-12 text-center" style="margin-top: 5px;padding-left: 25%;">
                       
                        <div id="ShowCkeditor" style="text-align: center;"></div>
                    </div>
                </div><br>
                <div class="row">
                 
                    <div class="col-sm-12 text-center" >
                    
                        <button type="submit" style="background-color:#009933;color:white"  id= "btn_savetext" class="btn "  <?php echo $Disable;?>>บันทึก<i style="color:white;width: 20%;" class="fa fa-save"></i></button>
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

<div class="modal modal-fullscreen" id="modal-addimage" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i style="color:#FFCE33;width: 20%;" class="fa fa-image"></i>สร้างข้อความรูปภาพ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
         <div class="row">
                <div class="col-sm-12 text-center" style="padding-left: 50px;">
                        <ol class="menu" style="width:1000px">
                           <div class="form-inline">
                                <label for="ImgXVMsgCode" style="padding-right:12px;">รหัสรูปภาพ:</label>
                                <input type="text" id="ImgXVMsgCode"  class="form-control" value="" readonly>
                            </div>
                            <div class="form-inline" style="padding-top:5px;">
                                <label for="imageName" style="padding-right:26px;">ชื่อรูปภาพ:</label>
                                <input type="text" id="imageName"  class="form-control w-75" value="">
                            </div>
                        </ol>
                </div>
            <!--
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">
           
                                 ชื่อรูปภาพ

            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <input type="text" id="imageName"  class="input" value="">
            </div>
                            -->
        </div>

        <div class="row" style="margin-top: 10;">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8" style="margin-top: 5px">
                <div class="container">
                    <div class="card">
                        <label for="images" class="drop-container" id="dropcontainer">
                        <i class="fa fa-arrow-circle-o-up" style="font-size:48px;color:#212529;"></i>
                            <span class="drop-title">คลิกเลือกไฟล์</span>
                                <h6 id="imagefilename"></h6>
                            
                                <input type="file" id="images" accept="image/*" required>
                               
                           
                            <button type="button"  id= "btn_saveimage" class="btn " style="background-color:#009933;color:white">บันทึก<i style="color:white;width: 20%;" class="fa fa-save"></i></button>
                        </label>

                    </div>
                </div>
            </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
       
      </div>
    </div>
  </div>
</div>

<div class="modal modal-fullscreen" id="modal-addvdo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i style="color:red;width: 20%;" class="fa fa-youtube"></i>สร้างข้อความวีดีโอ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
         <div class="row">
                <div class="col-sm-12 text-center" style="padding-left: 50px;">
                        <ol class="menu" style="width:1000px">
                           <div class="form-inline">
                                <label for="VdoXVMsgCode" style="padding-right:12px;">รหัสวีดีโอ:</label>
                                <input type="text" id="VdoXVMsgCode"  class="form-control" value="" readonly>
                            </div>
                            <div class="form-inline" style="padding-top:5px;">
                                <label for="vdoName" style="padding-right:40px;">ชื่อวีดีโอ:</label>
                                <input type="text" id="vdoName"  class="form-control w-75" value="">
                            </div>
                        </ol>
                </div>
            <!--
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">
           
                                 ชื่อวีดีโอ

            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <input type="text" id="vdoName"  class="input" value="">
            </div>
                            -->
        </div>

        <div class="row" style="margin-top: 10;">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8" style="margin-top: 5px">
                <div class="container">
                    <div class="card">
                        <label for="vdos" class="drop-container" id="dropcontainer">
                        <i class="fa fa-arrow-circle-o-up" style="font-size:48px;color:#212529;"></i>
                            <span class="drop-title">คลิกเลือกไฟล์</span>
                                <h6 id="vdofilename"></h6>
                                <input type="file" id="vdos" accept="video/*" required>
                                <button type="button"  id= "btn_savevdo" class="btn" style="background-color:#009933;color:white" >บันทึก<i style="color:white;width: 20%;" class="fa fa-save"></i></button>
                        </label>

                    </div>
                </div>
            </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
     
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
                    <button type="button"  id= "btn_next" class="btn btn-primary" >ถัดไป<i style="color:#ffff00;width: 20%;" class="fa fa-forward"></i></button>
                  
                </div>
      
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
      </div>
    </div>
  </div>
</div>

<div class="modal py-5" id="ModalExample" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="  height: 500px;">
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
    function SearchEdit(XVMsgCode,w,h){
        
          $.ajax({
                type: "POST",
                url: "messagepublicrelationsfunction.php",
                data: {
                    'SearchEdit': 'SearchEdit',
                    'XVMsgCode':XVMsgCode
                },
                success: function(result) {   
                   
                 
                    const myArray = result.split("^");
                    
                    if(myArray.length==2){
                        var XVMsgName=myArray[0];
                        var XVMsgHtmlM=myArray[1];
                        
                       
                        $("#ShowCkeditor").html(XVMsgHtmlM);
                        $("#TxtXVMsgCode").val(XVMsgCode);
                        $("#msgName").val(XVMsgName);
                       
                        $("#modal-addtext").modal("show");
                    }
                    
                
                }
            });
    }
    $("#btn_addtext").click(function(){
      
        $("#XVMssType").val(1);
       
        $("#TxtXVMsgCode").val('MSGXXXX-XXXX');
        $("#msgName").val('');
  
        $("#modal-MsgSize").modal("show");
    });
    $("#btn_addpicture").click(function(){
        let $el = $('#images');
                $el.wrap('<form>').closest(
                    'form').get(0).reset();
                $el.unwrap();
        $("#imagefilename").text('');
        $("#XVMssType").val(2);
        $("#ImgXVMsgCode").val('MSGXXXX-XXXX');
        $("#imageName").val('');
        $("#modal-MsgSize").modal("show");
      
    });
    $("#btn_addvdo").click(function(){
        let $el = $('#vdos');
                $el.wrap('<form>').closest(
                    'form').get(0).reset();
                $el.unwrap();
        $("#vdofilename").text('');
        $("#XVMssType").val(3);
        $("#VdoXVMsgCode").val('MSGXXXX-XXXX');
        $("#vdoName").val('');
        

        $("#modal-MsgSize").modal("show");
    });

    $("#btn_next").click(function(){
        var optionSelected = $("#SelMsgSize").val();
        const SizeArray =optionSelected.split(",");
        var XVMssCode=SizeArray[0];
        var w=SizeArray[1];
        var h=SizeArray[2];
        $("#XVMssCode").val(XVMssCode);
        var XVMssType=$("#XVMssType").val();
        if(XVMssType==1){
            $.ajax({
                type: "POST",
                url: "messagepublicrelationsfunction.php",
                data: {
                    'ckeditorsize': 'ckeditorsize',
                    'w':w,
                    'h':h
                },
                success: function(result) {     
                    $("#ShowCkeditor").html(result);
                }
            });
            $("#modal-MsgSize").modal("hide");
            $("#modal-addtext").modal("show");
        }
        if(XVMssType==2){
            $("#modal-MsgSize").modal("hide");
            $("#modal-addimage").modal("show");
        }
        if(XVMssType==3){
            $("#modal-MsgSize").modal("hide");
            $("#modal-addvdo").modal("show");
        }
    });
    
    $("#btn_savetext").click(function(){
      
       
        
        var optionSelected = $("#SelMsgSize").val();
      
        const SizeArray =optionSelected.split(",");
        var XVMssCode=SizeArray[0];
        var w=SizeArray[1];
        var h=SizeArray[2];
        $("#XVMssCode").val(XVMssCode);

        var XVMsgName=document.getElementById('msgName').value;
        var XVMsgCode=document.getElementById('TxtXVMsgCode').value;
        var objEditor = CKEDITOR.instances["detail"];
        var q = objEditor.getData();

        var bgcolor=document.getElementById('usercolor').value;
        if(XVMsgName==''){
            Swal.fire("กรุณาใส่ชื่อข้อความ", "", "warning");
            return false;
        }
        if(q==''){
         
            Swal.fire("กรุณาใส่ข้อความ", "", "warning");
            return false;
        }
       
       
        
        
        var XVMsgStatus="2";
         
        Swal.showLoading();
        $.ajax({
            type: "POST",
            url: "addMessage_libery.php",
            data: {'XVMsgInfoType':'2','XVMsgCode':XVMsgCode,'data': q,'XVMsgName':XVMsgName,'XVMsgStatus':XVMsgStatus,'idmsgSize':XVMssCode,'msgBG':bgcolor},
            success: function(result) {
                 
               
                 const obj = JSON.parse(result);
                 swal.close();
                 if(obj.Return=="True"){
                     $("#TxtXVMsgCode").val(obj.XVMsgCode);
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
                            
                                window.location.href = 'messagetraffics.php';
                            }
                        });
                 }else{
                     Swal.fire("ไม่สามรถบันทึกได้", "", "warning");
                 }
                
            }
        });
        
    });
    $("#btn_saveimage").click(function(){
                var XVMssCode = document.getElementById('XVMssCode').value;
                var XVMsgName = document.getElementById('imageName').value;
                if (XVMsgName == '') {   
                    Swal.fire("กรุณาใส่ชื่อรูปภาพ", "", "info");
                    return false;
                }
                var XVMsgStatus = "2";
                var XVMsgType=2;
                var fd = new FormData(); 
                var files = $('#images')[0].files[0]; 
                fd.append('file', files); 
                fd.append('XVMsgName', XVMsgName); 
                fd.append('XVMsgStatus', XVMsgStatus); 
                fd.append('XVMssCode', XVMssCode); 
                fd.append('XVMsgType', XVMsgType); 
                fd.append('XVMsgInfoType', '2'); 
                
                swal.showLoading();
                $.ajax({ 
                    url: 'addPicMessage_libery.php', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){
                        const RetArr = JSON.parse(response);
                        swal.close();
                        if (RetArr.Return=="True"){
                            $("#ImgXVMsgCode").val(RetArr.XVMsgCode);
                            Swal.fire({
                                title: "",
                                icon: "success",
                                text: "บันทึกสำเร็จ",
                                confirmButtonText: "ตกลง",
                          
                            }).then((result) => {
                          
                                if (result.isConfirmed) {
                                    window.location.href = 'messagetraffics.php';
                                }
                            });
                            
                        }else{
                            Swal.fire({
                                title: "",
                                icon: "warning",
                                text: "ไม่สามรถบันทึกได้ โปรดติดต่อผู้ดูแลระบบ",
                                confirmButtonText: "ตกลง",
                          
                            }).then((result) => {
                          
                                if (result.isConfirmed) {
                                    window.location.href = 'messagetraffics.php';
                                }
                            });
                           
                        }
                       
                    }, 
                }); 
    });

    
    $("#btn_savevdo").click(function(){
                var XVMssCode = document.getElementById('XVMssCode').value;
                var XVMsgName = document.getElementById('vdoName').value;
                if (XVMsgName == '') {   
                    Swal.fire("กรุณาใส่ชื่อรูปภาพ", "", "info");
                    return false;
                }
                var XVMsgStatus = "2";
                var XVMsgType=3;
                var fd = new FormData(); 
                var files = $('#vdos')[0].files[0]; 
                fd.append('file', files); 
                fd.append('XVMsgName', XVMsgName); 
                fd.append('XVMsgStatus', XVMsgStatus); 
                fd.append('XVMssCode', XVMssCode); 
                fd.append('XVMsgType', XVMsgType); 
                fd.append('XVMsgInfoType', '2'); 
                swal.showLoading();
                $.ajax({ 
                    url: 'addPicMessage_libery.php', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){
                     
                        swal.close();
                        const RetArr = JSON.parse(response);
                        if (RetArr.Return=="True"){
                            $("#VdoXVMsgCode").val(RetArr.XVMsgCode);
                            Swal.fire({
                                title: "",
                                icon: "success",
                                text: "บันทึกสำเร็จ",
                                confirmButtonText: "ตกลง",
                          
                            }).then((result) => {
                          
                                if (result.isConfirmed) {
                                    window.location.href = 'messagetraffics.php';
                                }
                            });
                            
                        }else{
                            Swal.fire({
                                title: "",
                                icon: "warning",
                                text: "ไม่สามรถบันทึกได้ โปรดติดต่อผู้ดูแลระบบ",
                                confirmButtonText: "ตกลง",
                          
                            }).then((result) => {
                          
                                if (result.isConfirmed) {
                                   
                                     window.location.href = 'messagetraffics.php';
                                }
                            });
                           
                        }
                       
                    }, 
                }); 
    });


    $("#btn_saveimage").hide();
    $('#images').change(function (e) {
        const fname = e.target.files[0].name;
        $("#imagefilename").text(fname);
        $("#btn_saveimage").show();
    });
    
    $("#btn_savevdo").hide();
    $('#vdos').change(function (e) {
        const fname = e.target.files[0].name;
        $("#vdofilename").text(fname);
        $("#btn_savevdo").show();
        
    });
    
function show_modal(e) {
    console.log(e.href);
    $("#iframe_modal").attr("src", e.href);
    $('#myModalIfame').modal('show');
    return false;
}

function examplesms(url, h, w, vmsmame) {

    document.getElementById("Example_Title").innerText = vmsmame + " ขนาด กว้าง=" + w + " สูง=" + h;

    document.getElementById("iframe").width = parseInt(w);
    document.getElementById("iframe").height = parseInt(h);
    document.getElementById("iframe").src = url;


    $('#ModalExample').modal('show');
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







function deleteMSG(MSGCode) {
   
    Swal.fire({
        title: "",
        text: "ต้องการลบ " + MSGCode + " ใช่หรือไม่?",
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
                url: "lib/delMessage.php",
                data: {
                    'msgCODE': MSGCode
                },
                success: function(result) {
                 
                    const obj = JSON.parse(result);
                   
                    if (obj.RETURN != "True") {
                        Swal.fire("ไม่สามรถลบได้ มีการใช้ข้อความที่ข้อความประชาสัมพันธ์แสดงบนป้าย "+obj.XVVmsName, "", "warnning");
                        
                        //window.location.href = 'mainMessage.php';
                    } else {

                        window.location.href = 'messagepublicrelations.php';
                    }

                }
            });
        }
    });
    
}

 //ปุ่มเลือกสี
 for (i = 0; i < <?=count($color)?>; i++) {
        var obj = document.getElementById("color" + i);
        obj.onmouseover = function(){this.className = "hover"};
        obj.onmouseout = function(){
            if (this.id == document.getElementById("usercolor").value) this.className = "current";
            else this.className = "button";
        };
        obj.onclick = function(){selectcolor(this.id)};
    }

    //เมื่อคลิกปุ่ม
    function selectcolor (id) {
        for (i = 0; i < <?=count($color)?>; i++) {
            document.getElementById("color" + i).className = "button";
        };
        if (!document.getElementById(id)) id = "color0";
        document.getElementById("bgcolor").value = document.getElementById(id).title;
        document.getElementById("usercolor").value = document.getElementById(id).title;
        document.getElementById(id).className = "current";
        $('#usercolor').css('background', document.getElementById(id).title);
        var bgrealcolor=document.getElementById(id).title;
        $(".cke_wysiwyg_frame").contents().find(".cke_editable").css("background-color",bgrealcolor);
        document.getElementById('msgBG').value=bgrealcolor;
    }
</script>
</body>

</html>