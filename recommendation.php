<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Recommendation</title>
    <?php require('inc/links.php') ?>
    <link rel="stylesheet" href="css/styles.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding: 50px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .upload-container {
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .upload-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        #preview {
            margin-top: 20px;
            max-width: 250px;
            display: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #results img {
            width: 150px;
            margin: 10px;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        .btn-custom {
            background-color: #ff4081;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #e6006e;
        }

        footer {
            background-color: #856f52;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php require('inc/header.php') ?>

    <main>
        <div class="upload-container">
            <h2>Upload an Image for Fashion Recommendations:</h2>

            <form id="upload-form" enctype="multipart/form-data">
                <input type="file" id="file-input" class="form-control"><br>
                <img id="preview" alt="Preview">
                <br><br>
                <button type="button" id="upload-btn" class="btn btn-custom">Get Recommendations</button>
            </form>

            <h3 class="mt-4">Recommended Outfits:</h3>
            <div id="results"></div>
        </div>
    </main>

    <?php require('inc/footer.php') ?>

    <script src="script.js"></script>
</body>
</html>
