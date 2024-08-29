<style>
.bg-success {
    --bs-bg-rgb-color: var(--bs-success-rgb);
    background-color: #f6f2f0 !important;
}


</style>

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

                    <div class="card  pt-3" >
                        <div class="text-center">
                           <h3>ลูกค้า</h3>
                        </div>
                        <div>
                           
                             <button style="position: absolute; top: 5%; z-index: 10;" type="button" id="BtnAdd"
                                    class="btn btn-dark ms-4 py-1 fs-8"> <i class="" <?php echo $Permis[1];?>></i>
                                    เพิ่มลูกค้า</button>
                        </div>
                       
                        <span class="label label-default" id="LabelSearch">ค้นหา</span>
                        <div class="table-responsive">
                            <table class="table table-striped display" id="table">
                                <thead>
                                    <tr style="background-color:#F2F4F4;">

                                        <th class="p-1 " style="color: black;font-size: 14px;font-weight: bold;" >รหัสลูกค้า</th>
                                        <th class="p-1"  style="color: black;font-size: 14px;font-weight: bold;">ชื่อ</th>
                                        <th class="p-1"  style="color: black;font-size: 14px;font-weight: bold;">สถานะ</th>
                                        <th class="p-1"  style="color: black;font-size: 14px;font-weight: bold;"></th>
                                        <th class="p-1"  style="color: black;font-size: 14px;font-weight: bold;"></th>
                                       
                                    </tr>
                                </thead>
                                <br>
                                <tbody id="TableBody">
                                    <?php //echo ShowBodyTable("");?>
                                </tbody>
                            </table>
                        </div>

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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body card shadow">
                <form id="FormCustomer" class="user" method="POST" action="Controller.php">
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">รหัสลูกค้า:</label>
                            <input type="text" class="form-control w-25" value="CUSYY-XXXXX" placeholder=""
                                id="TxtCstCode" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">ชื่อลูกค้า:</label>
                            <input type="text" class=" form-control input-sm " placeholder="" id="TxtCstName"
                                autocomplete="off" <?php echo $Permis[1];?> required>
                        </div>
                    </div>
                    
                    <div class="form-group row m-1" hidden>
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0 p-0">Email:</label>
                            <input type="email" class=" form-control input-sm w-50" placeholder="Email" id="EmaCstEmail"
                                autocomplete="off" <?php echo $Permis[1];?> >
                        </div>
                    </div>
                    <div class="form-group row m-1" >
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0 p-0">เบอร์โทร:</label>
                            <input type="tel" class=" form-control input-sm w-25"
                                placeholder="" id="TxtCstPhone" autocomplete="off" <?php echo $Permis[1];?>
                                >
                        </div>
                    </div>
                    <div class="form-group row m-1" >
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0 p-0">สถานะ:</label>
                            <select <?php echo $Permis[1];?> class=" form-control input-sm w-25" id="Selstatus">
                                <option value="1">ใช้งาน</option>
                                <option value="0">ยกเลิก</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                            <input type="hidden" id="txtmode">

                            <button class=" btn btn-success " type="submit" id="BtnSave"
                                name="BtnSave" <?php echo $Permis[1];?>>บันทึก</button>
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


<script src="view.js"></script>