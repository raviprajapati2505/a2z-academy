<div class="proficurrent-datacover">
      <div class="proficurrent-prof">
        <img src="<?php echo $currentUser['image']; ?>" alt="Allie Grater">
        <h3><?php echo $currentUser['name']; ?></h3>
        <p><?php echo $currentUser['current_grade']; ?></p>
      </div>
      <?php if (isset($userEvents) && !empty($userEvents)) { ?>
        <div class="videoandcurrent-title">
          <h3>Events</h3>
          <a href="{{ url('/teacher/events') }}">View All</a>
        </div>
        <div class="activitydata-cover">
          <?php foreach ($userEvents as $event) { ?>
            <div class="activitydata-iner">
              <a href="">
                <div class="media-left bgcolor1">
                  <img src="{{asset('public/images/biology-icon.png')}}" class="media-object">
                </div>
                <div class="media-body">
                  <h4><?php echo $event['description']; ?></h4>
                  <h6><?php echo $event['type']; ?></h6>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      <?php } ?>


      <?php if (isset($userVideoCourses) && !empty($userVideoCourses)) { ?>
        <div class="videoandcurrent-title">
          <h3>Upcoming classes</h3>
          <a href="Javascript:void(0);">View All</a>
        </div>
        <div class="videocoureslist-cover">
          <?php foreach ($userVideoCourses as $videoCourse) { ?>
            <div class="videocoureslist-iner">
              <a href="#">
                <div class="videocoureslist-left">
                  <img src="<?php echo $videoCourse['image']; ?>" alt="Science Subjects">
                </div>
                <div class="videocoureslist-right">
                  <h3><?php echo $videoCourse['title']; ?></h3>
                  <p><?php echo $videoCourse['description']; ?></p>
                  <!-- <div class="strandvidolive">
                    <h6><?php echo $videoCourse['rating']; ?> <i class='bx bxs-star'></i></h6>
                    <?php if ($videoCourse['is_live']) { ?>
                      <h5><span class="pulse"></span> Live Now</h5>
                    <?php } ?>
                  </div> -->
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      <?php } ?>


    </div>