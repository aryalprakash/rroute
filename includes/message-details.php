<div class="inbox-messages">
    <?php
    $participants = getMessageParticipants($_GET['conv']);
    if($participants['sender'] == $_SESSION['uid'] || $participants['recipient'] == $_SESSION['uid']) {
        $messages = getMessageDetails($_GET['conv']);
        foreach ($messages as $message) {
            $user = getUserData($message['sender']);
            ?>
            <div class="message-item">
                <div class="message-author">
                    <div class="router-user-photo">
                        <a href="<?php echo SITE_URL ?>/user.php?uid=<?php echo $message['sender']; ?>">
                            <?php if (empty($user['photo'])) { ?>
                                <img src="uploads/avatars/nophoto.jpg" alt="">
                            <?php } else { ?>
                                <img src="uploads/avatars/<?php echo $user['photo']; ?>" alt="">
                            <?php } ?>
                        </a>

                        <div class="router-user-name">
                            <a href="user.php?uid=<?php echo $user['user_id']; ?>"><?php echo ucwords($user['display_name']); ?></a>
                            <span class="comment-date"
                                  style="margin-left: 0;"><?php echo $message['created_on']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="message-content">
                    <?php echo $message['message']; ?>
                </div>
            </div>
        <?php }?>
<div class="message-content">
    <div class="answer-box" id="answer_1" >
 	<textarea></textarea>
    <div class="router-user-photo answer-photo">
        <a href="user.php?uid=<?php echo $user['user_id']; ?>">
		<?php if (empty($own_photo)) { ?>
        <img src="uploads/avatars/nophoto.jpg" alt="">
    <?php }
    else { ?>
        <img src="uploads/avatars/<?php echo $own_photo; ?>" alt="">
    <?php 	} ?>
    </a>
    <div class="you-are"></div>
</div>

<input class="submit-rounded answer-button" type="submit" value="Send" name="save_account" data-id="" data-user="" data-block="">

</div></div>

<?php    } else{
        ?>
        <div class="inbox-messages">
            <div class="featuring-text">Conversation not found.</div>
        </div>
        <?php
    }
    ?>

</div>