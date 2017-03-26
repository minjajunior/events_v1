<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/23/2017
 * Time: 12:18 AM
 */
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Enter your phone #</h2>
            </div>
            <div class="modal-body">
                <h2>Text in a modal</h2>
               </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $(window).ready(function(){
        $('#myModal').modal('show');
    });
</script>
