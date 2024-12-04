<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Email Generator</title>
    <!-- Use asset() helper to link stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Main Section -->
    <div class="container">
        <div class="text-section">
            <h1>Template Email Generator</h1>
            <!-- Use route() to generate URL for "choose-template" route -->
            <a href="{{ route('choose-template') }}">
                <button>Open Template</button>
            </a>
        </div>
        <div class="image-section"></div>
    </div>

    <!-- Use asset() helper to link scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
