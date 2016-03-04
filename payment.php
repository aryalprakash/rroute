<?php
include('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');
require_once('includes/libs/stripe-php-master/init.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');
if(!$_POST)
    redirect('home.php');
$user = getUserData($_SESSION['uid']);
$success = false;
$error = '';
$amount = '';
//print_r($_POST);
if (!empty($_POST['stripeToken'])) {
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_test_JibAHEWq92eWdNUWUfbmdaAN");
    $amount = intval($_POST['due_amount']); // amount in cents

    // Get the credit card details submitted by the form
    $token = $_POST['stripeToken'];

    // Create the charge on Stripe's servers - this will charge the user's card
    try {
        $charge = \Stripe\Charge::create(array(
                "amount" => $amount * 100, // amount in cents, again
                "currency" => "usd",
                "source" => $token,
                "description" => "Example charge")
        );

    } catch (\Stripe\Error\Card $e) {
        // The card has been declined
        $error = $e->getMessage();
    }

//    if (savePayment($token, $amount, $user)) {
//        $success = "Successful charge";
//
//    };
}

//function savePayment($token, $amount, $user)
//{
//    global $db_con;
//    global $balance;
//    checkBalance($user);
//    $balance = $balance + $amount;
//
//    $query = "INSERT INTO `payments`(`transaction_id`, `type`, `description`, `amount` , `user_id` , `balance` , `project_id`, `created_by`)
//		 VALUES ( '" . $token . "' , 0, '" . $db_con->escape($_POST['description']) . "' , '" . $amount . "' , '" . $db_con->escape($_POST['user_id']) . "' , '" . $balance . "' , '" . $db_con->escape($_POST['pid']) . "' , '" . $user['user_id'] . "')";
//
//    $db_con->query($query);
//    $id = $db_con->insert_id();
//
//    $query1 = "UPDATE `users` SET balance=" . $balance . " WHERE user_id=" . $user['user_id'];
//    $db_con->query($query1);
//    //updateStatusFunding();
//    //updateStatusProject($_POST['pid'])
//    //UpdateStatusFunings($_POST['pid'],$amount);
//    //UpdateStatusFundable($_POST['pid']);
//    return $id;
//}
//
//$balance = 0;
//function checkBalance($user)
//{
//    global $db_con;
//    global $balance;
//    $balanceQuery = "SELECT SUM(`amount`) as total FROM `payments` WHERE created_by = " . $user['user_id'];
//    $balance = $db_con->query($balanceQuery);
//    $balance = $db_con->fetch_array($balance);
//    $balance = intval($balance['total']);
//}
//
//checkBalance($user);
//

?>

    <div class="inner-page-wrapper">

        <div class="payment inner-page content">

            <?php include(DIR_INCLUDE . 'left_nav.php'); ?>


            <?php if ($_POST['pid']) {
                $project = getProjectById(intval($_POST['pid']));
                $monetize = intval($project['monetize']);
                $date = date('Y-m-d', time());
            } else {
                $monetize = 0;
                $date = 'N/A';
            }
            ?>


            <script type="text/javascript"
                    src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
            <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
            <script type="text/javascript">
                Stripe.setPublishableKey('pk_test_46B48arrqMlpOhwxXGLXMS4I');
                $(document).ready(function () {

                    /*function addInputNames() {
                     // Not ideal, but jQuery's validate plugin requires fields to have names
                     // so we add them at the last possible minute, in case any javascript
                     // exceptions have caused other parts of the script to fail.
                     $(".card-number").attr("name", "card-number")
                     $(".card-cvc").attr("name", "card-cvc")
                     $(".card-expiry-year").attr("name", "card-expiry-year")
                     }

                     function removeInputNames() {
                     $(".card-number").removeAttr("name")
                     $(".card-cvc").removeAttr("name")
                     $(".card-expiry-year").removeAttr("name")
                     }*/

                    amount = 0;
                    function submit(form) {
                        amount = $("input[name='due_amount']").val();
                        if (amount == '' || amount == 0) {
                            alert('Enter amount value');
                            return false;
                        }
                        // remove the input field names for security
                        // we do this *before* anything else which might throw an exception
                        //removeInputNames(); // THIS IS IMPORTANT!

                        // given a valid form, submit the payment details to stripe
                        $(form['submit-button']).attr("disabled", "disabled")

                        Stripe.createToken({
                            number: $('.card-number').val(),
                            cvc: $('.card-cvc').val(),
                            exp_month: $('.month').val(),
                            exp_year: $('.year').val()
                        }, function (status, response) {
                            if (response.error) {
                                // re-enable the submit button
                                $(form['submit-button']).removeAttr("disabled")

                                // show the error
                                $(".payment-errors").html(response.error.message);

                                // we add these names back in so we can revalidate properly
                                //addInputNames();
                            } else {
                                // token contains id, last4, and card type
                                var token = response['id'];

                                // insert the stripe token
                                var input = $("<input name='stripeToken' value='" + token + "' style='display:none;' />");
                                form.appendChild(input[0])

                                // and submit

                                $(".payment-errors").html('You payment accepted!');
                                form.submit();
                            }
                        });

                        return false;
                    }

                    // add custom rules for credit card validating
                    jQuery.validator.addMethod("cardNumber", Stripe.validateCardNumber, "Please enter a valid card number");
                    jQuery.validator.addMethod("cardCVC", Stripe.validateCVC, "Please enter a valid security code");
                    jQuery.validator.addMethod("cardExpiry", function () {
                        return Stripe.validateExpiry($(".month").val(),
                            $(".year").val())
                    }, "Please enter a valid expiration");

                    // We use the jQuery validate plugin to validate required params on submit
                    $("#card-payment").validate({
                        submitHandler: submit,
                        rules: {
                            "card-cvc": {
                                cardCVC: true,
                                required: true
                            },
                            "card-number": {
                                cardNumber: true,
                                required: true
                            },
                            "year": "cardExpiry" // we don't validate month separately
                        }
                    });

                    // adding the input field names is the last step, in case an earlier step errors
                    // addInputNames();
                });
            </script>

            <div class="main-content">

                <ul class="router-top-nav">
                    <li><a href="account.php">Account</a></li>
                    <li><a href="privacy.php">Privacy</a></li>
                    <li class="active"><a href="payment.php">Payment</a></li>
                    <li><a href="report.php">Report</a></li>
                    <li class="logout"><a href="logout.php">Logout</a></li>
                </ul>

                <div class="content-block">
                    <form action="<?php echo SITE_URL; ?>/payment_process.php" method="post" id="card-payment">

                        <input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>"/>
                        <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>"/>
                        <input type="hidden" name="eq_pc" value="<?php echo rtrim(trim($_POST['eq_pc'])); ?>"/>
                        <input type="hidden" name="fin_pro" value="<?php echo rtrim(trim($_POST['fin_pro'])); ?>"/>
                        <input type="hidden" name="user_choice" value="<?php echo rtrim(trim($_POST['user_choice'])); ?>"/>
                        <input type="hidden" name="user_id" value="<?php $user_id=getProjectAuthor( $_POST['pid']); echo $user_id ;?>" />
<!--                        <div class="content-title">Account Settings</div>-->
<!--                        <div class="report-content-title">Rangeenroute Finance Account</div>-->
<!--                        <br/>-->
<!---->
<!--                        <div class="form-item"><label>Available Balance:</label>$ <input type="text" name="balance"-->
<!--                                                                                         value="--><?php //echo $balance; ?><!--">-->
<!--                        </div>-->
<!--                        <hr class="delimiter standart">-->
<!---->
<!--                        <div class="content-left-col">-->
<!--                            <div class="form-item"><label>Amount Due:</label>$ <input type="text" name="due_amount"-->
<!--                                                                                      value="--><?php //echo $monetize; ?><!--">-->
<!--                            </div>-->
<!--                            <div class="form-item"><label>Due Date:</label>&nbsp;&nbsp; <input type="text"-->
<!--                                                                                               name="due_date"-->
<!--                                                                                               value="--><?php //echo $date; ?><!--">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="content-right-col">-->
<!--                            <div class="form-item"><br><input type="radio" name="payment_option" value="1"-->
<!--                                                              id="pay_account" disabled="disabled"><label-->
<!--                                    for="pay_account" class="radio-label">Rangeenroute Finance Account</label></div>-->
<!--                            <div class="form-item"><input type="radio" name="payment_option" value="2" id="pay_card"-->
<!--                                                          checked><label for="pay_card" class="radio-label">Debit or-->
<!--                                    Credit Card</label></div>-->
<!--                        </div>-->


                        <div class="report-page-block payment-section pay-via-card-section" style="width: 829px;">


                            <span class="payment-errors"><?php if ($success) echo $success; ?></span>

                            <div class="content-left-col">
                                <div class="form-item"><label>Amount: $</label> <input type="text" name ="amount" value="<?php echo $_POST['amount'];  ?>"readonly></div>
                                <div class="form-item"><label>Card Type:</label> <img src="images/icons/mastercard.png">
                                    <img src="images/icons/visa.png"> <img src="images/icons/paypal.png"> <img
                                        src="images/icons/googlecheckout.png"> <img src="images/icons/amex.png"> <img
                                        src="images/icons/discover.png"></div>
                                <div class="form-item"><label>Name on Card:</label> <input type="text" name="cardname" required></div>
                                <div class="form-item"><label>Expiration:</label>
                                    <select class="month" data-stripe="exp-month" name="month" required>
                                        <option>Month</option>
                                        <?php for ($i = 1; $i < 13; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <select class="year" data-stripe="exp-year" name="year" required>
                                        <option>Year</option>
                                        <?php for ($i = (date('Y', time()) + 10); $i >= date('Y', time()); $i--) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="content-right-col">
                                <div class="form-item"><label>Card Number:</label> <input type="text" size="20"
                                                                                          data-stripe="number"
                                                                                          class="card-number" name="card" required></div>
                                <div class="form-item"><label>CVV:</label> <input type="text" size="4" data-stripe="cvc"
                                                                                  class="card-cvc" name="cvc" required></div>
                                <div class="form-item"><label>Zip Code:</label> <input type="text" name="zip_code" required>
                                </div>
                            </div>
                        </div>
                        <div class="payment-bottom pay-via-card-section">
                            I agree to pay the amount due by clicking "Pay" button
                            <input class="cancel-pay-btn" type="button" value="Cancel">
                            <!--<input class="pay-btn" type="submit" value="Pay" name="submit-button">-->
                            <button type="submit" name="submit-button">Pay</button>

                        </div>
                    </form>


                    <div class="report-page-block payment-section pay-via-account-section" style="width: 829px;">
                        <form action="" method="post" id="account-payment">
                            <div class="content-left-col">
                                <div class="form-item"><label>Name of user:</label> <input type="text" name="user_name">
                                </div>
                                <div class="form-item"><label>Address of Billing:</label> <input type="text"
                                                                                                 name="billing_address">
                                </div>
                                <div class="form-item"><label>Rangeenroute Acc. #:</label> <input type="text"
                                                                                                  name="billing_address">
                                </div>
                            </div>

                            <div class="content-right-col">
                                <div class="form-item"><label>Available Balance:</label> $ <input type="text"
                                                                                                  name="available_balance"
                                                                                                  style="width:210px;">
                                </div>
                                <div class="form-item"><label>Deduction Amount:</label> $ <input type="text"
                                                                                                 name="deduction_amount"
                                                                                                 style="width:210px;">
                                </div>
                            </div>
                    </div>
                    <div class="payment-bottom pay-via-account-section">
                        I agree to pay the amount due by clicking "Pay" button.
                        <input class="cancel-pay-btn" type="button" value="Cancel">
                        <input class="pay-btn" type="submit" value="Pay">
                    </div>
                    </form>


                </div>


            </div>

        </div> <!-- account inner-page content -->

        <?php include(DIR_INCLUDE . 'right_side.php'); ?>


    </div> <!-- inner-page-wrapper -->


<?php include(DIR_INCLUDE . 'footer.php'); ?>