<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indicators</title>
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
        <h2>Intensitas Cahaya dan Pompa Air</h2>
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
            <h2>Intensitas Cahaya</h2>
            <div class="cards">
                <div class="card">
                    <h2>Light Intensity Chart</h2>
                    <iframe width="100%" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/2601551/charts/4?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Intensity+Value&type=spline&xaxis=Waktu&yaxis=Intensity"></iframe>
                </div>

                <div class="card">
                    <h2>Light Intensity Indicators</h2>
                    <iframe width="100%" height="260" src="https://thingspeak.com/channels/2601551/widgets/896214"></iframe>
                </div>
            </div>
        </div>
        </div>
        <div class="horizontal-category">
        <div class="category">
            <h2>Pompa Air</h2>
            <div class="cards">
                <div class="card">
                    <h2>Pompa Air Chart</h2>
                    <iframe width="100%" height="260" src="https://thingspeak.com/channels/2601551/charts/5?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Pompa+Air&type=line&xaxis=Waktu&yaxis=Status"></iframe>
                </div>

                <div class="card">
                    <h2>Pompa Air</h2>
                    <iframe width="100%" height="260" src="https://thingspeak.com/channels/2601551/widgets/896213"></iframe>
                </div>
            </div>
        </div>
        </div>
    </div>    
    </div>
</body>
</html>
