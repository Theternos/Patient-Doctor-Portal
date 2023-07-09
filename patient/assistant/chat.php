<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Dashboard</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>


</head>

<body>
    <?php
    #rasa run --enable-api --cors "*"
    #rasa run actions

    session_start();
    error_reporting(0);
    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");

    $sqlmain = "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch = $userrow->fetch_assoc();

    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];


    //echo $userid;
    //echo $username;

    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">All Doctors</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Scheduled Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Bookings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-active menu-icon-assistant-active">
            <a href="settings.php" class="non-style-link-menu non-style-link-menu-active">
                <div>
                    <p class="menu-text">Assistant</p>
            </a></div>
        </td>
    </tr>
    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Virtual Assistant</p>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php

                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        echo $today;


                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>
            </tr>
        </table>
        <div class="chat">
            <?php
            session_start();

            // Initialize conversation history if not set
            if (!isset($_SESSION['conversation'])) {
                $_SESSION['conversation'] = [];
            }

            // Rasa server URL
            $rasaServerURL = 'http://localhost:5005/webhooks/rest/webhook';

            // Function to send a message to Rasa server and get bot responses
            function getBotResponses($message)
            {
                global $rasaServerURL;

                // Create JSON payload
                $data = array(
                    'sender' => 'user',
                    'message' => $message
                );

                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => json_encode($data),
                    ),
                );

                // Send request to Rasa server
                $context = stream_context_create($options);
                $result = file_get_contents($rasaServerURL, false, $context);

                // Decode the response
                $response = json_decode($result, true);

                // Extract the bot responses
                $botResponses = [];
                foreach ($response as $message) {
                    $botResponses[] = $message['text'];
                }

                return $botResponses;
            }

            if (isset($_POST['user_input'])) {
                $userInput = $_POST['user_input'];

                // Add user input to conversation history
                $_SESSION['conversation'][] = array(
                    'role' => 'user',
                    'message' => $userInput
                );

                // Get bot responses
                $botResponses = getBotResponses($userInput);

                // Add bot responses to conversation history
                foreach ($botResponses as $botResponse) {
                    $_SESSION['conversation'][] = array(
                        'role' => 'bot',
                        'message' => $botResponse
                    );
                }
            }
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }

                    .chat-container {
                        display: flex;
                        flex-direction: column;
                        max-height: calc(82vh - 100px);
                        overflow-y: scroll;
                        padding: 20px;
                        background-color: #fff;
                        margin: 5vh 8vh 5vh 3vh;
                        border-radius: 7px;
                        border: 1px solid rgb(226, 226, 226);
                    }

                    .chat-bubble {
                        display: flex;
                        justify-content: flex-start;
                        margin-bottom: 10px;
                    }

                    .chat-bubble-user {
                        justify-content: flex-end;
                    }

                    .chat-bubble-logo {
                        width: 30px;
                        height: 30px;
                        margin: 18px 10px 0 10px;
                        border-radius: 50%;
                    }

                    .chat-bubble-content {
                        background-color: #f0f0f0;
                        padding: 3px 10px 3px 10px;
                        border-top-right-radius: 20px;
                        border-top-left-radius: 20px;
                        max-width: 80%;
                        word-wrap: break-word;
                    }

                    .chat-bubble-content-user {
                        background-color: #4285f4;
                        color: #fff;
                        text-align: right;
                        border-bottom-left-radius: 20px;
                        border-bottom-right-radius: 0;
                    }

                    .chat-bubble-content-bot {
                        background-color: #efefef;
                        color: #000;
                        border-bottom-right-radius: 20px;
                        border-bottom-left-radius: 0;
                    }

                    .chat-input {
                        display: flex;
                        align-items: center;
                        margin-top: 20px;
                        position: fixed;
                        bottom: 0;
                        right: 0;
                        width: 75%;
                        padding: 20px;
                        background-color: #fff;
                        box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
                    }

                    .user-input {
                        flex-grow: 1;
                        padding: 10px;
                        border: none;
                        border-radius: 5px;
                        margin-right: 10px;
                    }

                    .send-button {
                        padding: 10px 20px;
                        border: none;
                        background-color: #4285f4;
                        color: #fff;
                        border-radius: 5px;
                        cursor: pointer;
                    }
                </style>
            </head>

            <body>
                <div class="chat-container">
                    <?php
                    foreach ($_SESSION['conversation'] as $message) {
                        $role = $message['role'];
                        $text = $message['message'];

                        if ($role === 'user') { ?>
                            <div class="chat-bubble chat-bubble-user">
                                <div class="chat-bubble-content chat-bubble-content-user">
                                    <p class="user-message"><?php echo $text ?></p>
                                </div>
                                <img src="../img/user.png" alt="User Logo" class="chat-bubble-logo">
                            </div>
                        <?php } else { ?>
                            <div class="chat-bubble">
                                <img src="../img/icons/assistant.svg" alt="Bot Logo" class="chat-bubble-logo">
                                <div class="chat-bubble-content chat-bubble-content-bot">
                                    <p class="bot-message"><?php echo $text ?></p>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
                <form id="chat-form" method="POST" action="" class="chat-input">
                    <input type="text" id="user-input" name="user_input" class="user-input" placeholder="Type your message">
                    <button type="submit" class="send-button">Send</button>
                </form>
                <script>
                    // Scroll to the bottom of the chat container
                    const chatContainer = document.querySelector(".chat-container");
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                </script>
            </body>

            </html>

        </div>

</body>

</html>