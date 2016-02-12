<?php

require_once('config.php');
//if(isset($_POST['dispatcher']))
$action =$_POST['dispatcher'];

switch ($action) {
    case 'login':
        $user_id = login($_POST['email'], $_POST['password'], $_POST['remember']);

        if ($user_id)
            $responce['result'] = 'OK';
        else
            $responce['result'] = '';
        echo json_encode($responce);

        break;

    case 'add-developer':
        require_once(DIR_APP . 'users.php');
        $id = addDeveloper($_POST);

        if (!empty($id)) {
            $responce['result'] = 'OK';
            $responce['id'] = $id;
        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;

    case 'rate-project':
        require_once(DIR_APP . 'projects.php');
        require_once(DIR_APP . 'users.php');
        $id = rateProject($_POST['project_id'], $_POST['user_id'], $_POST['value']);
        if ($id) {
            $project_title = getProjectTitle($_POST['project_id']);
            $sent_to = getProjectAuthor($_POST['project_id']);
            $author = getUserNameById($_POST['user_id']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $text = $author . ' rated project ' . $project_title;
            addNotification($sent_to, $text, $_POST['user_id'], $url);
            addInteraction($_SESSION['uid'], 'rate', $sent_to, 'project', $_POST['project_id']);
            $responce['result'] = 'OK';

        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;

    case 'route-project':
        require_once(DIR_APP . 'projects.php');
        $id = AddProjectRouter($_POST['project_id'], $_SESSION['uid']);

        if (!empty($id)) {
            $responce['result'] = 'OK';
            $responce['id'] = $id;
        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;

    case 'remove-route-project':
        require_once(DIR_APP . 'projects.php');
        $id = RemoveProjectRouter($_POST['project_id'], $_SESSION['uid']);

        if (!empty($id)) {
            $responce['result'] = 'OK';
            $responce['id'] = $id;
        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;


    case 'like-project':
        require_once(DIR_APP . 'projects.php');
        require_once(DIR_APP . 'users.php');
        $id = AddProjectLike($_POST['project_id'], $_SESSION['uid']);

        if (!empty($id)) {
            $likes = getLikes($_POST['project_id']);

            $responce['result'] = 'OK';
            $responce['id'] = $id;
            $responce['likes'] = $likes;

            $project_title = getProjectTitle($_POST['project_id']);
            $sent_to = getProjectAuthor($_POST['project_id']);
            $author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $text = ucwords($author) . ' liked project ' . $project_title;
            addNotification($sent_to, $text, $_SESSION['uid'], $url);

            addInteraction($_SESSION['uid'], 'like', $sent_to, 'project', $_POST['project_id']);

        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;

    case 'like-idea':
        require_once(DIR_APP . 'projects.php');
        require_once(DIR_APP . 'users.php');
        $id = AddIdeaLike($_POST['ideathread_id'], $_SESSION['uid']);

        if (!empty($id)) {
            $likes = getIdeaLikes($_POST['ideathread_id']);
            $responce['result'] = 'OK';
            $responce['id'] = $id;
            $responce['likes'] = $likes;

            $ideathread_title = getIdeaTitle($_POST['ideathread_id']);
            $sent_to = getIdeaAuthor($_POST['ideathread_id']);
            $author = getUserNameById($sent_to);
            $user = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?iid=' . $_POST['ideathread_id'];
            $text = '<i>' . ucwords($user) . '</i>' . ' liked your ideathread ' . '<i>' . $ideathread_title . '</i>';

            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            plusInteraction($_POST['ideathread_id']);


            addInteraction($_SESSION['uid'], 'like', $sent_to, 'ideathread', $_POST['ideathread_id']);

        } else
            $responce['result'] = '';

        echo json_encode($responce);
        //print_r(json_encode($response));
        break;

    case 'remove-like-project':
        require_once(DIR_APP . 'projects.php');
        $id = RemoveProjectLike($_POST['project_id'], $_SESSION['uid']);

        if (!empty($id)) {
            $likes = getLikes($_POST['project_id']);
            $responce['result'] = 'OK';
            $responce['id'] = $id;
            $responce['likes'] = $likes;
        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;


    case 'remove-like-idea':
        require_once(DIR_APP . 'projects.php');
        $id = RemoveIdeaLike($_POST['ideathread_id'], $_SESSION['uid']);
        minusInteraction($_POST['ideathread_id']);

        if (!empty($id)) {
            $likes = getIdeaLikes($_POST['ideathread_id']);
            $responce['result'] = 'OK';
            $responce['id'] = $id;
            $responce['likes'] = $likes;
        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;


    case 'reply':
        require_once(DIR_APP . 'users.php');
        $res = sendMessage($_POST);
        //print_r($res);

        if ($res) {
            $responce['result'] = 'OK';
        } else
            $responce['result'] = '';

        echo json_encode($responce);

        break;

    case 'add-comment':
        require_once(DIR_APP . 'projects.php');
        require_once(DIR_APP . 'users.php');
        $id = addComment($_POST['project_id'], $_SESSION['uid'], $_POST['text']);


        if (!empty($id)) {
            $responce['result'] = 'OK';
            $responce['id'] = $id;

            $project_title = getProjectTitle($_POST['project_id']);
            $sent_to = getProjectAuthor($_POST['project_id']);
            $author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $text = $author . ' commented on your project ' . $project_title;
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            addInteraction($_SESSION['uid'], 'comment', $sent_to, 'project', $_POST['project_id']);

            $messages = getComments($_POST['project_id']);
            $content = '';
            foreach ($messages as $ix => $m) {
                $content .= '<div class="message-item';
                if (($ix % 2) == 0)
                    $content .= ' odd';
                $content .= '" data-id="' . $ix . '">
 						<div class="message-author">';


                $u = getUserData($m['created_by']);

                $content .= '<div class="router-user-photo">
        				<a href="user.php?uid=' . $u['user_id'] . '">';
                if (empty($u['photo'])) {
                    $content .= '<img src="uploads/avatars/nophoto.jpg" alt="">';
                } else {
                    $content .= '<img src="uploads/avatars/' . $u['photo'] . '" alt="">';
                }
                $content .= '</a>
						<div class="router-user-name">
						<a href="user.php?uid=' . $u['user_id'] . '">' . $u['first_name'] . '<br>' . $u['last_name'] . '</a>
						</div>
						</div>
						<div class="comment-date">' . $m['created_on'] . '</div>
						</div>
					 	<div class="message-content" data-id="' . $ix . '">' . $m['text'] . '</div>';

                if ($m['created_by'] == $_SESSION['uid'])
                    $content .= '<div class="delete delete_' . $m['comment_id'] . '" data-id="' . $m['comment_id'] . '" onclick="deleteComment(' . $m['comment_id'] . ')"></div>';

                $content .= '</div>';
            }

            $responce['content'] = $content;
        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;

    case 'add-idea-comment':
        require_once(DIR_APP . 'projects.php');
        require_once(DIR_APP . 'users.php');
        $id = addIdeaComment($_POST['ideathread_id'], $_SESSION['uid'], $_POST['text']);
        plusInteraction($_POST['ideathread_id']);

        if (!empty($id)) {
            $responce['result'] = 'OK';
            $responce['id'] = $id;

            $ideathread_title = getIdeaTitle($_POST['ideathread_id']);
            $sent_to = getIdeaAuthor($_POST['ideathread_id']);
            $author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?iid=' . $_POST['ideathread_id'];
            $text = ucwords($author) . ' commented on your ideathread ' . $ideathread_title;
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            addInteraction($_SESSION['uid'], 'comment', $sent_to, 'ideathread', $_POST['ideathread_id']);

            $messages = getIdeaComments($_POST['ideathread_id']);

            $content = '';
            foreach ($messages as $ix => $m) {
                $content .= '<div class="message-item';
                if (($ix % 2) == 0)
                    $content .= ' odd';
                $content .= '" data-id="' . $ix . '">
 						<div class="message-author">';

                $u = getUserData($m['created_by']);

                $content .= '<div class="router-user-photo">
        				<a href="user.php?uid=' . $u['user_id'] . '">';
                if (empty($u['photo'])) {
                    $content .= '<img src="uploads/avatars/nophoto.jpg" alt="">';
                } else {
                    $content .= '<img src="uploads/avatars/' . $u['photo'] . '" alt="">';
                }
                $content .= '</a>
						<div class="router-user-name">
						<a href="user.php?uid=' . $u['user_id'] . '">' . $u['first_name'] . '<br>' . $u['last_name'] . '</a>
						</div>
						</div>
						<div class="comment-date">' . $m['created_on'] . '</div>
						</div>
					 	<div class="message-content" data-id="' . $ix . '">' . $m['text'] . '</div>';

                if ($m['created_by'] == $_SESSION['uid'])
                    $content .= '<div class="delete delete_' . $m['comment_id'] . '" data-id="' . $m['comment_id'] . '" onclick="deleteComment(' . $m['comment_id'] . ')"></div>';

                $content .= '</div>';
            }

            $responce['content'] = $content;
        } else
            $responce['result'] = '';

        echo json_encode($responce);
        break;

    case 'report-project':
        require_once(DIR_APP . 'projects.php');
        reportProject($_POST['project_id'], $_POST['copyright'], $_POST['spam'], $_POST['violent'], $_POST['abusive'], $_POST['impersonation'], $_POST['harassment']);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;

    case 'delete-comment':
        require_once(DIR_APP . 'projects.php');

        deleteComment($_POST['comment_id']);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;

    case 'delete-idea-comment':
        require_once(DIR_APP . 'projects.php');

        deleteIdeaComment($_POST['comment_id']);
        minusInteraction($_POST['ideathread_id']);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;

    case 'delete-idea':
        require_once(DIR_APP . 'projects.php');
        deleteIdea($_POST['ideathread_id']);
        $response['result'] = 'OK';
        echo json_encode($response);
        break;
    case 'delete-investor':
        require_once(DIR_APP . 'projects.php');
        require_once(DIR_APP . 'users.php');
        $investor_id=$_POST['investor_id'];
//        $company_name = getInvestorName($investor_id);
//        $url = '';
//        $text = 'You have deleted  "' . $company_name . '" investor profile.';
//        addNotification($investor_id, $text, $_SESSION['uid'], $url);
        deleteInvestor($investor_id);
        $response['result'] = 'OK';
        echo json_encode($response);
        break;

    case 'delete-ideathread':
        require_once(DIR_APP . 'projects.php');
        $project_title = getIdeaTitle($_POST['ideathread_id']);
        //$author = getUserNameById($_SESSION['uid']);
        $sent_to = getIdeaAuthor($_POST['ideathread_id']);
        // $url = SITE_URL . '/home.php?iid=' . $_POST['ideathread_id'];
        $url = '';
        $text = 'Your Ideathread  "' . $project_title . '" has been removed.';
        addNotification($sent_to, $text, $_SESSION['uid'], $url);
        deleteIdea($_POST['ideathread_id']);
        $response['result'] = 'OK';
        echo json_encode($response);
        break;
    case 'delete-project':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $project_title = getProjectTitle($_POST['project_id']);
        //$author = getUserNameById($_SESSION['uid']);
        $url = '';
        $sent_to = getProjectAuthor($_POST['project_id']);
        $text = 'Your Project  "' . $project_title . '" has been removed.';
        addNotification($sent_to, $text, $_SESSION['uid'], $url);
        deleteProject($_POST['project_id']);
        $response['result'] = 'OK';
        echo json_encode($response);
        break;
    case 'delete-blogpost':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $project_title = getBlogPostTitle($_POST['post_id']);
        //$author = getUserNameById($_SESSION['uid']);
        $url = '';
        $sent_to = getBlogPostAuthor($_POST['post_id']);
        $text = 'Your Blog Post  "' . $project_title . '" has been removed.';
        addNotification($sent_to, $text, $_SESSION['uid'], $url);
        deleteBlogPost($_POST['post_id']);
        $response['result'] = 'OK';
        echo json_encode($response);
        break;
    case 'accept-route':
        require_once(DIR_APP . 'users.php');

        acceptRoute($_POST['routed_by'], $_POST['user_id'], $_POST['notify_id']);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;

    case 'decline-route':
        require_once(DIR_APP . 'users.php');

        declineRoute($_POST['routed_by'], $_POST['user_id'], $_POST['notify_id']);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;


    case 'share-project':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');

        $routed = $_POST['routed'];

        if ($routed) {
            addSuggestion($_POST['project_id'], $_POST['sent_to'], $_SESSION['uid']);

            $project_title = getProjectTitle($_POST['project_id']);
            $author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $text = $author . ' suggested project ' . $project_title;
            addNotification($_POST['sent_to'], $text, $_SESSION['uid'], $url);
        } else
            deleteSuggestion($_POST['project_id'], $_POST['sent_to'], $_SESSION['uid']);


        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;

    case 'add-transaction':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');

        $project_id = $_POST['project_id'];
        $project_title = $_POST['project_title'];
        $user_id = $_SESSION['uid'];
        $author_id = $_POST['created_by'];
        $amount = $_POST['amount'];

        addTransaction($user_id, $amount, $project_title, $project_id, $author_id);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;

    case 'notifyOwner':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');

        $project_id = $_POST['project_id'];
        $project_title = $_POST['project_title'];
        $user_id = $_SESSION['uid'];
        $author_id = $_POST['created_by'];
        $user_name = getUserNameById($_SESSION['uid']);
        $url = SITE_URL . '/home.php?iid=' . $project_id;
        $text = $user_name . ' wants to view your project ' . $project_title;

        addNotification($author_id, $text, $user_id, $url);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;


    case 'read-notifications':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');

        $user_id = $_SESSION['uid'];
        readNotifications($user_id);

        $responce['result'] = 'OK';

        echo json_encode($responce);
        break;


    case 'route-this-project':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $id = AddProjectRouter($_POST['project_id'], $_SESSION['uid'], $_POST['sent_to']);
        if (!empty($id)) {
            $responce['result'] = 'OK';
            $responce['id'] = $id;
            $responce['user_id'] = $_POST['sent_to'];
            $responce['user'] = getUserNameById($_POST['sent_to']);
            addSuggestion($_POST['project_id'], $_POST['sent_to'], $_SESSION['uid']);
            $project_title = getProjectTitle($_POST['project_id']);
            $author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $text = $author . ' suggested project ' . $project_title;
            addNotification($_POST['sent_to'], $text, $_SESSION['uid'], $url);
        } else {
            $responce['result'] = 'FALSE';
        }

        echo json_encode($responce);
        break;

    case 'unroute-this-user':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $user = getUserNameById($_POST['user_id']);
        if (RemoveRouterId($_POST['router_id'])) {
            $responce['result'] = 'OK';
            $responce['router_id'] = $_POST['router_id'];
            $responce['user'] = $user;
        } else {
            $responce['result'] = 'FALSE';
        }
        echo json_encode($responce);
        break;

    case 'search-route-user-lists':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $title = $_POST['title'];
        $user_id = $_SESSION['uid'];
        if (getUserNameBySearch($title, $user_id)) {
            $responce['result'] = 'OK';
        }

//        if(RemoveRouterId($_POST['router_id'])){
//            $responce['result'] = 'OK';
//            $responce['router_id'] = $_POST['router_id'];
//        }

         //echo json_encode($responce);
        break;

    case 'apply-for-fund':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $project_id = $_POST['project_id'];
        $user_id = $_SESSION['uid'];
        $investor_id=$_POST['investor_id'];
        applyProject($project_id,$investor_id);
        $project_title = getProjectTitle($project_id);
        //$author = getUserNameById($_SESSION['uid']);
        $url = SITE_URL . '/home.php?pid=' . $project_id;
        $sent_to = getProjectAuthor($project_id);
        $text = 'Your Project  "' . $project_title . '" has been Applied for funding.We Will notify you back when project is reviewed.';
        addNotification($sent_to, $text, $_SESSION['uid'], $url);
        $responce['result']='OK';
        echo json_encode($responce);
        break;
    case 'accept-project':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $project_id = $_POST['project_id'];
        $res = updateStatusProject($project_id);
        if ($res == 'accepted') {
            $project_title = getProjectTitle($_POST['project_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $sent_to = getProjectAuthor($_POST['project_id']);
            $text = 'Your Project  "' . $project_title . '" has been Published.';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'OK';
        } else {
            $project_title = getProjectTitle($_POST['project_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $sent_to = getProjectAuthor($_POST['project_id']);
            $text = 'Your Project  "' . $project_title . '" has been Unpublished.';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'reject';
        }
        echo json_encode($responce);
        break;

    case 'accept-ideathread':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $ideathread_id = $_POST['ideathread_id'];
        $res = updateStatusIdea($ideathread_id);
        if ($res == 'accepted') {
            $project_title = getIdeaTitle($_POST['ideathread_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?iid=' . $_POST['ideathread_id'];
            $sent_to = getIdeaAuthor($_POST['ideathread_id']);
            $text = 'Your Project  "' . $project_title . '" has been Published.';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'OK';
        } else {
            $project_title = getIdeaTitle($_POST['ideathread_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?iid=' . $_POST['ideathread_id'];
            $sent_to = getIdeaAuthor($_POST['ideathread_id']);
            $text = 'Your Project  "' . $project_title . '" has been Unpublished.';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'reject';
        }
        echo json_encode($responce);
        break;
    case 'accept-blogpost':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $post_id = $_POST['post_id'];
        $res = updateStatusBlogPost($post_id);
        if ($res == 'accepted') {
            $project_title = getBlogPostTitle($_POST['post_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/blog.php?id=' . $_POST['post_id'];
            $sent_to = getBlogPostAuthor($_POST['post_id']);
            $text = 'Your Blog Post  "' . $project_title . '" has been Published.';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'OK';
        } else {
            $project_title = getBlogPostTitle($_POST['post_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/blog.php?id=' . $_POST['post_id'];
            $sent_to = getBlogPostAuthor($_POST['post_id']);
            $text = 'Your Blog Post  "' . $project_title . '" has been Unpublihed.';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'reject';
        }
        echo json_encode($responce);
        break;
    case 'reject-blogpost':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $post_id = $_POST['post_id'];

        $res =rejectBlogPost($post_id);
        $project_title = getBlogPostTitle($post_id);
            //$author = getUserNameById($_SESSION['uid']);
        $url = SITE_URL . '/blog.php?id=' . $post_id;
        $sent_to = getBlogPostAuthor($post_id);
        $text = 'Your Blog Post  "'.  $project_title.'" has been Rejected.';
        addNotification($sent_to, $text, $_SESSION['uid'], $url);
        $responce['result'] = 'OK';
        echo json_encode($responce);
        break;
    case 'reject-ideathread':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $ideathread_id = $_POST['ideathread_id'];
        $res = rejectIdeathread($ideathread_id);
        $project_title = getIdeaTitle($ideathread_id);
        //$author = getUserNameById($_SESSION['uid']);
        $url = SITE_URL . '/home.php?iid=' . $ideathread_id;
        $sent_to = getIdeaAuthor($ideathread_id);
        $text = 'Your Ideathread  "' . $project_title . '" has been Rejected.';
        addNotification($sent_to, $text, $_SESSION['uid'], $url);
        $responce['result'] = 'OK';
        echo json_encode($responce);
        break;
    case 'reject-project':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $project_id = $_POST['project_id'];
        $res = rejectProject($project_id);
        $project_title = getProjectTitle($project_id);
        //$author = getUserNameById($_SESSION['uid']);
        $url = SITE_URL . '/home.php?iid=' . $project_id;
        $sent_to = getProjectAuthor($project_id);
        $text = 'Your Ideathread  "' . $project_title . '" has been Rejected.';
        addNotification($sent_to, $text, $_SESSION['uid'], $url);
        $responce['result'] = 'OK';
        echo json_encode($responce);
        break;

    case 'accept-user':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $user_id = $_POST['user_id'];
        $res = updateStatusUser($user_id);
        if ($res == 'accepted') {
            //$project_title = getIdeaTitle($_POST['ideathread_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/user.php?uid=' . $user_id;
            $sent_to = $user_id;//getIdeaAuthor($_POST['ideathread_id']);
            $text = 'Your Profile has been Verified.';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'OK';
        } else {
            //$project_title = getIdeaTitle($_POST['ideathread_id']);
            //$author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/user.php?uid=' . $user_id;
            $sent_to = $user_id;
            $text = 'Your verification has been canceled!';
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'reject';
        }
        echo json_encode($responce);
        break;
    case 'publish-investor':
        require_once(DIR_APP . 'users.php');
        require_once(DIR_APP . 'projects.php');
        $investor_id = $_POST['investor_id'];
        $res = updateStatusInvestor($investor_id);
        if ($res == 'accepted') {
            //$project_title = getIdeaTitle($_POST['ideathread_id']);
            //$author = getUserNameById($_SESSION['uid']);
            //$url = SITE_URL . '/user.php?iuid=' . $investor_id;
            //$sent_to =$user_id;//getIdeaAuthor($_POST['ideathread_id']);
            //$text = 'Your Profile has been Verified.';
            //addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'OK';
        } else {
            //$project_title = getIdeaTitle($_POST['ideathread_id']);
            //$author = getUserNameById($_SESSION['uid']);
            //$url = SITE_URL . '/user.php?uid=' . $user_id;
            //$sent_to = $user_id;
            //$text = 'Your verification has been canceled!';
            //addNotification($sent_to, $text, $_SESSION['uid'], $url);
            $responce['result'] = 'reject';
        }
        echo json_encode($responce);
        break;
    case 'admin-rate-project':
        require_once(DIR_APP . 'projects.php');
        require_once(DIR_APP . 'users.php');
        $value= array(
//            'project_id'=>$_POST['project_id'],
//            //'user_id'=>$_POST['user_id'],
//            'fes'=>$_POST['f_value'],
//            'uni'=>$_POST['u_value'],
//            'gro'=>$_POST['g_value'],
//            'sta'=>$_POST['s_value'],
//            'pro'=>$_POST['p_value'],
//            'ris'=>$_POST['r_value'],
//            'tim'=>$_POST['t_value'],
//            'red'=>$_POST['rd_value'],
//            'imp'=>$_POST['i_value'],
//            'prf'=>$_POST['pr_value'],
    );  $value['project_id']= $_POST['project_id'];
        $value['fes']= $_POST['f_value'];
        $value['uni']= $_POST['u_value'];
        $value['gro']= $_POST['g_value'];
        $value['sta']= $_POST['s_value'];
        $value['pro']= $_POST['p_value'];
        $value['ris']= $_POST['r_value'];
        $value['tim']= $_POST['t_value'];
        $value['red']= $_POST['rd_value'];
        $value['imp']= $_POST['i_value'];
        $value['prf']= $_POST['pr_value'];
      //  print_r($value);
        $data=json_encode($value,true);
        $id = AdminRateProject($value);
        //print_r($id);
        if ($id) {
            $score=calculate_mr($_POST['project_id']);
            updateProjectSeed($_POST['project_id'],$score);
            $project_title = getProjectTitle($_POST['project_id']);
            $sent_to = getProjectAuthor($_POST['project_id']);
            $author = getUserNameById($_SESSION['uid']);
            $url = SITE_URL . '/home.php?pid=' . $_POST['project_id'];
            $text = $author . ' rated project ' . $project_title;
            addNotification($sent_to, $text, $_SESSION['uid'], $url);
            addInteraction($_SESSION['uid'], 'rate', $sent_to, 'project', $_POST['project_id']);
            $responce['result'] = 'OK';

       } else {
            $responce['result'] = '';
        }
        echo json_encode($responce);
        break;
}
?>