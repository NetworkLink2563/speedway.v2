<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select2 HTML by devbanban.com 2022</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <form action="https://devbanban.com/?p=2867" method="post" class="form-horizontal">
                <div class="form-group row">
                    <h4>Select2 Bootstrap5 by devbanban.com</h4>
                    <div class="col-sm-8">
                        <select class="form-control select2">
                            <option value="">-เลือกตำแหน่งงาน</option>
                            <option value="1">อาจารย์</option>
                            <option value="2">เจ้าหน้าที่บริหารงานทั่วไป</option>
                            <option value="3">นักวิชาการศึกษา</option>
                            <option value="4">เจ้าหน้าที่พัสดุ</option>
                            <option value="5">นักวิชาการคอมพิวเตอร์</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary btn-sm">submit</button>
                    </div>


                </div> <!-- /.form-group -->
            </form>
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</div>
</body>
</html>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            closeOnSelect: false
        });
    });
</script>
