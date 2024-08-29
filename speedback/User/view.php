<style>
.bg-success {
    --bs-bg-rgb-color: var(--bs-success-rgb);
    background-color: #f6f2f0 !important;
}
</style>
<?php
   include '../lib/DatabaseManage.php';   
  // $Permis=Permission('MNU22-00004');
?>
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                       
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">

                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">

                <div class="row g-5 g-xl-10 mb-xl-10">

                    <div class="card pt-3">
                        <div class="text-center">
                           <h3>ผู้ใช้</h3>
                        </div>
                   
                        <div>
                            <button style="position: absolute; top: 5%; z-index: 10;" type="button" id="BtnAdd" class="btn btn-dark ms-4 py-1 fs-8"> <i
                                        class="" <?php echo $Permis[1];?>></i>
                                    เพิ่มผู้ใช้</button>
                        </div>
                       
                     
                        <span class="label label-default" id="LabelSearch">ค้นหา</span>
                        <br>
                        <div class="row mb-1">
                          
                          <div class="col-sm-12 mb-3 mb-sm-0 m-0">

                              <label class="m-0">ลูกค้า:</label>
                              <select id="Sel_Customer" class="form-control " required>
                                  <?php
                                      
                                      echo InPutSelect_Customer("");
                                  ?>
                              </select>

                          </div>
                      </div>
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr style="background-color:#F2F4F4;">
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ชื่อ</th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">E-mail</th>
                                    
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">สถานะ</th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;"></th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;"></th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;"></th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;"></th>
                                </tr>
                            </thead>
                            <br>
                            <tbody id="TableBody">
                                <?php //echo ShowBodyTable("");?>
                            </tbody>
                        </table>
                    </div>
                    <!--end::Body-->

                </div>

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

</div>
<!--end:::Main-->

</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog card shadow">
        <div class="modal-content ">

            <!-- Modal Header -->
            <div class="modal-header ">
                <h5 id="HeaderTitle" class="modal-title">
                    </h4>
                    <!--
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
-->
            </div>

            <!-- Modal body -->
            <div class="modal-body card shadow">
                <form id="FormRegister" class="user" method="POST" action="Controller.php">
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">รหัสผู้ใช้:</label>
                            <input type="text" class="form-control w-50" value="NNNN@NN.COM"
                                placeholder="" id="TxtCstCode" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">ลูกค้า:</label>
                            <select id="SelCustomer" <?php echo $Permis[1];?> class="form-control w-75" required>
                                <?php echo  InPutSelect_Customer($_SESSION["CstCode"]);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">ชื่อผู้ใช้:</label>
                            <input type="text" class=" form-control input-sm w-50"
                                placeholder="" id="TxtName" autocomplete="off" <?php echo $Permis[1];?> required>
                        </div>
                    </div>
                    
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0 p-0">Email:</label>
                            <input type="email" class=" form-control input-sm w-50"
                                placeholder="Email" id="EmaEmail" autocomplete="off" <?php echo $Permis[1];?> required>
                        </div>
                    </div>

                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                           
                            <label class="m-0 p-0">รหัสผ่าน:</label>
                       

                            <input type="password" <?php echo $Permis[1];?> class=" form-control input-sm w-50" id="password2" name="password2">
                        </div>

                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0 p-0">สถานะ:</label>
                            <select <?php echo $Permis[1];?> class=" form-control input-sm w-25" id="Selstatus">
                                <option value="1">ใช้งาน</option>
                                <option value="0">ยกเลิก</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1 pt-3">
                        <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                            <input type="hidden" id="txtmode">

                            <button class=" btn btn-success "
                                type="submit" id="BtnSave" name="BtnSave" <?php echo $Permis[1];?>>บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="ModalPermis">
    <div class="modal-dialog  modal-lg card shadow">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 id="HeaderTitle" class="modal-title">กำหนดสิทธิ์เมนู</h5>
                <!--
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
-->
            </div>
            <!-- Modal body -->
            <div class="modal-body card shadow ">
                <form id="FormPermis" class="user" method="POST" action="Controller.php">
                    <input type="hidden" id="txtUsrCode">
                    <h6 id="HeaderTitle" class="modal-title pb-2 text-center card shadow pt-1">เมนูภาพรวม</h6>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0 m-0">
                        <div class="col-sm-6 mb-3 mb-sm-0 ">
                            ภาพรวม
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-1"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-1"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-1"> ลบ
                        </div>
                    </div>

                    <hr style="border: 0.5px solid #e6e6e6;">
                    <h6 id="HeaderTitle" class="modal-title pb-2 text-center card shadow pt-1">เมนูผู้ดูแลระบบ</h6>
                    
                    <?php
                         $hidden="";
                        if($_SESSION["CstCode"]=="CUS22-00001"){
                            $hidden="hidden";
                        }
                        ?>
                
                  
                    <hr style="border: 1px solid #e6e6e6;">
                    <div class="form-group row p-0" <?php echo $hidden;?>>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            ลูกค้า
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-2"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-2"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-2"> ลบ
                        </div>
                    </div>
                  
                    <hr style="border: 1px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            โครงการ
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-3"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-3"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-3"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            ผู้ใช้
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-4"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-4"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-4"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            จุดติดตั้ง
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-5"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-5"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-5"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            กล้องวงจรปิด
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-6"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-6"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-6"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            วัดสภาพอากาศ
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-7"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-7"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-7"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            ตรวจจับความเร็ว
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-8"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-8"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-8"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                           ป้าย VMS
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-9"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-9"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-9"> ลบ
                        </div>
                    </div>
                    
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            เรด้านับรถ
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-10"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-10"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-10"> ลบ
                        </div>
                    </div>

                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            เส้นทาง
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-11"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-11"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-11"> ลบ
                        </div>
                    </div>

                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                        วาดเส้นทาง
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-12"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-12"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-12"> ลบ
                        </div>
                    </div>

                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                        FSK คอนโทรล
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-13"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-13"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-13"> ลบ
                        </div>
                    </div>
                  
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            FSK โหนด
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-14"> อ่าน
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel2-14"> บันทึก
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel3-14"> ลบ
                        </div>
                    </div>

                    <hr style="border: 0.5px solid #e6e6e6;">
                    <h6 id="HeaderTitle" class="modal-title pb-2 text-center card shadow pt-1">รายงาน</h6>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            กล้องวงจรปิด
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-15"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-15"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-15"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            สภาพอากาศ
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-16"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-16"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-16"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            ตรวจจับความเร็ว
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-17"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-17"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-17"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            ป้าย VMS
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-18"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-18"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-18"> ลบ
                        </div>
                    </div>
                    
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            เรด้านับรถ
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-19"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-19"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-19"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            Fsk
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-20"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-20"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-20"> ลบ
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
                    <div class="form-group row p-0">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            แผนที่
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="Sel1-21"> อ่าน
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel2-21"> บันทึก
                        </div>
                        <div class="col-sm-2" hidden>
                            <input type="checkbox" id="Sel3-21"> ลบ
                        </div>
                        <div class="col-sm-12 mb-3 mb-sm-0 text-center pt-2">
                            <button
                                class="<?php echo $Permis[1];?> btn btn-success  text-center"
                                type="submit" id="BtnSavePermis">บันทึก</button>
                        </div>
                    </div>
                    <hr style="border: 0.5px solid #e6e6e6;">
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
<div class="modal fade" id="ModalProject">
    <div class="modal-dialog   card shadow">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 id="HeaderTitle" class="modal-title">กำหนดสิทธิ์โครงการ</h5>
                 <!--
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    -->
            </div>
            <!-- Modal body -->
            <div class="modal-body card shadow ">
                <form id="FormProject" class="user" method="POST" action="Controller.php">
                    <input type="hidden" id="txt_UsrCode">
                    <?php
                        echo ShowProject();
                    ?>
                    <div class="form-group row p-0">
                        <div class="col-sm-12 mb-3 mb-sm-0 text-center pt-2">
                            <button
                                class="<?php echo $Permis[1];?> btn btn-success  text-center"
                                type="submit" id="BtnSaveProject">บันทึก</button>
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
<!--
<script src="view.js"></script>
                    -->
<script>
    
function ShowDataTable(){
    $( "#TableBody" ).empty();
    $.post("Controller.php",
    {
        CustCode: $("#Sel_Customer").val(),
        Search: "Search"

    })
    .done(async function (data) {
        
        obj=JSON.parse(data);
        $('#table').DataTable( {
            data: obj,
            columns: [
                { data: 'A' },
                { data: 'B' },
                { data: 'C' },
                { data: 'D' },
                { data: 'E' },
                { data: 'F' },
                { data: 'G' }
            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "40%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "10%", "targets": 6 }
              ],
            lengthChange: false,
            "bDestroy": true

        } );
        
    });
}
$("#Sel_Customer").change(function () {
    ShowDataTable();
});
function FuDelete(p) {
    
    Swal.fire({
        title: 'ต้องการลบ ' + p + ' ใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'ใช่',
        denyButtonText: 'ยกเลิก',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
                $.post("Controller.php",
                {
                    Delete: 'Delete',
                    UsrCode: p
                })
                .done(async function (data) {
                  
                    ShowDataTable();
                });
        }
    })
        
}
$("#BtnAdd").click(function () {
    $("#HeaderTitle").text('เพิ่มผู้ใช้ใหม่');
    $("#txtmode").val('0');
    $("#EmaEmail").val('');
    $("#TxtName").val('');
    $("#TxtPhone").val('');
    $("#Selstatus").val('1').change();
    /*
    $("#SelCustomer").prop("disabled", false);
    $("#EmaEmail").prop("disabled", false);
    $("#TxtName").prop("disabled", false);
    $("#TxtPhone").prop("disabled", false);
    $("#password2").prop("disabled", false);
    $("#Selstatus").prop("disabled", false);
  */
    $("#myModal").modal('toggle');
});
function FuPermis(UsrCode, p1, p2, p3) {
   

    const obj1 = JSON.parse(p1);
    const obj2 = JSON.parse(p2);
    const obj3 = JSON.parse(p3);
    
    for (i = 0; i <= 20; i++) {
        x=i+1;
        $("#Sel1-" + x).prop("checked", false);
        $("#Sel2-" + x).prop("checked", false);
        $("#Sel3-" + x).prop("checked", false);
        
        if (obj1[i] == 1) {
            $("#Sel1-" + x).prop("checked", true);
        }
        if (obj2[i] == 1) {
            $("#Sel2-" + x).prop("checked", true);
        }
        if (obj3[i] == 1) {
            $("#Sel3-" + x).prop("checked", true);
        }
    }
    $("#txtUsrCode").val(UsrCode);
    $("#ModalPermis").modal('toggle');
}
function FuProject(UsrCode) {
    $.post("Controller.php",
        {
            UsrPrj: 'UsrPrj',
            UsrCode: UsrCode,
        })
        .done(async function (data) {
            const obj = JSON.parse(data);
            var x = 0;
            $.each($("input[name='txtProjectC[]']"), function () {
                $("#Sel" + x).prop("checked", false);
                x = x + 1;
            });
            x = 0;
            $.each($("input[name='txtProjectC[]']"), function () {
                for (i = 0; i < obj.length; i++) {
                    var PrjCode = obj[i].XVPrjCode;
                    if ($(this).val() == PrjCode) {
                        $("#Sel" + x).prop("checked", true);
                    }
                }
                x = x + 1;
            });
        });
    $("#txt_UsrCode").val(UsrCode);
    $("#ModalProject").modal('toggle');
}
function FuEdit(p1, p2, p3, p4, p5) {
    var Selvalue = "0";
    if (p4 == 1) {
        Selvalue = "1";
    }
   
    $("#HeaderTitle").text('แก้ไขข้อมูลผู้ใช้');
    $("#txtmode").val('1');
    $("#TxtCstCode").val(p1);

    $("#EmaEmail").val(p1),
        $("#TxtName").val(p2),
        $("#TxtPhone").val(p3),
        $("#SelCustomer").val(p5).change();
    /*
    $("#SelCustomer").prop("disabled", true);
    $("#EmaEmail").prop("disabled", true);
    $("#TxtName").prop("disabled", true);
    $("#TxtPhone").prop("disabled", true);
    $("#PasPwd").prop("disabled", true);
    */
    $("#myModal").modal('toggle');
}
function RegisterAccount() {
    $.post("Controller.php",
        {
            Mode: $("#txtmode").val(),
            CstCode: $("#SelCustomer").val(),
            Name: $("#TxtName").val(),
       
            EmaEmail: $("#EmaEmail").val(),
            PasPwd: $("#password2").val(),
            Status: $("#Selstatus").val(),
        })
        .done(async function (data) {
         
         
            if(data.trim()=="Err1"){
                Swal.fire({
                    text: "อีเมลซ้ำ",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "รับทราบ",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
               return false;
            }
       
            ShowDataTable();
            $("#myModal").modal('toggle');
        });
}
$("#FormRegister").submit(function (event) {
    event.preventDefault();
    RegisterAccount();
});
$("#FormPermis").submit(function (event) {
   
    event.preventDefault();
    var s1 = [];
    var s2 = [];
    var s3 = [];
    s1.push('');
    s2.push('');
    s3.push('');
    for (i = 1; i <= 21; i++) {

        if ($('#Sel1-' + i).is(':checked')) {
            s1.push('1');
        }
        else {
            s1.push('0');
        }
        if ($('#Sel2-' + i).is(':checked')) {
            s2.push('1');
        }
        else {
            s2.push('0');
        }
        if ($('#Sel3-' + i).is(':checked')) {
            s3.push('1');
        }
        else {
            s3.push('0');
        }
    }
   
    $.post("Controller.php",
        {
            Permission: 'Permission',
            UsrCode: $("#txtUsrCode").val(),
            s1: s1,
            s2: s2,
            s3: s3
        })
        .done(async function (data) {
         
           
            ShowDataTable();
            $("#ModalPermis").modal('toggle');
        });
});
$("#FormProject").submit(function (event) {
    event.preventDefault();
    i = 0;
    var s1 = [];
    $.each($("input[name='txtProjectC[]']"), function () {
        if ($('#Sel' + i).is(':checked')) {
            s1.push($(this).val());
        }
        i = i + 1;
    });
    $.post("Controller.php",
        {
            PermisPrj: 'PermisPrj',
            UsrCode: $("#txt_UsrCode").val(),
            s1: s1
        })
        .done(async function (data) {
            ShowDataTable();
            $("#ModalProject").modal('toggle');
        });
});
$(function() {
   
    ShowDataTable();
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
                  "sProcessing": "กำลังดำเนินการ...",
                  "sLengthMenu": "แสดง_MENU_ แถว",
                  "sZeroRecords": "ไม่พบข้อมูล",
                  "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                  "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                  "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                  "sInfoPostFix": "",
                  "sSearch": "",
                  "sUrl": "",
                  "oPaginate": {
                                "sFirst": "เิริ่มต้น",
                                "sPrevious": "ก่อนหน้า",
                                "sNext": "ถัดไป",
                                "sLast": "สุดท้าย"
                  }
         }
    });

    $('#table').dataTable( {
        "searching": true,
        "bLengthChange": false
      } );
});

</script>