<?php
include ('includes/header.php');

require_once(DIR_APP.'projects.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');

$sent = false;
if (isset($_POST['send'])) {
    $sent  = sendMessage($_POST);
}
/* for sending reply */
if(isset($_POST['send'])){
    $sendreply=sendMessage($_POST);
}
/* 2015-12-23*/
if(isset($_GET['conv'])){
    $mode = 'details';
}
else if (isset($_GET['mode']) && $_GET['mode'] == 'create')
    $mode = 'create';
else
    $mode = 'show';
?>

    <div class="inner-page-wrapper">

    <div class="communication inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php');

$routers = getRoutersForUser($_SESSION['uid'], '');
if (!empty($routers))
    $connections = '('.count($routers).')';
else
    $connections = '';
?>


    <div class="main-content">

        <ul class="router-top-nav">
            <li><a href="connection.php">Connection <?php echo $connections; ?></a></li>
            <li class="active"><a href="communication.php">Communication</a></li>
        </ul>

        <div class="content-block">
            <div class="search-connection">
                <form action="" method="post">
                    <input type="button" value="Inbox" class="inbox-btn <?php if ($mode == 'show') echo 'active'; ?>" onclick="window.location='communication.php?mode=inbox'">
                    <input type="button" value="Create" class="create-message-btn <?php if ($mode == 'create') echo 'active'; ?>" onclick="window.location='communication.php?mode=create'">

                    <a href="communication.php?mode=create" class="inbox-settings">Settings</a>

                    <input type="hidden" name="search_connection" value="<?php if (isset($_POST['search_connection'])) echo $_POST['search_connection']; ?>" placeholder="Search">
<!--                    <input type="submit" name="search">-->

                </form>
            </div>

            <?php if ($mode == 'create') { ?>
            <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
            <script type="text/javascript">
                tinymce.init({
                    selector: "textarea"
                });
            </script>
            <div class="create-message-block">
                <?php if ($sent) { ?>
                    <div class="form-item send-result">Your message to <?php echo $_POST['recipient'] ?> has been sent</div>
                <?php } ?>
                <form id="create-message" action="" method="post">
                    <div class="form-item"><label>Recipient:</label> <input type="text" name="recipient" placeholder="Start to type name of recipient" id="recipient"></div>
                    <div class="form-item no-height message-box">
                        <label>Message:</label>
                        <textarea name="message" id="message"></textarea>
                    </div>
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="form-item"><input type="submit" value="Send" class="upload-next send-message-btn" name="send"></div>

                </form>
                <div> <!-- create-message-block -->




                    <?php }

                    if($mode == 'details'){
                        include 'includes/message-details.php';
                    }
                    else {
                        $messages = getInboxMessages($_SESSION['uid']);

                        if ($messages) {

                            $own = getUserData($_SESSION['uid']);
                            $own_photo = $own['photo'];?>
                            <div class="inbox-messages">
                            <?php
                            $myconversations = getConversations($_SESSION['uid']);
                    //print_r($myconversations);
                    foreach ($myconversations as $ix =>$conversation) {
                        $conversation_id = $conversation['com_id'];
                        if ($conversation['recipient'] == $_SESSION['uid']) {
                            $nextuser = $conversation['sender'];
                        } else $nextuser = $conversation['recipient'];

                        ?>
                        <?php $u = getUserData($nextuser);
                        getLastMessage($conversation_id,$nextuser,'ASC');if(!empty(getLastMessage($conversation_id,$nextuser,'ASC'))){
                        ?>
                        <div class="message-item odd" data-id="<?php echo $ix; ?>">
                            <div class="message-author">

                                <div class="router-user-photo">
                                    <a href="user.php?uid=<?php echo $u['user_id']; ?>">
                                        <?php if (empty($u['photo'])) { ?>
                                            <img src="uploads/avatars/nophoto.jpg" alt="">
                                        <?php } else { ?>
                                            <img src="uploads/avatars/<?php echo $u['photo']; ?>" alt="">
                                        <?php } ?>
                                    </a>

                                    <div class="router-user-name">
                                        <a href="user.php?uid=<?php echo $u['user_id']; ?>"><?php echo ucwords($u['display_name']); ?></a>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo SITE_URL?>/communication.php?conv=<?php echo $conversation_id;?>"><div class="message-content" data-id="<?php echo $conversation_id; ?>"><?php echo  getLastMessage($conversation_id,$nextuser);  ?>
                                </div>
                            </a>

                            </div> <?php }?>




                    <?php }?>
                            </div><!-- inbox-message -->

                        <?php
                        }
                        }
                        ?>

                </div>

            </div>


        </div> <!-- account inner-page content -->

        <?php include (DIR_INCLUDE.'right_side.php'); ?>

    </div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>