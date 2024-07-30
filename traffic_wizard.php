<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="http://www.centrecities.com/speedway/img/favicon.png" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>City Motorway Division</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="dist/css/css.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">

<!-- bootstrap wizard -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/1.35.0/iconfont/tabler-icons.min.css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>ตัวช่วยสร้างข้อความ</title>
</head>

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
<header>
    <?php include('header.php'); ?>
</header>


<div class="container" id="container" style="padding-bottom: .6rem;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <!-- <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> ตัวช่วย -->
        </div>


<div class="flex-container" style="">

        <div class="col-12" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px; box-shadow: 3px 3px 3px #aaaaaa !important;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> ตัวช่วยสร้างข้อความ</a>
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
					<div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #fda300!important; box-shadow: 3px 3px 3px #aaaaaa !important;">
						<a href="messagetraffics.php"><img src="img/create_white.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">1.สร้างข้อความสภาพการจราจรพื้นฐาน</h4>
                    <button onclick="location.href='messagetraffics.php'" style="padding: .5rem; width: 60%; background-color: #1f4762; box-shadow: 3px 3px 3px #aaaaaa !important; border-color: #d1d1d1;"  class="btn btn-primary fs-6">
					กดสร้างข้อความ<br>(Message)
                    </button>
					<div class="arrow-icon position-absolute d-none d-lg-block" style="top:50px; right:-25px">
						<svg class="bi bi-arrow-right" fill="currentColor" height="30" viewbox="0 0 16 16" width="30" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" fill-rule="evenodd"></path></svg>
					</div>
				</div>
			</div> 
			<div class="col-md-3">
				<div class="text-center position-relative">
					<div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #fda300!important; box-shadow: 3px 3px 3px #aaaaaa !important;">
						<a href="messagetrafficsframe.php"><img src="img/format.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">2.สร้างข้อความสภาพการจราจรแสดงบนป้าย</h4>
                    <button onclick="location.href='messagetrafficsframe.php'" style="padding: .5rem; width: 60%; background-color: #1f4762; box-shadow: 3px 3px 3px #aaaaaa !important; border-color: #d1d1d1;"  class="btn btn-primary fs-6">
					กดจัดรูปแบบข้อความ<br>(Format)
                    </button>
					<div class="arrow-icon d-none d-lg-block position-absolute" style="top:50px; right:-25px">
						<svg class="bi bi-arrow-right" fill="currentColor" height="30" viewbox="0 0 16 16" width="30" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" fill-rule="evenodd"></path></svg>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-center position-relative">
					<div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #fda300!important; box-shadow: 3px 3px 3px #aaaaaa !important;">
                    <a href="messagetrafficsframegroup.php"><img src="img/playlist.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">3.สร้างชุดการแสดงป้ายจราจร</h4>
					<button onclick="location.href='messagetrafficsframegroup.php'" style="padding: .5rem; width: 60%; background-color: #1f4762; box-shadow: 3px 3px 3px #aaaaaa !important; border-color: #d1d1d1;"  class="btn btn-primary fs-6">
					กดจัดชุดข้อความ<br>(Playlist)
                    </button> 
					<div class="arrow-icon d-none d-lg-block position-absolute" style="top:50px; right:-25px">
						<svg class="bi bi-arrow-right" fill="currentColor" height="30" viewbox="0 0 16 16" width="30" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" fill-rule="evenodd"></path></svg>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-center position-relative">
                <div class="btn step-icon mx-auto bg-primary border rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px; background-color: #fda300 !important; box-shadow: 3px 3px 3px #aaaaaa !important;">
                <a href="messagetrafficsplay.php"><img src="img/sent.png" width="50" alt=""></a>
					</div>
					<h4 class="mt-3 fs-6">4.ข้อความป้ายจราจร</h4>
					<button onclick="location.href='messagetrafficsplay.php'" style="padding: .5rem; width: 60%; background-color: #1f4762 ; box-shadow: 3px 3px 3px #aaaaaa !important; border-color: #d1d1d1;"  class="btn btn-primary fs-6">
					กดส่งชุดข้อความ<br>(Publisher)
                    </button> 
				</div>
			</div>
		</div>
	</div>
</section>

</div>
<!-- end div container-->


</body>
</html>


