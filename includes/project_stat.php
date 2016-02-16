<div class="content-block">
    <div class="content-title"><a class="project-title"
                                  href="home.php?pid=<?php echo $project['project_id']; ?>"><?php echo $project['project_title']; ?></a>
    </div>

    <div class="content-left-col project-details">
        <div class="user-photo">
            <?php
            $image = getFeaturingImage($project['project_id']);
            if (empty($image)) {
                echo '<a href="home.php?pid=' . $project['project_id'] . '"><img src="uploads/avatars/nophoto.jpg" alt=""></a>';
            } else {
                echo '<a href="home.php?pid=' . $project['project_id'] . '"><img src="uploads/images/' . $image . '" alt=""></a>';
            }
            ?>
        </div>
    </div>

    <div class="content-right-col project-details">
        <div class="project-stat-col">Initiated<span class="stat-col-title">Status</span></div>
        <div class="project-stat-col"><?php echo calculateRating($project['project_id']); ?><span
                class="stat-col-title">Rating</span></div>
        <div class="project-stat-col"><?php echo getRankForProject($project['project_id']); ?><span
                class="stat-col-title">Ranking</span></div>
    </div>

</div>

<div class="content-block">
    <div class="content-title">Seed Rating Score:<span
            class="rating-value"><?php echo calculate_mr($project['project_id']); ?></span></div>

    <div class="rating-block">
        <?php
        $score = getScroreForProject($project['project_id']);

        if (!$score) {
            $feasibility = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $uniqueness = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $growth_quality = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $startup_easeness = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $process_clarity = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $risk_factor = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $time_consumption = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $redundancy_featured = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $impact = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            $profile = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
        } else {
            $feasibility = explode(',', $score['feasibility']);
            $uniqueness = explode(',', $score['uniqueness']);
            $growth_quality = explode(',', $score['growth_quality']);
            $startup_easeness = explode(',', $score['startup_easeness']);
            $process_clarity = explode(',', $score['process_clarity']);
            $risk_factor = explode(',', $score['risk_factor']);
            $time_consumption = explode(',', $score['time_consumption']);
            $redundancy_featured = explode(',', $score['redundancy_featured']);
            $impact = explode(',', $score['impact']);
            $profile = explode(',', $score['profile']);
        }
        ?>
        <ul>
            <li>Feasibility: <?php
                foreach ($feasibility as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
            <li>Uniqueness: <?php
                foreach ($uniqueness as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
            <li>Growth Quality: <?php
                foreach ($growth_quality as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
            <li>Startup Easeness: <?php
                foreach ($startup_easeness as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
            <li>Process Clarity: <?php
                foreach ($process_clarity as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
        </ul>
    </div>

    <div class="rating-block">
        <ul>
            <li>Investment Risk Factor: <?php
                foreach ($risk_factor as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
            <li>Time Consumption to Effect: <?php
                foreach ($time_consumption as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
            <li>Redundancy Featured: <?php
                foreach ($redundancy_featured as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
        </ul>
    </div>

    <div class="rating-block">
        <ul>
            <li>Impact: <?php
                foreach ($impact as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
            <li>Profile: <?php
                foreach ($profile as $val) {
                    if (is_numeric($val))
                        $val = abs($val);
                    echo '<span class="nums">' . $val . '</span>';
                }
                ?></li>
        </ul>
    </div>

</div>

<div class="content-block">
    <div class="content-title">General Rating Data:<span
            class="rating-value"><?php echo @generalRatingData($project['project_id']); ?></span><span
            class="rating-note"></span></div>

    <table class="rating-table table1">
        <thead>
        <tr>
            <td>10-9</td>
            <td>9-8</td>
            <td>8-7</td>
            <td>7-6</td>
            <td>6-5</td>
            <td>5-4</td>
            <td>4-3</td>
            <td>3-2</td>
            <td>2-1</td>
            <td>1-0</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 9, 10); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 8, 9); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 7, 8); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 6, 7); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 5, 6); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 4, 5); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 3, 4); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 2, 3); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 1, 2); ?>%</span>
            </td>
            <td># of votes<span
                    class="percentline"><?php echo @getPercentLineForRating($project['project_id'], 0, 1); ?>%</span>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="rating-table table2">
        <thead>
        <tr>
            <td>User</td>
            <td>Male</td>
            <td>Female</td>
            <td>Age 13-19</td>
            <td>Age 19-40</td>
            <td>Age 40+</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Votes</td>
            <td><?php echo @getPercentLineGender($project['project_id'], 1); ?>%</td>
            <td><?php echo @getPercentLineGender($project['project_id'], 2); ?>%</td>
            <td><?php echo @getPercentLineAge($project['project_id'], 13, 19); ?>%</td>
            <td><?php echo @getPercentLineAge($project['project_id'], 19, 40); ?>%</td>
            <td><?php echo @getPercentLineAge($project['project_id'], 40, 150); ?>%</td>
        </tr>
        <tr>
            <td>RATING</td>
            <td><?php echo @getRatingGender($project['project_id'], 1); ?></td>
            <td><?php echo @getRatingGender($project['project_id'], 2); ?></td>
            <td><?php echo @getRatingAge($project['project_id'], 13, 19); ?></td>
            <td><?php echo @getRatingAge($project['project_id'], 19, 40); ?></td>
            <td><?php echo @getRatingAge($project['project_id'], 40, 150); ?></td>
        </tr>
        </tbody>
    </table>

</div>