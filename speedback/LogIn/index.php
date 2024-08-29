<?php
  //session_start();
  $_SESSION['token']= bin2hex(random_bytes(35));
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="" />
	<title>E-VA</title>
	<meta charset="utf-8" />
	<meta name="description" content="Network Link" />
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
	<!--begin::Theme mode setup on page load-->
	<script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if (localStorage.getItem("data-bs-theme") !== null) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::Root-->
	<style>
		body {
			background-color: #fd7e14 !important;
		}
	</style>

	<div class="yellow-dash" style="left:20px"></div>
	<div class="white-dash" style="left:20px"></div>
	<div class="d-flex flex-column flex-column-fluid flex-lg-row">
		<!--begin::Aside-->
		<div class="d-flex flex-center w-lg-30 pt-15 pt-lg-0 px-10">
			<!--begin::Aside-->
			<div class="d-flex flex-center flex-lg-start flex-column">


				<!--begin::Logo-->
				<!--
				<a href="index.html" class="mb-7">
					<img alt="Logo" src="../assets/media/logos/logo.png" />
				</a>
				-->
				<!--end::Logo-->

				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-center w-lg-70 p-10">
					<!--begin::Card-->

					<div class="card rounded-3 w-md-550px" style="position: absolute; top: 25%">

						<!--begin::Card body-->
						<div class="card-body d-flex flex-column p-10 p-lg-20 pb-lg-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
								<!--begin::Form-->
								<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
									data-kt-redirect-url="" action="#">
									<!--begin::Heading-->
									<div class="text-center mb-11">
										<!--begin::Title-->
										<h1 class="text-dark fw-bolder mb-3">Speedway </h1>
										<!--end::Title-->
										<!--begin::Sign up-->
										<!--
										<div class="text-gray-500 text-center fw-semibold fs-6">มีบัญชีผู้ใช้หรือยัง ?
											<a href="" class="link-primary">สมัครสมาชิก</a>
										</div>
										-->
										<!--end::Sign up-->
									</div>
									<!--begin::Heading-->
									<!--begin::Input group=-->
									<div class="fv-row mb-8">
										<!--begin::Email-->
										<input type="text" placeholder="อีเมล" name="email" id="usr" autocomplete="off"
											class="form-control bg-transparent" />
										<!--end::Email-->
									</div>
									<!--end::Input group=-->
									<div class="fv-row mb-3">
										<!--begin::Password-->
										<input type="password" placeholder="รหัสผ่าน" name="password" id="pwd" autocomplete="off"
											class="form-control bg-transparent" />
										<!--end::Password-->
									</div>
									<!--end::Input group=-->
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
										<div></div>
										<!--begin::Link-->
									    <!--
										<a href="" class="link-primary">ลืมรหัสผ่าน ?</a>
										-->
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Submit button-->
									<div class="mb-10 row"> 
										
										<div class="col-md-12 text-center"> 
										    <input type="hidden" id="token" value="<?php echo   $_SESSION['token'];?>">
											<button type="submit" id="kt_sign_in_submit" class="btn btn-primary col-md-6">
											<!--begin::Indicator label-->
											<span class="indicator-label">เข้าใช้งาน</span>
											<!--end::Indicator label-->
											<!--begin::Indicator progress-->
											<span class="indicator-progress">กรุณารอสักครู่...
												<span
													class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											<!--end::Indicator progress-->
										</button>
										</div>
									</div>
									<!--end::Submit button-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Wrapper-->
							
							
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="../assets/plugins/global/plugins.bundle.js"></script>
		<script src="../assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="view.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
</body>
<!--end::Body-->

</html>