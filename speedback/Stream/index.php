<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8 />
    <title>RTSP STREAMING TEST</title>

    <link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet">

</head>

<body>

    <video id='hls-example' class="video-js vjs-default-skin" width="400" height="300" controls>
        <source type="application/x-mpegURL" src="video.m3u8">

        <!--
<source type="application/x-mpegURL" src="http://ip-address/path/to/ouput/file-name.m3u8">
-->

    </video>

    <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>
    <script src="https://vjs.zencdn.net/7.2.3/video.js"></script>

    <script>
        var player = videojs('hls-example');
        player.play();
    </script>

</body>

</html>