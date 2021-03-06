
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

    //$(".view-more").click(function () {
    //    $('html, body').animate({
    //        scrollTop: $(".signup-line").offset().top
    //    }, 'slow');
    //});

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
    $('body').on('click', '.finalize', function () {
    //$('.finalize').click(function () {
        var pid =$(this).attr('data-id');
        var amount = $('.investment-amount-'+pid).val();
        var type =$('.finalize').attr('data-value');
        var eq_pc = $('.eq-pc-'+pid).text();
        var fin_pro=$('.final-product-'+pid).text();
        var user_choice =$(this).find('users-choice-'+pid).text();
        console.log(eq_pc,fin_pro,user_choice);



       // post_to_url("../rangeenroute/payment.php", { amount: amount,pid:pid ,type:type,eq_pc:eq_pc,fin_pro:fin_pro,user_choice:user_choice});
        post_to_url("./payment.php", { amount: amount,pid:pid ,type:type,eq_pc:eq_pc,fin_pro:fin_pro,user_choice:user_choice});
        function post_to_url(path, params, method) {
            method = method || "post";

            var form = document.createElement("form");

            //Move the submit function to another variable
            //so that it doesn't get overwritten.
            form._submit_function_ = form.submit;

            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
            }

            document.body.appendChild(form);
            form._submit_function_(); //Call the renamed function.
        }





        //$.ajax({
        //    type: 'POST',
        //    url: "payment.php",
        //    data: {amount: amount},
        //    error: function (req, text, error) {
        //        alert('Error AJAX: ' + text + ' | ' + error);
        //    },
        //    success: function (data) {
        //        console.log(amount);
        //       // window.location.href = 'payment.php';
        //    }
        //});
        //redirect('payment.php', {amout: amount});

    });
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
            //console.log(project_id,investor_id);
            //$(".apply-success").css('display', 'block');
            //$(".apply-project-area").delay(1500).slideUp('slow');
            //$('.apply-success').css('display', 'none');
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {project_id:project_id,investor_id:investor_id, dispatcher:'apply-for-fund'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        //console.log(project_id,investor_id);
                        //$(".apply-success").css('display', 'block');
                        $('.apply-success').fadeIn('slow');
                        $(".apply-project-area").delay(1500).slideUp('slow');
                       $('.apply-success').fadeOut(1500);

                    }else{console.log ("error");}
                },
                dataType: "json"
            });

        });
        return false;
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
    $('body').on('click', '.admin-delete-investor', function () {

        if (confirm('Are you sure you want to delete this?')) {
            var investor_id=$(this).attr("data-id");
            //console.log(investor_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {investor_id: investor_id, dispatcher: 'delete-investor'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        //$('.del_idea-'+ideathread_id).slideUp('slow');
                        //$('.idealist_' + ideathread_id).html('<div style="color: red; text-align: center; padding-top: 50px;">Your idea has been deleted.</div>');
                        $('.del-investor-'+investor_id).closest('tr').slideUp('slow').delay(500);
                        $('.del-investor-'+investor_id).closest('tr').remove().delay(1000);


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
            var session_user=$(this).attr("data-user");

            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {ideathread_id: ideathread_id, session_user:session_user, dispatcher: 'accept-ideathread'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#status_'+ideathread_id).text('Yes');
                        $('.accept_'+ideathread_id).attr('value','Unpublish');
                        $('#ideathread_acceptor_'+ideathread_id).text(session_user);
                        $('#ideathreadstatusrej_'+ideathread_id).text('Accepted');
                        $('.ideathreadreject_'+ideathread_id).attr("disabled",true);
                        $('.ideathreadreject_'+ideathread_id).css({"opacity":"0.4"});
                    }else {
                        $('#status_'+ideathread_id).text('No');
                        $('.accept_'+ideathread_id).attr('value','Publish');
                        $('#ideathreadstatusrej_'+ideathread_id).text('Accepted');
                        $('#ideathread_acceptor_'+ideathread_id).text(session_user);
                    }
                },
                dataType: "json"
            });

        }

    });

    $('body').on('click', '.admin-reject-ideathread', function () {

        if (confirm('Are you sure you want to Reject IdeaThread?')) {
            var ideathread_id=$(this).attr("data-id");
            var session_user=$(this).attr("data-user");
            //console.log(ideathread_id,session_user);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {ideathread_id:ideathread_id,session_user:session_user, dispatcher: 'reject-ideathread'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        //$('#blogpoststatus_'+post_id).text('No');
                        // $('.blogpostaccept_'+post_id).attr('value','Accept');
                        $('.accept_'+ideathread_id).css("opacity:0.4", "disabled");
                        $('#ideathread_acceptor_'+ideathread_id).text(session_user);
                        $('#ideathreadstatusrej_'+ideathread_id).text('Rejected');
                        $('.ideathreadreject_'+ideathread_id).css("opacity:0.4", "disabled");

                    }
                },
                dataType: "json"
            });

        }

    });

    $('body').on('click', '.admin-accept-project', function () {

        if (confirm('Are you sure you want to update status?')) {
            var project_id=$(this).attr("data-id");
            var session_user=$(this).attr("data-user");
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {project_id: project_id,session_user:session_user, dispatcher: 'accept-project'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#projectstatus_'+project_id).text('Yes');
                        $('.projectaccept_'+project_id).attr('value','Unpublish');
                        $('#project_acceptor_'+project_id).text(session_user);
                        $('#projectstatusrej_'+project_id).text('Accepted');
                        $('.projectreject_'+project_id).attr("disabled",true);
                        $('.projectreject_'+project_id).css({"opacity":"0.4"});


                    }else {
                        $('#projectstatus_'+project_id).text('No');
                        $('.projectaccept_'+project_id).attr('value','Accept');
                        $('#project_acceptor_'+project_id).text(session_user);
                        $('#projectstatusrej_'+project_id).text('Accepted');
                    }
                },
                dataType: "json"
            });

        }

    });

    $('body').on('click', '.admin-reject-project', function () {

        if (confirm('Are you sure you want to Reject Project?')) {
            var project_id=$(this).attr("data-id");
            var session_user=$(this).attr("data-user");
            //console.log(session_user,post_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {project_id: project_id,session_user:session_user, dispatcher: 'reject-project'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        console.log(session_user,project_id);
                        //$('#blogpoststatus_'+post_id).text('No');
                        // $('.blogpostaccept_'+post_id).attr('value','Accept');
                        $('.projectaccept_'+project_id).css({"opacity":"0.4"});
                        $('.projectaccept_'+project_id).attr("disabled",true);
                        $('#project_acceptor_'+project_id).text(session_user);
                        $('#projectstatusrej_'+project_id).text('Rejected');
                        $('.projectreject_'+project_id).attr("disabled",true);
                        $('.projectreject_'+project_id).css({"opacity":"0.4"});

                    }
                },
                dataType: "json",
            });

        }

    });


    $('body').on('click', '.admin-accept-blogpost', function () {

        if (confirm('Are you sure you want to update status?')) {
            var post_id=$(this).attr("data-id");
            var session_user=$(this).attr("data-user");
            //console.log(session_user);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {post_id: post_id,session_user:session_user, dispatcher: 'accept-blogpost'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#blogpoststatus_'+post_id).text('Yes');
                        $('.blogpostaccept_'+post_id).attr('value','Unpublish');
                        $('#blogpost_acceptor_'+post_id).text(session_user);
                        $('#blogpoststatusrej_'+post_id).text('Accepted');
                        $('.blogpostreject_'+post_id).attr("disabled",true);
                        $('.blogpostreject_'+post_id).css({"opacity":"0.4"});

                    }else {
                        $('#blogpoststatus_'+post_id).text('No');
                        $('.blogpostaccept_'+post_id).attr('value','Accept');
                        $('#blogpost_acceptor_'+post_id).text(session_user);
                        $('#poststatusrej_'+post_id).text('Accepted')
                    }
                },
                dataType: "json"
            });

        }

    });
    $('body').on('click', '.admin-reject-blogpost', function () {

        if (confirm('Are you sure you want to Reject Blog Post?')) {
            var post_id=$(this).attr("data-id");
            var session_user=$(this).attr("data-user");
            //console.log(session_user,post_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {post_id: post_id,session_user:session_user, dispatcher: 'reject-blogpost'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        //console.log(session_user,post_id);
                        //$('#blogpoststatus_'+post_id).text('No');
                        // $('.blogpostaccept_'+post_id).attr('value','Accept');
                        $('.blogpostaccept_'+post_id).css({"opacity":"0.4"});
                        $('.blogpostaccept_'+post_id).attr("disabled",true);
                        $('#blogpost_acceptor_'+post_id).text(session_user);
                        $('#blogpoststatusrej_'+post_id).text('Rejected');
                        $('.blogpostreject_'+post_id).attr("disabled",true);
                        $('.blogpostreject_'+post_id).css({"opacity":"0.4"});

                    }
                },
                dataType: "json",
            });

        }

    });

    //$('body').on('click','#save_blogpost',function(){
    //
    //    var title=$('#post_title').attr('value');
    //    var description=$('#post_description').attr('value');
    //    var image =$('#thumbnailImg').attr('value');
    //    $.ajax({
    //        type:'POST',
    //        url:"includes/ajaxDispatcher.php",
    //        data:{title:title,description:description,image:image,dispatcher:'post-blogpost'},
    //        error: function (req, text, error) {
    //            alert('Error AJAX: ' + text + ' | ' + error);
    //        },
    //        success: function (data) {
    //            if (data['result'] == 'OK') {
    //                //$('.postedblogpost').css('display', 'block');
    //                $('postedblogpost').slideDown('slow');
    //                $(".apply-project-area").delay(500).slideUp('slow');
    //            }
    //        },
    //        dataType: "json"
    //    });
    //    return false;
    //});
//view seed score
    $('body').on('click','#admin_view_seed',function () {
        var pid = $(this).attr("data-id");
        //$('.admin-seed-area').hide();
        $('admin-seed-area').siblings().hide();
          //$('.admin-view-seed-'+pid).show();
        $('.admin-view-seed-'+pid).slideToggle('slow');
        return false;
    });


     //rate project admin
    $('body').on('click','#admin_rate_project',function () {
        var pid = $(this).attr("data-id");
        $(this).siblings().hide();
        $('.admin-rate-area-'+pid).slideToggle('slow');
        return false;
    });

    //$('body').on('click','#admin_save_rate_project',function () {
    //    var pid = $(this).attr("data-id");
    //    $('.admin-rate-area-'+pid).css('display','block');
    //    return false;
    //});
    $('body').on('click','#admin_save_rate_project',function () {
        var project_id = $(this).attr('data-id');
       var user_id = $(this).attr('data-user');
       var f_value = $('#fes_value_'+project_id).val();
       var u_value = $('#uni_value_'+project_id).val();
       var g_value = $('#gro_value_'+project_id).val();
       var s_value = $('#sta_value_'+project_id).val();
       var p_value = $('#pro_value_'+project_id).val();
       var r_value = $('#ris_value_'+project_id).val();
       var t_value = $('#tim_value_'+project_id).val();
       var rd_value = $('#red_value_'+project_id).val();
       var pr_value = $('#prf_value_'+project_id).val();
       var i_value = $('#imp_value_'+project_id).val();
        //var dataArray =new Array(12);
        //dataArray[0]= project_id;
        //dataArray[1]= user_id;
        //dataArray[2]= f_value;
        //dataArray[3]= u_value;
        //dataArray[4]= g_value;
        //dataArray[5]= s_value;
        //dataArray[6]= p_value;
        //dataArray[7]= r_value;
        //dataArray[8]= t_value;
        //dataArray[9]= rd_value;
        //dataArray[10]= pr_value;
        //dataArray[11]= i_value;
        //var jsonString = JSON.stringify(dataArray);
        //console.log(jsonString,dataArray);
        $.ajax({
           type: 'POST',
           url: "includes/ajaxDispatcher.php",
          data:{project_id: project_id,f_value: f_value, u_value: u_value, g_value: g_value, s_value: s_value, p_value: p_value,
              r_value: r_value,
              t_value: t_value,
              rd_value: rd_value,
              pr_value: pr_value,
              i_value: i_value,
              dispatcher:'admin-rate-project'
          },
           error: function (req, text, error) {
               alert('Error AJAX: ' + text + ' | ' + error);
          },
          success: function (data) {
               if (data['result'] == 'OK') {
                   $('.admin_rate_project_'+project_id).attr('value','Rated');
                   $('.admin_rate_project_'+project_id).css({'color':'#FF4F03','opacity':'0.6','disable':'disabled'});
                   $('.admin-rate-area').slideUp('slow');
              }
          },
          dataType: "json"
       });
        return false;
    });
//user verify-deny click event
    $('body').on('click', '.admin-accept-user', function () {

        if (confirm('Are you sure you want to update user status?')) {
            var user_id=$(this).attr("data-id");
            var session_user=$(this).attr("data-user");

            //console.log(user_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {user_id: user_id,session_user:session_user, dispatcher: 'accept-user'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#userstatus_'+user_id).text('Yes.');
                        $('.useraccept_'+user_id).attr('value','Deny');
                        $('<img src="images/4.png" alt=""  title="Verified."class="ver-admin-page">').appendTo('#username_'+user_id);
                        $('#user_acceptor_'+user_id).text(session_user);
                    }else {
                        $('#userstatus_'+user_id).text('No.');
                        $('.useraccept_'+user_id).attr('value','Verify');
                        $('#username_'+user_id).find('.ver-admin-page').hide();
                        $('#user_acceptor_'+user_id).text(session_user)
                    }
                },
                dataType: "json"
            });

        }

    });

    //investor show hide
$('body').on('click','.close-me',function(){
    $('.admin-rate-area').css('display','none');
});
    //user verify-deny click event
    $('body').on('click', '.admin-accept-investor', function () {

        if (confirm('Are you sure you want to update investor status?')) {
            var investor_id=$(this).attr("data-id");
            var session_user=$(this).attr("data-user");

            //console.log(investor_id);
            $.ajax({
                type: 'POST',
                url: "includes/ajaxDispatcher.php",
                data: {investor_id: investor_id,session_user:session_user, dispatcher: 'publish-investor'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data['result'] == 'OK') {
                        $('#investorstatus_'+investor_id).text('Yes.');
                        $('.investoraccept_'+investor_id).attr('value','Hide');
                        $('<img src="images/4.png" alt=""  title="Verified."class="ver-admin-page">').appendTo('#investorname_'+investor_id);
                        $('#investor_acceptor_'+investor_id).text(session_user);
                    }else {
                        $('#investorstatus_'+investor_id).text('No.');
                        $('.investoraccept_'+investor_id).attr('value','Show');
                        $('#investorname_'+investor_id).find('.ver-admin-page').hide();
                        $('#investor_acceptor_'+investor_id).text(session_user)
                    }
                },
                dataType: "json"
            });

        }

    });

   //admin assign raters /

    $('body').on('click','#project_raters',function () {
        var pid = $(this).attr("data-id");

        //$(this).siblings().hide();
        //$('.project-rater-area').attr('data-id',pid);
        //$('.project-rater-area-'+pid).find('.rater-users').attr('data-id',pid);
        $('.project-rater-area-'+pid).slideToggle('slow');
        $('.project-rater-area').find('.rater-search').val('');
        //$('.project-rater-area').find('#route-result').hide();

    $('.rater-search-'+pid).keyup(function (e) {
            // if(e.keyCode == 13) {
            var title = $(this).val();
            var user=  $(this).attr("data-id");
            //console.log(title,user);
            searchRaterList(title,user,pid);
            //}
        });
        return false;
    });

    function searchRaterList(title,user,pid) {
               //console.log('yaha aayo');
        //var title =$('project-rater-area').find(".rater-search").val();
        var title = title;
        var user_id = user;
        if (title != "") {
//                console.log(title);
            //$("#route-result").html("<li>searching</li>");
            $.ajax({
                type: "post",
                url: "includes/ajaxDispatcher.php",
                data: {title: title, user_id: user_id, dispatcher: 'search-rater-user-lists'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {

                    $("#rater-result-"+pid).html(data);
                    //$("#route-result").html('<li class="click-user">'+data+'</li>');
//                        $("#rater-search").val("");
                }
            });
        }
        else {//for empty result
            $.ajax({
                type: "post",
                url: "searchuser.php",
                data: "title=" + title,
                success: function (data) {
                    $("#rater-result-"+pid).html("");
                }
            });
        }
    }


    //$("#rater-button").click(function () {
    //    var pid = $(this).attr("data-id");
    //    searchRaterList(pid);
    //});
    //
    //$('.project-rater-area').find('.rater-search').keyup(function (e) {
    //    // if(e.keyCode == 13) {
    //    var title = $(this).val();
    //    var user=  $(this).attr("data-id");
    //    console.log(title,user);
    //    searchRaterList(title,user);
    //    //}
    //});

//click on admin user

    $('body').on('click', '.click-rater-user', function () {
        var pid=$(this).parent().attr("data-id");
        $.ajax({
            type: "post",
            url: "includes/ajaxDispatcher.php",
            data: {
                sent_to: $(this).attr("data-id"),//user
                project_id: $(this).parent().attr("data-id"),
                dispatcher: 'assign-rater'
            },
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                //console.log(data.result);
                if (data.result == 'OK') {
                    $(".success-message").html('<p style="color:forestgreen;" class="suc"> Assigned to '+data.user+'.</p>');
                    $(".suc").fadeOut(4000);
                    $(".raterusers-"+pid).prepend('<div class="rater-users-list" data-id="' + data.id + '"><span class="remove-rater" data-id="' + data.id + '" user-id="'+data.user_id+'">X</span><a href="user.php?uid=' + data.user_id + '"><li class="routed-name">' + data.user + '</li></a></div>')
                }
                if(data.result == 'LIMIT') {
                    alert("You've already Added 5  users.");
                }
                if(data.result == 'FALSE'){ alert("You've already Added this user.");}
            },
            dataType: "json"
        });
    });

    $('body').on('click', '.remove-rater', function () {
        var pid=$(this).parent().parent().attr("data-id");
        var r = confirm("Are You Sure Want to Remove this user?");
        if (r == true) {
            $.ajax({
                type: "post",
                url: "includes/ajaxDispatcher.php",
                data: {project_id:pid,rater_id: $(this).attr("data-id"), user_id: $(this).attr("user-id"), dispatcher: 'remove-rater-user'},
                error: function (req, text, error) {
                    alert('Error AJAX: ' + text + ' | ' + error);
                },
                success: function (data) {
                    if (data.result == 'OK') {
                        //console.log(data);
                        $(".raterusers-"+pid).find("[data-id=" + data.rater_id + "]").remove();
                        $(".success-message").html('<p style="color: orangered;" class="suc">Unrouted to '+data.user+'.</p>');
                        $(".suc").fadeOut(4000);
                    }
                },
                dataType: "json"
            });
        }
    });


    //admin assign raters ends

    //get profiled
    function validateEmail($email) {
        var emailReg = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return emailReg.test( $email );
    }
    $('#profiled_id').on('click',function(){
       var name =$('#profiled_name').val();
       var  email =$('#profiled_email').val();
       var location =$("#profiled_loc").val();
        console.log(name,email,location);
        if (!name || !email || !location) {
            $("#profiled-message ").attr('title','Error!')
            $("#profiled-message ").find('h3').text('Fill All Columns!');

            $(function() {
                $( "#profiled-message" ).dialog({
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
            });
        }
        else{
            if( validateEmail(email)) {
                $(function() {

                $.ajax({
                    type: "post",
                    url: "includes/ajaxDispatcher.php",
                    data: {name: name, email: email, location: location, dispatcher: 'register-profiled'},
                    error: function (req, text, error) {
                        alert('Error AJAX: ' + text + ' | ' + error);
                    },
                    success: function (data) {
                        if (data.result == 'OK') {
                            $('#profiled_name').val('');
                            $('#profiled_email').val('');
                            $("#profiled_loc").val('');
                            $("#profiled-message ").find('h3').text('Your information has been submitted!');
                                $("#profiled-message").dialog({
                                    modal: true,
                                    buttons: {
                                        Ok: function () {
                                            $(this).dialog("close");
                                        }
                                    }
                                });

                        }
                    },
                    dataType: "json"
                });
            });
            }else{
                $("#profiled-message ").attr('title','Error!')
                $("#profiled-message ").find('h3').text('Enter Valid Email!');

                $(function() {
                    $( "#profiled-message" ).dialog({
                        modal: true,
                        buttons: {
                            Ok: function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    });
                });
            }

        }

    });

//for load more ideathread
    $('body').on('click','.load-more',function(){
        //var last_id = $(this).attr('data-id');
        var current =$(this);
        var AjaxHit = parseInt($(this).attr('data-id'),10);
        current.val("Getting more ideathreads... ");
        $.ajax({
            type: "post",
            url: "includes/ajaxDispatcher.php",
            data: {AjaxHit:AjaxHit, dispatcher: 'load-more'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                console.log(data);
                if (data) {
                    $('.showmore').append(data);
                    current.val("View More");
                    current.parent().appendTo($('body').find('div .showmore').last());
                    AjaxHit=AjaxHit + 5;
                    current.attr('data-id',AjaxHit);
                }else {
                    $('body').find('.load-more').last().css('display', 'none');
                    return;
                }
            },
            //dataType: "json"
        });

    });

//for load more
    $('body').on('click','.view-more',function(){
        var last_id = $(this).attr('data-id');
        var current =$(this);
        var block = current.parent().parent();
        console.log(block);
        var countHit =parseInt($(this).attr('data-id'),10);
        current.text("Loading.... ");
        $.ajax({
            type: "post",
            url: "includes/ajaxDispatcher.php",
            data: {countHit:countHit, dispatcher: 'view-more-trend'},
            error: function (req, text, error) {
                alert('Error AJAX: ' + text + ' | ' + error);
            },
            success: function (data) {
                if (data) {
                    block.hide();
                    $('body').find('.trendviewmore:last-child').prepend(data);
                    current.text("More");
                    $('body').find('.trendviewmore:last-child').append(block);
                    countHit=countHit + 1;
                    current.attr('data-id',countHit);
                    block.show();

                }else {
                    current.text("End");
                    //$('body').find('.view-more').last().val("End");
                    return;
                    //if (data.result == 'OK') {
                    //    current.val("End");
                    //    //$('body').find('.load-more').val('End Of Data');
                    //}else{

                    //}
                }
            },
            //dataType: "json"
        });
    });


    //fancy box to view clicked verified documents
    $(".fancybox").fancybox({});

    //uploading investor image

});