<?php
include 'header.php';
?>
<div class="centered" style="margin-top: 50;margin-left: 10;">
<div class="box" style="margin-top: 30;" align="left">
    <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
        <div class="row">
            <div class="col-sm-6">
                <div style="margin-top: 10;"><img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;จัดตารางข้อความประชาสัมพันธ์</div>
            </div>
            <div class="col-sm-6" align="right"><select id="productselection" name="cars" id="cars" style="width: 200; height: 37" class="input">
                    <option value="product_1">69+380L</option>
                    <option value="product_2">69+381L</option>
                    <option value="product_3">69+380R</option>
                    <option value="product_4">70+380R
                </select>
                <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalOpen" style=" height: 35; color: #595959" onclick="inputMessageValue('<?php echo $result['XVVmsCode'];?>')" title="การแสดงข้อความ"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มรายการข้อความ</a>&nbsp;&nbsp;&nbsp;
                <a href="AddSchedulemessage.php" class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มรายการข้อความ</a> </button>
            </div>
            <div style="margin-top:-5;"><hr></div>

        </div>
    </div>
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <div class="tablinks2 active" > &nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i> รายการในป้าย</div>
    </div>
    <div id="416160" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 10px;">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div id='product1'>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">ป้าย</th>
                            <th scope="col"><div align="center">ดูข้อความ</div></th>
                            <th scope="col">เวลาเริ่ม</th>
                            <th scope="col">เวลาหยุด</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="row"><input id="inputitem1" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                            <td>69+380L</td>
                            <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=1';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div></td>
                            <td>2024/01/24 10:23</td>
                            <td>2024/03/06 11:18</td>
                            <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td scope="row"><input id="inputitem2" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                            <td>69+380L</td>
                            <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=2';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div></td>
                            <td>2024/01/24 10:23</td>
                            <td>2024/03/06 11:18</td>
                            <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td scope="row"><input id="inputitem3" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                            <td>69+380L</td>
                            <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=3';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div></td>
                            <td>2024/01/24 10:23</td>
                            <td>2024/03/06 11:18</td>
                            <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div id='product2' style='display:none'>
                    <p></p>
                </div>

                <div id='product3' style='display:none'>
                    <p></p>
                </div>

                <div id='product4' style='display:none'>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-2">
            </div>

        </div>
    </div>
    <br>
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <div class="tablinks2 active" >&nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i> ข้อความที่เตรียม</div>
    </div>

    <div id="416160" class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;">
        <div style="text-align: right; "><a href="adduser.php" style="color: #8d9499"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มในตาราง</a></div>

        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"><div align="center">ดูข้อความ</div></th>
                        <th scope="col">เวลาเริ่ม</th>
                        <th scope="col">เวลาหยุด</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="row"><input id="inputitem2" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                        <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=1';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div></td>
                        <td>2024/01/24 10:23</td>
                        <td>2024/03/06 11:18</td>
                        <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td scope="row"><input id="inputitem2" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                        <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=2';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div></td>
                        <td>2024/01/24 10:23</td>
                        <td>2024/03/06 11:18</td>
                        <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td scope="row"><input id="inputitem2" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                        <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=3';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div></td>
                        <td>2024/01/24 10:23</td>
                        <td>2024/03/06 11:18</td>
                        <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td scope="row"><input id="inputitem2" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                        <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=4';?>" onclick="return show_modalImg(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div></td>
                        <td>2024/01/24 10:23</td>
                        <td>2024/03/06 11:18</td>
                        <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td scope="row"><input id="inputitem2" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                        <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=5';?>" onclick="return show_modalImg(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div></td>
                        <td>2024/01/24 10:23</td>
                        <td>2024/03/06 11:18</td>
                        <td>  <i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2">
            </div>

        </div>
    </div><br>
    <div align="center">
        <button type="button" class="btn btn-primary">ส่งคำสั่ง</button>
    </div>
    <br>
</div>
</div>
<!-- Modal -->

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Text</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="iframe_modal" src="" style="width: 100%; height: 40%;"></iframe>

            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModalImg" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="iframe_modalImg" src="" style="width: 435; height: 190;"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModalOpen" tabindex="-1" role="dialog"style="width: 1200" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content"style="width: 900">
            <div class="modal-header" >
                <h5 class="modal-title">เลือกประเภทข้อความ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="tab" style="margin-left: 10px;margin-right: 55px;">
                    <button id="tabMessage" name="firstactive" class="tablinks active" onclick="openActivityMessage(event, 'MessageValue')">แสดงข้อความ</button>
                </div>
                <div id="MessageValue" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" style="margin-top: 10px"><input id="messageListModalRadio" name="radiobuttonBrightness" type="radio" value="1"  onclick="messageListValue(1)"/> จากรายการข้อความ
                        </div>
                        <div class="col-sm-3"  style="margin-top: 10px"><input id="messageManualModalRadio" name="radiobuttonBrightness" type="radio" value="2" onclick="messageListValue(2)"/>&nbsp;เขียนข้อความ
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                </div>
                <br >
                <div id="buttonSend" style="display: none">
                    <div align="center" >
                        <button id="buttonSend" type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="btnRefresh" onclick="checkSendButton();">ส่งคำสั่ง</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script type="text/javascript"
        src="https://tarruda.github.io/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript"
        src="https://tarruda.github.io/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
</script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>


<script>
    function inputMessageValue(bannerID){
        document.getElementById( 'tabMessage' ).style.display = 'block';
        document.getElementById( 'MessageValue' ).style.display = 'block';



    }
    function messageListValue(e){
        if(e==1){
            window.location.href = 'addMessager.php?op=messageAuto';
        }else{
            window.location.href = 'addMessager.php?op=messageManual';

        }
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function openCity2(evt, cityName) {
        var i, tabcontent2, tablinks2;
        tabcontent = document.getElementsByClassName("tabcontent2");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks2");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }

    function show_modal(e)
    {
        console.log (e.href);
        $("#iframe_modal").attr("src", e.href);
        $('#myModal').modal('show');
        return false;
    }

    function show_modalImg(e)
    {
        console.log (e.href);
        $("#iframe_modalImg").attr("src", e.href);
        $('#myModalImg').modal('show');
        return false;
    }
    function checkboxes(){
        var inputs = document.getElementsByClassName("inputitem");
        var inputObj;
        var selectedCount = 0;
        for(var count1 = 0;count1<inputs.length;count1++) {
            inputObj = inputs[count1];
            var type = inputObj.getAttribute("type");
            if (type == 'checkbox' && inputObj.checked) {
                selectedCount++;
            }
        }
        if(selectedCount<1){
            alert("กรุณาเลือกรายการป้าย");
        }else{
            <?php  for ($x = 1; $x <= 4; $x++) {?>
            document.getElementById("inputitem<?php echo $x;?>").checked = false;
            <?php }?>

        }
    }

</script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker3').datetimepicker({
            pickDate: false
        });
    });
</script>
</body>
</html>
