@extends('layouts.app_theme')

@section('content')

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
<script src="https://code.highcharts.com/highcharts.js"></script>

<style>
    .fa {
        margin-right: 5px;
    }

    .rating .fa {
        font-size: 22px;
    }

    .rating-num {
        margin-top: 0px;
        font-size: 60px;
    }

    .progress {
        margin-bottom: 5px;
    }

    .progress:after {
        width: 0% !important;
        border: 0px !important;
    }

    .progress-bar-custom {
        text-align: left;
    }

    .rating-desc .col-md-3 {
        padding-right: 0px;
    }

    .sr-only {
        margin-left: 5px;
        overflow: visible;
        clip: auto;
    }

    .progress-bar-custom-success {
        background-color: #5cb85c;
    }

    .progress-striped .progress-bar-custom-success {
        background-image: -webkit-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: -o-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
    }

    .progress-bar-custom-info {
        background-color: #5bc0de;
    }

    .progress-striped .progress-bar-custom-info {
        background-image: -webkit-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: -o-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
    }

    .progress-bar-custom-warning {
        background-color: #f0ad4e;
    }

    .progress-striped .progress-bar-custom-warning {
        background-image: -webkit-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: -o-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
    }

    .progress-bar-custom-danger {
        background-color: #d9534f;
    }

    .progress-striped .progress-bar-custom-danger {
        background-image: -webkit-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: -o-linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
        background-image: linear-gradient(45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent);
    }
</style>

<div class="proprofimaincov">
    <div class="quizmaindata-cover">
        @include ('messages')
        <div class="profset-title">
            <h1>{{ $title }}</h1>
            <!--  <p>Welcome to Newness Super Admin</p> -->
        </div>
    </div>
    <div class="mainquizans-cover">
        <div class="supadmmain_cover">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-users primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$studentsCount}}</h3>
                                        <span>Total Learner</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-users warning font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$teachersCount}}</h3>
                                        <span>Total Instructors</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-graduation success font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$enrolledCourses}}</h3>
                                        <span>Enrolled Courses</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-graduation danger font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{$activeCourses}}</h3>
                                        <span>Active Courses</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="primary">{{$freeCourses}}</h3>
                                        <span>Free Courses</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-graduation primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="primary">{{$paidCourses}}</h3>
                                        <span>Paid Courses</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-graduation warning font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="success">${{ $totalEarning }}</h3>
                                        <span>Total Revenue</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-cup success font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-sm-6 col-6">
                    <!-- <div class="card">
                        <div class="card-content">
                        </div>
                </div> -->


                    <!-- Chart container -->
                    <div class="card">
                        <div class="card-content">


                            <div class="card-body">
                                <select id="chart-selector" class="form-control" style="width: 25%">
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                                <div id="revenue-chart-container"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-6 col-sm-6 col-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="row rating-desc">
                                                <div class="col-xs-3 col-md-3 text-right">
                                                    <span class="fa fa-star"></span>5
                                                </div>
                                                <div class="col-xs-8 col-md-9">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom progress-bar-custom-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= isset($ratingsCounts[4]) ? ($ratingsCounts[4]->count / $totalReviewCount) * 100 : 0 ?>%">
                                                            <span class="sr-only">{{ isset($ratingsCounts[4]) ? ($ratingsCounts[4]->count/$totalReviewCount)*100 : 0}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-md-3 text-right">
                                                    <span class="fa fa-star"></span>4
                                                </div>
                                                <div class="col-xs-8 col-md-9">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom progress-bar-custom-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= isset($ratingsCounts[3]) ? ($ratingsCounts[3]->count / $totalReviewCount) * 100 : 0 ?>%">
                                                            <span class="sr-only">{{ isset($ratingsCounts[3]) ? ($ratingsCounts[3]->count/$totalReviewCount)*100 : 0}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-md-3 text-right">
                                                    <span class="fa fa-star"></span>3
                                                </div>
                                                <div class="col-xs-8 col-md-9">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom progress-bar-custom-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= isset($ratingsCounts[2]) ? ($ratingsCounts[2]->count / $totalReviewCount) * 100 : 0 ?>%">
                                                            <span class="sr-only">{{ isset($ratingsCounts[2]) ? ($ratingsCounts[2]->count/$totalReviewCount)*100 : 0}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-md-3 text-right">
                                                    <span class="fa fa-star"></span>2
                                                </div>
                                                <div class="col-xs-8 col-md-9">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom progress-bar-custom-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= isset($ratingsCounts[1]) ? ($ratingsCounts[1]->count / $totalReviewCount) * 100 : 0 ?>%">
                                                            <span class="sr-only">{{ isset($ratingsCounts[1]) ? ($ratingsCounts[1]->count/$totalReviewCount)*100 : 0}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-md-3 text-right">
                                                    <span class="fa fa-star"></span>1
                                                </div>
                                                <div class="col-xs-8 col-md-9">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom progress-bar-custom-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= isset($ratingsCounts[0]) ? ($ratingsCounts[0]->count / $totalReviewCount) * 100 : 0 ?>%">
                                                            <span class="sr-only">{{ isset($ratingsCounts[0]) ? ($ratingsCounts[0]->count/$totalReviewCount)*100 : 0}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        @php
                                        $totalReviewByStar = $ratingsCounts[0]->count*1 + $ratingsCounts[1]->count*2 + $ratingsCounts[4]->count*5 + $ratingsCounts[3]->count*4 + $ratingsCounts[2]->count*3;
                                        $avg = $totalReviewByStar/$totalReviewCount;
                                        @endphp
                                        <div class="col-xs-12 col-md-6 text-center">
                                            <h1 class="rating-num">{{$avg}}</h1>
                                            <div class="rating">

                                                <?php
                                                for ($x = 0; $x < round($avg); $x++) {
                                                    echo '<span class="fa fa-star"></span>';
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <span class="fa fa-user"></span>{{$totalReviewCount}} total votes
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.manage_admin.model')
</div>
<script>
    $(document).ready(function() {

    });
</script>
<script>
    // Function to get month name from month number (1-12)
    function getMonthName(monthNumber) {
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return monthNames[monthNumber - 1]; // Adjust index because month numbers start from 1
    }

    // JavaScript to initialize Highcharts
    function initializeChart(chartType, data) {
        // Initialize Highcharts chart
        Highcharts.chart('revenue-chart-container', {
            // Chart configuration
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Revenue Chart'
            },
            xAxis: {
                // Set categories based on chartType
                categories: data[chartType].map(item => chartType === 'weekly' ? `Week ${item.week}` : getMonthName(parseInt(item.month.split('-')[1])))
            },
            yAxis: {
                title: {
                    text: 'Revenue'
                }
            },
            series: [{
                // Series based on chartType
                name: chartType === 'weekly' ? 'Weekly Revenue' : 'Monthly Revenue',
                data: data[chartType].map(item => item.total)
            }]
        });
    }

    // Fetch data from Laravel controller and initialize chart
    function fetchDataAndInitializeChart(chartType) {
        fetch('{{ url('/')}}/admin/revenue_chart')
            .then(response => response.json())
            .then(data => {
                initializeChart(chartType, data);
            })
            .catch(error => {
                console.error('Error fetching revenue data:', error);
            });
    }

    // Initialize chart on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch data and initialize chart with default type
        fetchDataAndInitializeChart('weekly');

        // Event listener for dropdown change
        document.getElementById('chart-selector').addEventListener('change', function() {
            const selectedChartType = this.value;
            fetchDataAndInitializeChart(selectedChartType);
        });
    });
</script>

@endsection