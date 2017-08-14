<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/15/2017
 * Time: 9:50 AM
 */
?>
<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <h1> <a class="navbar-brand" href="#">Events</a></h1>
    </div>
    <div class=" border-bottom">
        <!-- Brand and toggle get grouped for better mobile display -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="drop-men" >
            <ul class=" nav_1">
                <?php if(!empty($this->session->admin_id)) {?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo $this->session->admin_name; ?> <i class="caret"></i></span></a>
                    <ul class="dropdown-menu " role="menu">
                        <li><a href="<?php echo site_url('admin/settings')?>"><i class="fa fa-cog"></i>Setting</a></li>
                        <li><a href="<?php echo site_url('login/logout')?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
        <div class="clearfix"></div>

        <?php if(!empty($this->session->admin_id)) {?>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="<?php echo site_url('admin')?>" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span> </a></li>
<!--                        <li><a href="--><?php //echo site_url('admin/estimator')?><!--" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Budget Estimate</span> </a></li>-->
                        <?php if(isset($event_id)){ ?>
                        <li><a href="javascript:void(0)" class="menu_item hvr-bounce-to-right" rel="<?php echo $event_id; ?>" id="home_view"><i class="fa fa-home nav_icon "></i><span class="nav-label">Home</span> </a></li>
                        <li><a href="javascript:void(0)" class="menu_item hvr-bounce-to-right" rel="<?php echo $event_id; ?>" id="budget_view"><i class="fa fa-money nav_icon "></i><span class="nav-label">Budget</span> </a></li>
                        <li><a href="javascript:void(0)" class="menu_item hvr-bounce-to-right" rel="<?php echo $event_id; ?>" id="member_view"><i class="fa fa-users nav_icon "></i><span class="nav-label">Members</span> </a></li>
                        <li><a href="javascript:void(0)" class="menu_item hvr-bounce-to-right" rel="<?php echo $event_id; ?>" id="gift_view"><i class="fa fa-gift nav_icon "></i><span class="nav-label">Gifts</span> </a></li>
                        <li><a href="javascript:void(0)" class="menu_item hvr-bounce-to-right" rel="<?php echo $event_id; ?>" id="reports_view"><i class="fa fa-files-o nav_icon "></i><span class="nav-label">Reports</span></a></li>
                        <?php } ?>
                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                            <ul class="nav-settings nav-second-level">
                                <?php if(isset($event_id)){ ?>
                                <li><a href="javascript:void(0)" class="menu_item hvr-bounce-to-right" rel="<?php echo $event_id; ?>" id="settings_view"><i class="fa fa-edit nav_icon"></i>Event Settings</a></li>
                                <?php } ?>
                                <li><a href="<?php echo site_url('admin/settings')?>" class=" hvr-bounce-to-right"><i class="fa fa-user-secret nav_icon"></i> Admin Settings</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo site_url('login/logout')?>" class=" hvr-bounce-to-right"><i class="fa fa-sign-out nav_icon"></i> <span class="nav-label">Logout</span> </a></li>
                    </ul>
                </div>
            </div>
        <?php } elseif(!empty($this->session->member_phone)) {?>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php if(isset($this->session->member_phone)){ ?>
                            <li><a href="<?php echo site_url('member') ?>" class="hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span> </a></li>
                        <?php } ?>
                        <li><a href="<?php echo site_url('login/logout')?>" class=" hvr-bounce-to-right"><i class="fa fa-sign-out nav_icon"></i> <span class="nav-label">Logout</span> </a></li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</nav>
<script>
    $(document).ready(function() {

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
        }

        $('.nav').on("click", ".menu_item", function() {
            var view_name = $(this).attr("id");
            var event_id = $(this).attr("rel");
            var postData = {
                'view_name': view_name,
                'event_id': event_id,
            };

            getContentView(postData);
        });

    });
</script>