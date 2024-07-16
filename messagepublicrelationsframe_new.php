<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <header>
        <?php include('navbar.php'); ?>
    </header>

    <div class="container">
    
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style=" border-radius: 0;position: relative; top: 170px;">
        <div style="margin: 1rem; text-align: center;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image">&nbsp;สร้างข้อความประชาสัมพันธ์แสดงบนป้าย
            <div style="margin-top:-5;">
                <hr>
            </div>
        </div>
        
        <input type="hidden" id="framenumber" >
        <input type="hidden" id="framesmsid" >
        <input type="hidden" id="framewidth" >
        <input type="hidden" id="frameheight" >
        <input type="hidden" id="XVMssCode" >
        <div  id="message"  style="display: block; margin-left: 10px;margin-right: 10px;" id="container">
            
            <div class="container">
            <div class="row justify-content-center ">

                    <div class="col-3 ps-1 mx-3" style="border-right: 1px solid #DCDCDC;">
                        
                        
                        <div class="  " style="border-bottom: 1px solid #DCDCDC; text-align: center; font-size: 14px;">
                            <p style="maring:0px;padding:0px;">เลือกรูปแบบข้อความป้าย</p>
                        </div>
                       <div class=" my-2 py-2 mt-4 "  onclick="showframe1()"   style="cursor: pointer;text-align: center; "><p style="maring:0px;padding:0px; font-size: 18px;">แบบข้อความเดี่ยว</p><img class="hover " src="http://43.229.151.103/speedway/img/f1.png" alt="Girl in a jacket" width="100%" height="100"></div>
                       
                       <div class="my-2 py-2 mt-4"  onclick="showframe2()" style="cursor: pointer;text-align: center; "><p style="maring:0px;padding:0px; font-size: 18px;">แบบ 2 ข้อความ 3 ช่อง</p><img class="hover " src="http://43.229.151.103/speedway/img/f2.png" alt="Girl in a jacket" width="100%" height="100"></div>

                       <div class="my-2 py-2 mt-4" onclick="showframe3()" style="cursor: pointer;text-align: center; "><p style="maring:0px;padding:0px;font-size: 18px;">แบบ 1 ข้อความ 2 ช่อง</p><img class="hover " src="http://43.229.151.103/speedway/img/f3.png" alt="Girl in a jacket" width="100%" height="100"></div>
                    </div>

                    <div class="col-8" style="">


                    <div class="col-md-auto ml-auto ">
                        <div class="dt-search" style="float: right; width: 220px; margin-bottom: 0.5rem"><label for="dt-search-0" ></label><input type="search" class="form-control form-control-sm" id="dt-search-0" placeholder="กรอกข้อความที่ต้องการค้นหา..." aria-controls="VMSTable"></div>
                    </div>

                    <div style="">
                        <table id="VMSTable" class="table table-striped table-hover" style="width:100%;">
                            <thead style="border-top: 1px solid #DCDCDC;">
                                <tr style="font-size: 10pt">
                                    <th class="th-sm">รหัส
                                    </th>
                                    <th class="th-sm">ชื่อข้อความ
                                    </th>
                                    <!--
                                    <th class="th-sm" style="text-align: center">ตัวอย่าง
                                    </th>

-->
                                    <th class="th-sm" style="text-align: center">ขนาด
                                    </th>

                                    <th class="th-sm" style="text-align: center"><i class="fa fa-trash-o"></i>ลบ
                                    </th>
                                    
                                    <th class="th-sm" style="text-align: center"><i class="fa fa-trash-o"></i>แก้ไข
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                                                <tr id="XVMsfCodeMSF2407-0025" style="font-size: 10pt">
                                    <td>MSF2407-0025</td>
                                    <td>frame test</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                                    
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0024" style="font-size: 10pt">
                                    <td>MSF2407-0024</td>
                                    <td>jpg</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0016" style="font-size: 10pt">
                                    <td>MSF2407-0016</td>
                                    <td>เฟม 1 ติดต่อขอความช่วยเหลือ</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0015" style="font-size: 10pt">
                                    <td>MSF2407-0015</td>
                                    <td>เฟม 1 ห้ามจอด</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0014" style="font-size: 10pt">
                                    <td>MSF2407-0014</td>
                                    <td>เฟม 3 กรมทางหลวง</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0013" style="font-size: 10pt">
                                    <td>MSF2407-0013</td>
                                    <td>เฟม 2 กรมทางหลวง</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0012" style="font-size: 10pt">
                                    <td>MSF2407-0012</td>
                                    <td>เฟม 1 พื้นที่กวดขันวินัย</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0011" style="font-size: 10pt">
                                    <td>MSF2407-0011</td>
                                    <td>yoframe1</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0010" style="font-size: 10pt">
                                    <td>MSF2407-0010</td>
                                    <td>ทดสอบ</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0009" style="font-size: 10pt">
                                    <td>MSF2407-0009</td>
                                    <td>yoframe1</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0008" style="font-size: 10pt">
                                    <td>MSF2407-0008</td>
                                    <td>test55</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0007" style="font-size: 10pt">
                                    <td>MSF2407-0007</td>
                                    <td>เทส3</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">344x178</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0006" style="font-size: 10pt">
                                    <td>MSF2407-0006</td>
                                    <td>เทส2</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">344x178</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0005" style="font-size: 10pt">
                                    <td>MSF2407-0005</td>
                                    <td>เทส 1</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">344x178</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0004" style="font-size: 10pt">
                                    <td>MSF2407-0004</td>
                                    <td>เฟม 3</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0003" style="font-size: 10pt">
                                    <td>MSF2407-0003</td>
                                    <td>เฟม 2</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0002" style="font-size: 10pt">
                                    <td>MSF2407-0002</td>
                                    <td>เฟม 1</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                                    <tr id="XVMsfCodeMSF2407-0001" style="font-size: 10pt">
                                    <td>MSF2407-0001</td>
                                    <td>xxx</td>
                                    <!--
                                    <td style="text-align: center;">
                                      
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('"></i>
                                      

                                    </td>
                    -->
                                    <td style="text-align: center">960x384</td>
                                   
                                    <td>
     
                                        <div style="margin-top: 5px ;text-align: center">
                            
                                             <img src="https://cdn-icons-png.freepik.com/256/14610/14610736.png?semt=ais_hybrid" width="20" alt="">
                                            
                                        </div>
                                    </td>

                                    <td style="text-align: center">
     
                                        <div style="margin-top: 5px ">
                            
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" width="20" alt="">
                                            
                                        </div>
                                    </td>
                
                    </tr>
                                        </tbody>
                    </table>

                    <div class="row justify-content-between"><div class="col-md-auto mr-auto "><div class="dt-info" aria-live="polite" id="VMSTable_info" role="status">รายการ 1 ถึง 10 จาก 19 ข้อมูล</div></div><div class="col-md-auto ml-auto "><div class="dt-paging paging_full_numbers"><ul class="pagination"><li class="dt-paging-button page-item disabled"><a class="page-link first" aria-controls="VMSTable" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a></li><li class="dt-paging-button page-item disabled"><a class="page-link previous" aria-controls="VMSTable" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a></li><li class="dt-paging-button page-item active"><a href="#" class="page-link" aria-controls="VMSTable" aria-current="page" data-dt-idx="0" tabindex="0">1</a></li><li class="dt-paging-button page-item"><a href="#" class="page-link" aria-controls="VMSTable" data-dt-idx="1" tabindex="0">2</a></li><li class="dt-paging-button page-item"><a href="#" class="page-link next" aria-controls="VMSTable" aria-label="Next" data-dt-idx="next" tabindex="0">›</a></li><li class="dt-paging-button page-item"><a href="#" class="page-link last" aria-controls="VMSTable" aria-label="Last" data-dt-idx="last" tabindex="0">»</a></li></ul></div></div></div>
                    
                </div>
            </div>

            
            </div>

            

</body>
</html>