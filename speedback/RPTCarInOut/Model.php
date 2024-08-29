<?php
function   ShowData($io,$starttime,$endtime){
    $BranchCode=$_SESSION["XCBranchCode"];
    if($io=='I'){
        $sql="select XCCardVisitorCode, XCPlateNo, XTIn ,DATE(XTIn) as DATEIN
        , XTOut 
        , XICardLostPrice, XIHoutPrice, XIDayPrice,XIPriceCoutDay ,XITotal,XIDiscount,XIStampPrice,XCStampCode,XINet,WhoEdit,XCCardVisitorCode, XCBranchName 
        from mstcardvisitor,mstbranch where ((mstbranch.XCBranchCode=mstcardvisitor.XCBranchCode) 
        and ((UNIX_TIMESTAMP(XTIn)>=$starttime) 
        and (UNIX_TIMESTAMP(XTIn)<=$endtime)) 
        and (mstcardvisitor.XCBranchCode='$BranchCode')) 
        order by XTOut;";
    } 
    if($io=='O'){
        $sql="select XCCardVisitorCode, XCPlateNo, XTIn , XTOut, DATE(XTOut) as DATEOUT
        , XICardLostPrice, XIHoutPrice, XIDayPrice,XIPriceCoutDay ,XITotal,XIDiscount,XIStampPrice,XCStampCode,XINet,WhoEdit,XCCardVisitorCode, XCBranchName 
        from mstcardvisitor,mstbranch where ((mstbranch.XCBranchCode=mstcardvisitor.XCBranchCode) 
        and ((UNIX_TIMESTAMP(XTOut)>=$starttime) 
        and (UNIX_TIMESTAMP(XTOut)<=$endtime)) 
        and (mstcardvisitor.XCBranchCode='$BranchCode')) 
        order by XTOut;";
    } 

   
    $result=DbSql($sql);
    
    $data="[";
    while($row = $result->fetch_assoc()) {
        
        $WhoEdit=$row["WhoEdit"];
        $XCStampCode=$row["XCStampCode"];
        $XCName="";
        $XCShopName="";
        $imgdate="";
        if($io=='I'){
            $timeio=$row["XTIn"];
            $imgdate=$row["DATEIN"];
        }else if($io=='O'){
            $timeio=$row["XTOut"];
            $imgdate=$row["DATEOUT"];
        }
        $sql="select XCName from mstuser where XCUserCode='$WhoEdit'";
        $result1=DbSql($sql);
        while($row1 = $result1->fetch_assoc()) {
                $XCName=$row1["XCName"];
        }
        
        $sql="select XCShopName from mststamp,mstshop where mststamp.XCShopCode=mstshop.XCShopCode and XCStampCode='$XCStampCode'";
        $result1=DbSql($sql);
        while($row1 = $result1->fetch_assoc()) {
            $XCShopName=$row1["XCShopName"];
        }
        
        $url1="../img/".$imgdate."/".$row["XCCardVisitorCode"]."_1.jpg";
        $url2="../img/".$imgdate."/".$row["XCCardVisitorCode"]."_2.jpg";

        $im1='<img src=\"'.$url1.'\" class=\"img-rounded\"  width=\"304\" height=\"236\">';
        $im2='<img src=\"'.$url2.'\" class=\"img-rounded\"  width=\"304\" height=\"236\">';

        $data.='
        {
            "A":"'.$row["XCCardVisitorCode"].'",
            "B":"'.str_replace("'", "", $row["XCPlateNo"]).'",
            "C":"'.$timeio.'",
            "D":"'.$im1.'",
            "E":"'.$im2.'"
            
        },';
        
   
    }
    $data=substr($data,0,strlen($data)-1)."]";
    
    return  $data;
    
}  
?>