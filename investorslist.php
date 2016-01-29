<div class="content-block">
<?php
$users = getAllInvestors();

if ($users){
foreach ($users as $user) { ?>

    <div style="width:100%; height:200px;">

        <div class="left" style="width:250px; float:left;">
            <div class="user-photo">
                <?php
                if (empty($user['photo'])) {
                    echo '<img src="uploads/avatars/nophoto.jpg" style="width:200px;" alt="">';
                } else {
                    echo '<img src="uploads/avatars/investors/' . $user['photo'] . '" style="width:200px;" alt="">';
                }
                ?>
            </div>
        </div>
        <div class="right" style="width:639px; float:right;">
            <div class="form-item no-height">
                <ul class="user-info-left">
                    <li>
                        <div class="content-title-search">
                            <a href="investor.php?iuid=<?php echo ucwords($user['investor_id']); ?>"
                               style="text-decoration:none; color:#FF4F03;"><?php echo $user['company_name'] ?></a>
                        </div>
                    </li>
                    <li><h2><?php echo $user['location'] ?></h2></li>
                    <li><h2 style="color:#4a77a4;"><?php echo $user['email'] ?></h2></li>
                </ul>

            </div>
        </div>
    </div>

    <?php }
    }

    else {
        echo '<h2>No Results</h2>';
    }
    ?>
</div>