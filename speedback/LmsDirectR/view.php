<div class="container-fluid mt-3">
    <h3>ป้ายประชาสัมพันธ์ปรับเปลี่ยนข้อความได้ (LMS)</h3>

    <div class="row">
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
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th style="color: black;font-size: 14px;font-weight: bold;">ชื่อสื่อ</th>
                                <th style="color: black;font-size: 14px;font-weight: bold;">ประเภท</th>
                                <th></th>
                        </thead>
                        <tbody id="tbodytable1">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-1 p-3 text-center">
            <br>
            <br>
            <br>
            <div>
                <button type="button" class="btn btn-secondary" id="BtnInsert">--></button>
            </div>
            <br>
            <div>
                <button type="button" class="btn btn-secondary" id="BtnDelete"><--</button>
            </div>
        </div>
        <div class="col-sm-4 p-3">
            <div class="card p-3">
                <div>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">ป้าย LMS</span>
                    <select id="SelVms" class="form-control">

                    </select>

                </div>
                <div>
                    <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                
                                <th style="color: black;font-size: 14px;font-weight: bold;">ชื่อสื่อ</th>
                                <th style="color: black;font-size: 14px;font-weight: bold;">ประเภท</th>
                                <th style="color: black;font-size: 14px;font-weight: bold;">หน่วงเวลา(s)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbodytable2">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
        <div class="col-sm-3 p-3 ">
            <div class="card p-3">
                <div class="p-3">
                   <button type="button" class="btn btn-primary w-100" id="BtnView">แสดงตัวอย่าง</button>
                </div>  
                <div class="p-3">
                   <button type="button" class="btn btn-primary w-100" id="BtnShowCamera">กล้องแสดงป้ายประชาสัมพันธ์</button>
                </div> 
                <div class="p-3">     
                   <button class=" btn btn-primary w-100" type="button" id="BtnSendToVms" name="BtnSave">ส่งขึ้นจอประชาสัมพันธ์</button>
                </div> 
                
        </div>

    </div>
</div>

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
            <div class="row ">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4 text-left">
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
    <!--begin::Row-->
    <div class="row g-5 g-xl-12 g-xl-12" id="ShowForm">
        <!--begin::Col-->
        <div class="col-xl-5 mb-5 mb-xl-10">
            <!--begin::Chart widget 5-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แสดงตัวอย่าง</h4>
      </div>
      <div class="modal-body">
        <div style="padding-left:35px;">
           
           <div id="ShowDiv" style="height: 288px;width: 384px;overflow: hidden;background-color: black;" >
           </div>
        </div>    
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="BtnCloseView">ปิด</button>
      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal" id="myModalShowCamera" >
  <div class="modal-dialog ">
    <div class="modal-content" style="">
      <!-- Modal body -->
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แสดงตัวอย่าง</h4>
      </div>
      <div class="modal-body">
        <div style="padding-left:20px;">
           
          <span class="text-gray-400 mt-1 fw-semibold fs-6">กล้องแสดงป้ายประชาสัมพันธ์</span>
          <div class="ratio ratio-16x9">
  

             <iframe id="iframeID" scrolling="no"  src="" > </iframe>
          </div> 
        </div>    
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="BtnCloseShowCamera">ปิด</button>
      </div>
    </div>
  </div>
</div>

<script src="view.js"></script>