<?php

session_start();
include('../connection.php');

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'rm') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

$sqlmain = "select * from review_machine where rmemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();

$docid = $userfetch["docid"];
$userid = $userfetch["rmid"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Doctor Rating</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&amp;display=swap'>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/jquery-min.js"></script>

</head>
<style>
    * {
        border: 0;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .hidden {
        display: none;
    }

    :root {
        --bg: #e3e4e8;
        --fg: #17181c;
        --primary: #255ff4;
        --yellow: #f4a825;
        --yellow-t: rgba(244, 168, 37, 0);
        --bezier: cubic-bezier(0.42, 0, 0.58, 1);
        --trans-dur: 0.3s;
        font-size: calc(24px + (30 - 24) * (100vw - 320px) / (1280 - 320));
    }

    body {
        background-color: var(--bg);
        color: var(--fg);
        font: 1em/1.5 "DM Sans", sans-serif;
        display: flex;
        height: 100vh;
        transition: background-color var(--trans-dur), color var(--trans-dur);
    }

    .rating {
        margin: auto;
        margin-top: 35vh !important;
    }

    .rating__display {
        font-size: 1em;
        font-weight: 500;
        min-height: 1.25em;
        position: absolute;
        top: 100%;
        width: 100%;
        text-align: center;
    }

    .rating__stars {
        display: flex;
        padding-bottom: 0.375em;
        position: relative;
    }

    .rating__star {
        display: block;
        overflow: visible;
        pointer-events: none;
        width: 2em;
        height: 2em;
    }

    .rating__star-ring,
    .rating__star-fill,
    .rating__star-line,
    .rating__star-stroke {
        animation-duration: 1s;
        animation-timing-function: ease-in-out;
        animation-fill-mode: forwards;
    }

    .rating__star-ring,
    .rating__star-fill,
    .rating__star-line {
        stroke: var(--yellow);
    }

    .rating__star-fill {
        fill: var(--yellow);
        transform: scale(0);
        transition: fill var(--trans-dur) var(--bezier), transform var(--trans-dur) var(--bezier);
    }

    .rating__star-stroke {
        stroke: #c7cad1;
        transition: stroke var(--trans-dur);
    }

    .rating__label {
        cursor: pointer;
        padding: 0.125em;
    }

    .rating__label--delay1 .rating__star-ring,
    .rating__label--delay1 .rating__star-fill,
    .rating__label--delay1 .rating__star-line,
    .rating__label--delay1 .rating__star-stroke {
        animation-delay: 0.05s;
    }

    .rating__label--delay2 .rating__star-ring,
    .rating__label--delay2 .rating__star-fill,
    .rating__label--delay2 .rating__star-line,
    .rating__label--delay2 .rating__star-stroke {
        animation-delay: 0.1s;
    }

    .rating__label--delay3 .rating__star-ring,
    .rating__label--delay3 .rating__star-fill,
    .rating__label--delay3 .rating__star-line,
    .rating__label--delay3 .rating__star-stroke {
        animation-delay: 0.15s;
    }

    .rating__label--delay4 .rating__star-ring,
    .rating__label--delay4 .rating__star-fill,
    .rating__label--delay4 .rating__star-line,
    .rating__label--delay4 .rating__star-stroke {
        animation-delay: 0.2s;
    }

    .rating__input {
        -webkit-appearance: none;
        appearance: none;
    }

    .rating__input:hover~[data-rating]:not([hidden]) {
        display: none;
    }

    .rating__input-1:hover~[data-rating="1"][hidden],
    .rating__input-2:hover~[data-rating="2"][hidden],
    .rating__input-3:hover~[data-rating="3"][hidden],
    .rating__input-4:hover~[data-rating="4"][hidden],
    .rating__input-5:hover~[data-rating="5"][hidden],
    .rating__input:checked:hover~[data-rating]:not([hidden]) {
        display: block;
    }

    .rating__input-1:hover~.rating__label:first-of-type .rating__star-stroke,
    .rating__input-2:hover~.rating__label:nth-of-type(-n + 2) .rating__star-stroke,
    .rating__input-3:hover~.rating__label:nth-of-type(-n + 3) .rating__star-stroke,
    .rating__input-4:hover~.rating__label:nth-of-type(-n + 4) .rating__star-stroke,
    .rating__input-5:hover~.rating__label:nth-of-type(-n + 5) .rating__star-stroke {
        stroke: var(--yellow);
        transform: scale(1);
    }

    .rating__input-1:checked~.rating__label:first-of-type .rating__star-ring,
    .rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-ring,
    .rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-ring,
    .rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-ring,
    .rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-ring {
        animation-name: starRing;
    }

    .rating__input-1:checked~.rating__label:first-of-type .rating__star-stroke,
    .rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-stroke,
    .rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-stroke,
    .rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-stroke,
    .rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-stroke {
        animation-name: starStroke;
    }

    .rating__input-1:checked~.rating__label:first-of-type .rating__star-line,
    .rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-line,
    .rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-line,
    .rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-line,
    .rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-line {
        animation-name: starLine;
    }

    .rating__input-1:checked~.rating__label:first-of-type .rating__star-fill,
    .rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-fill,
    .rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-fill,
    .rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-fill,
    .rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-fill {
        animation-name: starFill;
    }

    .rating__input-1:not(:checked):hover~.rating__label:first-of-type .rating__star-fill,
    .rating__input-2:not(:checked):hover~.rating__label:nth-of-type(2) .rating__star-fill,
    .rating__input-3:not(:checked):hover~.rating__label:nth-of-type(3) .rating__star-fill,
    .rating__input-4:not(:checked):hover~.rating__label:nth-of-type(4) .rating__star-fill,
    .rating__input-5:not(:checked):hover~.rating__label:nth-of-type(5) .rating__star-fill {
        fill: var(--yellow-t);
    }

    .rating__sr {
        clip: rect(1px, 1px, 1px, 1px);
        overflow: hidden;
        position: absolute;
        width: 1px;
        height: 1px;
    }

    @media (prefers-color-scheme: dark) {
        :root {
            --bg: #17181c;
            --fg: #e3e4e8;
        }

        .rating {
            margin: auto;
        }

        .rating__star-stroke {
            stroke: #454954;
        }
    }

    @keyframes starRing {

        from,
        20% {
            animation-timing-function: ease-in;
            opacity: 1;
            r: 8px;
            stroke-width: 16px;
            transform: scale(0);
        }

        35% {
            animation-timing-function: ease-out;
            opacity: 0.5;
            r: 8px;
            stroke-width: 16px;
            transform: scale(1);
        }

        50%,
        to {
            opacity: 0;
            r: 16px;
            stroke-width: 0;
            transform: scale(1);
        }
    }

    @keyframes starFill {

        from,
        40% {
            animation-timing-function: ease-out;
            transform: scale(0);
        }

        60% {
            animation-timing-function: ease-in-out;
            transform: scale(1.2);
        }

        80% {
            transform: scale(0.9);
        }

        to {
            transform: scale(1);
        }
    }

    @keyframes starStroke {
        from {
            transform: scale(1);
        }

        20%,
        to {
            transform: scale(0);
        }
    }

    @keyframes starLine {

        from,
        40% {
            animation-timing-function: ease-out;
            stroke-dasharray: 1 23;
            stroke-dashoffset: 1;
        }

        60%,
        to {
            stroke-dasharray: 12 12;
            stroke-dashoffset: -12;
        }
    }

    .name-details {
        background-color: #c7cad1;
        width: 80vw;
        height: 27vh;
        position: absolute;
        margin: 7vh 0 0 10vw;
        border-radius: 10px;
        color: #17181c;
        font-family: 'Montserrat', sans-serif;
    }

    .thanks-message {
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 1px;
        font-size: 18px;
        margin-top: 10vh;
    }
</style>

<body>
    <?php
    $result =  $database->query("SELECT doctor.docname, patient.pname FROM doc_review INNER JOIN patient ON patient.pid = doc_review.pid INNER JOIN doctor ON doctor.docid = doc_review.docid WHERE doc_review.docid = '$docid' and seen_status = 0;");
    ?>
    <div class="name-details">
        <div style="position: absolute;">
            <p style="margin: 10vh 0vh 0vh 10vw"><b>Doctor :</b> <span id="docname"></span></p>
        </div>
        <div style="position: absolute;">
            <p style="margin: 10vh 0vh 0vh 45vw"><b>Patient :</b> <span id="pname"></span></p>
        </div>
    </div>
    <div id="rating-container" style="margin: auto;">
        <form class="rating" style="transform: scale(1.4);">
            <div class="rating__stars">
                <input id="rating-1" class="rating__input rating__input-1" type="radio" name="rating" value="1">
                <input id="rating-2" class="rating__input rating__input-2" type="radio" name="rating" value="2">
                <input id="rating-3" class="rating__input rating__input-3" type="radio" name="rating" value="3">
                <input id="rating-4" class="rating__input rating__input-4" type="radio" name="rating" value="4">
                <input id="rating-5" class="rating__input rating__input-5" type="radio" name="rating" value="5">
                <label class="rating__label" for="rating-1">
                    <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                        <g transform="translate(16,16)">
                            <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                        </g>
                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <g transform="translate(16,16) rotate(180)">
                                <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                            </g>
                            <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                            </g>
                        </g>
                    </svg>
                    <span class="rating__sr">1 star—Terrible</span>
                </label>
                <label class="rating__label" for="rating-2">
                    <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                        <g transform="translate(16,16)">
                            <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                        </g>
                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <g transform="translate(16,16) rotate(180)">
                                <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                            </g>
                            <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                            </g>
                        </g>
                    </svg>
                    <span class="rating__sr">2 stars—Bad</span>
                </label>
                <label class="rating__label" for="rating-3">
                    <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                        <g transform="translate(16,16)">
                            <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                        </g>
                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <g transform="translate(16,16) rotate(180)">
                                <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                            </g>
                            <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                            </g>
                        </g>
                    </svg>
                    <span class="rating__sr">3 stars—OK</span>
                </label>
                <label class="rating__label" for="rating-4">
                    <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                        <g transform="translate(16,16)">
                            <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                        </g>
                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <g transform="translate(16,16) rotate(180)">
                                <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                            </g>
                            <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                            </g>
                        </g>
                    </svg>
                    <span class="rating__sr">4 stars—Good</span>
                </label>
                <label class="rating__label" for="rating-5">
                    <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                        <g transform="translate(16,16)">
                            <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                        </g>
                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <g transform="translate(16,16) rotate(180)">
                                <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                            </g>
                            <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                            </g>
                        </g>
                    </svg>
                    <span class="rating__sr">5 stars—Excellent</span>
                </label>
                <p class="rating__display" data-rating="1" hidden>Terrible</p>
                <p class="rating__display" data-rating="2" hidden>Bad</p>
                <p class="rating__display" data-rating="3" hidden>OK</p>
                <p class="rating__display" data-rating="4" hidden>Good</p>
                <p class="rating__display" data-rating="5" hidden>Excellent</p>
            </div>
        </form>
        <p id="thanks-message" style="display: none;">Thanks for rating!</p>
    </div>

</body>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        const starRating = new StarRating("form");
    });

    class StarRating {
        constructor(qs) {
            this.ratings = [{
                    id: 1,
                    name: "Terrible"
                },
                {
                    id: 2,
                    name: "Bad"
                },
                {
                    id: 3,
                    name: "OK"
                },
                {
                    id: 4,
                    name: "Good"
                },
                {
                    id: 5,
                    name: "Excellent"
                }
            ];
            this.rating = null;
            this.el = document.querySelector(qs);

            this.init();
        }
        init() {
            this.el?.addEventListener("change", this.updateRating.bind(this));

            // stop Firefox from preserving form data between refreshes
            try {
                this.el?.reset();
            } catch (err) {
                console.error("Element isn’t a form.");
            }
        }
        updateRating(e) {
            // clear animation delays
            Array.from(this.el.querySelectorAll(`[for*="rating"]`)).forEach(el => {
                el.className = "rating__label";
            });

            const ratingObject = this.ratings.find(r => r.id === +e.target.value);
            const prevRatingID = this.rating?.id || 0;

            let delay = 0;
            this.rating = ratingObject;
            this.ratings.forEach(rating => {
                const {
                    id
                } = rating;

                // add the delays
                const ratingLabel = this.el.querySelector(`[for="rating-${id}"]`);

                if (id > prevRatingID + 1 && id <= this.rating.id) {
                    ++delay;
                    ratingLabel.classList.add(`rating__label--delay${delay}`);
                }

                // hide ratings to not read, show the one to read
                const ratingTextEl = this.el.querySelector(`[data-rating="${id}"]`);

                if (this.rating.id !== id)
                    ratingTextEl.setAttribute("hidden", true);
                else
                    ratingTextEl.removeAttribute("hidden");
            });
        }
    }
</script>
<script>
    // Function to enter full screen
    function enterFullscreen(element) {
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.mozRequestFullScreen) { // Firefox
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) { // Chrome, Safari, and Opera
            element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) { // IE/Edge
            element.msRequestFullscreen();
        }
    }

    // Enter full screen automatically when the page loads
    const elementToFullscreen = document.documentElement; // Fullscreen the entire document
    enterFullscreen(elementToFullscreen);
</script>
<script>
    // Function to fetch and update data dynamically
    function updateData() {
        $.ajax({
            url: 'fetch_data.php', // Replace with your server-side script URL
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update the HTML content with the fetched data
                $('#docname').text(response.docname);
                $('#pname').text(response.pname);
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch data:', status, error);
            }
        });
    }

    // Call the updateData function initially and set an interval to periodically update
    updateData();
    setInterval(updateData, 5000); // Update every 5 seconds (adjust as needed)
</script>

<script>
    $(document).ready(function() {
        // Function to handle rating selection
        $('.rating__input').on('change', function() {
            var selectedRating = $(this).val();

            // Set the selected rating value in the hidden input field
            $('#rating-value').val(selectedRating);

            // Send the rating to the PHP script using AJAX
            $.ajax({
                type: 'POST',
                url: 'process_rating.php', // Replace with the URL of your PHP script
                data: {
                    rating: selectedRating
                },
                success: function(response) {
                    // Handle the response from the PHP script (if needed)
                    console.log(response);

                    // Hide the form after 5 seconds
                    setTimeout(function() {
                        $('.rating').hide();

                        // Display the "Thanks for rating" message
                        $('#thanks-message').show();

                        // Reload the page after another 5 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to send rating:', status, error);
                }
            });
        });
    });
</script>


</html>