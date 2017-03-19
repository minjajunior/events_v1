<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 3/13/2017
 * Time: 3:56 PM
 */
?>
<div class="blank">
    <div class="blank-page">
        <div class="h4 col-md-6">
            Event Admins
        </div>
        <div class="col-md-6">
            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => 'add_admin');
                echo form_open('admin/add_admin/'.$event_id, $attributes);
            ?>
            <div class="form-group">
                <div class="col-md-9">
                    <input type="text" name="mail" id="mail"  value="<?php echo set_value('mail')?>" class="form-control1" placeholder="Enter admin email here to add or invite">
                </div>
                <div class="col-md-3" id="response">
                </div>
            </div>
            </form>
        </div>
        <br>
        <table class="table">
            <tbody>
            <?php
            if (!isset($event_admin['error'])){
                foreach($event_admin as $ea){ ?>
                <tr class="table-row">
                    <td class="table-text">
                        <?php if($ea->role_id == 1) { ?>
                        <h6><a href="<?php echo base_url('admin/profile/'.$ea->admin_id)?>" class=""><?php echo $ea->admin_name ?></a></h6>
                        <?php } else { ?>
                            <h6><?php echo $ea->admin_name ?></h6>
                        <?php } ?>
                    </td>
                    <td>
                        <p><?php echo $ea->admin_phone ?></p>
                    </td>
                    <td >
                        <p><?php echo $ea->admin_email ?></p>
                    </td>
                    <td>
                        <span class="mar"><?php echo $ea->role_name?></span>
                    </td>
                </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#mail").keyup(function () {

             var mail = $("#mail").val();
             var dataString = "email=" + mail;

             $.ajax({
                 url: '<?php echo base_url("admin/add_admin/".$event_id) ?>',
                 type: 'post',
                 data: dataString,

                 success: function (response) {
                     if(response == 0){
                         $('#rea').remove();
                         $('.form-group').removeClass('has-error')
                             .addClass('has-error');
                         $('.text-danger').remove();
                     }else if (response == 1){
                         $('#rea').remove();
                         $('.form-group').removeClass('has-error')
                             .addClass('has-success').append('<button type="submit" id="rea" value="invite" name="submit" class="btn btn-danger">Invite</button>');
                         $('.text-danger').remove();
                     } else if (response == 2){
                         $('#rea').remove();
                         $('.form-group').removeClass('has-error')
                             .addClass('has-success').append('<button type="submit" id="rea" value="add" name="submit" class="btn btn-danger">Add</button>');
                         $('.text-danger').remove();
                     } else if (response == 5){
                         $('#rea').remove();
                         $('.form-group').removeClass('has-error')
                             .addClass('has-error').append('<div id="rea">This user is already Admin</div>');
                         $('.text-danger').remove();
                     }
                 }
             });
         });

        $('#add_admin').submit(function (e) {
            e.preventDefault();

            var action = $("#rea").val();
            var mail = $("#mail").val();
            var postData = {
                'email': mail,
                'action': action,
            };

            $.ajax({
                url: '<?php echo base_url("admin/add_admin/".$event_id) ?>',
                type: 'post',
                data: postData,

                success: function (response) {
                    if(response == 3){
                        $('#rea').remove();
                        $('#response').append('Admin Added');
                        $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                        $('.text-danger').remove();

                        $('#add_admin')[0].reset();

                        // close the message after seconds
                        $('#response').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                                //window.location.reload()
                            });
                        });
                    }else if (response == 4){
                        $('#rea').remove();
                        $('#response').append('Admin Invited');
                        $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                        $('.text-danger').remove();

                        $('#add_admin')[0].reset();

                        // close the message after seconds
                        $('#response').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                                //window.location.reload()
                            });
                        });
                    }
                }
            });
        })
    });
</script>
