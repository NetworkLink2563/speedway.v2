<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="http://www.centrecities.com/speedway/img/favicon.png" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- bootstrap wizard -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/1.35.0/iconfont/tabler-icons.min.css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>ตัวช่วยสร้างข้อความ</title>
</head>

<?php 
include('header.php');
include "service/privilege.php"; 


$menucode="009";
$pri=pri_($_SESSION['user'],$menucode);  
$pri_w=$pri[0]['pri_w'];  // สิทธิ์การเขียน
$pri_r=$pri[0]['pri_r'];  // สิทธิ์การอ่าน
$pri_del=$pri[0]['pri_del'];  // สิทธิ์การลบ


?>





<style>
     body {
        background: #e1f0fa!important;
    }

    #container{
        background-color:  white;
        position: relative;
        top: 75px;
    }

    .btn:hover{
        opacity: 0.8;
        transition: 0.5s;
    }


</style>

<body>



<div class="container" id="container" style="padding-bottom: .6rem;">


<?php if($pri_r != 0){ ?>
<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <!-- <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> ตัวช่วย -->
        </div>


<div class="flex-container" style="">

        <div class="col-12" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px; box-shadow: 3px 3px 3px #aaaaaa !important;">
            <a class="tablinks2 active " style="cursor: context-menu;"><img src="/speedway/img/icon/help.png" height="25" alt="Responsive image"> ตัวช่วยสร้างข้อความ</a>
        </div>


<section class="py-5" style="background-color: #f6f6f6;">
	<div class="container">
		<!-- <div class="row justify-content-center text-center mb-4">
			<div class="col-lg-8 col-xxl-7">
				<span class="text-muted">Steps</span>
				<h2 class="display-5 fw-bold">How it Works</h2>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta harum ipsum venenatis metus sem veniam eveniet aperiam suscipit.</p>
			</div>
		</div> -->


		<div class="row">
			<div class="col-md-3">
				<div class="text-center position-relative">
					<div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #4976BA!important; box-shadow: 3px 3px 3px #aaaaaa !important;">
						<a href="#"><img src="img/create_white.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">1.สร้างข้อความ</h4>
					<?php if($pri_w != 0){?>
                    <button onclick="location.href='messagepublicrelations.php'" style="padding: .5rem; width: 60%; background-color: #084387; box-shadow: 3px 3px 3px #aaaaaa !important;"  class="btn btn-primary fs-6">
					กดสร้างข้อความ<br>(Message)
                    </button>
					<?php } ?>
					<div class="arrow-icon position-absolute d-none d-lg-block" style="top:50px; right:-25px">
						<svg class="bi bi-arrow-right" fill="currentColor" height="30" viewbox="0 0 16 16" width="30" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" fill-rule="evenodd"></path></svg>
					</div>
				</div>
			</div> 
			<div class="col-md-3">
				<div class="text-center position-relative">
					<div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #4976BA!important; box-shadow: 3px 3px 3px #aaaaaa !important;">
						<a href="#"><img src="img/format.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">2.จัดรูปแบบข้อความ</h4>

					<?php if($pri_w != 0){ ?>
                    <button onclick="location.href='messagepublicrelationsframe.php'" style="padding: .5rem; width: 60%; background-color: #084387; box-shadow: 3px 3px 3px #aaaaaa !important;"  class="btn btn-primary fs-6">
					กดจัดรูปแบบข้อความ<br>(Format)
                    </button>
					<?php } ?>

					<div class="arrow-icon d-none d-lg-block position-absolute" style="top:50px; right:-25px">
						<svg class="bi bi-arrow-right" fill="currentColor" height="30" viewbox="0 0 16 16" width="30" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" fill-rule="evenodd"></path></svg>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-center position-relative">
					<div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #4976BA!important; box-shadow: 3px 3px 3px #aaaaaa !important;">
                    <a href="#"><img src="img/playlist.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">3.ชุดข้อความ</h4>
					
					<?php if($pri_w != 0){ ?>
					<button onclick="location.href='messagepublicrelationsframegroup.php'" style="padding: .5rem; width: 60%; background-color: #084387; box-shadow: 3px 3px 3px #aaaaaa !important;"  class="btn btn-primary fs-6">
					กดจัดชุดข้อความ<br>(Playlist)
                    </button> 
					<?php } ?>

					<div class="arrow-icon d-none d-lg-block position-absolute" style="top:50px; right:-25px">
						<svg class="bi bi-arrow-right" fill="currentColor" height="30" viewbox="0 0 16 16" width="30" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" fill-rule="evenodd"></path></svg>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-center position-relative">
                <div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #4976BA !important; box-shadow: 3px 3px 3px #aaaaaa !important;">
                <a href="#"><img src="img/sent.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">4.ส่งข้อความ</h4>
					
					<?php if($pri_w != 0){ ?>
					<button onclick="location.href='messagepublicrelationsplay.php'" style="padding: .5rem; width: 60%; background-color: #084387 ; box-shadow: 3px 3px 3px #aaaaaa !important;"  class="btn btn-primary fs-6">
					กดส่งข้อความ<br>(Publisher)
                    </button> 
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</section>
<?php }else{
echo '<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';
} ?>
</div>
<!-- end div container-->


</body>
</html>


