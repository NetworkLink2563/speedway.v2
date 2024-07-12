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
            <div class="col-sm-6" align="right"><select name="cars" id="cars" style="width: 200; height: 37">
                    <option value="volvo">69+380L</option>
                    <option value="saab">69+381L</option>
                    <option value="mercedes">69+380R</option>
                    <option value="audi">70+380R</option>
                </select> <a href="AddSchedulemessage.php" class="btn btn-warning">เพิ่มรายการข้อความ</a> <button type="button"  class="btn btn-info">เพิ่มในตารางแสดง</button>
            </div>
        </div>
        <div style="margin-top:-5;"><hr></div>
    </div>
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <div class="tablinks2 active" >&nbsp;&nbsp; ข้อความที่เตรียม</div>
    </div>
    <div id="416160" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 10px;">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ข้อความ</th>
                        <th scope="col">วันที่เริ่ม</th>
                        <th scope="col">วันที่หยุด</th>
                        <th scope="col">เวลาเริ่ม</th>
                        <th scope="col">เวลาหยุด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+380L</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+381L</td>
                        <td>ไฟกระพริบ</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+380R</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2">
            </div>

        </div>
    </div>
    <br >
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <div class="tablinks2 active" >&nbsp;&nbsp; รายการในป้าย</div>
    </div>
    <div id="416160" class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ข้อความ</th>
                        <th scope="col">วันที่เริ่ม</th>
                        <th scope="col">วันที่หยุด</th>
                        <th scope="col">เวลาเริ่ม</th>
                        <th scope="col">เวลาหยุด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+380L</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+381L</td>
                        <td>ไฟกระพริบ</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+380R</td>
                        <td></td>
                        <td></td>
                        <td></td>
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
