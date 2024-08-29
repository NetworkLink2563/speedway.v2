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
                    <div class="col-12">
                        <div class="card p-3">
                            <h3>เปลี่ยนรหัสผ่าน</h3>
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                                <div class="row col-12">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 py-5">
                                        <form id="CnangePwd" class="user" method="POST" action="Controller.php">
                                            <div class="form-group row">
                                                <label class="m-0"><h3>รหัสผ่านใหม่ อย่างน้อย 8 ตัวอักษร:[a-z] [A-Z] [0-9]
                                                    [!@#$%^&*_=+-]<h3></label>
                                                <input class="form-control" style="width:90%" type="password" id="pwd"
                                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,24}$"
                                                    autocomplete="off" required>
                                             
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center pt-3">
                                                    <button
                                                        class="btn btn-primary  mb-3  text-center"
                                                        type="submit" id="BtnSave">บันทึก</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 g-xl-10">
                    <div class="w-100 pt-6 row" id="BodyShow">


                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

</div>
<!--end:::Main-->

</div>
<script src="view.js"></script>