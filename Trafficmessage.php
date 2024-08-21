<?php
include 'header.php';
?>
<div class="centered" style="margin-top: 50;margin-left: 10;">
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <div class="row">
                <div class="col-sm-6">
                    <div style="margin-top: 10;"><img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;ข้อความสภาพจราจร</div>
                </div>
                <div class="col-sm-6" align="right"><select id="productselection" name="cars" id="cars" style="width: 200; height: 37" class="input">
                        <option value="product_1">69+380L</option>
                        <option value="product_2">69+381L</option>
                        <option value="product_3">69+380R</option>
                        <option value="product_4">70+380R</option>
                    </select> <a href="AddSchedulemessage.php" class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มรายการข้อความ</a> <button type="button"  class="btn btn-info" onClick="checkboxes();"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มในตารางแสดง</button>
                </div>
            </div>
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">
            <div class="tablinks2 active" >&nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i> รายการในป้าย</div>
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
                                <th scope="col"><div align="center">ตัวอย่างข้อความ</div></th>
                                <th scope="col">เวลาเริ่ม</th>
                                <th scope="col">เวลาหยุด</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td scope="row"><input id="inputitem1" class="inputitem" type="checkbox" name="checkbox" value="checkbox" /></td>
                                <td>69+380L</td>
                                <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/textview.php?id=1';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div></td>
                                <td>2024/01/24 10:23</td>
                                <td>2024/03/06 11:18</td>
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
        <br >
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">
            <div class="tablinks2 active" >&nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i> ข้อความที่เตรียม</div>
        </div>
        <div id="416160" class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><div align="center">ตัวอย่างข้อความ</div></th>
                            <th scope="col">เวลาเริ่ม</th>
                            <th scope="col">เวลาหยุด</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/textview.php?id=1';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div></td>
                            <td>2024/01/24 10:23</td>
                            <td>2024/03/06 11:18</td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td><div align="center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/textview.php?id=2';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div></td>
                            <td>2024/01/24 10:23</td>
                            <td>2024/03/06 11:18</td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2">
                </div>

            </div>
        </div>
        <br >
        <div align="center">
            <button type="button" class="btn btn-primary">ส่งคำสั่ง</button>
        </div><br >
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
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script type="text/javascript" src="dist/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-datetimepicker.pt-BR.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (){
        var productselection = document.getElementById("productselection");
        <?php
        for ($x = 1; $x <= 4; $x++) {
        ?>
        var product<?php echo $x;?> = document.getElementById("product<?php echo $x;?>");
        <?php } ?>
        productselection.addEventListener("change", function(){
            var text = productselection.value;
            const myArray = text.split("_");
            var productselections = document.getElementById("productselection");
            var valuer = productselections.value;
            var textr = productselections.options[productselections.selectedIndex].text;
            <?php for ($x = 1; $x <= 4; $x++) { ?>
            if(myArray[1] == <?php echo $x;?>){
                product<?php echo $x;?>.style.display = 'block';
            }else{
                product<?php echo $x;?>.style.display = 'none';
            }
            <?php } ?>


        });
    });

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
