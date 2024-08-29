<div class="container-fluid mt-3">
    <h3>ป้ายประชาสัมพันธ์ปรับเปลี่ยนข้อความได้ (VMS)</h3>

    <div class="row">
        <div class="col-sm-4 p-3 ">
            <div class="box" style="height: 320px;width: 480px;overflow: hidden;background-color: black;">
                <div class="row">
                    <div class="col-sm-12 pt-1">
                        <img id="ImgLogo" style="height:60px;width:60" src="" class="rounded">

                        <p id="Sms1" class="text-white" style="position:absolute; top: 130px;left:90px;font-size: 16px;"></p>
                        <p id="Sms2" class="text-white" style="position:absolute; top: 160px;left:90px;font-size: 16px;"></p>
                        <p style="position: absolute; top: 25px;right:20px;" class="text-white">25 ํC</p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 pt-1">
                        <img id="ImgMap" style="height: 200px;width: 300px;" src="">
                        <canvas id="Canvas"
                            style="position: absolute; top: 190px;left:30px;height: 200px;width: 300px;border:2px solid yellow;opacity: 0.5;"></canvas>
                        <iframe id="IframeVdo" style="position: absolute; top: 180px;left:340px;width:162px"
                            class="embed-responsive-item" src=""
                            allowfullscreen></iframe>
                        <div class="pt-5"
                            style="font-size: 14px;position: absolute; top: 325px;left:400px;color:white ;border: 2px solid white;border-radius: 5px;width:100px;height:65px">
                            <p class="m-0 ps-4">ค่า PM2.5</p>
                            <p class="m-0 ps-4">50 AQI</p>
                        </div>
                        <button style="position: absolute; top: 150px;left:40px;height: 20px;" type="button"
                            class="btn btn-primary p-0 m-0" id="BtnLogo">โลโก้</button>
                        
                        <button style="position: absolute; top: 190px;left:30px;height: 20px;" type="button"
                            class="btn btn-primary p-0 m-0" id="BtnMap">แผนที่</button>

                        <button style="position: absolute; top: 190px;left:340px;height: 20px;" type="button"
                            class="btn btn-primary p-0 m-0" id="BtnVdo">วีดีโอ</button>
                        <button style="position: absolute; top: 130px;left:455px;height: 20px;" type="button"
                            class="btn btn-primary p-0 m-0" id="BtnText1">ข้อความ1</button>
                        <button style="position: absolute; top: 160px;left:460px;height: 20px;" type="button"
                            class="btn btn-primary p-0 m-0" id="BtnText2">ข้อความ2</button>

                        <button style="position: absolute; top: 410px;left:455px;height: 20px;" type="button"
                            class="btn btn-primary p-0 m-0" id="BtnText3">ข้อความ3</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 pt-1 pt-4">
                        <p id="Sms3" style="font-size: 16px;color:white"></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-4 p-3 ">
            <div class="card p-3">
                <div>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">โครงการ</span>
                    <select id="SelProject" class="form-control">
                        <?php
					include '../lib/DatabaseManage.php';  
					echo InPutSelect_Project();
				?>
                    </select>
                </div>
                <div>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">ป้าย Vms</span>
                    <select id="SelVms" class="form-control">
                    </select>
                </div>

            </div>
        </div>
    </div>
    <form id="FormActionPoint" class="user" method="POST" action="Controller.php">
        <div class="row">

            <div class="col-sm-4 p-3 ">
                <div class="row">
                    <div class="col-sm-6 p-3 ">
                        <label class="m-0">จุดเริ่มต้น X</label>
                        <input class="form-control" type="text" id="X1" required>
                        <label class="m-0">จุดเริ่มต้น Y</label>
                        <input class="form-control" type="text" id="Y1" required>
                    </div>
                    <div class="col-sm-6 p-3 ">
                        <label class="m-0">จุดเริ่มสิ้นสุด X</label>
                        <input class="form-control" type="text" id="X2" required>
                        <label class="m-0">จุดสิ้นสุด Y</label>
                        <input class="form-control" type="text" id="Y2" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 p-3 ">
                
                <div class="mt-1">
                    <label for="SelPoint">ชื่อจุด</label>
                    <input class="form-control" type="number" id="PointNumber" required>
                </div>
                <div class="mt-1">
                    <label for="SelPoint">คำอธิบาย</label>
                    <input class="form-control" type="text" id="Remark" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6  text-center">
                <button class=" btn btn-success " type="submit" id="BtnSave" name="BtnSave">บันทึก</button>

            </div>
            <div class="col-sm-6  text-center">

                <button class=" btn btn-success " type="button" id="BtnShowPoint"
                    name="BtnShowPoint">จุดเริ่มต้น/จุดสิ้นสุด</button>
            </div>
        </div>
    </form>
    <!-- The Modal -->
    <div class="modal" id="ModalUploadLogo">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">อัปโหลดโลโก้</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="FormActionLogo" class="user" method="POST" action="Controller.php">
                        <div class="form-group row m-1">
                            <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                                <label class="m-0"> รูปภาพขนาด กว้าง 60 PX สูง 60:</label>
                                <input class="form-control" type="file" id="file1" required />
                            </div>
                        </div>

                        <div class="form-group text-center pt-3">
                            <button
                                class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                                type="submit" id="BtnUpVdo">อัปโหลดโลโก้</button>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>

            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal" id="ModalUploadVdo">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">วีดีโอสตรีม</h4>

                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="FormActionStream" class="user" method="POST" action="Controller.php">
                        <div class="form-group row m-1">
                            <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                                <label class="m-0">Url</label>
                                <input class="form-control" type="text" id="XVLinkStream" required />
                            </div>
                        </div>

                        <div class="form-group text-center pt-3">
                            <button class=" btn btn-success " type="submit" id="BtnSave" name="BtnSave">บันทึก</button>
                        </div>
                    </form>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="ModalUploadMap">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">อัปโหลดแผนที่</h4>

                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="FormActionMap" class="user" method="POST" action="Controller.php">
                        <div class="form-group row m-1">
                            <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                                <label class="m-0"> รูปภาพขนาด กว้าง 480 PX สูง
                                    320:</label>
                                <input class="form-control" type="file" id="file2" required />
                            </div>
                        </div>

                        <div class="form-group text-center pt-3">
                            <button
                                class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                                type="submit" id="BtnUpVdo">อัปโหลดแผนที่</button>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>

            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="myModalSms1">
        <div class="modal-dialog   card shadow" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">ข้อความที่1</h4>
                </div>
                <div class="modal-body card shadow">
                    <form id="FormActionSms1" class="user" method="POST" action="Controller.php">



                        <div class="form-group row m-1 pt-3" style="padding-left: 20px;">
                            <script type="text/javascript" src="../Ckeditors/ckeditor/ckeditor.js"></script>
                            <textarea id="TxtSms1" name="TxtSms1" style="width:320px;height: 480px"></textarea>
                            <script>
                            CKEDITOR.replace('TxtSms1');

                            function CKupdate() {
                                for (instance in CKEDITOR.instances)
                                    CKEDITOR.instances[instance].updateElement();
                            }
                            </script>
                        </div>
                        <div class="form-group row m-1">
                            <div class="text-center pt-3">
                                <button class=" btn btn-success " type="submit" id="BtnSave"
                                    name="BtnSave">บันทึก</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>




    <!-- The Modal -->
    <div class="modal fade" id="myModalSms2">
        <div class="modal-dialog   card shadow" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">ข้อความที่2</h4>
                </div>
                <div class="modal-body card shadow">
                    <form id="FormActionSms2" class="user" method="POST" action="Controller.php">
                        <div class="form-group row m-1 pt-3" style="padding-left: 20px;">
                            <script type="text/javascript" src="../Ckeditors/ckeditor/ckeditor.js"></script>
                            <textarea id="TxtSms2" name="TxtSms2" style="width:320px;height: 480px"></textarea>
                            <script>
                            CKEDITOR.replace('TxtSms2');

                            function CKupdate() {
                                for (instance in CKEDITOR.instances)
                                    CKEDITOR.instances[instance].updateElement();
                            }
                            </script>
                        </div>
                        <div class="form-group row m-1">
                            <div class="text-center pt-3">
                                <button class=" btn btn-success " type="submit" id="BtnSave"
                                    name="BtnSave">บันทึก</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="myModalSms3">
        <div class="modal-dialog   card shadow" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">ข้อความที่3</h4>
                </div>
                <div class="modal-body card shadow">
                    <form id="FormActionSms3" class="user" method="POST" action="Controller.php">
                        <div class="form-group row m-1 pt-3" style="padding-left: 20px;">
                            <script type="text/javascript" src="../Ckeditors/ckeditor/ckeditor.js"></script>
                            <textarea id="TxtSms3" name="TxtSms3" style="width:320px;height: 480px"></textarea>
                            <script>
                            CKEDITOR.replace('TxtSms3');

                            function CKupdate() {
                                for (instance in CKEDITOR.instances)
                                    CKEDITOR.instances[instance].updateElement();
                            }
                            </script>
                        </div>
                        <div class="form-group row m-1">
                            <div class="text-center pt-3">
                                <button class=" btn btn-success " type="submit" id="BtnSave"
                                    name="BtnSave">บันทึก</button>
                            </div>
                        </div>


                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="myModalPoint">
        <div class="modal-dialog  modal-lg card shadow" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">จุดเริ่มต้น/จุดสิ้นสุด</h4>
                </div>
                <div class="modal-body card shadow">
                    <div class="table-responsive pt-1">
                        <table style="width:100%" class="table table-striped" id="table">
                            <thead>
                                <tr>

                                    <th class="p-1 " style="color: black;font-size: 14px;font-weight: bold;">
                                        ชื่อจุด/คำอธิบาย</th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">
                                        จุดเริ่ม X/Y</th>

                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">
                                        จุดสิ้นสุด X/Y</th>

                                    <th class="p-1"></th>
                                    <th class="p-1"></th>
                                    
                                </tr>
                            </thead>
                            <tbody id="TableBody">
                                <?php //echo ShowBodyTable("");?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


    <script src="view.js"></script>