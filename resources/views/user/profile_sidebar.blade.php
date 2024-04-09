<div class="proficurrent-datacover">
      <div class="proficurrent-prof">
        <img src="<?php echo $currentUser['image']; ?>" alt="Allie Grater">
        <h3><?php echo $currentUser['name']; ?></h3>
        <p><?php echo $currentUser['current_grade']; ?></p>
      </div>
      <?php if (isset($userActivities) && !empty($userActivities)) { ?>
        <div class="videoandcurrent-title">
          <h3>Current Activity</h3>
          <a href="Javascript:void(0);">View All</a>
        </div>
        <div class="activitydata-cover">
          <?php foreach ($userActivities as $activity) { ?>
            <div class="activitydata-iner">
              <a href="<?php echo $activity['url']; ?>">
                <div class="media-left bgcolor1">
                  <img src="<?php echo $activity['image']; ?>" alt="<?php echo $activity['title']; ?>" class="media-object">
                </div>
                <div class="media-body">
                  <h4><?php echo $activity['title']; ?></h4>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      <?php } ?>


      <?php if (isset($userVideoCourses) && !empty($userVideoCourses)) { ?>
        <div class="videoandcurrent-title">
          <h3>Video Coures</h3>
          <a href="Javascript:void(0);">View All</a>
        </div>
        <div class="videocoureslist-cover">
          <?php foreach ($userVideoCourses as $videoCourse) { ?>
            <div class="videocoureslist-iner">
              <a href="<?php echo $videoCourse['url']; ?>">
                <div class="videocoureslist-left">
                  <img src="<?php echo $videoCourse['image']; ?>" alt="Science Subjects">
                </div>
                <div class="videocoureslist-right">
                  <h3><?php echo $videoCourse['title']; ?></h3>
                  <p>By <?php echo $videoCourse['author']; ?></p>
                  <div class="strandvidolive">
                    <h6><?php echo $videoCourse['rating']; ?> <i class='bx bxs-star'></i></h6>
                    <?php if ($videoCourse['is_live']) { ?>
                      <h5><span class="pulse"></span> Live Now</h5>
                    <?php } ?>
                  </div>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      <?php } ?>


    </div>