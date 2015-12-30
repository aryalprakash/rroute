$(document).ready(function () {

    //login
    $("#login_submit").click(function () {
        var email = $('#user_email').val();
        var password = $('#user_password').val();
        var remember = 0;

        if ($("#keep_me_logged").prop("checked"))
            remember = 1;
        //check username and pass
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {email: email, password: password, remember: remember, dispatcher: 'login'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    window.location = 'home.php';
                }
                else {
                    alert('Invalid username or password');
                }
            },
            dataType: "json"

        });

        return false;
    });


    $(".signup-tabs ul li").click(function () {
        var selected_tab = $("li").index(this);
        var user_type = selected_tab + 1;

        if (!user_type)
            user_type = 3;

        $(".signup-tabs ul li").removeClass('active');
        $(this).toggleClass('active');
        $("#user_type").val(user_type);

    });


    $("#replace-photo").click(function () {
        $("input[id='upload_file']").click();
    });

    $("#remove-photo").click(function () {
        $('.avatar-img').attr('src', 'uploads/avatars/nophoto.jpg');
        $('#user_photo').val('');
        $('#photo_updated').val('1');
    });


    $(".add-developer").click(function () {
        $(".add-developer-form").css('display', 'block');
    });


    $("#add-developer-btn").click(function () {
        var name = $('#developer_name').val();
        var email = $('#developer_email').val();
        var spec = $('#developer_spec').val();
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {name: name, email: email, spec: spec, dispatcher: 'add-developer'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('#project_developer')
                        .append($("<option></option>")
                            .attr("value", data['id'])
                            .attr("selected", "selected")
                            .text(name));

                    $('#developer_name').val('');
                    $('#developer_email').val('');
                    $('#developer_spec').val('');

                    $('.add-developer-form').css('display', 'none');
                }
            },
            dataType: "json"

        });

        return false;
    });


    $(".upload-video").click(function () {
        $("input[id='upload_video']").click();
    });

    $(".upload-image").click(function () {
        $("input[id='upload_image']").click();
    });
    $(".upload-product-image").click(function () {
        $("input[id='upload_product_image']").click();
    });

    $(".upload-image-1").click(function () {
        $("input[id='upload_picture_1']").click();

        return false;
    });

    $(".upload-image-2").click(function () {
        $("input[id='upload_picture_2']").click();

        return false;
    });

    $(".upload-image-3").click(function () {
        $("input[id='upload_picture_3']").click();

        return false;
    });

    $(".upload-image-4").click(function () {
        $("input[id='upload_picture_4']").click();

        return false;
    });

    $(".upload-image-5").click(function () {
        $("input[id='upload_picture_5']").click();

        return false;
    });


    /*rate project*/
    $("#rate_project").click(function () {
        $('.rate-area').slideDown('slow');
        $('.comment-area').css('display', 'none');
        $('.report-area').css('display', 'none');
        $('.route-area').css('display', 'none');
        $('.homeshare-area').css('display', 'none');

        return false;
    });
    $("#save_rate_project").click(function () {
        var project_id = $(this).attr('data-id');
        var user_id = $(this).attr('data-user');
        var value = $('#rating_value').val();

        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {project_id: project_id, user_id: user_id, value: value, dispatcher: 'rate-project'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('#rate_project').html('Rated');
                    $('#rate_project').css('opacity', '0.6');
                    $('.rate-area').slideUp('slow');
                }
            },
            dataType: "json"
        });
        return false;
    });
    /*end unlike project*/


    /*route project*/
    //$("#route_project").click(function () {
    //
    //    $('.route-area').slideDown('slow');
    //
    //    var project_id = $(this).attr('data-id');
    //    $.ajax({
    //        type: 'POST',
    //        url: "includes/ajaxDispatcher.php",
    //        data: {project_id: project_id, dispatcher: 'route-project'},
    //        error: function (req, text, error) {
    //            alert('Error AJAX: ' + text + ' | ' + error);
    //        },
    //        success: function (data) {
    //            if (data['result'] == 'OK') {
    //                $('#route_project').css('display', 'none');
    //                $('#routed_project').css('display', 'block');
    //                $('#routed_project').css('opacity', '0.6');
    //            }
    //        },
    //        dataType: "json"
    //    });
    //    return false;
    //});
    /*end route project*/


    /*unroute project*/
    $("#routed_project").click(function () {

        $('.route-area').slideDown('slow');

        var project_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {project_id: project_id, dispatcher: 'remove-route-project'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('#routed_project').css('display', 'none');
                    $('#route_project').css('display', 'block');
                }
            },
            dataType: "json"
        });
        return false;
    });
    /*end route project*/

    /*share project*/
    $(".router-item").click(function () {
        var project_id = $(this).attr('data-project');
        var sent_to = $(this).attr('data-id');
        var routed = 0;

        if ($(this).is(":checked"))
            routed = 1;

        //alert(routed);

        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {project_id: project_id, sent_to: sent_to, routed: routed, dispatcher: 'share-project'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {

                }
            },
            dataType: "json"
        });

    });


    /*like project*/
    $("#like_project").click(function () {
        var project_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {project_id: project_id, dispatcher: 'like-project'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('#like_project').css('display', 'none');
                    $('#liked_project').css('display', 'block');
                    $('#liked_project').css('opacity', '0.6');
                    // $('.likes-area').html(data['likes']);
                    $('.totalLikes').html(data['likes']);

                    $('.rate-area').css('display', 'none');
                    $('.comment-area').css('display', 'none');
                    $('.report-area').css('display', 'none');
                    $('.route-area').css('display', 'none');
                    $('.homeshare-area').css('display', 'none');
                    $('.share-area').css('display', 'none');

                    //  $('.likes-area').slideDown("slow");
                    //  $(".likes-area").delay(1500).slideUp('slow');
                }
            },
            dataType: "json"
        });
        return false;
    });
    /*end like project*/

    /*like idea*/
    $("#like_idea").click(function () {
        var ideathread_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {
                ideathread_id: ideathread_id, dispatcher: 'like-idea'
            },
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {

                    $('#like_idea').css('display', 'none');
                    $('#liked_idea').css('display', 'block');
                    $('#liked_idea').css('opacity', '0.6');
                    // $('.likes-area').html(data['likes']);
                    $('.totalLikes').html(data['likes']);

                    $('.rate-area').css('display', 'none');
                    $('.comment-area').css('display', 'none');
                    $('.report-area').css('display', 'none');
                    $('.route-area').css('display', 'none');
                    $('.share-area').css('display', 'none');
                    $('.homeshare-area').css('display', 'none');

                    //  $('.likes-area').slideDown("slow");
                    //  $(".likes-area").delay(1500).slideUp('slow');
                }
            },
            dataType: "json"
        });
        return false;
    });
    /*end like idea*/


    /*unlike project*/
    $("#liked_project").click(function () {
        var project_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {project_id: project_id, dispatcher: 'remove-like-project'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('#liked_project').css('display', 'none');
                    $('#like_project').css('display', 'block');

                    // $('.likes-area').html(data['likes']);
                    $('.totalLikes').html(data['likes']);

                    $('.rate-area').css('display', 'none');
                    $('.comment-area').css('display', 'none');
                    $('.report-area').css('display', 'none');
                    $('.homeshare-area').css('display', 'none');
                    $('.share-area').css('display', 'none');

                    //  $('.likes-area').slideDown("slow");
                    // $(".likes-area").delay(1500).slideUp('slow');

                }
            },
            dataType: "json"
        });
        return false;
    });
    /*end unlike project*/


    /*unlike idea*/
    $("#liked_idea").click(function () {
        var ideathread_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {ideathread_id: ideathread_id, dispatcher: 'remove-like-idea'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('#liked_idea').css('display', 'none');
                    $('#like_idea').css('display', 'block');

                    // $('.likes-area').html(data['likes']);
                    $('.totalLikes').html(data['likes']);

                    $('.rate-area').css('display', 'none');
                    $('.comment-area').css('display', 'none');
                    $('.report-area').css('display', 'none');
                    $('.homeshare-area').css('display', 'none');
                    $('.share-area').css('display', 'none');

                    //  $('.likes-area').slideDown("slow");
                    // $(".likes-area").delay(1500).slideUp('slow');

                }
            },
            dataType: "json"
        });
        return false;
    });
    /*end unlike idea*/


    /*show comment form*/
    $("#comment_project").click(function () {

        $('.rate-area').css('display', 'none');
        $('.likes-area').css('display', 'none');
        $('.report-area').css('display', 'none');
        $('.route-area').css('display', 'none');
        $('.homeshare-area').css('display', 'none');
        $('.share-area').css('display', 'none');
        $(".comment-area p").remove();
        $('.comment-idea-textarea').css('display', 'block');
        $('#add-comment-btn').css('display', 'block');
        $(".comment-area").toggle("slow");

        return false;
    });


    /*hide comment form*/
    $(".comment-textarea").keydown(function (e) {
        if (e.keyCode == 13) {
            var comment_text = $('.comment-textarea').val();
            var project_id = $(this).attr('data-id');

            if (comment_text == '') {
                $('.comment-textarea').css('border', '#ff4f00 solid 1px');
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: "includes/ajaxDispatcher.php",
                    data: {project_id: project_id, text: comment_text, dispatcher: 'add-comment'},
                    error: function (req, text, error) {
                        alert('Error AJAX: ' + text + ' | ' + error);
                    },
                    success: function (data) {
                        if (data['result'] == 'OK') {
                            $('.comment-textarea').css('border', '');
                            $('.comment-textarea').val('');
                            //$('.comment-textarea').css('display', 'none');
                            //$('#add-comment-btn').css('display', 'none');
                            //$(".comment-area").append('<p class="success-comment">Your comment has been added</p>');
                            //$(".comment-area").delay(1500).slideUp('slow');
                            $(".comment-area .inbox-messages").html(data['content']);

                            $('#comment_project').text('Commented');
                            $('#comment_project').css('opacity', '0.6');
                        }
                    },
                    dataType: "json"
                });

            }

            return false;
        }
    });

    $(".comment-idea-textarea").keydown(function (e) {
        if (e.keyCode == 13) {
            var comment_text = $('.comment-idea-textarea').val();
            var ideathread_id = $(this).attr('data-id');

            if (comment_text == '') {
                $('.comment-idea-textarea').css('border', '#ff4f00 solid 1px');
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: "includes/ajaxDispatcher.php",
                    data: {ideathread_id: ideathread_id, text: comment_text, dispatcher: 'add-idea-comment'},
                    error: function (req, text, error) {
                        alert('Error AJAX: ' + text + ' | ' + error);
                    },
                    success: function (data) {
                        if (data['result'] == 'OK') {
                            $('.comment--dea-textarea').css('border', '');
                            $('.comment-idea-textarea').val('');
                            //$('.comment-textarea').css('display', 'none');
                            //$('#add-comment-btn').css('display', 'none');
                            //$(".comment-area").append('<p class="success-comment">Your comment has been added</p>');
                            //$(".comment-area").delay(1500).slideUp('slow');
                            $(".comment-area .inbox-messages").html(data['content']);

                            $('#comment_project').text('Comented');
                            $('#comment_project').css('opacity', '0.6');
                        }
                    },
                    dataType: "json"
                });

            }

            return false;
        }
    });

    /*delete comment*/
//$(".message-item").on("click", "div.delete", function() {
    /*$(".message-item .delete").on("click", function(event) {
     var comment_id = $(this).attr('data-id');

     //alert();

     $.ajax({
     type: 'POST',
     url: "includes/ajaxDispatcher.php",
     data: {comment_id:comment_id, dispatcher: 'delete-comment'},
     error: function(req, text, error) {
     alert('Error AJAX: ' + text + ' | ' + error);
     },
     success: function(data){
     if (data['result'] == 'OK'){
     //$(this).parents('.message-item').css('background', '#000000');
     //alert($(this).parent().prop("tagName"));
     }
     },
     dataType: "json"
     });

     $(this).parent().slideUp('slow');

     return false;
     });*/

    /*delete ideathread comment*/
//$(".idea-message").on("click", "div.delete", function() {
    /*$(".idea-message .delete").on("click", function(event) {
     var comment_id = $(this).attr('data-id');

     //alert();

     $.ajax({
     type: 'POST',
     url: "includes/ajaxDispatcher.php",
     data: {comment_id:comment_id, dispatcher: 'delete-idea-comment'},
     error: function(req, text, error) {
     alert('Error AJAX: ' + text + ' | ' + error);
     },
     success: function(data){
     if (data['result'] == 'OK'){
     //$(this).parents('.idea-message').css('background', '#000000');
     //alert($(this).parent().prop("tagName"));
     }
     },
     dataType: "json"
     });

     $(this).parent().slideUp('slow');

     return false;
     });*/


    /*report_project project*/
    $("#report_project").click(function () {
        $('.rate-area').css('display', 'none');
        $('.likes-area').css('display', 'none');
        $('.comment-area').css('display', 'none');
        $('.route-area').css('display', 'none');
        $('.share-area').css('display', 'none');
        $('.homeshare-area').css('display', 'none');
        $(".report-area").toggle("slow");

        return false;
    });

    $("#report-issue").click(function () {
        var project_id = $(this).attr('data-id');
        var copyright = $("#copyright_issue").prop("checked");
        var spam = $("#spam_issue").prop("checked");
        var violent = $("#violent_issue").prop("checked");
        var abusive = $("#abusive_issue").prop("checked");
        var impersonation = $("#impersonation_issue").prop("checked");
        var harassment = $("#harassment_issue").prop("checked");

        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {
                project_id: project_id,
                copyright: copyright,
                spam: spam,
                violent: violent,
                abusive: abusive,
                impersonation: impersonation,
                harassment: harassment,
                dispatcher: 'report-project'
            },
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $(".report-message").css('display', 'block');
                    $(".report-area").delay(1500).slideUp('slow');
                    $('.report-message').css('display', 'none');
                    $('#report_project').text('Reported');
                    $('#report_project').css('opacity', '0.6');
                }
            },
            dataType: "json"
        });
        return false;
    });

    /*end report_project project*/


    $("#recipient").autocomplete({
        source: "includes/autocomplete_recipients.php",
        minLength: 2,
        select: function (event, ui) {
            $('#user_id').val(ui.item.id)
        }
    });


//hide message sent text
    $(".send-result").delay(2000).hide('slow');


    /*show answer form*/
    //$(".message-content").click(function () {
    //    $('.answer-box').slideUp('fast');
    //
    //    var answer_block = $(this).attr('data-id');
    //
    //    $('#answer_' + answer_block).slideDown('slow');
    //
    //    return false;
    //});


    /*send answer*/
    $(".answer-button").click(function () {
        var sender = $(this).attr('data-block');
        var sent_time = $(this).attr('data-time');
        var photo = $(this).attr('data-photo');
        var recipient = $(this).attr('data-user');
        var com_id = $(this).attr('data-id');
        var message = $('textarea').val();
        var messagep = '<p>' + $('textarea').val() + '</p>'
        console.log(com_id, message, recipient);
        if (message === '') {
            $('#reply-ans').delay(100).html('<p style="line-height: 2;"> Message Empty.</p>');
            $('#reply-ans').val('');
            $('#reply-ans').delay(500).hide('slow');
        } else {
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {user_id: recipient, message: messagep, com_id: com_id, dispatcher: 'reply'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $(".message-item").before(
                            '<div class="message-items"style="border-top:none;"><div class="message-author">' +
                            '<div class="router-user-photo photo-right">' +
                            ' <a href="/user.php?uid=' + sender +
                            '"><img src="uploads/avatars/' + photo + '" title="' + sent_time + '">' +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '<div class="message-right">' + messagep + ' <p>                </p></div></div>'
                        );

                        //$('#message-contents').delay(500).append('<p style="line-height: 2;">Your Message has been sent</p>');
                        //$('#reply-ans').delay(500).html('<p style="line-height: 2;">Your Message has been sent</p>');
                        //$('#reply-ans').val('');
                        $('textarea').val('').delay(1000);
                        //$('#reply-ans').delay(1000).hide('slow');
                        $('.inbox-messages').scrollTop($(".answer-box").offset().top+200);
                    } else {
                        $('#reply-ans').val().delay(500).html('<div style="line-height: 2;">Error</div>');
                        $('#reply-ans').val('');
                        $('textarea').val('')
                        $('#reply-ans').delay(1000).hide('slow');
                    }
                },
                dataType: "json"
            });
        }
        return false;
    })

    /*show payment form*/
    $("#pay_card").click(function () {
        $('.pay-via-account-section').css('display', 'none');
        $('.pay-via-card-section').css('display', 'block');
    });

    $("#pay_account").click(function () {
        $('.pay-via-card-section').css('display', 'none');
        $('.pay-via-account-section').css('display', 'block');
    });


    $("#search_project").autocomplete({
        source: "includes/autocomplete_projects.php",
        minLength: 2,
        select: function (event, ui) {
            $('#project_id').val(ui.item.id)
        }
    });


    $(".ad-thematic_post_1").click(function () {
        $('.thematic_type').value = 'video';
        var thumb = $('.thematic_post_1').html();
        $('.ad-preview-thumb').html(thumb);
    });

    $(".ad-thematic_post_2").click(function () {
        $('.thematic_type').value = 'video';
        var thumb = $('.thematic_post_2').html();
        $('.ad-preview-thumb').html(thumb);
    });

    $(".ad-thematic_post_3").click(function () {
        $('.thematic_type').value = 'video';
        var thumb = $('.thematic_post_3').html();
        $('.ad-preview-thumb').html(thumb);
    });

    $(".ad-thematic_post_3").click(function () {
        $('.thematic_type').value = 'video';
        var thumb = $('.thematic_post_3').html();
        $('.ad-preview-thumb').html(thumb);
    });

    $(".ad-thematic_post_4").click(function () {
        $('.thematic_type').value = 'video';
        var thumb = $('.thematic_post_4').html();
        $('.ad-preview-thumb').html(thumb);
    });

    $(".ad-thematic_post_5").click(function () {
        $('.thematic_type').value = 'image';
        var thumb = $('.thematic_post_5').html();
        $('.ad-preview-thumb').html(thumb);
    });

    $(".ad-thematic_post_6").click(function () {
        $('.thematic_type').value = 'description';
        var thumb = $('.thematic_post_6').html();
        $('.ad-preview-thumb').html('<label class="post_description" style="width: 206px;">' + thumb + '</label>');
    });

    $("#slogan").blur(function () {
        var text = $(this).val();
        $('.ad-preview-slogan').html(text);

    });

    $("#headline").blur(function () {
        var text = $(this).val();
        $('.ad-preview-headline').html(text);
    });


    $(".fancybox").fancybox({
        autoResize: true,
        fitToView: true,
        maxWidth: '800',
        maxHeight: '600'
    });


    $(".get-verified").click(function () {

        if ($('#upload-id').is(":hidden")) {
            $('#upload-id').slideDown('slow');
        }
        else {
            $('#upload-id').slideUp('slow');
        }
    });

    $("#report-profile").click(function () {
        if ($('#profile-report-area').is(":hidden")) {
            $('#profile-report-area').slideDown('slow');
        }
        else {
            $('#profile-report-area').slideUp('slow');
        }
    });

    $("#report-project").click(function () {
        if ($('#project-report-area').is(":hidden")) {
            $('#project-report-area').slideDown('slow');
        }
        else {
            $('#project-report-area').slideUp('slow');
        }
    });

    $("#report-router").click(function () {
        if ($('#router-report-area').is(":hidden")) {
            $('#router-report-area').slideDown('slow');
        }
        else {
            $('#router-report-area').slideUp('slow');
        }
    });

    $("#report-finance").click(function () {
        if ($('#finance-report-area').is(":hidden")) {
            $('#finance-report-area').slideDown('slow');
        }
        else {
            $('#finance-report-area').slideUp('slow');
        }
    });

    $("#report-store").click(function () {
        if ($('#store-report-area').is(":hidden")) {
            $('#store-report-area').slideDown('slow');
        }
        else {
            $('#store-report-area').slideUp('slow');
        }
    });

    $("#report-settings").click(function () {
        if ($('#settings-report-area').is(":hidden")) {
            $('#settings-report-area').slideDown('slow');
        }
        else {
            $('#settings-report-area').slideUp('slow');
        }
    });

    $(".top-messages").click(function () {
        if ($('.popup-alerts').is(":hidden")) {
            $('.popup-alerts').slideDown('slow');
        }
        else {
            $('.popup-alerts').slideUp('slow');
        }
    });


    /*accept route*/
    $(".accept-route").click(function () {

        var routed_by = $(this).attr('data-routedby');
        var user_id = $(this).attr('data-user');
        var notify_id = $(this).parent().parent().attr('data-id');

        //alert(notify_id);

        //check username and pass
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {routed_by: routed_by, user_id: user_id, notify_id: notify_id, dispatcher: 'accept-route'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    //alert('#notifytext_'+ notify_id);
                    $('#notifytext_' + notify_id).html('Accepted!');

                }
            },
            dataType: "json"

        });

        return false;
    });


    $('html').on('click', '#acceptPayment', function () {

        var project_id = $(this).attr('data-projectId');
        var created_by = $(this).attr('data-createdBy');
        var project_title = $(this).attr('data-projectTitle');
        var amount = $(this).attr('data-amount');
        $('<img src="images/bg_loader.gif" />').insertAfter($(this));
        $(this).hide();
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {
                project_id: project_id,
                created_by: created_by,
                project_title: project_title,
                amount: amount,
                dispatcher: 'add-transaction'
            },
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    window.location = "/project_details.php?pid=" + project_id;
                }
            },
            dataType: "json"

        });

        return false;
    });

    $('html').on('click', '#notifyOwner', function () {


        var project_id = $(this).attr('data-projectId');
        var created_by = $(this).attr('data-createdBy');
        var project_title = $(this).attr('data-projectTitle');

        $('<img src="images/bg_loader.gif" />').insertAfter($(this));
        $(this).hide();
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {
                project_id: project_id,
                created_by: created_by,
                project_title: project_title,
                dispatcher: 'notifyOwner'
            },
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    console.log('bayo hai');
                    $('div#notifyTextContent').html('<p>Request has been sent to the owner. You will be notified after approval of your request.</p>');
                }
            },
            dataType: "json"

        });

        return false;
    });


    /*accept route*/
    $(".decline-route").click(function () {

        var routed_by = $(this).attr('data-routedby');
        var user_id = $(this).attr('data-user');
        var notify_id = $(this).parent().parent().attr('data-id');


        //check username and pass
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {routed_by: routed_by, user_id: user_id, notify_id: notify_id, dispatcher: 'decline-route'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('#notifytext_' + notify_id).html('Declined!');
                }
            },
            dataType: "json"

        });

        return false;
    });


    $("#searchInput").keyup(function () {
        //split the current value of searchInput
        var data = this.value.split(" ");
        //create a jquery object of the rows
        var jo = $("#fbody").find("tr");
        if (this.value == "") {
            jo.show();
            return;
        }
        //hide all the rows
        jo.hide();

        //Recusively filter the jquery object to get results.
        jo.filter(function (i, v) {
                var $t = $(this);
                for (var d = 0; d < data.length; ++d) {
                    if ($t.is(":contains('" + data[d] + "')")) {
                        return true;
                    }
                }
                return false;
            })
            //show the rows that match.
            .show();
    }).focus(function () {
        this.value = "";
        $(this).css({
            "color": "black"
        });
        $(this).unbind('focus');
    }).css({
        "color": "#C0C0C0"
    });


    $(".edit-create-password").click(function () {
        $('#password').focus();

        return false;
    });


    $(".multiple-select").change(function () {
        if ($(this).val().length > 3) {
            var option = $("option:selected:last", this);

            option.prop("selected", false);
            alert("Maximum 3 co-founders are allowed");
        } else {
            var selected_users = '';
            $('.multiple-select :selected').each(function (i, selected) {

                selected_users = selected_users + '<span>' + $(selected).text() + '</span>';
            });
        }
        $('.cofounder-selected-list').html(selected_users);
    });
// view project confirm
    //$('')

});


/*$(".multiple-select").change(function () {

 var selected_users = '';
 $('.multiple-select :selected').each(function(i, selected){
 selected_users = selected_users + '<span>' + $(selected).text() + '</span>';
 });
 alert('123');
 $('.cofounder-selected-list').html(selected_users);

 alert($(this).val());

 });*/

/* $("#co_founders").change(function () {         
 var _clickedItemText = $(this).text();
 alert(_clickedItemText);
 });*/


/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:

    // var url = 'https://www.rangeenroute.com/js/file-uploading/server/php/';
    var url = "<?php echo SITE_URL; ?>;" + '/js/file-uploading/server/php/';
    //var url =  'https://rangeen/js/file-uploading/server/php/';

    var base_url = 'https://rangeenroute.com/';
    //var base_url =  'http://rangeen/';


    //upload user photo
    $('#upload_file').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.avatar-img').attr('src', '');
                $('.avatar-img').attr('style', '');
                $('.avatar-img').attr('src', 'js/file-uploading/server/php/files/' + file.name);
                $('#user_photo').val(file.name);
                $('#photo_updated').val('1');
            });
        },
        progressall: function (e, data) {
            $('.avatar-img').css('left', '-100px');
            $('.avatar-img').css('position', 'relative');
            $('.avatar-img').css('top', '30px');
            $('.avatar-img').attr('src', 'js/file-uploading/img/loading.gif');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    //upload user video for project step 3
    $('#upload_video').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-video').css('background-image', 'url(' + base_url + 'images/video_preview1.jpg)');
                $('#uploaded_video').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-video').css('background-image', 'url(js/file-uploading/img/loading.gif)');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    //upload user video for project step 3
    $('#upload_image').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-image').css('background-image', 'url(js/file-uploading/server/php/files/thumbnail/' + file.name + ')');
                $('.upload-image').css('background-size', '244px');
                $('#uploaded_image').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-image').css('background-image', 'url(js/file-uploading/img/loading.gif)');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    //upload product photo for project step 5
    $('#upload_product_image').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-product-image').html(file.name);
                $('.upload-product-image').css('background-image', 'none');
                $('#uploaded_product_image').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-product-image').css('background-image', 'url(js/file-uploading/img/loading.gif)', 'width', '100%');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('#upload_picture_1').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-image-1').css('background-image', 'url(js/file-uploading/server/php/files/thumbnail/' + file.name + ')');
                $('.upload-image-1').css('background-size', '244px');
                $('#uploaded_picture_1').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-image-1').css('background-image', 'url(js/file-uploading/img/loading.gif)');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('#upload_picture_2').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-image-2').css('background-image', 'url(js/file-uploading/server/php/files/thumbnail/' + file.name + ')');
                $('.upload-image-2').css('background-size', '244px');
                $('#uploaded_picture_2').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-image-2').css('background-image', 'url(js/file-uploading/img/loading.gif)');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('#upload_picture_3').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-image-3').css('background-image', 'url(js/file-uploading/server/php/files/thumbnail/' + file.name + ')');
                $('.upload-image-3').css('background-size', '244px');
                $('#uploaded_picture_3').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-image-3').css('background-image', 'url(js/file-uploading/img/loading.gif)');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('#upload_picture_4').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-image-4').css('background-image', 'url(js/file-uploading/server/php/files/thumbnail/' + file.name + ')');
                $('.upload-image-4').css('background-size', '244px');
                $('#uploaded_picture_4').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-image-4').css('background-image', 'url(js/file-uploading/img/loading.gif)');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('#upload_picture_5').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('.upload-image-5').css('background-image', 'url(js/file-uploading/server/php/files/thumbnail/' + file.name + ')');
                $('.upload-image-5').css('background-size', '244px');
                $('#uploaded_picture_5').val(file.name);
            });
        },
        progressall: function (e, data) {
            $('.upload-image-5').css('background-image', 'url(js/file-uploading/img/loading.gif)');

        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


});


$(function () {
    $("#home-tabs").tabs({
        beforeLoad: function (event, ui) {
            ui.jqXHR.error(function () {
                ui.panel.html(
                    "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                    "If this wouldn't be a demo.");
            });
        }
    });

});

function deleteComment(comment_id) {
    //

    $.ajax({
        type: 'POST',
        url: "includes/ajaxDispatcher.php",
        data: {comment_id: comment_id, dispatcher: 'delete-comment'},
        error: function (req, text, error) {
            alert('Error AJAX: ' + text + ' | ' + error);
        },
        success: function (data) {
            if (data['result'] == 'OK') {
                //$(this).parents('.message-item').css('background', '#000000');
                //alert($(this).parent().prop("tagName"));
            }
        },
        dataType: "json"
    });

    $('.delete_' + comment_id).parent().slideUp('slow');

    return false;
}

function deleteIdea(ideathread_id) {
    if (confirm('Are you sure you want to delete this?')) {
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {ideathread_id: ideathread_id, dispatcher: 'delete-idea'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    $('.idea_' + ideathread_id).html('<div style="color: red; text-align: center; padding-top: 50px;">Your idea has been deleted.</div>');
                }
            },
            dataType: "json"
        });

    }
}