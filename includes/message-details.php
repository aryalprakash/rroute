<?php
$participants = getMessageParticipants($_GET['conv']);
if ($participants['sender'] == $_SESSION['uid'] || $participants['recipient'] == $_SESSION['uid']) {

if ($participants['sender'] == $_SESSION['uid']) {
    $conv_partner = $participants['recipient'];
} else {
    $conv_partner = $participants['sender'];
}
$messages = getMessageDetails($_GET['conv']);
?>
<div class="user-name-tops">
  <a href ="<?php echo SITE_URL;?>/user.php?uid=<?php echo $conv_partner?>">  <?php echo ucwords(getUserNameById($conv_partner)); ?></a>
</div>
<div class="inboxs-messages">

    <?php
    foreach ($messages as $message) {
        $user = getUserData($message['sender']);
        $recipent = $message['recipient'];
        if ($user['user_id'] == $_SESSION['uid']) {
            $classval = 'router-user-photo';
            $alignmessage = 'message-right';
            $alignphoto = 'photo-right';
        } else {
            $classval = 'router-user-photo';
            $alignmessage = 'message-left';
            $alignphoto = 'photo-left';
        }
        ?>
        <div class="message-items " style="border-top: none;">
            <div class="message-author">
                <div class="message-photo <?php echo $classval.' '.$alignphoto; ?>">
                    <a href="<?php echo SITE_URL ?>/user.php?uid=<?php echo $message['sender']; ?>">
                        <?php if (empty($user['photo'])) { ?>
                            <img src="uploads/avatars/nophoto.jpg"
                                 title="<?php $dates = strtotime($message['created_on']);
                                 echo date("g:i A m/d/Y", $dates); ?>">
                        <?php } else { ?>
                            <img src="uploads/avatars/<?php echo $user['photo']; ?>"
                                 alt="<?php $dates = strtotime($message['created_on']);
                                 echo date("g:i A m/d/Y", $dates); ?>">
                        <?php } ?>
                    </a>
                </div>
            </div>
            <div class=" <?php echo $alignmessage; ?> ">
                <?php echo $message['message']; ?>
            </div>
        </div>
    <?php } ?>


    <div class="message-item" style="border-top: none;"><?php
        $own = getUserData($_SESSION['uid']);
        $own_photo = $own['photo']; ?>
        <div class="answer-box" id="answer_<?php echo $_GET['conv']; ?>">
            <textarea name="message" id="message" placeholder="Enter Message."></textarea>

            <div class="router-user-photo answer-photo">
                <a href="user.php?uid=<?php echo $own['user_id']; ?>">
                    <?php if (empty($own_photo)) { ?>
                        <img src="uploads/avatars/nophoto.jpg" alt="<?php $dates = strtotime($message['created_on']);
                        echo date("g:i A m/d/Y", $dates); ?>">
                    <?php } else { ?>
                        <img src="uploads/avatars/<?php echo $own_photo; ?>"
                             alt="<?php $dates = strtotime($message['created_on']);
                             echo date("g:i A m/d/Y", $dates); ?>">
                    <?php } ?>
                </a>

                <div class="you-are"></div>
            </div>

            <input class="submit-rounded answer-button" type="submit" value="Send" name="save_account"
                   data-id="<?php echo $_GET['conv'] ?>"
                   data-user="<?php echo getMessageRecipient($_GET['conv']); ?>"
                   data-block="<?php echo $_SESSION['uid']; ?>"
                   data-photo="<?php
                   if (empty($own_photo)) {
                       echo 'uploads/avatars/nophoto.jpg';
                   } else {
                       echo $own_photo;
                   }
                   ?>"
                   data-time="<?php echo date("g:i A m/d/Y", $dates); ?>"
                   method="post">

            <div id="reply-ans"></div>

        </div>
    </div>

    <?php } else {
        ?>
        <div class="featuring-text"></div>
        <div class="inbox-messages">
            <div class="featuring-text">Conversation not found.</div>
        </div>
        <?php
    }
    ?>

</div>
<script>
    $(document).ready(function(){
        $('.inbox-messages').scrollTop($(".answer-box").offset().top);
    })
</script>