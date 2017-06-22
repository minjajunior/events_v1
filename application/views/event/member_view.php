<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 5:15 PM
 */
?>

<div class="banner">
    <h2>
        <a href="<?php echo site_url('event/home/'.base64_encode($event_id)) ?>">Event</a>
        <i class="fa fa-angle-right"></i>
        <span>Members</span>
    </h2>
</div>

<div class="blank">

    <?php if(isset($this->session->admin_id)) {
        if (isset($member_details['error']) && $member_details['error'] == "0") { ?>
            <div class="blank-page">
                <h4>
                    <div class="col-md-3"> All Members</div>
                    <div class="col-md-9">
                        <?php if (date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>
                            <a href="#" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#newGroup" data-placement="bottom" title="Create Group"><i class="fa fa-users"></i> Create Group</a>&nbsp;
                            <a href="#" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#newMember" data-placement="bottom" title="New Member"><i class="fa fa-user-plus"></i> New Member</a>&nbsp;
                            <a href="#" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#uploadMembers" data-placement="bottom" title="Upload Members File"><i class="fa fa-upload"></i> Upload Members</a>
                            <a href="<?php echo site_url('event/template/member')?>" class="btn btn-xs btn-success pull-right" data-toggle="tooltip" data-placement="bottom" title="Download Budget Template" >&nbsp;<i class="fa fa-download"></i> Download Template&nbsp;</a>
                        <?php } ?>
                    </div>
                </h4>
                <hr>
                No members found. Create <a href="#" data-toggle="modal" data-target="#newMember">new member</a> or upload your members file.
            </div>
        <?php } else { ?>
            <div class="col-md-3 compose">
                <nav class="nav-sidebar">
                    <ul class="nav tabs">
                        <li class="active"><a href="#allMembers" data-toggle="tab">All Members</a></li>
                        <?php if(!isset($member_group['error'])) {
                            foreach ($member_group as $mg) { ?>
                                <li><a href="#<?php echo $mg->group_id; ?>" data-toggle="tab"><?php echo $mg->group_name?></a></li>
                            <?php } } ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-9 tab-content tab-content-in">
                <div class="tab-pane active text-style" id="allMembers">
                    <div class="blank-page">
                        <h4>
                            <div class="col-md-3"> All Members</div>
                            <div class="col-md-9">
                            <?php if (date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>
                                <a href="#" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#newGroup" data-placement="bottom" title="Create Group"><i class="fa fa-users"></i> Create Group</a>&nbsp;
                                <a href="#" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#newMember" data-placement="bottom" title="New Member"><i class="fa fa-user-plus"></i> New Member</a>&nbsp;
                                <a href="#" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#uploadMembers" data-placement="bottom" title="Upload Members File"><i class="fa fa-upload"></i> Upload Members</a>
                                <a href="<?php echo site_url('event/template/member')?>" class="btn btn-xs btn-success pull-right" data-toggle="tooltip" data-placement="bottom" title="Download Budget Template" >&nbsp;<i class="fa fa-download"></i> Download Template&nbsp;</a>
                            <?php } ?>
                            </div>
                        </h4>
                        <br><br>
                        <div class="col-md-6">
                            <div class="input-group input-group-in">
                                <input type="text" id="search" onkeyup="searchFunction()" class="form-control2 input-search" placeholder="Search...">
                                <span class="input-group-btn"><button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-xs btn-danger pull-right" data-toggle="modal" data-target="#newGroup"> <i class="fa fa-trash"></i> Delete All</a>
                        </div>
                        <div class="tables">
                            <table class="table table-hover" id="members-list">
                                <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Phone Number</th>
                                    <th>Pledge (TZS)</th>
                                    <th>Cash (TZS)</th>
                                    <th>Balance (TZS)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($member_details as $md){ ?>
                                    <tr>
                                        <td>
                                            <?php if (date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>
                                                <a href="javascript:void(0)" class="edit_member" rel="<?php echo $md->member_id; ?>" id="editMember_view"><?php echo $md->member_name?></a>
                                            <?php } else {
                                                echo $md->member_name;
                                            } ?>
                                        </td>
                                        <td><?php echo $md->member_phone ?></td>
                                        <td><?php echo $english_format_number = number_format($md->member_pledge, 0, '.', ',');?></td>
                                        <td><?php echo $english_format_number = number_format($md->member_cash, 0, '.', ','); ?></td>
                                        <?php if($md->member_pledge >= $md->member_cash) {
                                            $balance = $md->member_pledge - $md->member_cash;
                                        } else { $balance = 0; } ?>
                                        <td><?php echo $english_format_number = number_format($balance, 0, '.', ','); ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if(!isset($member_group['error'])){
                    foreach ($member_group as $mg) { ?>
                    <div class="tab-pane text-style" id="<?php echo $mg->group_id;?>">
                        <div class="blank-page">
                            <h4>
                                <div class="col-md-6"><?php echo $mg->group_name ?></div>
                                <div class="col-md-6"><a href="#" class="btn btn-success pull-right" data-toggle="modal" data-target="#delete<?php echo $mg->group_id;?>" >Delete Group</a></div>
                            </h4>
                            <div class="tables">
                                <table class="table table-hover" id="members-list">
                                    <thead>
                                        <tr>
                                            <th>Member Name</th>
                                            <th>Phone Number</th>
                                            <th>Pledge (TZS)</th>
                                            <th>Cash (TZS)</th>
                                            <th>Balance (TZS)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($member_details as $md){
                                        if($mg->group_id == $md->group_id) { ?>
                                            <tr>
                                                <td>
                                                    <?php if (date_add(date_create($event_date), date_interval_create_from_date_string('7 days')) > date_create(date('Y-m-d'))) { ?>
                                                        <a href="javascript:void(0)" class="edit_member" rel="<?php echo $md->member_id; ?>" id="editMember_view"><?php echo $md->member_name?></a>
                                                    <?php } else {
                                                        echo $md->member_name;
                                                    } ?>
                                                </td>
                                                <td><?php echo $md->member_phone ?></td>
                                                <td><?php echo $english_format_number = number_format($md->member_pledge, 0, '.', ',');?></td>
                                                <td><?php echo $english_format_number = number_format($md->member_cash, 0, '.', ','); ?></td>
                                                <?php if($md->member_pledge >= $md->member_cash) {
                                                    $balance = $md->member_pledge - $md->member_cash;
                                                } else { $balance = 0; } ?>
                                                <td><?php echo $english_format_number = number_format($balance, 0, '.', ','); ?></td>
                                            </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $mg->group_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h2 class="modal-title">Delete Group</h2>
                                </div>
                                <div class="modal-body">
                                    <div class="the-response"></div>
                                    <p>Are you sure you want to delete <?php echo $mg->group_name ?> group ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                                    <a href="javascript:void(0)" class="delete_group btn btn-danger" rel="<?php echo $mg->group_id; ?>" id="member_view">Delete</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                <?php } } ?>
            </div>
        <?php } ?>
        <div class="clearfix"> </div>
    <?php } ?>
</div>

<div class="modal fade" id="newMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">New Member</h2>
            </div>
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'new_member');
            echo form_open('event/new_member/'.$event_id, $attributes);
            ?>
            <div class="modal-body">
                <div id="the-message"></div>
                <div class="form-group">
                    <label for="membername" class="col-sm-4 control-label">Member Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="membername" value="<?php echo set_value('membername'); ?>" class="form-control1" id="membername" placeholder="Member Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="memberpledge" class="col-sm-4 control-label">Member Pledge</label>
                    <div class="col-sm-8">
                        <input type="text" name="memberpledge" value="<?php echo set_value('memberpledge'); ?>" class="form-control1" id="memberpledge" placeholder="Member Pledge">
                    </div>
                </div>
                <div class="form-group">
                    <label for="membercash" class="col-sm-4 control-label">Member Cash</label>
                    <div class="col-sm-8">
                        <input type="text" name="membercash" value="<?php echo set_value('membercash'); ?>" class="form-control1" id="membercash" placeholder="Member Cash">
                        <?php echo form_error('membercash'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="memberphone" class="col-sm-4 control-label">Phone Number</label>
                    <div class="col-sm-8">
                        <input type="text" name="memberphone" value="<?php echo set_value('memberphone'); ?>" class="form-control1" id="memberphone" placeholder="Phone Number">
                        <?php echo form_error('memberphone'); ?>
                    </div>
                </div>
                <?php if (!isset($member_group['error'])) {?>
                    <div class="form-group">
                        <label for="group" class="col-sm-4 control-label">Group</label>
                        <div class="col-sm-8">
                            <select name="group" id="selector1" class="form-control1">
                                <option value="">Select Group</option>
                                <?php foreach($member_group as $mg){ ?>
                                    <option value="<?php echo $mg->group_id; ?>" id="group"><?php echo $mg->group_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="newGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Create Group</h2>
            </div>
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'new_group');
            echo form_open('member/new_group/'.$event_id, $attributes);
            ?>
            <div class="modal-body">
                <div id="the-response"></div>
                <div class="form-group">
                    <label for="groupname" class="col-sm-4 control-label">Group Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="groupname" value="<?php echo set_value('groupname'); ?>" class="form-control1" id="groupname" placeholder="Group Name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="uploadMembers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Upload Members File</h2>
            </div>
            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'upload_members');
            echo form_open_multipart('event/upload_members/'.$event_id, $attributes);
            ?>
            <div class="modal-body">
                <div id="upload-response"></div>
                <div class="form-group">
                    <label for="members" class="col-sm-4 control-label">Browse File</label>
                    <div class="col-sm-8">
                        <input type="file" accept=".xls,.xlsx" name="members" id="members">
                        <p class="help-block">Upload .xls or .xlsx file</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Upload</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        /*$('#members-list').DataTable();*/
        var getContentView = function(postData) {
            $.ajax({
                type:"POST",
                url: "<?php echo base_url('event/load_views')?>",
                //data:"id="+view_name,
                data:postData,
                dataType: "html",
                success: function(data) {
                    $('#load_navigation_menu_view').html(data);
                },
                error: function(data) {
                    alert('An error has occured trying to get the page details');
                }
            });
        };

        $('.table').on("click", ".edit_member", function() {
            var view_name = $(this).attr("id");
            var member_id = $(this).attr("rel");
            var postData = {
                'view_name': view_name,
                'member_id': member_id,
            };
            getContentView(postData);
        });

        $('#new_member').submit(function(e) {
            e.preventDefault();
            var me = $(this);
            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: me.serialize(),
                dataType: 'json',
                success: function (response) {
                    if(response.success == true){
                        $('#the-message').append('<div class="alert alert-success">' +
                            '<i class="fa fa-check"></i>' +
                            ' Member Created Successfully' +
                            '</div>');
                        $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                        $('.text-danger').remove();
                        // reset the form
                        me[0].reset();
                        // close the message after seconds
                        $('.alert-success').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                                $('#newMember').modal('hide');
                                var postData = {
                                    'view_name' : 'member_view',
                                    'event_id' : '<?php echo $event_id ?>'
                                };
                                getContentView(postData);
                            });
                        })
                    }else {
                        $.each(response.messages, function (key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();
                            element.after(value)
                        })
                    }
                }
            });
        });


        $('#upload_members').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formD = $(form)[0];
            var formData = new FormData(formD);

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                //data: form.serialize(),
                data : formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.success == true){
                        $('#upload-response').append('<div class="alert alert-success">' +
                            '<i class="fa fa-check"></i>' +
                            ' Members Uploaded Successfully' +
                            '</div>');
                        $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                        $('.text-danger').remove();

                        // reset the form
                        form[0].reset();

                        // close the message after seconds
                        $('.alert-success').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                                $('#uploadMembers').modal('hide');
                                var postData = {
                                    'view_name' : 'member_view',
                                    'event_id' : '<?php echo $event_id ?>'
                                };
                                getContentView(postData);
                            });
                        })
                    }else if(response.success == false) {
                        $('#upload-response').append('<div class="alert alert-danger">' +
                            response.messages + '</div>'
                        );
                        $('.alert-danger').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        });
                    }
                }
            });
        });


        $('#new_group').submit(function(e) {
            e.preventDefault();
            var me = $(this);
            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: me.serialize(),
                dataType: 'json',
                success: function (response) {
                    if(response.success == true){
                        $('#the-response').append('<div class="alert alert-success">' +
                            '<i class="fa fa-check"></i>' +
                            ' Group Created Successfully' +
                            '</div>');
                        $('.form-group').removeClass('has-error')
                            .removeClass('has-success');
                        $('.text-danger').remove();
                        // reset the form
                        me[0].reset();
                        // close the message after seconds
                        $('.alert-success').delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                                $('#newGroup').modal('hide');
                                var postData = {
                                    'view_name' : 'member_view',
                                    'event_id' : '<?php echo $event_id ?>'
                                };
                                getContentView(postData);
                            });
                        })
                    }else {
                        $.each(response.messages, function (key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();
                            element.after(value)
                        })
                    }
                }
            });
        });

        $('.modal-footer').on("click", ".delete_group", function () {
            var view_name = 'member_view';
            var group_id = $(this).attr("rel");

            var postValue = {
                'view_name': view_name,
                'event_id': <?php echo $event_id?>,
            };

            $.ajax({
                type:"POST",
                url: "<?php echo base_url('member/delete_group/')?>"+ group_id,
                //data:"id="+view_name,
                data:postValue,
                dataType: "json",
                success: function(response) {
                    if(response.success == true) {
                        $('#delete'+group_id).modal('hide');
                        getContentView(postValue);
                    }
                }
            });
        });
    });
</script>
<script>
    function searchFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
         input = document.getElementById("search");
         filter = input.value.toUpperCase();
         table = document.getElementById("members-list");
         tr = table.getElementsByTagName("tr");

         // Loop through all table rows, and hide those who don't match the search query
         for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
         }
    }
</script>