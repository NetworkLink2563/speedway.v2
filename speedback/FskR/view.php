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
                            <h3>กราฟสถานะไฟฟ้าโคมไฟ(Fsk)</h3>
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                                <div class="row col-12">

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
                                        <!--
                                        <div class="col-6 text-left">
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">อุปกรณ์Fsk</span>
                                            <select id="SelSubMenu" multiple class="form-control">
                                            </select>
                                        </div>
                                        -->
                                    </div>
                                   
                                </div>


                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 g-xl-10" id="ShowChart">
                    <div class="row g-5 g-xl-10 g-xl-10">
                            <div class=" col-sm-12 col-xl-4">
                        <div class="bg-success rounded  p-4">
                            <h6 class="mb-4" style="color:#F97609">เปอร์เซ็นต์สถานะหลอดไฟติด-ดับขณะนี้</h6>
                            <div style="height: 200px">
                                <canvas id="chart1"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-success rounded  p-4">
                            <h6 class="mb-4" style="color:#F97609">เปอร์เซ็นต์สถานะหลอดไฟติด-ดับแต่ละวัน</h6>
                            <div style="height: 200px">
                                <canvas id="chart2"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xl-2">
                        <div class="bg-success rounded  p-4">
                            <h6 style="font-size: 12px;color:#F97609" class="mb-4">กระแสไฟฟ้าที่ใช้ขณะนี้</h6>
                            <div style="height: 205px" class="text-center">
                                <div style="border-radius: 25px;border: 2px solid #FF9933;padding-top:10px;">
                                    <h5 style="color:var(--secondary)" id="ShowAmp">0 A</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-2">
                        <div class="bg-success rounded  p-4">
                            <h6 style="font-size: 12px;color:#F97609" class="mb-4">แรงดันไฟฟ้าที่ใช้ขณะนี้</h6>
                            <div style="height: 205px;" class="text-center">
                                <div style="border-radius: 25px;border: 2px solid #FF9933;padding-top:10px;">
                                    <h5 style="color:var(--secondary)" id="ShowVolt">0 V</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-success rounded  p-4" hidden>
                            <h6 class="mb-4" style="color:#F97609">ปริมาณกำลังไฟฟ้าที่ใช้แต่ละวัน</h6>
                            <div style="height: 200px">
                                <canvas id="chart6"></canvas>
                            </div>
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

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <p >วันที่: <input class="form-control " type="text" value="<?php echo  date("Y-m-d");?>"
                            id="datepicker"></p>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th style="color: black;font-size: 14px;font-weight: bold;">ชื่ออุปกร์Fsk</th>
                            <th style="color: black;font-size: 14px;font-weight: bold;">กระแสไฟฟ้า(A)</th>
                            <th style="color: black;font-size: 14px;font-weight: bold;">สถานะ</th>

                        </tr>
                    </thead>
                    <tbody id="TableBody">

                    </tbody>
                </table>
            </div>
           
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="mb-3">
                    <label for="TextOn" class="form-label">จำนวนหลอดไฟที่ติด</label>
                    <input type="text" class="form-control" id="TextOn" placeholder="Enter password" name="pswd">
                </div>
                <div class="mb-3">
                    <label for="TextOff" class="form-label">จำนวนหลอดไฟที่ดับ</label>
                    <input type="text" class="form-control" id="TextOff" placeholder="Enter password" name="pswd">
                </div>
                <br>
                <button type="button" class="btn btn-danger" id="BtnMyModalClose" data-bs-dismiss="modal">ปิด</button>
            </div>

        </div>
    </div>
</div>

<script src="view.js"></script>
<script src="Chart1.js"></script>
<script src="Chart2.js"></script>
<script src="Chart4.js"></script>
<script src="Chart6.js"></script>