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

            <div class="row g-5 g-xl-10 mb-xl-10">
                <div class="col-12">
                    <div class="card p-3">
                        <h3>ป้ายประชาสัมพันธ์ปรับเปลี่ยนข้อความได้ (VMS)</h3>
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
                                        <select id="SelVms" multiple class="form-control">
                                            <?php 
                                                        //$PrjCode=FirstProgect();
                                                        //echo Menu_Vms($PrjCode);
                                                ?>
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
            <div class="row g-5 g-xl-12 g-xl-12" id="ShowForm">
                <!--begin::Col-->
                <div class="col-xl-5 mb-5 mb-xl-10">
                    <!--begin::Chart widget 5-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header flex-nowrap pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">กล้องแสดงป้าย Vms</span>
                            </h3>
                            <!--end::Title-->

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5 ps-6">
                            <div id="ShowCamera"></div>

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-5 mb-5 mb-xl-10">
                    <!--begin::Chart widget 5-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header flex-nowrap pt-5">
                            <!--begin::Title-->

                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">ข้อความรูปภาพ</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                            </h3>
                            <!--end::Title-->
                            <button
                                class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3 btn-lg"
                                type="button" id="BtnCreatePictureClearT">สร้างข้อความใหม่</button>
                            <button
                                class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3 btn-lg"
                                type="button" id="BtnUploadPictureNew">อัปโหลดรูปภาพ</button>


                            <button
                                class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                                type="button" id="BtnSendToVms">ส่งขึ้นจอVms</button>

                            <!--end::Title-->

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5 ps-6">
                            <table id="TableImage" class="table">
                                <thead>
                                    <tr>
                                        <th></th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="TableBodyImage">

                                </tbody>
                            </table>

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 5-->
                </div>
                <!--end::Col-->
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



</div>
<!-- The Modal -->
<div class="modal" id="ModalImage">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">สร้างข้อความรูปภาพ</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="col-xl-12 mb-xl-10">
                    <!--begin::Chart widget 5-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header flex-nowrap pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">สร้างข้อความ</span>

                            </h3>
                            <!--end::Title-->

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5 ps-6">
                            <div style="height: 400px;overflow-y: scroll;">
                                <input type="hidden" id="TextMode">
                                <input type="hidden" id="TextId">

                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <input style=" display: inline-block;" type="color" value="#FF0000" id="csms1">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่1</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT1">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="text" class="form-control mb-1" id="tsms1"
                                        placeholder="ข้อความบรรทัดที่1">
                                </div>
                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <input type="color" value="#FF0000" id="csms2">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่2</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT2">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="text" class="form-control mb-1" id="tsms2"
                                        placeholder="ข้อความบรรทัดที่2">
                                </div>

                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <input type="color" value="#FF0000" id="csms3">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่3</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT3">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="text" class="form-control mb-1" id="tsms3"
                                        placeholder="ข้อความบรรทัดที่3">
                                </div>

                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <input type="color" value="#FF0000" id="csms4">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่4</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT4">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="text" class="form-control mb-1" id="tsms4"
                                        placeholder="ข้อความบรรทัดที่4">
                                </div>
                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <input type="color" value="#FF0000" id="csms5">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่5</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT5">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="text" class="form-control mb-1" id="tsms5"
                                        placeholder="ข้อความบรรทัดที่5">
                                </div>

                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <input type="color" value="#FF0000" id="csms6">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่6</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT6">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="text" class="form-control mb-1" id="tsms6"
                                        placeholder="ข้อความบรรทัดที่6">
                                </div>

                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่7</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT7">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="color" value="#FF0000" id="csms7">
                                    <input type="text" class="form-control mb-1" id="tsms7"
                                        placeholder="ข้อความบรรทัดที่7">
                                </div>

                                <div class="form-group mb-2 p-2"
                                    style="border: 2px solid var(--bs-gray-300); border-radius: 5px;">
                                    <input type="color" value="#FF0000" id="csms8">
                                    <span class="card-label fw-bold text-gray-800">ข้อความบรรทัดที่8</span>
                                    <select style="display: inline-block;" class="form-control" id="selFONT8">
                                        <option value="12">ตัวอักษร ขนาด 12</option>
                                        <option value="14">ตัวอักษร 14</option>
                                        <option value="16">ตัวอักษร 16</option>
                                        <option value="18">ตัวอักษร 18</option>
                                        <option value="20">ตัวอักษร 20</option>
                                        <option value="22">ตัวอักษร 22</option>
                                        <option value="24">ตัวอักษร 24</option>
                                        <option value="26">ตัวอักษร 26</option>
                                        <option value="28">ตัวอักษร 28</option>
                                        <option value="30">ตัวอักษร 30</option>
                                        <option value="32">ตัวอักษร 32</option>
                                        <option value="34">ตัวอักษร 34</option>
                                        <option value="36">ตัวอักษร 36</option>
                                        <option value="38">ตัวอักษร 38</option>
                                        <option value="40">ตัวอักษร 40</option>
                                    </select>
                                    <input type="text" class="form-control mb-1" id="tsms8"
                                        placeholder="ข้อความบรรทัดที่8">
                                </div>

                            </div>

                            <div class="form-group pt-3">
                                <button
                                    class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3 btn-lg"
                                    type="button" id="BtnCreatePictureT">บันทึก</button>

                            </div>

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 5-->
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="BtnCloseModalImage">ปิด</button>

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

                <div class="form-group">
                    รูปภาพขนาด กว้าง 384 PX สูง 288
                    <input class="form-control" type="file" id="file" required />
                </div>
                <div class="form-group text-center pt-3">
                    <button
                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold mb-3  "
                        type="button" id="BtnUpPicTure">อัปโหลดรูปภาพ</button>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="BtnCloseModalUploadImg">Close</button>
            </div>

        </div>
    </div>
</div>
<script src="view.js"></script>