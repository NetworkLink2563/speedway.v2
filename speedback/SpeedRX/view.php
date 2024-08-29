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

                <div class="row g-5 g-xl-10 mb-xl-5">
                    <div class="col-12">
                        <div class="card p-3">
                            <h3>กล้องตรวจจับความเร็ว</h3>
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
                                        <div class="col-6 text-left">
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">กล้องตรวจจับความเร็ว</span>
                                            <select id="SelSubMenu" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end row">

                                        
                                        <div class="col-3 text-left">
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">วันที่</span>
                                            <input type="text" class="form-control" id="datepicker"
                                                value="">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--begin::chart-->
                <div id="chart">
                    <div id="Chart1">
                        <div class="row g-5 g-xl-10 g-xl-10 p-3">

                            <div class="col-12">
                                <div class="p-3 mb-0 text-center">
                                    <h3>กราฟแสดงปริมาณรถ</h3>
                                </div>
                                <div class="p-3 mb-0">
                                    <h6 id="LabelCountDay" class="mb-4" style="color:var(--bs-heading-color, inherit);">
                                    </h6>
                                    <h6 id="LabelCountDayMax" class="mb-4"
                                        style="color:var(--bs-heading-color, inherit);"></h6>
                                    <h6 id="LabelCountDayMin" class="mb-4"
                                        style="color:var(--bs-heading-color, inherit);"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="row g-5 g-xl-10 g-xl-10 p-3">
                            <div class="col-sm-10 col-xl-12">
                                <div class="bg-success rounded pt-3">
                                    <div style="height: 200px">
                                        <canvas id="chartcountday" style="height: 200px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="Chart2">
                        <div class="row g-5 g-xl-10 g-xl-10 p-3">
                            <div class="col-12">
                                <div class="p-3 mb-0 text-center">
                                    <h3>กราฟแสดงความเร็วเฉลี่ย</h3>
                                </div>
                                <div class="p-3 mb-0">
                                    <h6 id="LabelCountAvgDay" class="mb-4"
                                        style="color:var(--bs-heading-color, inherit);"></h6>
                                    <h6 id="LabelCountAvgDayMax" class="mb-4"
                                        style="color:var(--bs-heading-color, inherit);"></h6>
                                    <h6 id="LabelCountAvgDayMin" class="mb-4"
                                        style="color:var(--bs-heading-color, inherit);"></h6>

                                </div>
                            </div>
                        </div>
                        <div class="row g-5 g-xl-10 g-xl-10 p-3">
                            <div class="col-sm-10 col-xl-12">
                                <div class="bg-success rounded pt-3">
                                    <div style="height: 200px">
                                        <canvas id="chartaveday" style="height: 200px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div id="ShowTable">
                        <div class="row g-5 g-xl-10 g-xl-10 p-3">
                            <div class="col-12">
                                <div class="p-3 mb-0 text-center">
                                    <h3>ตารางแสดงข้อมูลปริมาณรถ</h3>
                                </div>

                            </div>
                        </div>
                        <div class="row g-5 g-xl-10 g-xl-10 p-3">
                            <div class="col-sm-10 col-xl-12">
                                <div class=" rounded p-3">
                                    <div style="height: 200px">
                                        <div class="table-responsive pt-1">
                                            <table class="table table-striped" id="table">
                                                <thead>
                                                    <tr>
                                                        <th style=" font-weight: bold;">ประเภทรถ</th>
                                                        <th style=" font-weight: bold;">00:00:00 </th>
                                                        <th style=" font-weight: bold;">01:00:00</th>
                                                        <th style=" font-weight: bold;">02:00:00</th>
                                                        <th style=" font-weight: bold;">03:00:00</th>
                                                        <th style=" font-weight: bold;">04:00:00</th>
                                                        <th style=" font-weight: bold;">05:00:00</th>
                                                        <th style=" font-weight: bold;">06:00:00</th>
                                                        <th style=" font-weight: bold;">07:00:00</th>
                                                        <th style=" font-weight: bold;">08:00:00</th>
                                                        <th style=" font-weight: bold;">09:00:00</th>
                                                        <th style=" font-weight: bold;">10:00:00</th>
                                                        <th style=" font-weight: bold;">11:00:00</th>
                                                        <th style=" font-weight: bold;">12:00:00</th>
                                                        <th style=" font-weight: bold;">13:00:00</th>
                                                        <th style=" font-weight: bold;">14:00:00</th>
                                                        <th style=" font-weight: bold;">15:00:00</th>
                                                        <th style=" font-weight: bold;">16:00:00</th>
                                                        <th style=" font-weight: bold;">17:00:00</th>
                                                        <th style=" font-weight: bold;">18:00:00</th>
                                                        <th style=" font-weight: bold;">19:00:00</th>
                                                        <th style=" font-weight: bold;">20:00:00</th>
                                                        <th style=" font-weight: bold;">21:00:00</th>
                                                        <th style=" font-weight: bold;">22:00:00</th>
                                                        <th style=" font-weight: bold;">23:00:00</th>
                                                        <th style=" font-weight: bold;">รวม</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TableBody">
                                                    <?php //echo ShowBodyTable("");?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::shart-->

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