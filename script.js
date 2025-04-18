document.getElementById("upload-btn").addEventListener("click", async function () {
    let fileInput = document.getElementById("file-input");
    if (fileInput.files.length === 0) {
        alert("Please select an image!");
        return;
    }

    let formData = new FormData();
    formData.append("image", fileInput.files[0]);

    try {
        let response = await fetch("http://127.0.0.1:5000/recommend", { 
            method: "POST", 
            body: formData 
        });

        let data = await response.json();
        console.log("Recommended Files:", data.recommended_files);

        // Optional: show in current window
        let resultsDiv = document.getElementById("results");
        resultsDiv.innerHTML = "";
        data.recommended_files.forEach(file => {
            let img = document.createElement("img");
            img.src = `http://localhost/Fashion/Images/${file}`; // Use actual filename from Flask
            img.alt = file;
            img.style.width = "200px";
            img.style.margin = "10px";
            resultsDiv.appendChild(img);
        });

        // ALSO open in new window
        let newWindowContent = '<html><head><title>Recommendations</title></head><body>';
        newWindowContent += '<h2>Recommended Outfits</h2>';
        data.recommended_files.forEach(file => {
            newWindowContent += `<img src="http://localhost/Fashion/Images/${file}" alt="${file}" style="width:200px; margin:10px;" />`;
        });
        newWindowContent += '</body></html>';

      
        newWindow.document.write(newWindowContent);
        newWindow.document.close();

    } catch (error) {
        console.error("Error:", error);
        alert("Failed to get recommendations. Please try again.");
    }
});
