<?php
/**
 * Created by PhpStorm.
 * User: d.felix
 * Date: 15/03/2017
 * Time: 23:08
 */

$this->load->view('shared/pdf_header');

//if(isset($this->session->admin_id)){ ?>


<div class="graph-grid">
    <div class="col-md-6 graph-1">
        <div class="grid-1">
            <h4>Bar</h4>
            <canvas id="bar1" height="375" width="625" style="width: 500px; height: 300px;"></canvas>
            <script>
                var barChartData = {
                    labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon","Tue","Wed","Thu"],
                    datasets : [
                        {
                            fillColor : "#FBB03B",
                            strokeColor : "#FBB03B",
                            data : [25,40,50,65,55,30,20,10,6,4]
                        },
                        {
                            fillColor : "#FBB03B",
                            strokeColor : "#FBB03B",
                            data : [30,45,55,70,40,25,15,8,5,2]
                        }
                    ]

                };
                new Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData);
            </script>
        </div>
    </div>
    <div class="col-md-6 graph-2">
        <div class="grid-1">
            <h4>Line</h4>
            <canvas id="line1" height="375" width="625" style="width: 500px; height: 300px;"></canvas>
            <script>
                var lineChartData = {
                    labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon"],
                    datasets : [
                        {
                            fillColor : "#fff",
                            strokeColor : "#1ABC9C",
                            pointColor : "#1ABC9C",
                            pointStrokeColor : "#1ABC9C",
                            data : [20,35,45,30,10,65,40]
                        }
                    ]

                };
                new Chart(document.getElementById("line1").getContext("2d")).Line(lineChartData);
            </script>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>


    <div class="graph-box1 clearfix">
        <div class="grid-1">
            <h4>Pie</h4>
            <div class="grid-graph">
                <div class="grid-graph1">
                    <div id="os-Win-lbl">Chrome <span>100%</span></div>
                    <div id="os-Mac-lbl">Internet Explorer <span> 50%</span></div>
                    <div id="os-Other-lbl">Safari<span>30%</span></div>
                </div>
            </div>
            <div class="grid-2">
                <canvas id="pie" height="393" width="587" style="width: 470px; height: 315px;"></canvas>
                <script>
                    var pieData = [
                        {
                            value: 30,
                            color:"#D95459"
                        },
                        {
                            value : 50,
                            color : "#1ABC9C"
                        },
                        {
                            value : 100,
                            color : "#3BB2D0"
                        }

                    ];
                    new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
                </script>
            </div>
            <div class="clearfix"> </div>
        </div>

    </div>

<?php

//  }

$this->load->view('shared/pdf_footer');

?>

