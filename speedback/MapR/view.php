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
                            <h3>แผนที่</h3>
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                                <div class="row col-12">
                                    
                                    <div class="col-md-12 text-end row">
                                        <div class="col-4 text-left">
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">โครงการ</span>
                                            <select id="SelProject" class="form-control">
                                                <?php
													include '../lib/DatabaseManage.php';  
													echo InPutSelect_Project();
												?>
                                            </select>
                                        </div>
                                        <div class="col-4 text-left">
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">อุปกรณ์</span>
                                            <select id="SelSubMenu" multiple class="form-control">
                                            </select>
                                        </div>
                                        <div class="col-4 text-left">
                                           <button type="button" id="ShowMap" class="btn btn-warning">แสดงแผนที่</button>
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
                        <div class="card">
                            <div id="map" style="width:100%; height: 450px;"></div>
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
<script src="http://maps.google.com/maps/api/js?key=AIzaSyAdnE3rRU1dEs_x_APSdXiPIM28-3ng2dA" type="text/javascript">