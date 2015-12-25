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
        $('.share-area').css('display', 'none');
        $('.homeshare-area').css('display', 'none');

        $(".route-area").slideDown("slow");

        return false;
    });

    //share ideathread
    $("#share_project").click(function () {
        $('.rate-area').css('display', 'none');
        $('.likes-area').css('display', 'none');
        $('.comment-area').css('display', 'none');
        $('.report-area').css('display', 'none');
        $('.route-area').css('display', 'none');

        $(".share-area").toggle("slow");

        return false;
    });

    //share project
    $("#homeshare_project").click(function () {
        $('.rate-area').css('display', 'none');
        $('.likes-area').css('display', 'none');
        $('.comment-area').css('display', 'none');
        $('.report-area').css('display', 'none');
        $('.route-area').css('display', 'none');

        $(".homeshare-area").toggle("slow");

        return false;
    });
    //for active class
    $('#route_project,#homeshare_project,#share_project,#comment_project,#like_project,#rate_project,#report_project,#like_idea,#liked_idea').on('click', function () {

        //if ( $( "#route_project" ).hasClass( "active" ) ) {
        $('#route_project,#share_project,#comment_project,#like_project,#rate_project,#report_project,#like_idea,#liked_idea').removeClass('active');
        //} else {
        $(this).addClass('active');
        // }

    });
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
                    $(".routed-users").prepend('<div class="routed-users-list" data-id="' + data.id + '"><span class="unroute" data-id="' + data.id + '">X</span><a href="user.php?uid=' + data.user_id + '"><li class="routed-name">' + data.user + '</li></a></div>')
                } else {
                    alert("You've already routed this user.");
                }
            },
            dataType: "json"
        });
    });

    $('body').on('click', '.unroute', function () {
        $.ajax({
            type: "post",
            url: "includes/ajaxDispatcher.php",
            data: {router_id: $(this).attr("data-id"), dispatcher: 'unroute-this-user'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data.result == 'OK') {
                    $(".routed-users").find("[data-id=" + data.router_id + "]").remove();
                }
            },
            dataType: "json"
        });
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


});
