<?php
function displayStarRating($rating) {
    if ($rating == 0) {
        return "No ratings yet"; // Or return an empty string for no output
    }
    $output = '<div class="star-rating">';

    // Full stars
    for ($i = 0; $i < floor($rating); $i++) {
        $output .= '<img src="images/sf-icons/star.png" width="25px">'; // Full star
    }

    // Half star
    if ($rating - floor($rating) >= 0.5) {
        $output .= '<img src="images/sf-icons/half-star.png" width="25px">'; // Half star (You can use a half-star character or icon)
    }

    // Empty stars
    for ($i = ceil($rating); $i < 5; $i++) {
        $output .= '<img src="images/sf-icons/empty-star.png" width="25px">'; // Empty star
    }

    $output .= '</div>';

    return $output;
}
?>
