<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="row mb-2">
                    <div class="col-sm-12 text-center">
                        <h3 class="text-primary">รายงานรถเข้า-ออก</h3>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <label for="SelCardNo">วันที่</label>
                            <input type="datetime-local" id="starttime"  class="form-control" style="background-color:white">
                           
                        
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                           
                            <label for="SelCardNo">ถึงวันที่</label>
                            <input type="datetime-local" id="endtime"  class="form-control" style="background-color:white;">
                        
                        </div>
                    </div>
                    <div class="col-sm-3">
                    <div class="mb-3">
                            <label for="SelXCUserCode">เลือกรถเข้า-ออก</label>
                            <select class="form-select" id="SelInout" style="background-color:white">
                                <option value="I">รถเข้า</option>
                                <option value="O">รถออก</option>
                            </select>
                    </div>
                    </div>
                </div>
                
                <?php include "Form.php";?>

            </div>
        </div>
    </div>
</div>
<script src="../js/Modal.js"></script>
<script src="View.js"></script>