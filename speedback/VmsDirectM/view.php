<style>
.bg-success {
    --bs-bg-rgb-color: var(--bs-success-rgb);
    background-color: #f6f2f0 !important;
}
.swal2-html-container{
    overflow-y: hidden; /* Hide vertical scrollbar */
  overflow-x: hidden; /* Hide horizontal scrollbar */
}
.modal {
    --bs-modal-zindex: 1055;
    --bs-modal-width: 800px;
    --bs-modal-padding: 1.75rem;
    --bs-modal-margin: 0.5rem;
    --bs-modal-color: ;
    --bs-modal-bg: var(--bs-body-bg);
    --bs-modal-border-color: var(--bs-border-color-translucent);
    --bs-modal-border-width: 0;
    --bs-modal-border-radius: 0.75rem;
    --bs-modal-box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    --bs-modal-inner-border-radius: 0.75rem;
    --bs-modal-header-padding-x: 1.75rem;
    --bs-modal-header-padding-y: 1.75rem;
    --bs-modal-header-padding: 1.75rem 1.75rem;
    --bs-modal-header-border-color: var(--bs-border-color);
    --bs-modal-header-border-width: 1px;
    --bs-modal-title-line-height: 1.5;
    --bs-modal-footer-gap: 0.5rem;
    --bs-modal-footer-bg: ;
    --bs-modal-footer-border-color: var(--bs-border-color);
    --bs-modal-footer-border-width: 1px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: var(--bs-modal-zindex);
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}
</style>
<?php
   include '../lib/DatabaseManage.php';   
   $Permis=Permission('MNU22-00006');
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
                            <h3>จัดการสื่อข้อความ/รูปภาพ/วีดีโอ</h3>
                        </div>
                        <div>
                            <?php
                            if( $_SESSION["CstCode"]=="CUS22-00001"){ 
                        ?>
                            <div class="row mb-1">
                                <div class="col-sm-2 mb-3 mb-sm-0 m-0">

                                </div>
                                <div class="col-sm-2 mb-3 mb-sm-0 m-0">

                                </div>
                            </div>
                            <?php
                            }
                        ?>
                        </div>
                        <br>
                        <br>
                        <span class="label label-default" id="LabelSearch">ค้นหา</span>
                        <div class="row mb-1">
                            <div class="col-sm-4 mb-3 mb-sm-0 m-0">

                                <label class="m-0">โครงการ:</label>
                                <select id="Sel_PrjCode" class="form-control " required>
                                    <?php
                                    	
                                        echo InPutSelect_Project();
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">
                                <button type="button" id="BtnAdd" class="btn btn-dark ms-4 py-1 fs-8"
                                    style="margin-top:30px;"> <i class="" <?php echo $Permis[1];?>></i>
                                    สร้างข้อความ</button>
                            </div>
                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">

                                <button type="button" id="BtnAddImg" class="btn btn-dark ms-4 py-1 fs-8"
                                    style="margin-top:30px;"> <i class="" <?php echo $Permis[1];?>></i>
                                    เพิ่มรูปภาพ</button>
                            </div>
                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">

                                <button type="button" id="BtnAddVdo" class="btn btn-dark ms-4 py-1 fs-8"
                                    style="margin-top:30px;"> <i class="" <?php echo $Permis[1];?>></i>
                                    เพิ่มVdo</button>
                            </div>
                            <?php
                            if( $_SESSION["CstCode"]=="CUS22-00001"){ 
                        ?>
                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">

                                <button type="button" id="BtnAddTemplate" class="btn btn-dark ms-4 py-1 fs-8"
                                    style="margin-top:30px;"> <i class="" <?php echo $Permis[1];?>></i>
                                    เพิ่มรูปภาพแนะนำเส้นทาง</button>
                            </div>
                            <?php
                            }
                        ?>
                         <?php
                            if( $_SESSION["CstCode"]=="CUS22-00001"){ 
                        ?>
                            <div class="col-sm-2 mb-3 mb-sm-0 m-0">

                                <button type="button" id="BtnAddTemplateMap" class="btn btn-dark ms-4 py-1 fs-8"
                                    style="margin-top:30px;"> <i class="" <?php echo $Permis[1];?>></i>
                                    เพิ่มรูปภาพแนะนำเส้นทางแผนที่</button>
                            </div>
                            <?php
                            }
                        ?>
                        </div>
                        <br>
                        <div class="table-responsive pt-1">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th class="p-1 " style="color: black;font-size: 14px;font-weight: bold;">
                                            รหัสข้อความ/รูปภาพ</th>
                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">
                                            ชื่อ</th>

                                        <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">
                                            ประเภท</th>
                                        <th class="p-1"></th>
                                        <th class="p-1"></th>
                                    </tr>
                                </thead>
                                <tbody id="TableBody">
                                    <?php //echo ShowBodyTable("");?>
                                </tbody>
                            </table>
                        </div>
                        <!--end::Body-->
                    </div>
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
    <div class="modal-dialog   card shadow" style="width:500px;">
        <div class="modal-content">

            <div class="modal-body card shadow">
                <form id="FormAction" class="user" method="POST" action="Controller.php">


                    <div class="form-group row m-1" style="padding-left: px;">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">รหัสข้อความ:</label>
                            <input type="text" class="form-control 50" value="MDVYY-XXXXX" placeholder=""
                                id="TxtMediaVmsCode" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="form-group row m-1" style="padding-left: px;">
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">ชื่อข้อความ:</label>
                            <input type="text" id="TxtMediaName" class="form-control " placeholder="" 
                                autocomplete="off"  required>
                        </div>
                    </div>
                    <div class="form-group row m-1 pt-3" style="padding-left: 20px;">
                        <script type="text/javascript" src="../Ckeditors/ckeditor/ckeditor.js"></script>
                        <textarea id="TxtSms" name="TxtSms" style="width:384px;height:288px"></textarea>
                        <script>
                        CKEDITOR.replace('TxtSms');

                        function CKupdate() {
                            for (instance in CKEDITOR.instances)
                                CKEDITOR.instances[instance].updateElement();
                        }
                        </script>
                    </div>
                    <div class="form-group row m-1">
                        <div class="text-center pt-3">
                            <button class=" btn btn-success " type="submit" id="BtnSave" name="BtnSave"
                                >บันทึก</button>
                        </div>
                    </div>






                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                            <input type="hidden" id="TxtMode">
                            <input type="hidden" id="TxtType">

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
<div class="modal" id="ModalUploadImg">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">อัปโหลดรูปภาพ</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0">ชื่อรูปภาพ:</label>
                        <input type="text" id="TxtMediaName2" class="form-control " placeholder="" 
                            autocomplete="off"  required>
                    </div>
                </div>
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0"> รูปภาพขนาด:</label>
                        <input class="form-control" type="file" id="file"  required />
                    </div>
                </div>

                <div class="form-group text-center pt-3">
                    <button
                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                        type="button" id="BtnUpPicTure">อัปโหลดรูปภาพ</button>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                <h4 class="modal-title">อัปโหลดVdo</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0">ชื่อVdo:</label>
                        <input type="text" id="TxtMediaName3" class="form-control " placeholder="" 
                            autocomplete="off"  required>
                    </div>
                </div>
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0"> รูปภาพขนาด</label>
                        <input class="form-control" type="file" id="file3"  required />
                    </div>
                </div>

                <div class="form-group text-center pt-3">
                    <button
                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                        type="button" id="BtnUpVdo">อัปโหลดVdo</button>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



<!-- The Modal -->
<div class="modal" id="ModalUploadTemplate">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">อัปโหลดรูปภาพแนะนำเส้นทางแผนที่</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0">ชื่อรูปภาพ:</label>
                        <input type="text" id="TxtMediaName4" class="form-control " placeholder="" id="TxtUrl"
                            autocomplete="off"  required>
                    </div>
                </div>
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0"> รูปภาพขนาด</label>
                        <input class="form-control" type="file" id="file4"  required />
                    </div>
                </div>

                <div class="form-group text-center pt-3">
                    <button
                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                        type="button" id="BtnUpTemplate">อัปโหลด</button>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="ModalUploadTemplateMap">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">อัปโหลดรูปภาพแนะนำเส้นทางแผนที่</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0">ชื่อรูปภาพ:</label>
                        <input type="text" id="TxtMediaName5" class="form-control " placeholder="" id="TxtUrl"
                            autocomplete="off"  required>
                    </div>
                </div>
                <div class="form-group row m-1">
                    <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                        <label class="m-0"> รูปภาพ</label>
                        <input class="form-control" type="file" id="file5"  required />
                    </div>
                </div>

                <div class="form-group text-center pt-3">
                    <button
                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                        type="button" id="BtnUpTemplateMap">อัปโหลด</button>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script src="view.js"></script>