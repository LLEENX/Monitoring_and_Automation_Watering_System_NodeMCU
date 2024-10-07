<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>
    <link rel="stylesheet" href="../style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <header>
        <h2>Suhu Lingkungan dan Kelembapan Tanah</h2>
    </header>
    <div class="main-container">
        <nav class="sidebar">
        <div class="logo">
                <img src="../assets/logo.png" alt="Logo" />
            </div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="monitoring.php">Monitoring</a></li>
                <li><a href="indicators.php">Indicators</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
    <div class="content">
        <div class="horizontal-category">
        <div class="category">
            <h2>Suhu Lingkungan</h2>
            <div class="cards">
                <div class="card">
                    <h3>Temperature Chart</h3>
                    <iframe width="450" height="260" src="https://thingspeak.com/channels/2601551/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Temperature&type=spline&xaxis=Waktu&yaxis=Celcius"></iframe>
                </div>
            </div>
        </div>
        <div class="category">
            <h2>Kelembapan Tanah</h2>
            <div class="cards">
                <div class="card">
                    <h3>Soil Moisture Chart</h3>
                    <iframe width="450" height="260" src="https://thingspeak.com/channels/2601551/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Soil+Moisture&type=line&xaxis=Waktu&yaxis=%25"></iframe>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
