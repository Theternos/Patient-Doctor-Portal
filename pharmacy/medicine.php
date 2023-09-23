<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">

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

        h1 {
            background-color: #232f3e;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        /* Search form styles */
        #search-form {
            text-align: center;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
        }

        /* Product container styles */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .product-container {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .product-container:hover {
            transform: scale(1.02);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .product-details {
            padding: 20px;
        }

        .product-button {
            background-color: #232f3e;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>


</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'm') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");

    $sqlmain = "select * from others where oemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch = $userrow->fetch_assoc();

    $userid = $userfetch["oid"];
    $username = $userfetch["oname"];


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
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment-active menu-active">
                        <a href="medicine.php" class="non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Medicines</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Today's Patients</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-recent">
                        <a href="recent.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">All Consultancy</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Settings</p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

                <tr>

                    <td colspan="1" class="nav-bar">
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Shopping Cart</p>

                    </td>
                    <td>
                        <form id="search-form" class="header-search">
                            <input type="search" id="medicine-name" name="search" class="input-text header-searchbar" placeholder="Search Medicine Name">&nbsp;&nbsp;
                            <button type="submit" class="login-btn btn-primary btn">Search</button>
                        </form>
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


                            $patientrow = $database->query("select  * from  patient;");
                            $doctorrow = $database->query("select  * from  doctor;");
                            $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                            $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
            </table>

            <div>
                <div id="result" class="hidden"></div>
                <div class="product-grid" id="shopping-cart" class="hidden">
                    <!-- Product containers will be dynamically added here using JavaScript -->
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const initialMedicineName = "General";

            // Function to create a product container
            function createProductContainer(medicine) {
                const productContainer = document.createElement("div");
                productContainer.classList.add("product-container");
                productContainer.innerHTML = `
          <img src="${medicine.image}" alt="${medicine.name}" width="100%">
          <div class="product-details">
            <h3>${medicine.name}</h3>
            <p>Manufacturer: ${medicine.manufacturer.name}</p>
            <p>Price: Rs. ${medicine.price.final_price}</p>
            <button class="product-button">Add to Cart</button>
          </div>
        `;
                return productContainer;
            }

            // Function to fetch and display medicine data
            function fetchAndDisplayMedicineData(medicineName) {
                fetch(
                        `https://beta.myupchar.com/api/medicine/search?api_key=62d1ac936a4324a198c4a60d4c98c2c1&name=${medicineName}`
                    )
                    .then((response) => response.json())
                    .then((data) => {
                        const resultDiv = document.getElementById("result");
                        resultDiv.innerHTML = ""; // Clear previous results
                        resultDiv.classList.remove("hidden");

                        const shoppingCart = document.getElementById("shopping-cart");
                        shoppingCart.classList.remove("hidden");

                        const productGrid = document.querySelector(".product-grid");
                        productGrid.innerHTML = "";

                        // Loop through the medicine data and create product containers
                        data.data.forEach((medicine) => {
                            const productContainer = createProductContainer(medicine);
                            productGrid.appendChild(productContainer);

                            // Add product to shopping cart on button click
                            const addToCartButton =
                                productContainer.querySelector(".product-button");
                            addToCartButton.addEventListener("click", function() {
                                const cartItem = document.createElement("li");
                                cartItem.innerHTML = `
                  <img src="${medicine.image}" alt="${medicine.name}" width="150px">
                  <h3>${medicine.name}</h3>
                  <p>Manufacturer: ${medicine.manufacturer.name}</p>
                  <p>Price: Rs. ${medicine.price.final_price}</p>
                  <a href="${medicine.product_url}" target="_blank">View Details</a>
                `;
                                document.getElementById("cart-items").appendChild(cartItem);
                            });
                        });
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            }

            // Fetch and display medicine data on initial page load
            fetchAndDisplayMedicineData(initialMedicineName);

            // Add event listener to the form
            document
                .getElementById("search-form")
                .addEventListener("submit", function(e) {
                    e.preventDefault();

                    // Get the medicine name entered by the user
                    const medicineName = document.getElementById("medicine-name").value;

                    // Fetch and display medicine data based on the user's input
                    fetchAndDisplayMedicineData(medicineName);
                });
        });
    </script>
</body>

</html>