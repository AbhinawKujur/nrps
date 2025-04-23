<!DOCTYPE html>
<html>
<head>
    <title>Fee Generation</title>
</head>
<body>
    <h3>Fee Generation</h3>
    <form id="fee_generation_form" method="post" action="">
        <label for="selected_month">Select Month:</label>
        <input type="month" id="selected_month" name="selected_month" required>
        <button type="submit" id="generate_button">Generate Fee</button>
    </form>

    <?php
    // Start PHP session
    session_start();

    // Check if the fee generation process has been executed for the selected month
    if (isset($_SESSION['fee_generation_executed']) && $_SESSION['fee_generation_executed'] === true) {
        echo '<h4>Fee generation has already been executed for the selected month.</h4>';
    } else {
        // Check if the form is submitted and the selected month is provided
        if (isset($_POST['selected_month']) && !empty($_POST['selected_month'])) {
            // Perform the fee generation process here for the selected month
            // For example:
            $selectedMonth = $_POST['selected_month'];
            // ... (Your fee generation code here)

            // Set the flag to indicate that the fee generation process has been executed
            $_SESSION['fee_generation_executed'] = true;

            // Display a success message or redirect to another page
            echo '<h4>Fee generation for ' . $selectedMonth . ' has been successfully executed.</h4>';
        }
    }
    ?>

    <script>
        // Function to get the current month in the format "YYYY-MM"
        function getCurrentMonth() {
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            let month = currentDate.getMonth() + 1; // Months are 0-based
            if (month < 10) {
                month = '0' + month;
            }
            return year + '-' + month;
        }

        // Set the selected month to the current month when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            const selectedMonthInput = document.getElementById('selected_month');
            selectedMonthInput.value = getCurrentMonth();

            // Automatically click the "Generate Fee" button
            const generateButton = document.getElementById('generate_button');
            generateButton.click();
        });
    </script>
</body>
</html>
