<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript">

        function getUrlParams() {
            var params = {};
            window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(str, key, value) {
                params[key] = value;
            });
            return params;
        }

        var params = getUrlParams();
        var url = "";


        function preLoad() {
            var params = getUrlParams();
            //alert(params.camid);
//                document.getElementById("cam").src = url;
        }

        refreshImage = function()
        {
            var params = getUrlParams();
            img = document.getElementById("cam");
//                img.src = url + "?rand=" + Math.random() * 10;
            //alert(img.src);

            img.src = 'https://www.ccs.jasmine.com/CCTV_MONITOR/resources/page/camera/getImageLogo.jsp?imageURL=<?php echo $_GET['livecode'];?>_thumb.jpg' + '&rand=' + Math.random() * 10;

        }

    </script>
    <title>Auto-Refresh Camera</title>
</head>
<body onload="preLoad();window.setInterval(refreshImage, 1 * 1000);">
<img src="https://www.ccs.jasmine.com/CCTV_MONITOR/resources/page/camera/getImageLogo.jsp?imageURL=<?php echo $_GET['livecode'];?>_thumb.jpg&amp;rand=4.434067246688203" id="cam" width="320" height="240">
</body>