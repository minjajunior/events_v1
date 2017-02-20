<?php
/**
 * Created by PhpStorm.
 * User: Minja Junior
 * Date: 2/20/2017
 * Time: 5:43 PM
 */?>

<div class="blank">
    <div class="row">
        <div class="col-md-6">
            <div class="blank-page">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="glyphicon glyphicon-wrench pull-right"></i>
                            <h4>Download Reports</h4>
                        </div>
                    </div>



                    <div class="panel-body">

                        <p> Below reports will help you to better analyse and understand your event very quick</p>
                        <form class="form form-vertical">
                            <div class="control-group">
                                <label>Name</label>
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label>Message</label>
                                <div class="controls">
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>

                    </div>
                    <div class="control-group">
                        <label></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                <!--/panel content-->
            </div>
        </div>
        <div class="col-md-6">
            <div class="blank-page">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="glyphicon glyphicon-wrench pull-right"></i>
                            <h4>Create Custom Reports</h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <p>Using the form below, you may create and download a report of your choice for the category you select:</p>


                        <div> <label class="" >Category</label>
                            <select id="category-selection" class="" >
                                <option value="0" selected="selected">Members</option>
                                <option value="1">Budget</option>
                                <option value="2">Eventy Type</option>
                            </select>
                        </div>

                        <form class="form form-vertical">
                            <div class="control-group">
                                <label>Name</label>
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="Enter Name">
                                </div>
                            </div>


                    </div>
                    <div class="control-group">
                        <label></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                <!--/panel content-->
            </div>
        </div>
    </div>
</div>

