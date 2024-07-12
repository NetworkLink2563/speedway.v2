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
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/setting.png" height="25" alt="Responsive image">&nbsp;จัดการข้อความสภาพจราจร
            <div style="margin-top:-5;">
                <hr>
            </div>
        </div>
        
    
        <div  id="message"  style="display: block; margin-left: 10px;margin-right: 10px;" id="container">
            <div class="row">
               
                   
                    <div class="col-sm-12" >
                        <div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;">
                            <div class="btn-group">
                               <button style="margin: 5px;border-radius: 5px;" type="button" id="btn_addtext"   data-toggle="modal" data-target="#modal-addtext"  class="btn btn-primary btn-lg btn-open-modal">สร้างข้อความตัวอักษร<i style="margin-left: 10px;color:#09C703;font-size: 30px;" class="fa fa-file-text"></i></button>
                               <button style="margin: 5px;border-radius: 5px;" type="button" id="btn_addpicture"  class="btn btn-primary btn-lg ">สร้างข้อความรูปภาพ<i style="margin-left: 10px;color:#FFCE33;font-size: 30px;" class="fa fa-image"></i></button>
                              
                           


                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="row">
              
                <div class="col-sm-12" style="">
                    <div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;">
                        <table id="VMSTable" class="table" style="width:100%;">
                            <thead>
                                <tr style="font-size: 10pt">
                                    <th class="th-sm">MSG Code
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
                                    <th class="th-sm" style="text-align: center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $stmt = "SELECT TMstMMessage.XVMsgCode,TMstMMessage.XVMsgName,TMstMMessage.XVWhoCreate,TMstMMsgSize.XIMssWPixel,TMstMMsgSize.XIMssHPixel,TMstMMessage.XVMsgType FROM TMstMMessage 
                                 INNER JOIN TMstMMsgSize ON TMstMMsgSize.XVMssCode=TMstMMessage.XVMssCode
                                 
                                     ORDER BY TMstMMessage.XTWhenCreate DESC";
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
                                        <!--
                                    <div style=" margin-top: 5px"><a
                                            href="ifarme.php?msg=<?php //echo base64_encode($result['XVMsgCode']);?>"
                                            target="_blank" style="color: #0a0a0a"><i class="fa fa-file-word-o"
                                                aria-hidden="true"></i></a></div>
                    -->

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
                        <div style="margin-top: 5px"><a href="#" class="del-item" style="color: #8d9499;<?php echo $Disable;?>"
                                onclick="deleteMSG('<?php echo $result['XVMsgCode']; ?>');" ><i class="fa fa-trash-o"
                                    aria-hidden="true"></i></a></div>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>
    <br>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog " role="document">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 class="modal-title">เลือกขนาดป้าย/ประเภทข้อความ</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-sm-12">
                        <select name="MssCode" id="MssCode" class="input">
                            <option value="" selected>เลือกขนาด</option>
                            <?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel,XVMssName FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                        $querySQL = sqlsrv_query($conn, $sql);
                        while($result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $result_row['XVMssCode'];?>">
                                <?php echo $result_row['XVMssName'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-sm-12">
                        <select name="MssType" id="MssType" class="input">
                            <option value="" selected>ประเภทข้อความ</option>
                            <option value="1">ข้อความ</option>
                            <option value="2">รูปภาพ</option>
                            <option value="3">วีดีโอ</option>
                        </select>
                    </div>

                </div>
                <div class=" row py-3">

                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"
                            id="btnRefresh" onclick="goToAddMessage()">ตกลง</button>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>



<div class="modal modal-fullscreen" id="modal-addtext" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">สร้างข้อความตัวอักษร</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          

           
           <div class="box" style="margin-top: 30;" align="left">
                <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
                    <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;เพิ่มรายการข้อความ
                    <div style="margin-top:-5;"><hr></div>
                </div>
                <input type="hidden" id="idmsgSize" value="<?php echo $result_row['XVMssCode'];?>">

                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-1" style="margin-top: 5px">ชื่อข้อความ
                    </div>
                    <div class="col-sm-4" style="margin-left: -30;">
                        <input type="text" id="msgName" name="msgName" class="input" value="">
                    </div>
                </div>
                
            
                <div class="row" style="margin-top: 10" >
                    <div class="col-sm-4">
                        
                    </div>
                    <div class="col-sm-1" style="margin-top: 5px">สีพื้นหลัง
                    </div>
                    <div class="col-sm-4" style="margin-left: -170"><ol class="menu">
                            <?php
                            //กำหนดโค้ดสีที่ต้องการลงใน array
                            $color= array("#0a0a0a", "maroon", "#F60310", "#E76E14", "#E7C514", "#1DDC12", "#148CE7", "#6C1CEA");
                            for ($i = 0; $i < count($color); $i++) {
                                echo "<li><span id=\"color$i\" title=\"$color[$i]\" class=\"button\"><font class=\"btncolor\" style=\"background-color:$color[$i];color:$color[$i]; \" >Yy</font></span></li>";
                            }
                            ?>
                        </ol>
                        <!--input รับค่าสีที่เลือกสำหรับการส่งต่อผ่านฟอร์ม-->
                        <input type="hidden" id="bgcolor" name="bgcolor" />
                    </div><div class="col-sm-1" style="margin-left: -75px;margin-top: px"><input type="hidden" class="input"  id="usercolor" name="usercolor" style="height:30;color: #fff;text-align: center; font-weight: 50; background: " disabled/>
                    </div>

                </div>
                <div class="row" style="margin-top: 10;">
                   
                    <div class="col-sm-12" style="margin-top: 5px">
                        <textarea  name="detail" id="detail" ></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-8" >
                    
                        <button type="submit" class="btn btn-primary" onclick="preViewsMsg('<?php echo $resultProcedSQL['ptCode'];?>',1);" <?php echo $Disable;?>>บันทึก</button>
                    </div>
                </div>
                <br>
            </div>
           

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-fullscreen" id="modal-addimage" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">สร้างข้อความรูปภาพ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
         <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">
           
                                 ชื่อรูปภาพ

            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <input type="text" id="imageName" name="msgName" class="input" value="">
            </div>
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
                               
                           
                            <button type="button"  id= "btn_saveimage" class="btn btn-primary" >บันทึก</button>
                        </label>

                    </div>
                </div>
            </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-fullscreen" id="modal-addvdo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">สร้างข้อความวีดีโอ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
         <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">
           
                                 ชื่อวีดีโอ

            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <input type="text" id="vdoName" name="msgName" class="input" value="">
            </div>
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
                            
                                <input type="file" id="vdos" accept="image/*" required>
                               
                           
                            <button type="button"  id= "btn_savevdo" class="btn btn-primary" >บันทึก</button>
                        </label>

                    </div>
                </div>
            </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary">บันทึก</button>
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
    
    CKEDITOR.replace('detail',{
        font_names: 'SarunThangLuang'+
                 
                    'Arial/Arial, Helvetica/sans-serif;' +
                    'THSarabun;' +
                    'Comic Sans MS/Comic Sans MS, cursive;' +
                    'Courier New/Courier New, Courier, monospace;' +
                    'Georgia/Georgia, serif;' +
                    'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
                    'Tahoma/Tahoma, Geneva, sans-serif;' +
                    'Times New Roman/Times New Roman, Times, serif;' +
                    'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
                    'Verdana/Verdana, Geneva, sans-serif',
        toolbar : [
                ['Font', 'FontSize'], ['TextColor', 'BGColor'], ['Bold', 'Italic', 'Underline', 'Strike'], ['Subscript', 'Superscript'],
                ['JustifyLeft', 'JustifyRight', 'JustifyCenter', 'JustifyBlock'] 
               
                ]

    });
    
    $("#btn_addpicture").click(function(){
        let $el = $('#images');
                $el.wrap('<form>').closest(
                    'form').get(0).reset();
                $el.unwrap();
        $("#imagefilename").text('');
        $("#modal-addimage").modal("show");
    });
   
    $("#btn_addvdo").click(function(){
        let $el = $('#vdos');
                $el.wrap('<form>').closest(
                    'form').get(0).reset();
                $el.unwrap();
        $("#vdofilename").text('');
        $("#modal-addvdo").modal("show");
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

function goToAddMessage() {
    var e = document.getElementById("MssCode").value;
    var t = document.getElementById("MssType").value;

    if (e == "") {
        Swal.fire({
            title: "",
            text: "โปรดเลือกขนาดป้าย",
            icon: "warning",
            confirmButtonText: "ตกลง",

        }).then((result) => {

            if (result.isConfirmed) {
                $('#myModal').modal('show');
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
        return false;
    }
    if (t == "") {
        Swal.fire({
            title: "",
            text: "โปรดเลือกประเภทข้อความ",
            icon: "warning",
            confirmButtonText: "ตกลง",

        }).then((result) => {

            if (result.isConfirmed) {
                $('#myModal').modal('show');
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });


        return false;
    }
    if (t == 1) {
        window.location.href = 'addMessage.php?msgsize=' + btoa(e) + "&mmstype=" + btoa(t);
    } else {
        window.location.href = 'addPicMessage.php?msgsize=' + btoa(e) + "&mmstype=" + btoa(t);

    }
}
$(document).ready(function() {
    var productselection = document.getElementById("productselection");
    <?php
        for ($x = 1; $x <= 4; $x++) {
        ?>
    var product<?php echo $x;?> = document.getElementById("product<?php echo $x;?>");
    <?php } ?>
    productselection.addEventListener("change", function() {
        var text = productselection.value;
        const myArray = text.split("_");
        var productselections = document.getElementById("productselection");
        var valuer = productselections.value;
        var textr = productselections.options[productselections.selectedIndex].text;
        <?php for ($x = 1; $x <= 4; $x++) { ?>
        if (myArray[1] == <?php echo $x;?>) {
            product<?php echo $x;?>.style.display = 'block';
            productlist<?php echo $x;?>.style.display = 'block';
        } else {
            product<?php echo $x;?>.style.display = 'none';
            productlist<?php echo $x;?>.style.display = 'none';
        }
        <?php } ?>


    });
});

function onlyNumbers(e) {
    var c = e.which ? e.which : e.keyCode;
    if (c < 48 || c > 57) {
        return false;
    }
}

function numberValidation(e) {
    e.target.value = e.target.value.replace(/[^\d]/g, '');
    return false;
}

function getValue(radio) {
    if ((radio.value) == 1) {
        document.getElementById("multiCam").style.display = "none";
    } else {
        document.getElementById("multiCam").style.display = "block";
    }
}

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
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

function disableUser(userCodeInput) {
    var hashEncode = '76605981da8c7170dd309c591438288b';
    $.ajax({
        type: "POST",
        url: "lib/processUser.php",
        data: {
            'usercode': userCodeInput,
            'encode': hashEncode,
            'VMScode': VMSCodeInput
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusUserNonActive' + userCodeInput).style.display = 'none';
                document.getElementById('statusUserBlockActive' + userCodeInput).style.display =
                    'block';
                document.getElementById('statusUser' + userCodeInput).innerHTML = 'Unactive';
            }
        }
    });
}

function disableVMS(VMSCodeInput) {
    var hashEncode = '76605981da8c7170dd309c591438288b';
    $.ajax({
        type: "POST",
        url: "lib/processVMS.php",
        data: {
            'VMScode': VMSCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusVMSNonActive' + VMSCodeInput).style.display = 'none';
                document.getElementById('statusVMSBlockActive' + VMSCodeInput).style.display = 'block';
                document.getElementById('statusVMS' + VMSCodeInput).innerHTML = 'Offlice';
            }
        }
    });
}

function activeUser(userCodeInput) {
    var hashEncode = '7c08aa10ab8b543cf5f3ebab19c55587';
    $.ajax({
        type: "POST",
        url: "lib/processUser.php",
        data: {
            'usercode': userCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusUserNonActive' + userCodeInput).style.display = 'block';
                document.getElementById('statusUserBlockActive' + userCodeInput).style.display = 'none';
                document.getElementById('statusUser' + userCodeInput).innerHTML = 'Active';
            }
        }
    });
}

function activeVMS(VMSCodeInput) {
    var hashEncode = '7c08aa10ab8b543cf5f3ebab19c55587';
    $.ajax({
        type: "POST",
        url: "lib/processVMS.php",
        data: {
            'VMScode': VMSCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusVMSNonActive' + VMSCodeInput).style.display = 'block';
                document.getElementById('statusVMSBlockActive' + VMSCodeInput).style.display = 'none';
                document.getElementById('statusVMS' + VMSCodeInput).innerHTML = 'Online';
            }
        }
    });
}

function deleteUser(userCodeInput) {
    var hashEncode = '9aa1fca65b77dd8b8b7a88dfe547d35c';
    $.ajax({
        type: "POST",
        url: "lib/processUser.php",
        data: {
            'usercode': userCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('usercode' + userCodeInput).style.display = 'none';
            }
        }
    });
}

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
                        Swal.fire("ไม่สามรถลบได้ มีการใช้ข้อความนี้อยู่ที่ป้าย"+obj.XVVmsName, "", "warnning");
                        
                        //window.location.href = 'mainMessage.php';
                    } else {

                        window.location.href = 'mainMessage.php';
                    }

                }
            });
        }
    });

}

/*function deleteVMS(VMSCodeInput){
    var hashEncode='9aa1fca65b77dd8b8b7a88dfe547d35c';
    $.ajax({
        type: "POST",
        url: "lib/processVMS.php",
        data: {'VMScode': VMSCodeInput,'encode':hashEncode},
        success: function(result) {
            if(result==1){
                document.getElementById( 'VMScode'+VMSCodeInput ).style.display = 'none';
            }
        }
    });
}*/
</script>
</body>

</html>