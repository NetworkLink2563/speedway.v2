<?php
include 'header.php';
?>
<style>
    .Neon {
        font-family: sans-serif;
        font-size: 14px;
        color: #494949;
        position: relative;


    }
    .Neon * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .Neon-input-dragDrop {
        display: block;
        width: 343px;
        margin: 0 auto 25px auto;
        padding: 25px;
        color: #8d9499;
        color: #97A1A8;
        background: #fff;
        border: 2px dashed #C8CBCE;
        text-align: center;
        -webkit-transition: box-shadow 0.3s, border-color 0.3s;
        -moz-transition: box-shadow 0.3s, border-color 0.3s;
        transition: box-shadow 0.3s, border-color 0.3s;
    }
    .Neon-input-dragDrop .Neon-input-icon {
        font-size: 48px;
        margin-top: -10px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    .Neon-input-text h3 {
        margin: 0;
        font-size: 18px;
    }
    .Neon-input-text span {
        font-size: 12px;
    }
    .Neon-input-choose-btn.blue {
        color: #008BFF;
        border: 1px solid #008BFF;
    }
    .Neon-input-choose-btn {
        display: inline-block;
        padding: 8px 14px;
        outline: none;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        white-space: nowrap;
        font-size: 12px;
        font-weight: bold;
        color: #8d9496;
        border-radius: 3px;
        border: 1px solid #c6c6c6;
        vertical-align: middle;
        background-color: #fff;
        box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;เพิ่มรายการข้อความ
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">
            <button class="tablinks active" onclick="openTab(event, 'Text');openChild(event, 'TextChild');clearContent('Text');">ข้อความ</button>
            <button class="tablinks" onclick="openTab(event, 'Picture');openChild(event, 'PictureChild');clearContent('Picture');">รูปภาพ</button>
            <button class="tablinks" onclick="openTab(event, 'Movement');openChild(event, 'MovementChild');clearContent('Movement');">ภาพเคลื่อนไหว</button>
        </div>

        <div id="Text" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 10px;">
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-2"><input id="textAutoRadio" name="textAutoRadio" type="radio" value="1"  onclick="returnTextTimer(1)"/> ข้อความอัตโนมัติ</div>
                <div class="col-sm-2"><input id="textManualRadio" name="textManualRadio" type="radio" value="2" onclick="returnTextTimer(2)"/><label> &nbsp;ข้อความแบบกำหนดเอง</label></div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3" id="showTimer"><label>ระยะเวลาแสดง</label> <input id="inputTimer" class="input" style="width: 40px;text-align: center;" type="text" name="inputTimer" disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"/> วินาที</div>
                <div class="col-sm-2" id="showStartdate" style="display: none">วันที่เริ่ม <input type="text" id="datetimepicker" style="width: 145" disabled autocomplete="off" class="input"></div>
                <div class="col-sm-2" id="showEnddate" style="display: none">วันที่สิ้นสุด <input type="text" id="datetimepickerend" style="width: 145 "  disabled autocomplete="off" class="input">
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-7"><textarea id="editor1">
	</textarea></div>

                </div>
        </div>

        <div id="Picture" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-2"><input id="imgAutoRadio" name="imgAutoRadio" type="radio" value="1"  onclick="returnTextTimer(3)"/> ข้อความอัตโนมัติ</div>
                <div class="col-sm-2"><input id="imgManualRadio" name="imgManualRadio" type="radio" value="2" onclick="returnTextTimer(4)"/><label> &nbsp;ข้อความแบบกำหนดเอง</label></div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-2"><label>ระยะเวลาแสดง</label> <input id="imginputTimer" style="width: 40px;text-align: center;" type="text" name="textfield" class="input" disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"/> วินาที</div>
                <div class="col-sm-2">วันที่เริ่ม <input type="text" id="datetimepicker2" style="width: 145" disabled autocomplete="off" class="input"></div>
                <div class="col-sm-2">วันที่สิ้นสุด <input type="text" id="datetimepickerend2" style="width: 145" disabled autocomplete="off" class="input">
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6"><div class="Neon Neon-theme-dragdropbox">
                        <input style="z-index: 999; opacity: 0; width: 320px; height: 200px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;" name="files[]" id="filer_input2" multiple="multiple" type="file">
                        <div class="Neon-input-dragDrop"><div class="Neon-input-inner"><div class="Neon-input-icon"><i class="fa fa-file-image-o"></i></div><div class="Neon-input-text"><h3>Drag & Drop Image here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="Neon-input-choose-btn blue">Browse Files</a></div></div>
                    </div></div>

            </div>
        </div>
        <div id="Movement" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-2"><input id="aniAutoRadio" name="aniAutoRadio" type="radio" value="1"  onclick="returnTextTimer(5)"/> ข้อความอัตโนมัติ</div>
                <div class="col-sm-2"><input id="aniManualRadio" name="aniManualRadio" type="radio" value="2" onclick="returnTextTimer(6)"/><label> &nbsp;ข้อความแบบกำหนดเอง</label></div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-2"><label>ระยะเวลาแสดง</label> <input id="aniinputTimer" class="input" style="width: 40px;text-align: center;" type="text" name="textfield" disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"/> วินาที</div>
                <div class="col-sm-2">วันที่เริ่ม <input type="text" id="datetimepicker3" style="width: 145"  disabled autocomplete="off" class="input"></div>
                <div class="col-sm-2">วันที่สิ้นสุด <input type="text" id="datetimepickerend3" style="width: 145"  disabled autocomplete="off" class="input">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6"><div class="Neon Neon-theme-dragdropbox">
                        <input style="z-index: 999; opacity: 0; width: 320px; height: 200px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;" name="files[]" id="filer_input2" multiple="multiple" type="file">
                        <div class="Neon-input-dragDrop"><div class="Neon-input-inner"><div class="Neon-input-icon"><i class="fa fa-file-image-o"></i></div><div class="Neon-input-text"><h3>Drag & Drop Animation here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="Neon-input-choose-btn blue">Browse Files</a></div></div>
                    </div></div>

            </div>
        </div>
        <br >
        <div align="center">
            <button type="button" class="btn btn-warning">เพิ่มรายการ</button>
        </div>
        <br >
        <div class="tab" style="margin-left: 10px;margin-right: 10px;"></div>
        <div id="TextChild" class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">แบบป้าย</th>
                            <th scope="col"><div style="text-align: center">ตัวอย่างข้อความ</div></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>69+380L</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=1';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td>69+381L</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=2';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td>69+380R</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=3';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                </div>

            </div>
        </div>

        <div id="PictureChild" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">แบบป้าย</th>
                            <th scope="col"><div style="text-align: center">ตัวอย่างข้อความ</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>69+380L</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=4';?>" onclick="return show_modalImg(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td>69+381L</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=5';?>" onclick="return show_modalImg(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>

                        </tr>
                        <tr>
                            <td>69+380R</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=6';?>" onclick="return show_modalImg(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>

                        </tr>
                        <tr>
                            <td>69+380R</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=7';?>" onclick="return show_modalImg(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                </div>

            </div>
        </div>

        <div id="MovementChild" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">แบบป้าย</th>
                            <th scope="col"><div style="text-align: center">ตัวอย่างข้อความ</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>69+380L</td>
                            <td><div style="text-align: center"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/speedway/textview.php?id=8';?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a></div></td>
                            <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                </div>

            </div>

        </div>

        <br >
    </div>
</div>

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
                <iframe id="iframe_modal" src="" style="width: 100%; height: 190;"></iframe>
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
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script src="dist/js/jquery.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/ck.js"></script>
<script src="dist/js/main_speed.js"></script>
<script>
    function returnTextTimer(e){
        if(e==1){
            document.getElementById("inputTimer").disabled = false;
            document.getElementById("datetimepicker").disabled = false;
            document.getElementById("datetimepickerend").disabled = false;
            let textManualRadio = document.getElementById("textManualRadio");
            textManualRadio.checked = false;
        }else if(e==2){
            document.getElementById("inputTimer").disabled = true;
            document.getElementById("datetimepicker").disabled = false;
            document.getElementById("datetimepickerend").disabled = false;
            let textAutoRadio = document.getElementById("textAutoRadio");
            textAutoRadio.checked = false;
        }else if(e==3){
            document.getElementById("imginputTimer").disabled = false;
            document.getElementById("datetimepicker2").disabled = false;
            document.getElementById("datetimepickerend2").disabled = false;
            let imgManualRadio = document.getElementById("imgManualRadio");
            imgManualRadio.checked = false;
        }else if(e==4){
            document.getElementById("imginputTimer").disabled = true;
            document.getElementById("datetimepicker2").disabled = false;
            document.getElementById("datetimepickerend2").disabled = false;
            let imgAutoRadio = document.getElementById("imgAutoRadio");
            imgAutoRadio.checked = false;
        }else if(e==5){
            document.getElementById("aniinputTimer").disabled = false;
            document.getElementById("datetimepicker3").disabled = false;
            document.getElementById("datetimepickerend3").disabled = false;
            let aniManualRadio = document.getElementById("aniManualRadio");
            aniManualRadio.checked = false;
        }else if(e==6){
            document.getElementById("aniinputTimer").disabled = true;
            document.getElementById("datetimepicker3").disabled = false;
            document.getElementById("datetimepickerend3").disabled = false;
            let aniAutoRadio = document.getElementById("aniAutoRadio");
            aniAutoRadio.checked = false;
        }
    }
    function clearContent(e){
        let textManualRadio = document.getElementById("textManualRadio");
        textManualRadio.checked = false;
        let textAutoRadio = document.getElementById("textAutoRadio");
        textAutoRadio.checked = false;
        let imgManualRadio = document.getElementById("imgManualRadio");
        imgManualRadio.checked = false;
        let imgAutoRadio = document.getElementById("imgAutoRadio");
        imgAutoRadio.checked = false;
        let aniManualRadio = document.getElementById("aniManualRadio");
        aniManualRadio.checked = false;
        let aniAutoRadio = document.getElementById("aniAutoRadio");
        aniAutoRadio.checked = false;

        document.getElementById("inputTimer").disabled = true;
        document.getElementById("imginputTimer").disabled = true;
        document.getElementById("aniinputTimer").disabled = true;

    }
</script>
</body>
</html>
