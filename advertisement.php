<?php
include ('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');

if (isset($_GET['mode']) && $_GET['mode'] == 'manage')
    $mode = 'manage';
else
    $mode = 'create';

$user = getUserData($_SESSION['uid']);

if (isset($_POST['finalize'])) {
    $res = createCampaign($_POST);
    if ($res)
        redirect('advertisement.php?mode=manage');
}


if (isset($_POST['finalize_edit'])) {
    $res = editCampaign($_POST, intval($_GET['cid']));
    if ($res)
        redirect('advertisement.php?mode=manage');
}



if (isset($_GET['action']) && $_GET['action'] == 'delete'){
        deleteAd(intval($_GET['cid']));
        redirect('advertisement.php?mode=manage');
}


if (isset($_GET['action']) && $_GET['action'] == 'pause') {
        startAd(intval($_GET['cid']), intval($_GET['status']));
        redirect('advertisement.php?mode=manage');
}
?>

<div class="inner-page-wrapper">

    <div class="finance advertisement inner-page content">

        <?php include (DIR_INCLUDE . 'left_nav.php'); ?>


        <div class="main-content">

            <div class="content-title">Finance</div>

            <div class="finance-graph"><?php include (DIR_INCLUDE . 'draw_graph_ads.php'); ?></div>

            <ul class="router-top-nav">
                <li><a href="account_management.php">Account Management</a></li>
                <li><a href="royalty.php">Royalty</a></li>
                <li  class="active"><a href="advertisement.php">Advertisement</a></li>
            </ul>

            <form action="" method="post" id="account-form">
                <div class="content-block" style="min-height: 200px; ">

                    <div class="form-item">
                        <input class="inbox-btn <?php if ($mode == 'create') echo 'active'; ?>" type="button" onclick="window.location = 'advertisement.php'" value="Start Ad Campaign">
                        <input class="create-message-btn  <?php if ($mode == 'manage') echo 'active'; ?>" type="button" onclick="window.location = 'advertisement.php?mode=manage'" value="Manage Ad Campaign">
                    </div>

                    <?php if (!isset($_POST['start']) && $mode == 'create' && !isset($_GET['action'])) { ?>
                        <div class="search-connection">
                            <form action="" method="post">
                                <input type="text" name="search_project" placeholder="Type to find your project" id="search_project">
                                <input type="submit" name="search">
                                <input type="submit" value="Start" class="get-connection" name="start">
                                <input type="hidden" name="project_id" id="project_id">
                            </form>
                        </div>

                    </div> <!-- content-block-->

                    <?php
                } else if (isset($_POST['start'])) {

                    $id = $_POST['project_id'];


                    $countries = getCountries();
                    ?>
                    <div class="content-title">Select your thematic post:</div>

                    <form action="" method="post">
                        <div class="form-item no-height thematic">
                            <?php
                            $video = getFeaturingVideo($id);

                            if (!empty($video)) {
                                for ($i = 1; $i < 5; $i++) {
                                    ?>
                                    <div class="thematic_item">
                                        <label for="thematic_post_<?php echo $i; ?>" class="thematic_post_<?php echo $i; ?>"><img src="images/video_preview<?php echo $i; ?>.jpg" alt=""></label>
                                        <input type="radio" name="thematic_post[]" id="thematic_post_<?php echo $i; ?>" class="ad-thematic_post_<?php echo $i; ?>" value="<?php echo $i; ?>">
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <?php
                            $image = getFeaturedImage($id);

                            if (!empty($image)) {
                                ?>
                                <div class="thematic_item">
                                    <label for="thematic_post_5" class="thematic_post_5"><img src="uploads/images/thumbs/<?php echo $image['file_name']; ?>" alt="" width="244" height="143"></label>
                                    <input type="radio" name="thematic_post[]" id="thematic_post_5" class="ad-thematic_post_5" value="<?php echo $image['image_id']; ?>" onclick="document.getElementById('thematic_type').value = 'image';">
                                </div>
                                <?php
                            }

                            $description = getFeaturedDescription($id);
                            if (!empty($description)) {
                                ?>
                                <div class="thematic_item">
                                    <label for="thematic_post_6" class="post_description thematic_post_6"><?php echo substr($description['content'], 0, 200); ?></label>
                                    <input type="radio" name="thematic_post[]" id="thematic_post_6" class="ad-thematic_post_6" value="<?php echo $description['description_id']; ?>" onclick="document.getElementById('thematic_type').value = 'description';">
                                </div>
                            <?php } ?>

                        </div>

                        </div> <!-- content-block-->

                        <div class="content-block create-ad">
                            <div class="content-title">Define your ad campaign:</div>
                            <div class="form-item"><label>Slogan:</label> <input type="text" name="slogan" id="slogan" placeholder="Enter marketing slogan"></div>
                            <div class="form-item"><label>Headline:</label> <input type="text" name="headline" id="headline" placeholder="Enter marketing headline"></div>
                        </div> <!-- content-block-->

                        <div class="content-block create-ad">
                            <div class="content-title">Campaign strategy:</div>
                            <div class="form-item no-height"><label>Campaign Territory:</label>
                                <select name="country[]" id="country" size="10" multiple class="multiple">
                                    <?php
                                    foreach ($countries as $country)
                                        echo '<option value="' . $country['name'] . '">' . $country['name'] . '</option>';
                                    ?>
                                </select>
                            </div>

                            <div class="form-item"><label>Age:</label>
                                <select name="min_age" id="min_age" class="age">
                                    <option>Min</option>
                                    <?php
                                    for ($i = 18; $i < 81; $i++)
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    ?>
                                </select>
                                -
                                <select name="max_age" id="max_age" class="age">
                                    <option>Max</option>
                                    <?php
                                    for ($i = 18; $i < 81; $i++)
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    ?>
                                </select>
                            </div>

                            <div class="form-item"><label>Gender:</label>
                                <select name="gender" id="gender">
                                    <option>Please Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-item"><label>Budget Amount:</label>
                                <select name="currency" id="currency">
                                    <option>Currency</option>
                                    <option value="USD">USD</option>
                                </select>
                                <input type="text" class="amount" name="amount" id="amount" placeholder="Amount">

                                <select name="time" id="time">
                                    <option>Time</option>
                                    <option value="1">1 day</option>
                                    <option value="2">1 week</option>
                                    <option value="3">1 month</option>
                                </select>
                            </div>

                            <div class="form-item"><label>Schedule:</label>
                                <select name="schedule" id="schedule">
                                    <option value="1">Immediately</option>
                                </select>
                            </div>

                            <div class="form-item"><label>Link:</label>
                                <input type="text" name="link" id="link" placeholder="Enter URL to open... I don't see what is next :)">
                            </div>


                        </div> <!-- content-block-->

                        <div class="content-block create-ad">
                            <div class="content-title">Preview:</div>
                            <div class="ad-preview">
                                <div class="ad-preview-thumb"></div>
                                <div class="ad-preview-text">
                                    <div class="ad-preview-headline"></div>
                                    <div class="ad-preview-slogan"></div>
                                </div>
                            </div>
                        </div> <!-- content-block-->

                        <input type="hidden" id="thematic_type" name="thematic_type" value="">
                        <input type="hidden" name="project_id" value="<?php echo $id; ?>">

                        <div class="finalize-ad">
                            <div class="form-item"><input type="submit" value="Finalize" class="get-connection" name="finalize"> By clicking "Finalize" you pay</div>
                        </div>
                    </form>
                    <?php
                } else if (isset($_GET['mode']) && $_GET['mode'] == 'manage') {
                    $ads = getCampaigns($_SESSION['uid']);

                    if ($ads) {
                        foreach ($ads as $ad) {
                            ?>
                            <div class="ad-item">
                                <div class="ad-preview">
                                    <div class="ad-preview-thumb"><?php echo getAdThematic($ad['thematic_type'], $ad['thematic_id']); ?></div>
                                    <div class="ad-action">
                                        <ul>
                                            <li><a href="advertisement.php?action=edit&cid=<?php echo $ad['ad_id'] ?>" class="edit">Edit</a></li>
                                            <li><a href="advertisement.php?action=pause&cid=<?php echo $ad['ad_id'].'&status='.$ad['status']; ?>" class="pause"><?php if ($ad['status']) echo 'Pause';
                else echo 'Start'; ?></a></li>
                                            <li><a href="advertisement.php?action=delete&cid=<?php echo $ad['ad_id'] ?>" class="delete" onclick="if(confirm('Are you sure?')) return true; else return false;">Delete</a></li>
                                        </ul>
                                    </div>
                                    <div class="ad-preview-text">
                                        <div class="ad-preview-headline"><?php echo $ad['headline']; ?></div>
                                        <div class="ad-preview-slogan"><?php echo $ad['slogan']; ?></div>
                                    </div>                                
                                </div>   
                                
                        <?php } ?>

                                <table class="finance-table" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>Likes</th>
                                        <th>Rates</th>
                                        <th>Comments</th>
                                        <th>Routes</th>
                                        <th>Engaged</th>
                                    </tr>
                                    <tr>
                                        <td class="bold">2</td>
                                        <td class="bold">4</td>
                                        <td class="bold">1</td>
                                        <td class="bold">2</td>
                                        <td class="bold">10</td>
                                    </tr>                                    
                                </table>
                                
                                <div class="content-title">Engaged</div>
                                <div class="finance-graph">
                                <canvas id="drawingCanvas1" width="883" height="203"></canvas>
                                </div>
                                
                                <div class="ad-stat">
                                    <div class="stat-column">
                                        <p><label>Male:</label> 2%</p>
                                        <p><label>Female:</label> 98%</p>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="stat-column">
                                        <p><label>USA:</label> 70%</p>
                                        <p><label>Norway:</label> 25%</p>
                                        <p><label>Panama:</label> 5%</p>
                                    </div>
                                    <div class="stat-column">
                                        <p><label>13-19 age:</label> 70%</p>
                                        <p><label>19-40 age:</label> 25%</p>
                                        <p><label>40+ age:</label> 5%</p>
                                    </div>
                                </div>
                                
                            </div><!-- ad-item -->
                            <?php
                        
                    }
                    ?>

                <?php }
                
                if (isset($_GET['action']) && $_GET['action'] == 'edit') {

                    $campaign = getCampaign(intval($_GET['cid']));
                    $id = $campaign['project_id'];


                    $countries = getCountries();
                    ?>
                    <div class="content-title">Select your thematic post:</div>

                    <form action="" method="post">
                        <div class="form-item no-height thematic">
                            <?php
                            $video = getFeaturingVideo($id);

                            if (!empty($video)) {
                                for ($i = 1; $i < 5; $i++) {
                                    ?>
                                    <div class="thematic_item">
                                        <label for="thematic_post_<?php echo $i; ?>" class="thematic_post_<?php echo $i; ?>"><img src="images/video_preview<?php echo $i; ?>.jpg" alt=""></label>
                                        <input type="radio" name="thematic_post[]" id="thematic_post_<?php echo $i; ?>" class="ad-thematic_post_<?php echo $i; ?>" value="<?php echo $i; ?>">
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <?php
                            $image = getFeaturedImage($id);

                            if (!empty($image)) {
                                ?>
                                <div class="thematic_item">
                                    <label for="thematic_post_5" class="thematic_post_5"><img src="uploads/images/thumbs/<?php echo $image['file_name']; ?>" alt="" width="244" height="143"></label>
                                    <input type="radio" name="thematic_post[]" id="thematic_post_5" class="ad-thematic_post_5" value="<?php echo $image['image_id']; ?>" onclick="document.getElementById('thematic_type').value = 'image';">
                                </div>
                                 <?php
                            }

                            $description = getFeaturedDescription($id);
                            if (!empty($description)) {
                                ?>
                                <div class="thematic_item">
                                    <label for="thematic_post_6" class="post_description thematic_post_6"><?php echo substr($description['content'], 0, 200); ?></label>
                                    <input type="radio" name="thematic_post[]" id="thematic_post_6" class="ad-thematic_post_6" value="<?php echo $description['description_id']; ?>" onclick="document.getElementById('thematic_type').value = 'description';">
                                </div>
                            <?php } ?>

                        </div>

                        </div> <!-- content-block-->

                        <div class="content-block create-ad">
                            <div class="content-title">Define your ad campaign:</div>
                            <div class="form-item"><label>Slogan:</label> <input type="text" name="slogan" id="slogan" placeholder="Enter marketing slogan" value="<?php echo $campaign['slogan']; ?>"></div>
                            <div class="form-item"><label>Headline:</label> <input type="text" name="headline" id="headline" placeholder="Enter marketing headline" value="<?php echo $campaign['headline']; ?>"></div>
                        </div> <!-- content-block-->

                        <div class="content-block create-ad">
                            <div class="content-title">Campaign strategy:</div>
                            <div class="form-item no-height"><label>Campaign Territory:</label>
                                <select name="country[]" id="country" size="10" multiple class="multiple">
                                    <?php
                                    
                                    $territory = $campaign['territory'];
                                    $territory_arr = explode(',', $territory);
                                    
                                    foreach ($countries as $country) {
                                        if (@in_array($country['name'], $territory_arr))
                                                $selected = 'selected';
                                        else 
                                            $selected = '';
                                        echo '<option value="' . $country['name'] . '" '.$selected.'>' . $country['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-item"><label>Age:</label>
                                <select name="min_age" id="min_age" class="age">
                                    <option>Min</option>
                                    <?php
                                    for ($i = 18; $i < 81; $i++){
                                        if ($i == $campaign['age_min'])
                                                $selected = 'selected';
                                        else 
                                            $selected = '';
                                        echo '<option value="' . $i . '" '.$selected.'>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                                -
                                <select name="max_age" id="max_age" class="age">
                                    <option>Max</option>
                                    <?php
                                    for ($i = 18; $i < 81; $i++) {
                                         if ($i == $campaign['age_max'])
                                                $selected = 'selected';
                                        else 
                                            $selected = '';
                                        
                                        echo '<option value="' . $i . '" '.$selected.'>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-item"><label>Gender:</label>
                                <select name="gender" id="gender">
                                    <option>Please Select</option>
                                    <option value="male" <?php if ($campaign['gender'] == 'male') echo 'selected'; ?>>Male</option>
                                    <option value="female" <?php if ($campaign['gender'] == 'female') echo 'selected'; ?>>Female</option>
                                </select>
                            </div>

                            <div class="form-item"><label>Budget Amount:</label>
                                <select name="currency" id="currency">
                                    <option>Currency</option>
                                    <option value="USD" selected>USD</option>
                                </select>
                                <input type="text" class="amount" name="amount" id="amount" placeholder="Amount" value="<?php echo $campaign['amount']; ?>">

                                <select name="time" id="time">
                                    <option>Time</option>
                                    <option value="1" <?php if ($campaign['time'] == 1) echo 'selected'; ?>>1 day</option>
                                    <option value="2" <?php if ($campaign['time'] == 2) echo 'selected'; ?>>1 week</option>
                                    <option value="3" <?php if ($campaign['time'] == 3) echo 'selected'; ?>>1 month</option>
                                </select>
                            </div>

                            <div class="form-item"><label>Schedule:</label>
                                <select name="schedule" id="schedule">
                                    <option value="1">Immediately</option>
                                </select>
                            </div>

                            <div class="form-item"><label>Link:</label>
                                <input type="text" name="link" id="link" placeholder="Enter URL" value="<?php echo $campaign['link']; ?>">
                            </div>


                        </div> <!-- content-block-->

                        <div class="content-block create-ad">
                            <div class="content-title">Preview:</div>
                            <div class="ad-preview">
                                <div class="ad-preview-thumb"><?php echo getAdThematic($campaign['thematic_type'], $campaign['thematic_id']); ?></div>
                                <div class="ad-preview-text">
                                    <div class="ad-preview-headline"><?php echo $campaign['headline']; ?></div>
                                        <div class="ad-preview-slogan"><?php echo $campaign['slogan']; ?></div>
                                </div>
                            </div>
                        </div> <!-- content-block-->

                        <input type="hidden" id="thematic_type" name="thematic_type" value="">
                        <input type="hidden" name="project_id" value="<?php echo $id; ?>">

                        <div class="finalize-ad">
                            <div class="form-item"><input type="submit" value="Finalize" class="get-connection" name="finalize_edit"> By clicking "Finalize", you agree to pay the amount due</div>
                        </div>
                    </form>
                    <?php
                }
                ?>



        </div>


    </div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>