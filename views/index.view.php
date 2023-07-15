<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DNS Tool</title>
    <script src="/assets/js/app.js"></script>
</head>
<body>
    <div class="container">
        <form method="get">
            <input type="text" id="domain-input" placeholder="Enter domain name" />
            <button type="submit" id="dns-search-button">
                Search
            </button>
        </form>
        <div class="results">
            <div>
                <span>
                    Google
                </span>
                <span id="google-ip">
                    -
                </span>
            </div>
            <div>
                <span>
                    Cloudflare
                </span>
                <span id="cloudflare-ip">
                    -
                </span>
            </div>
            <div>
                <span>
                    Control D
                </span>
                <span id="control-d-ip">
                    -
                </span>
            </div>
            <div>
                <span>
                    Quad9
                </span>
                <span id="quad-9-ip">
                    -
                </span>
            </div>
            <div>
                <span>
                    OpenDNS
                </span>
                <span id="open-dns-ip">
                    -
                </span>
            </div>
            <div>
                <span>
                    CleanBrowsing
                </span>
                <span id="clean-browsing-ip">
                    -
                </span>
            </div>
        </div>
    </div>
</body>
</html>