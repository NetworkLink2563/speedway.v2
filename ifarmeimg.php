<?php
$msg = $_GET['msg'];
$type = $_GET['type'];
include "lib/DatabaseManage.php";
if ($type == 1) {


    $q = "SELECT * FROM TMstMMessage WHERE  XVMsgCode ='$msg'";
    $qr = sqlsrv_query($conn, $q);
    $qd = sqlsrv_fetch_array($qr, SQLSRV_FETCH_ASSOC); ?>
    <div class="modal py-5 show" id="ModalExample" style="display: block;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height: 500px;">
                <div class="modal-body text-center">
                    <?php echo $qd['XVMsgHtml']; ?>
                </div>
            </div>
        </div>
    </div>

<?php } elseif ($type == 2) { ?>
    <div class="modal py-5 show" id="ModalExample" style="display: block;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height: 500px;">
                <div class="modal-body text-center">
                    <img style=" margin: 0px;padding: 0px;width:100%;height:100%;" src='/media/tmp/<?php echo  $msg; ?>'></img>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
<?php } elseif ($type == 3) { ?>
    <div class="modal py-5 show" id="ModalExample" style="display: block;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height: 500px;">
                <div class="modal-body text-center">
                    <video width="960" height="520" controls>
                        <source src="/media/tmp/<?php echo  $msg; ?>" type="video/mp4">
                    </video>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
<?php }  ?>