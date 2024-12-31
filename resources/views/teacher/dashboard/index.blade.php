@extends('layouts.app_theme')

@section('content')
<div class="main-contsleftright">
  <div class="leftdatamain_cover">

    <div class="col comtitledata-cover">
      <h1>Dashboard</h1>
      <p>Under the Maintenance</p>
      <img src="{{ asset('public/images/title-background-dashboard.png') }}" alt="Welcome to GORD Academy">
    </div>

    <!-- <div class="row">
      <?php if (isset($dashboardDetails['classes']) && !empty($dashboardDetails['classes'])) { ?>
        <div class="col-sm smcoldatrispo">
          <div class="todayclass-cover">
            <h2 class="todayclass-title">Today Classes</h2>
            <div class="classlistofall">
              <?php foreach ($dashboardDetails['classes'] as $class) { ?>
                <div class="classlistof_cover">
                  <img src="<?php echo $class['image']; ?>" alt="<?php echo $class['title']; ?>">
                  <h4><?php echo $class['title']; ?></h4>
                  <div class="progress progcolor1" data-percentage="<?php echo $class['percentage']; ?>">
                    <span class="progress-left">
                      <span class="progress-bar"></span>
                    </span>
                    <span class="progress-right">
                      <span class="progress-bar"></span>
                    </span>
                    <div class="progress-value">
                      <div><?php echo $class['percentage']; ?>%</div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php if (isset($dashboardDetails['time_spent']) && !empty($dashboardDetails['time_spent'])) { ?>
        <div class="col-sm smcoldatrispo">
          <div class="timespentchartset">
            <h2 class="todayclass-title">Time Spent</h2>
            <div class="timespentchart-cover">
              <div class="timespentchart-top">
                <img src="{{ asset('public/images/time-spent-img.png') }}" alt="Time Spent">
                <h4>Good job, keep going!</h4>
              </div>

              <div class="comcharttimedata">
                <h5><?php echo $dashboardDetails['time_spent']['total']; ?></h5>
                <?php if (isset($dashboardDetails['time_spent']['items']) && !empty($dashboardDetails['time_spent']['items'])) { ?>
                  <div id="doughnutChart" class="chart"></div>
                  <div class="chartinerdata-com">
                    <?php foreach ($dashboardDetails['time_spent']['items'] as $item) { ?>
                      <div class="allcomdatacover">
                        <span style="background: <?php echo $item['color']; ?>;"></span>
                        <p><?php echo $item['title']; ?></p>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div> -->
  </div>
  <div class="rightdatamain_cover">
    @include('user.profile_sidebar')
  </div>
</div>
<script src="{{ asset('public/js/chart.js') }}"></script>
@endsection