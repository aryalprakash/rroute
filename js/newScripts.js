
$(document).ready(function () {
    var SITE_URL = "<?php echo SITE_URL; ?>";
    $("#rewardType")
        .change(function () {
            var str = "";
            $("#rewardType option:selected").each(function () {
                str += $(this).text();
            });

            if (str == 'Product') {
                $("#equityEntry").slideUp('slow');
                $("#productEntry").slideDown('slow');
            }
            if (str == 'Equity') {
                $("#contdProduct").slideUp('slow');
                $("#productEntry").slideUp('slow');
                $("#equityEntry").slideDown('slow');
            }

        });

    var rewardType = $("#rewardType option:selected").text();
    if (rewardType == 'Product') {
        $("#equityEntry").slideUp('slow');
        $("#productEntry").slideDown('slow');
    }
    if (rewardType == 'Equity') {
        $("#contdProduct").slideUp('slow');
        $("#productEntry").slideUp('slow');
        $("#equityEntry").slideDown('slow');
    }
    /* added for communication message for active or inactive class */
    //$('.inbox-messages').children(':odd').addClass('odd');
    //$('.message-item odd').click(function(){
    //    $('.message-item ev').removeClass('odd');
    //    $('.message-item').addClass('even');
    //});

    /* added for communication message for active or inactive class */


    $("#projectType")
        .change(function () {
            var str = "";
            $("#projectType option:selected").each(function () {
                str += $(this).text();
            });

            if (str == 'Monetised') {
                $("#monitizeBar").slideDown('slow');
            }
            else {
                $("#monitizeBar").slideUp('slow');
            }

        });

    var projectType = $("#projectType option:selected").text();

    if (projectType == 'Monetised') {
        $("#monitizeBar").slideDown('slow');
    }
    else {
        $("#monitizeBar").slideUp('slow');
    }


    $("#productSubmit").click(function () {
        $("#contdProduct").slideDown('slow');
        return false;

    });


    $("#equitySubmit").click(function () {
        $("#contdEquity").slideDown('slow');
        var equity = $("#equityValue").val();
        var startup_amount = $("#startup_amount").val();
        $(".equityVal").html(equity + "% Equity Reward for $" + startup_amount);
    });


    //Fundables

    var showBox = function (el) {
        console.log(el);
    }

    $('.help_title').click(function () {
        contentId = '#' + this.id + 'Content';
        if ($(contentId).is(":hidden")) {
            $('.help_content').hide();
            $(contentId).slideDown('slow');
        } else {
            $(contentId).hide();
        }
        return false;
    });

    $(".view-more").click(function () {
        $('html, body').animate({
            scrollTop: $(".signup-line").offset().top
        }, 'slow');
    });

    $('.allNotifications').click(function () {
        var user_id = $(this).attr('user-id');
        //console.log(user_id);
        $.ajax({
            type: 'POST',
            url: "includes/ajaxDispatcher.php",
            data: {user_id: user_id, dispatcher: 'read-notifications'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data['result'] == 'OK') {
                    //console.log(data);
                    $('.notifyNo').css('display', 'none');
                }
            },
            dataType: "json"
        });
        return false;
    });

//for sliding social sharing icons
//    $( "#h" ).hover(function () {
//        if ( $( ".project-action-btns" ).is( ":hidden" ) ) {
//            $( ".project-action-btns" ).toggle( "slow" );
//        } else {
//            $( ".project-action-btns" ).hide();
//        }
//    });
////


    /*Route_project */
    $(".route_project").click(function () {
        $('.rate-area').css('display', 'none');
        $('.likes-area').css('display', 'none');
        $('.comment-area').css('display', 'none');
        $('.report-area').css('display', 'none');
       // $('.share-area').css('display', 'none');
        $('.homeshare-area').css('display', 'none');

        $(".route-area").slideToggle('slow');

        return false;
    });

    //share ideathread
    $("#share_project").click(function () {
        $('.rate-area').css('display', 'none');
        $('.likes-area').css('display', 'none');
        $('.comment-area').css('display', 'none');
        $('.report-area').css('display', 'none');
        $('.route-area').css('display', 'none');

        $(".share-area").slideToggle('slow');

        return false;
    });

    //share project
    $("#homeshare_project").click(function () {
        $('.rate-area').css('display', 'none');
        $('.likes-area').css('display', 'none');
        $('.comment-area').css('display', 'none');
        $('.report-area').css('display', 'none');
        $('.route-area').css('display', 'none');

        $(".homeshare-area").slideToggle('slow');
        return false;
    });
    //for active class
   // $('#route_project,#homeshare_project,#share_project,#comment_project,#like_project,#rate_project,#report_project,#like_idea,#liked_idea').on('click', function () {

        //if ( $( "#route_project" ).hasClass( "active" ) ) {
        //$('#route_project,#share_project, #comment_project,#like_project,#rate_project,#report_project,#like_idea,#liked_idea').removeClass('active');
        //} else {
        //$(this).addClass('active');
        // }

   // });
    //end share project

    //tooltip dekhaune

    $('.showtooltipRate').mouseover(function () {
        $('.showtooltipRate').tooltip({
            items: ".showtooltipRate",
            content: "Not applicable action because there is no project related to this IdeaThread in Rangeenroute"
        });
        $('.showtooltipRate').tooltip("open");
    });

    $('.showtooltipRoute').mouseover(function () {
        $('.showtooltipRoute').tooltip({
            items: ".showtooltipRoute",
            content: "Not applicable action because there is no project related to this IdeaThread in Rangeenroute"
        });
        $('.showtooltipRoute').tooltip("open");
    });

    $('.showRoute').mouseover(function () {
        $('.showRoute').tooltip({
            items: ".showRoute",
            content: "You will be directed to the Project page of this IdeaThread"
        });
        $('.showRoute').tooltip("open");
    });


    $('.showRate').mouseover(function () {
        $('.showRate').tooltip({
            items: ".showRate",
            content: "You will be directed to the Project page of this IdeaThread"
        });
        $('.showRate').tooltip("open");
    });


    //route project ko


//    function search(){
////                console.log('yaha aayo');
//        var title=$("#route-search").val();
//
//        if(title!=""){
////                console.log(title);
//            //$("#route-result").html("<li>searching</li>");
//            $.ajax({
//                type:"post",
//                url:"searchuser.php",
//                data:"title="+title,
//                success:function(data){
////                        console.log(data);
//                    $("#route-result").html(data);
//                    //$("#route-result").html('<li class="click-user">'+data+'</li>');
////                        $("#route-search").val("");
//                }
//            });
//        }else
//        {
//           // $("#route-result").html("<li>searching</li>");
//            $.ajax({
//                type:"post",
//                url:"searchuser.php",
//                data:"title="+title,
//                success:function(data){
////                        console.log(data);
//                   // $("#route-result").html(data);
//                    $("#route-result").html("<li>searching</li>");
//                    //$("#route-result").html('<li class="click-user">'+data+'</li>');
////                        $("#route-search").val("");
//                }
//            });
//        }
//
//    }

    function searchUserList() {
//                console.log('yaha aayo');
        var title = $("#route-search").val();
        var user_id = $(this).attr("#data-id");
        if (title != "") {
//                console.log(title);
            //$("#route-result").html("<li>searching</li>");
            $.ajax({
                type: "post",
                url: "includes/ajaxDispatcher.php",
                data: {title: title, user_id: user_id, dispatcher: 'search-route-user-lists'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {

                    $("#route-result").html(data);
                    //$("#route-result").html('<li class="click-user">'+data+'</li>');
//                        $("#route-search").val("");
                }
            });
        }
        else {
            $.ajax({
                type: "post",
                url: "searchuser.php",
                data: "title=" + title,
                success: function (data) {
                    $("#route-result").html("");
                }
            });
        }
    }


    $("#route-button").click(function () {
        searchUserList();
    });

    $('#route-search').keyup(function (e) {
        // if(e.keyCode == 13) {
        searchUserList();
        //}
    });
    $('body').on('click', '.click-user', function () {
        $.ajax({
            type: "post",
            url: "includes/ajaxDispatcher.php",
            data: {
                sent_to: $(this).attr("data-id"),
                project_id: $('.route_project').attr("data-id"),
                dispatcher: 'route-this-project'
            },
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data.result == 'OK') {
                    $(".success-message").html('<p style="color:forestgreen;" class="suc">Routed to '+data.user+'.</p>');
                    $(".suc").fadeOut(4000);
                    $(".routed-users").prepend('<div class="routed-users-list" data-id="' + data.id + '"><span class="unroute" data-id="' + data.id + '" user-id="'+data.user_id+'">X</span><a href="user.php?uid=' + data.user_id + '"><li class="routed-name">' + data.user + '</li></a></div>')
                } else {
                    alert("You've already routed this user.");
                }
            },
            dataType: "json"
        });
    });

    $('body').on('click', '.unroute', function () {
        var r = confirm("Are You Sure Want to Unroute this user?");
        if (r == true) {
            $.ajax({
                type: "post",
                url: "includes/ajaxDispatcher.php",
                data: {router_id: $(this).attr("data-id"), user_id: $(this).attr("user-id"), dispatcher: 'unroute-this-user'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data.result == 'OK') {
                        console.log(data);
                        $(".routed-users").find("[data-id=" + data.router_id + "]").remove();
                        $(".success-message").html('<p style="color: orangered;" class="suc">Unrouted to '+data.user+'.</p>');
                        $(".suc").fadeOut(4000);
                    }
                },
                dataType: "json"
            });
        }
    });


    /* After clicking on message */

    //$('.msg-click').click(function(){
    //    //var user_id = $(this).attr('user-id');
    //    var conv_id = $this.attr('data-id');
    //    //console.log(user_id);
    //    $.ajax({
    //        type: 'POST',
    //        url: "includes/ajaxDispatcher.php",
    //        data: {conv_id: conv_id, dispatcher: 'show-detail-message'},
    //        error: function (req, text, error) {
    //            alert('Error AJAX: ' + text + ' | ' + error);
    //        },
    //        success: function (data) {
    //            if (data['result'] == 'OK') {
    //                //console.log(data);
    //                $('.notifyNo').css('display','none');
    //            }
    //        },
    //        dataType: "json"
    //    });
    //    return false;
    //});
///* After clicking on message ends */

    //$('.finalize').click(function () {
    //   console.log('now you can start coding.');
    //
    //});
/********for apllying project box*****/
    $("#apply_project_button").click(function () {
        $(".apply-project-area").slideToggle("slow");
        return false;
    });

    $(".apply-project-bottom").click(function () {
        //alert($('input[type="checkbox"]:checked').length);
        $('input[type="checkbox"]:checked').each(function(){
            var project_id = $(this).data('id');
            var investor_id=$(this).data('value');
            console.log(project_id,investor_id)
            //$.ajax({
            //    type: 'POST',
            //    url: "includes/ajaxDispatcher.php",
            //    data: {project_id:project_id,investor_id:investor_id, dispatcher:'apply-for-fund'},
            //    error: function (req, text, error) {
            //        alert('Error AJAX: ' + text + ' | ' + error);
            //    },
            //    success: function (data) {
            //        if (data['result'] == 'OK') {
            //            $(".apply-success").css('display', 'block');
            //            $(".apply-project-area").delay(1500).slideUp('slow');
            //            $('.apply-success').css('display', 'none');
            //
            //        }
            //    },
            //    dataType: "json"
            //});
            //return false;
        });

    });

        //$('.apply-project-area').each(
        //    function() {
        //       var len= $('input[type="checkbox"]:checked').length;
        //
        //
        //    }
        //);

    $('body').on('click', '.admin-delete-project', function () {

        if (confirm('Are you sure you want to delete this?')) {
            var project_id=$(this).attr("data-id");
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {project_id: project_id, dispatcher: 'delete-project'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        //$('.del_idea-'+post_id).slideUp('slow');
                        //$('.idealist_' + post_id).html('<div style="color: red; text-align: center; padding-top: 50px;">Your idea has been deleted.</div>');
                        $('.del-project-'+project_id).closest('tr').slideUp('slow').delay(500);
                        $('.del-project-'+project_id).closest('tr').remove().delay(1000);


                        // alert("done");
                    }
                },
                dataType: "json"
            });

        }

    });

    $('body').on('click', '.admin-delete-blogpost', function () {

        if (confirm('Are you sure you want to delete this?')) {
            var post_id=$(this).attr("data-id");
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {post_id: post_id, dispatcher: 'delete-blogpost'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        //$('.del_idea-'+post_id).slideUp('slow');
                        //$('.idealist_' + post_id).html('<div style="color: red; text-align: center; padding-top: 50px;">Your idea has been deleted.</div>');
                        $('.del-blogpost-'+post_id).closest('tr').slideUp('slow').delay(500);
                        $('.del-blogpost-'+post_id).closest('tr').remove().delay(1000);


                        // alert("done");
                    }
                },
                dataType: "json"
            });

        }

    });

    $('body').on('click', '.admin-delete-idea', function () {

        if (confirm('Are you sure you want to delete this?')) {
            var ideathread_id=$(this).attr("data-id")
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {ideathread_id: ideathread_id, dispatcher: 'delete-ideathread'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        //$('.del_idea-'+ideathread_id).slideUp('slow');
                        //$('.idealist_' + ideathread_id).html('<div style="color: red; text-align: center; padding-top: 50px;">Your idea has been deleted.</div>');
                        $('.del-idea-'+ideathread_id).closest('tr').slideUp('slow').delay(500);
                            $('.del-idea-'+ideathread_id).closest('tr').remove().delay(1000);


                       // alert("done");
                    }
                },
                dataType: "json"
            });

        }

    });


    $('body').on('click', '.admin-accept-ideathread', function () {

        if (confirm('Are you sure you want to update status?')) {
            var ideathread_id=$(this).attr("data-id");
            console.log(ideathread_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {ideathread_id: ideathread_id, dispatcher: 'accept-ideathread'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#status_'+ideathread_id).text('Published.');
                        $('.accept_'+ideathread_id).attr('value','Reject');

                    }else {
                        $('#status_'+ideathread_id).text('Unpublished.');
                        $('.accept_'+ideathread_id).attr('value','Accept');
                    }
                },
                dataType: "json"
            });

        }

    });

    $('body').on('click', '.admin-accept-project', function () {

        if (confirm('Are you sure you want to update status?')) {
            var project_id=$(this).attr("data-id");
            console.log(project_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {project_id: project_id, dispatcher: 'accept-project'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#projectstatus_'+project_id).text('Published.');
                        $('.projectaccept_'+project_id).attr('value','Reject');

                    }else {
                        $('#projectstatus_'+project_id).text('Unpublished.');
                        $('.projectaccept_'+project_id).attr('value','Accept');
                    }
                },
                dataType: "json"
            });

        }

    });
    $('body').on('click', '.admin-accept-blogpost', function () {

        if (confirm('Are you sure you want to update status?')) {
            var post_id=$(this).attr("data-id");
            console.log(post_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {post_id: post_id, dispatcher: 'accept-blogpost'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#blogpoststatus_'+post_id).text('Published.');
                        $('.blogpostaccept_'+post_id).attr('value','Reject');

                    }else {
                        $('#blogpoststatus_'+post_id).text('Unpublished.');
                        $('.blogpostaccept_'+post_id).attr('value','Accept');
                    }
                },
                dataType: "json"
            });

        }

    });


    /* rate project admin */
    $('body').on('click','#admin_rate_project',function () {
        var pid = $(this).attr("data-id");
        $('.admin-rate-area-'+pid).slideToggle('slow');
        return false;
    });
    $('body').on('click','#admin_save_rate_project',function () {
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
                    $('.admin_rate_project_'+project_id).attr('value','Rated');
                    $('.admin_rate_project_'+project_id).css('opacity', '0.6');
                    $('.admin-rate-area').slideUp('slow');
                }
            },
            dataType: "json"
        });
        return false;
    });
});