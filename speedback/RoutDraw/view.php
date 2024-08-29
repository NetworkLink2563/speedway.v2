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
                    <div class="col-12">
                        <div class="card p-3">
                        <h3>วาดเส้นทาง</h3>
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                                <div class="row col-12">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 text-end row">
                                        <div class="col-6 text-left">
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">โครงการ</span>
                                            <select id="SelProject" class="form-control">
                                                <?php
													include '../lib/DatabaseManage.php';  
													echo InPutSelect_Project();
												?>
                                            </select>
                                        </div>
                                        <div class="col-6 text-left">
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">ป้าย Vms</span>
                                            <select id="SelSubMenu" multiple class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 g-xl-10">

                    <div class="col-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-12  text-primary h6 text-gray-800">
                                    <label class="m-0">เลือกรูปแบบ:</label>
                                    <select id="SelectDraw" class="form-control w-25">
                                        <option value="1">วาดเส้นทาง</option>
                                        <option value="2">แทรกรูปภาพ</option>
                                        <option value="3">แทรกระยะทางเวลาจาก Google Map</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12  text-primary h6 text-gray-800">
                                    <label class="m-0">เส้นทาง:</label>
                                    <select id="Sel_RouteCode" class="form-control w-25" required>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 text-center text-primary h6 text-gray-800">
                                    <div class="row">
                                        <div class="col-sm-12 pt-3 text-primary h6 text-gray-800"
                                            style="overflow: scroll;">

                                            <canvas id="CanvasRout" width="384" height="288"></canvas>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 text-center text-primary text-gray-800"><br>
                                            <button style="width:100%" id="BtnShowRoute" type="button"
                                                class="btn btn-dark btn-sm">แสดงเส้นทาง</button>
                                        </div>
                                        <div class="col-sm-6 text-center text-primary text-gray-800"><br>
                                            <button style="width:100%" id="BtnShowLael" type="button"
                                                class="btn btn-dark btn-sm">แสดงคำอธิบาย</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4 text-primary h6 text-gray-800">
                                    <div class="form-group">
                                        <label class="m-0">ตำแหน่ง X:</label>
                                        <input type="text" class="form-control w-25" id="TxtImageX">
                                    </div>
                                    <div class="form-group">
                                        <label class="m-0">ตำแหน่ง Y:</label>
                                        <input type="text" class="form-control w-25" id="TxtImageY">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control w-50" type="file" id="file" required />
                                    </div>

                                    <div class="form-group">
                                        <button style="width:50%" class="btn btn-dark btn-sm  " type="button"
                                            id="BtnUpPicTure">อัปโหลด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-4 text-center text-primary h6 text-gray-800">
                                    <div class="pt-3" style="border: 2px solid gray;border-radius: 5px;padding-5px">
                                        <p>วาดเส้นทาง</p>
                                        <div class="table-responsive">
                                            <table id="TableRout" class="table">
                                                <thead>
                                                    <tr>
                                                        <th hidden class="text-center"></th>
                                                        <th class="text-center">ชื่อเส้นทาง</th>
                                                        <th class="text-center">ลำดับที่</th>
                                                        <th class="text-center">X</th>
                                                        <th class="text-center">Y</th>
                                                        <th class="text-center">สี</th>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TableBody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-center text-primary h6 text-gray-800">
                                    <div class="pt-3" style="border: 2px solid gray;border-radius: 5px;padding-5px">
                                        <p>แทรกรูปภาพ</p>
                                        <div class="table-responsive">
                                            <table id="TableImage" class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width:0px" class="text-center"></th>
                                                        <th class="text-center">ชื่อภาพ</th>
                                                        <th class="text-center">X</th>
                                                        <th class="text-center">Y</th>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TableBodyImage">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-center text-primary h6 text-gray-800">
                                    <div class="pt-3" style="border: 2px solid gray;border-radius: 5px;padding-5px">
                                        <p>แทรกระยะทางเวลา Google Map</p>
                                        <div class="table-responsive">
                                            <table id="TableGTime" class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width:0px" class="text-center"></th>
                                                        <th class="text-center">เส้นทาง</th>
                                                        <th class="text-center">X</th>
                                                        <th class="text-center">Y</th>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TableBodyGTime">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- The Modal -->
                <div class="modal fade" id="Modal1">
                    <div class="modal-dialog   card shadow">
                        <div class="modal-content ">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 id="HeaderTitle" class="modal-title">แก้ไขค่า X Y</h5>


                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body card shadow ">
                                <form id="FormT1" class="user" method="POST" action="Controller.php">
                                    <input type="hidden" id="TxtSelect">
                                    <input type="hidden" id="TxtId">
                                    <div class="form-group row m-1">
                                        <div class="col-sm-6 mb-3 mb-sm-0 ">
                                            <label class="m-0 p-0">X</label>
                                            <input type="text" class="form-control w-100" placeholder="" id="TxtX"
                                                autocomplete="off" required>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0 ">
                                            <label class="m-0 p-0">Y</label>
                                            <input type="text" class="form-control w-100" placeholder="" id="TxtY"
                                                autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group row pt-1">
                                        <div class="col-sm-12 mb-3 mb-sm-0 text-center pt-2">
                                            <button class="btn btn-success btn-sm mb-3 badge badge-pill text-center"
                                                type="submit" id="BtnSaveProject">บันทึก</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
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