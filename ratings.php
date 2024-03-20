<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="dev_Junwen/css/vendorRating(Viewing).css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/pages.css?1">
    <link rel="stylesheet" href="styles/sidebar.css?1">
    <title>MCX Store Directory</title>
</head>
<style>
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        z-index: 1;
        display: none;
    }
</style>



<body>
    <div id="overlay"></div>
    <?php
    @include 'sidebar.php';
    ?>

    <main class="content">
        <div class="search-container">
            <div class="search-box">
                <input type="text" class="search-bar" placeholder="Search...">
                <i class="fa fa-search search-icon"></i> <!-- Example using FontAwesome -->
            </div>
        </div>

        <div class="filter-container">
            <label for="location">Location:

                <select name="location" id="location" class="search-select" style="background-color: #555; color: white;">
                    <!-- Assume options are generated dynamically -->
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </label>
            <label for="sort">Sort By:
                <select name="sort" id="sort" class="search-select" style="background-color: #555; color: white;">
                    <!-- Assume options are generated dynamically -->
                    <option value="name-asc">Name (A to Z)</option>
                    <option value="name-desc">Name (Z to A)</option>
                    <option value="date-asc">Date (Oldest First)</option>
                    <option value="date-desc">Date (Newest First)</option>
                    <option value="rating-high-low">Rating (High to Low)</option>
                    <option value="rating-low-high">Rating (Low to High)</option>
                    <option value="price-high-low">Price (High to Low)</option>
                    <option value="price-low-high">Price (Low to High)</option>
                </select>
            </label>
        </div>

        <div class="order-container">
            <!-- Vendor Order Card -->
            <div class="order-card">
                <div class="vendor-info">
                    <h2 class="vendor-name">Vendor Name</h2>
                    <div class="order-image-container">
                        <img src="/images/books/bookcases_cabinets.png" alt="Image of Order" class="order-image">
                    </div>
                </div>
                <div class="order-details">
                    <p class="order-number">Order Number: xxx-xxx-xxxxxx</p>
                    <p class="product-name">Product Name</p>
                    <p class="order-status">Status: In Progress</p>
                    <p class="order-quantity">Quantity: 100</p>
                    <p class="order-date">Order Date: 02/21/2024</p>
                </div>
                <div class="order-feedback">
                    <div class="order-rating">
                        <!-- Assuming you have a star rating component or icons -->
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-alt"></i>
                    </div>
                    <p class="total-price">Total Price: $xxx,xxx,xxx</p>
                    <p class="advance-payment">Advance payment: $xx,xxx</p>
                </div>
                <div class="order-actions">
                    <button class="details-button">Details of Order</button>
                    <button class="feedback-button">Feedback</button>
                </div>
            </div>
            <!-- Repeat for other vendor orders -->
            <div class="order-card">
                <div class="card-section vendor-info">
                    <h2 class="vendor-name">Vendor Name</h2>
                    <div class="order-image-container">
                        <img src="/images/books/computerscience_illuminated.png" alt="Image of Order" class="order-image">
                    </div>
                </div>
                <div class="card-section order-details">
                    <p><span class="order-label">Order Number:</span> xxx-xxx-xxxxxx</p>
                    <p><span class="order-label">Product Name</span></p>
                    <p><span class="order-status-label">Status:</span> In Progress</p>
                    <p><span class="order-label">Quantity:</span> 100</p>
                    <p><span class="order-label">Order Date:</span> 02/21/2024</p>
                </div>
                <div class="card-section order-feedback">
                    <div class="order-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-alt"></i>
                    </div>
                    <p class="total-price"><span class="order-label">Total Price:</span> $xxx,xxx,xxx</p>
                    <p class="advance-payment"><span class="order-label">Advance payment:</span> $xx,xxx</p>
                </div>
                <div class="card-section order-actions">
                    <button class="details-button">Details of Order</button>
                    <button class="feedback-button">Feedback</button>
                </div>
            </div>
        </div>


        <div class="pagination">
            <!-- Pagination buttons go here -->
            <button class="page-number active">1</button>
            <button class="page-number">2</button>
            <button class="page-number">3</button>
            <button class="page-number">4</button>
            <button class="page-number">5</button>
            <button class="page-number">Next</button>
            <!-- etc. -->
        </div>
    </main>

</body>

</html>