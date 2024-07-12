

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST["ckeditorsize"])){
        $w=$_POST["w"];
        $h=$_POST["h"];
        echo ckeditorsize($w,$h);
    }
    if(isset($_POST["SearchEdit"])){
        $XVMsgCode=$_POST["XVMsgCode"];
        echo SearchEdit($XVMsgCode);
    }
   
}
function ckeditorsize($w,$h){
    $data='<textarea class="ck-editor" name="detail" id="detail" ></textarea>';
    $data.="<script>
        CKEDITOR.replace('detail',{
            font_names: 'SarunThangLuang'+
                    
                        'Arial/Arial, Helvetica/sans-serif;' +
                        'THSarabun;' +
                        'Comic Sans MS/Comic Sans MS, cursive;' +
                        'Courier New/Courier New, Courier, monospace;' +
                        'Georgia/Georgia, serif;' +
                        'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
                        'Tahoma/Tahoma, Geneva, sans-serif;' +
                        'Times New Roman/Times New Roman, Times, serif;' +
                        'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
                        'Verdana/Verdana, Geneva, sans-serif',
            toolbar : [
                    ['Font', 'FontSize'], ['TextColor', 'BGColor'], ['Bold', 'Italic', 'Underline', 'Strike'], ['Subscript', 'Superscript'],
                    ['JustifyLeft', 'JustifyRight', 'JustifyCenter', 'JustifyBlock'] 
                
                    ],";

            $data.="width:'".$w."px',";
            $data.="height:'".$h. "px'";
    $data.="
        });
    </script>";
    return $data;
}

function SearchEdit($XVMsgCode){
       include "lib/DatabaseManage.php";
       $data="";
       $sql = "SELECT        XVMsgCode, XVMsgName, XVMsgHtmlM
                FROM            dbo.TMstMMessage
                WHERE        (XVMsgCode = '$XVMsgCode')";

    $sql = "SELECT        dbo.TMstMMessage.XVMsgCode, dbo.TMstMMessage.XVMsgName, dbo.TMstMMessage.XVMsgHtmlM, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel
FROM            dbo.TMstMMsgSize INNER JOIN
                         dbo.TMstMMessage ON dbo.TMstMMsgSize.XVMssCode = dbo.TMstMMessage.XVMssCode
WHERE        (dbo.TMstMMessage.XVMsgCode = '$XVMsgCode')";
       $query = sqlsrv_query($conn, $sql);
       $XVMsgCode="";
       $XVMsgName="";
       $XVMsgHtml="";
       while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
       {
          $XVMsgName=$result['XVMsgName'];
          $XVMsgHtmlM=$result['XVMsgHtmlM'];
          $w=$result['XIMssWPixel'];
          $h=$result['XIMssHPixel'];
       }  
       sqlsrv_close( $conn );
       $XVMsgHtml='<textarea class="ck-editor" name="detail" id="detail" >'.$XVMsgHtmlM.'</textarea>';
       $XVMsgHtml.="<script>
           CKEDITOR.replace('detail',{
               font_names: 'SarunThangLuang'+
                       
                           'Arial/Arial, Helvetica/sans-serif;' +
                           'THSarabun;' +
                           'Comic Sans MS/Comic Sans MS, cursive;' +
                           'Courier New/Courier New, Courier, monospace;' +
                           'Georgia/Georgia, serif;' +
                           'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
                           'Tahoma/Tahoma, Geneva, sans-serif;' +
                           'Times New Roman/Times New Roman, Times, serif;' +
                           'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
                           'Verdana/Verdana, Geneva, sans-serif',
               toolbar : [
                       ['Font', 'FontSize'], ['TextColor', 'BGColor'], ['Bold', 'Italic', 'Underline', 'Strike'], ['Subscript', 'Superscript'],
                       ['JustifyLeft', 'JustifyRight', 'JustifyCenter', 'JustifyBlock'] 
                   
                       ],";
   
               $XVMsgHtml.="width:'".$w."px',";
               $XVMsgHtml.="height:'".$h. "px'";
       $XVMsgHtml.="
           });
       </script>";
       $data=$XVMsgName.'#'.$XVMsgHtml;
       return  $data;
}
?>