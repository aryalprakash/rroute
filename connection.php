<?php
include('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');
?>

    <div class="inner-page-wrapper">

        <div class="connection inner-page content">

            <?php include(DIR_INCLUDE . 'left_nav.php');
            $search_str = '';
            $routers = getRoutersForUser($_SESSION['uid'], $search_str);

            if (!empty($routers))
                $connections = '(' . count($routers) . ')';
            else
                $connections = '';

            ?>


            <div class="main-content connection-content">

                <ul class="router-top-nav">
                    <li class="active"><a href="connection.php">Connection <?php $connections; ?></a></li>
                    <li><a href="communication.php">Communication</a></li>
                </ul>

                <div class="content-block">
                    <div class="search-connection">
                        <form action="" method="post">
                            <input type="text" name="search_connection"
                                   value="<?php if (isset($_POST['search_connection'])) echo $_POST['search_connection']; ?>"
                                   placeholder="Search Connection">
                            <input type="submit" name="search">
                            <input type="button" value="Get Connection" class="get-connection"
                                   onclick="window.location='communication.php?mode=create'">
                        </form>
                    </div>


                    <div class="connection-list">
                        <?php
                        if (isset($_POST['search']))
                            $search_str = $_POST['search_connection'];
                        else $search_str = '';

                        //$routers = getRoutersForUser($_SESSION['uid'], $search_str);
                        if (!empty($routers)) {
                            foreach ($routers as $router) {
                                $u = getUserData($router['user_id']); ?>
                                <div class="user-photo">
                                    <?php if (empty($u['photo'])) {
                                        echo '<a href="user.php?uid=' . $u['user_id'] . '"><img src="uploads/avatars/nophoto.jpg" alt=""></a>';
                                    } else {
                                        echo '<a href="user.php?uid=' . $u['user_id'] . '"><img src="uploads/avatars/' . $u['photo'] . '" alt=""></a>';
                                    }
                                    ?>
                                    <div class="name-block"><?php echo $u['display_name']; ?></div>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>

                </div>

            </div>


        </div> <!-- account inner-page content -->

        <?php include(DIR_INCLUDE . 'right_side.php'); ?>

    </div> <!-- inner-page-wrapper -->

<?php include(DIR_INCLUDE . 'footer.php'); ?>