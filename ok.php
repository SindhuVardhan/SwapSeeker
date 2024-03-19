<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #f2f2f2;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 10% auto;
            max-width: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .tick-mark {
            width: 50px; /* Decrease the width to 50px */
            height: 50px; /* Decrease the height to 50px */
            margin: 20px auto;
            background: url('tick.png') no-repeat center;
        }

        h2 {
            color: #007BFF;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        #continue-link {
            color: #007BFF;
        }

        #countdown {
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <img class="tick-mark" src="tick.png" alt="Tick Mark Image"> -->
        <h2>Your Product Placed for Sale</h2>
        <p>We finger Crossed that your product will be sold soon!</p>
       

        <p id="countdown">Redirecting to shopping in <span id="timer">5</span> seconds...</p>
        <a id="continue-link" href="index.php">Continue</a>
    </div>

    <script>
        // Set the initial countdown value and target URL
        let countdown = 5;
        let targetURL = "index.php";

        // Function to update the countdown and redirect
        function updateCountdown() {
            countdown--;
            document.getElementById("timer").textContent = countdown;
            if (countdown <= 0) {
                window.location.href = targetURL;
            }
        }

        // Update the countdown every second
        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>
