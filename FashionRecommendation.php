<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Recommendation</title>
    <!-- Add links to any external CSS frameworks or custom stylesheets here -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navigation bar -->
    <header>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#upload">Upload Image</a></li>
            </ul>
        </nav>
    </header>

    <!-- Image Upload Section -->
    <section id="upload" class="section">
        <div class="container">
            <h2 class="section-title">Upload Your Image for Recommendations</h2>
            <form id="uploadForm" action="http://127.0.0.1:5000/recommend" method="POST" enctype="multipart/form-data">
                <input type="file" name="image" id="image" accept="image/*" required>
                <button type="submit">Get Recommendations</button>
            </form>
            <div id="recommendations"></div>
        </div>
    </section>

    <!-- JavaScript to handle form submission and display results -->
    <script>
        const form = document.getElementById("uploadForm");
        form.onsubmit = async function (event) {
            event.preventDefault();
            const formData = new FormData(form);

            try {
                const response = await fetch('http://127.0.0.1:5000/recommend', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                if (result.recommended_files) {
                    const recommendationsDiv = document.getElementById("recommendations");
                    recommendationsDiv.innerHTML = ""; // Clear previous recommendations
                    result.recommended_files.forEach(file => {
                        const img = document.createElement("img");
                        img.src = file; // Assuming the file paths returned are valid URLs or paths to the images
                        img.alt = file;
                        img.style.maxWidth = "200px";
                        img.style.margin = "10px";
                        recommendationsDiv.appendChild(img);
                    });
                } else {
                    alert("No recommendations found!");
                }
            } catch (error) {
                alert("Error occurred while fetching recommendations.");
            }
        };
    </script>

</body>

</html>
