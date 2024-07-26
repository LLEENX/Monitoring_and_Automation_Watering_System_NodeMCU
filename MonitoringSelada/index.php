<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Sistem Otomatis Penyiraman</title>
    <link rel="stylesheet" href="style.css">

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
        <h2>Monitoring Sistem Otomatis Penyiraman</h2>
    </header>
    <div class="main-container">
        <nav class="sidebar">
            <div class="logo">
                <img src="assets/logo.png" alt="Logo" />
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="interface/monitoring.php">Monitoring</a></li>
                <li><a href="interface/indicators.php">Indicators</a></li>
                <li><a href="interface/about.php">About</a></li>
            </ul>
        </nav>
    <div class="content">
        <div class="category">
            <h2>Suhu Lingkungan</h2>
            <div class="cards">
                <div class="card">
                    <h3>Temperature Gauge</h3>
                    <iframe width="100%" height="260" src="https://thingspeak.com/channels/2601551/widgets/896212"></iframe>
                </div>
                <div class="card">
                    <h3>Humidity Gauge</h3>
                    <iframe width="100%" height="260" src="https://thingspeak.com/channels/2601551/widgets/896211"></iframe>
                </div>
            </div>
        </div>
        <div class="horizontal-category">
        <div class="category">
            <h2>Kelembapan Tanah</h2>
            <div class="cards">
                <div class="card">
                    <h3>Soil Moisture Gauge</h3>
                    <iframe width="100%" height="260" src="https://thingspeak.com/channels/2601551/widgets/896217"></iframe>
                </div>
            </div>
        </div>
        <div class="category">
            <h2>Indikator Pompa Air</h2>
            <div class="cards">
                <div class="card">
                    <h3>Pompa Air Indikator</h3>
                    <iframe width="100%" height="260" src="https://thingspeak.com/channels/2601551/widgets/896213"></iframe>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
