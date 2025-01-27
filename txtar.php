
<?php
    $conn = new mysqli('localhost', 'root', '', 'registration_db');
    $sql3 = "SELECT * FROM blogcraft WHERE author_email = '$email'";
    $result2 = $conn->query($sql3);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $time=$row['created_at'];
            $rowid=$row['id'];

        }
    }
    // $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resizable, Draggable, Rotatable Textarea, Image, Video & Canvas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> -->
    <style>
        #container {
            position: relative;
            width: 70vw;
            height: auto;
            min-height: 100vw;
            border: none;
            border-radius: 5px;
            padding: 5px;
            background-color: rgba(255, 255, 255, 1);
            margin: 40px auto;
            margin-top: 0px;
            overflow-y: auto;
            display: flex;
            /* justify-content: center; */
            /* transform-origin: top center;*/
            transition: transform 0.2s ease;
        }
        #container:focus{
            outline: none;
            box-shadow: 0 0 5px white;
        }

        .draggable-container {
            position: absolute;
            transform-origin: center;
            display: inline-block;
            cursor: grab;
        }
        .draggable-textarea,
        .draggable-img,
        .draggable-video,
        .draggable-canvas {
            display: inline-block;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: relative;
            resize: horizontal;
        }
        .draggable-canvas{
            resize: both;
        }
        .draggable-textarea{
            min-width: 50px;
            min-height: 30px;
            padding: 5px;
            overflow-y: auto;
            overflow-wrap: anywhere;
            word-wrap: break-word;
        }
        .draggable-img, .draggable-video{
            width: 200px; /* Makes image width responsive */
            min-width: 40px; /* Sets maximum width of the image */
            /* max-width: 400px; */
            height: auto; /* Keeps the aspect ratio */
            /* object-fit: contain; Ensures image scales well without distortion */
        }
        .rotate-handle, .delete-button, .move-button, .resize-handle{
            display: none;
        }
        .draggable-container:hover .rotate-handle,
        .draggable-container:hover .delete-button,
         .draggable-container:hover .resize-handle,
         .draggable-container:hover .move-button
         {
            display: initial;
        }

        .rotate-handle {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background-color: #007bff;
            border-radius: 50%;
            cursor: crosshair;
            color: white;
            text-align: center;
            line-height: 20px;
            z-index: 1000;
        }
        .delete-button {
            position: absolute;
            top: -15px;
            right: -15px;
            width: 20px;
            height: 20px;
            background-color: #ff4d4d;
            border-radius: 50%;
            cursor: url('gpointer.png'), pointer;
            color: white;
            text-align: center;
            line-height: 20px;
            font-size: 16px;
            font-weight: bold;
            z-index: 1000;
        }
        
        #toolbar p:hover {
            background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            color: white;
        }
        
        #toolbar p:hover button, #toolbar p:hover span  {
            background-color:rgb(9 194 105 / var(--tw-bg-opacity, 1));
            color: white;
        }
        .back {
                text-align: center;
                margin-top: 20px;
                font-size: 30px;
        }
        .back a{
            color: black;
        }
        .back:hover a{
            color: white;
        }
        .resize-handle {
            width: 10px;
            height: 10px;
            background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            position: absolute;
            right: 0;
            bottom: 0;
            cursor: se-resize;
            z-index: 1000;
        }
        .move-button {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background-color: #28a745;
            border-radius: 50%;
            cursor: grab;
            color: white;
            text-align: center;
            line-height: 20px;
            z-index: 1000;
        }
        #toolbar {
            margin: 10px auto;
            padding: 10px;
            display: flex;
            width: 50%;
            overflow-x: scroll;
            position: fixed;
            bottom: 0;
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 5px rgb(9 194 105 / var(--tw-bg-opacity, 1));
            left: 50%;
            transform: translateX(-50%);
            border: solid 5px transparent;
            border-radius: 5px;
            scrollbar-color: rgb(9 194 105 / var(--tw-bg-opacity, 1)) transparent !important;
            scrollbar-width: thin;
        }
        #toolbar p{
            width: 200px;
            height: 20px;
            padding: 10px 20px;
            margin: 10px 10px;
            background-color: white;
            color: black;
            border: solid 1px rgb(9 194 105 / var(--tw-bg-opacity, 1));
            border-radius: 5px;
            display: flex;
            text-align: center;
            cursor: url('gpointer.png'), pointer;
        }
        #toolbar p span {
            width: 200px;
            color: black;
            cursor: url('gpointer.png'), pointer;
            
        }
        #toolbar p button {
            border: none;
            background: white;
            font-size: medium;
            cursor: url('gpointer.png'), pointer;
            
        }
        #toolbar p select{
            width: 50px;
            cursor: url('gpointer.png'), pointer;
        }
        input{
            cursor: url('gpointer.png'), pointer;

        }
        #toolbar button:hover {
            background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
        }
        #zoom-controls{
            width:50px;
            padding: 10px 5px !important;
            border-radius: 50% !important; 
        }
        .imageup{
            opacity: 1 !important;
            transform: scale(1) !important;
        }
        .search-bar {
            position: absolute;
            left:50%;
            transform: translate(-50%, -50px);
            top: 340px;
            display: none;
            padding: 5px;
        }
        .search-bar input{
            border: none;
            border-radius: 5px;

        }
        input:focus{
            outline: none;
            box-shadow: 0 0 5px white;
        }
        .highlight {
            background-color: transparent;
            color: transparent;
        }
        .imginfo{
            color: darkslategrey;
            background: white;
            padding: 20px 10px;
            border: none;
            box-shadow: 0 0 5px darkgrey;
            border-radius: 5px;
            opacity: 0;
            margin-top: -100px;
            text-align: center;
        }
        .image-box:hover .imginfo{
            opacity: 1;
        }
        .imginfo button{
            margin: 0 10px;
            margin-top: 20px;
            padding: 0px;
            /* width:100px; */
            border: none;
            border-radius: 2px;
            font-size: 10px;
            background: transparent;
            color: darkslategrey;
            cursor: url('gpointer.png'), pointer;
        }
        .imginfo .dbtn:hover{
            color: orangered;
        }
        .imginfo .ebtn:hover{
            color: rgb(74, 121, 191);
        }
        @media (min-width: 1800px) {
            #container{
                width: 1260px !important;
                min-height: 1800px !important;
            }
            #zoom-controls{
                pointer-events: none;
                cursor: not-allowed !important;
                opacity: .7;
            }
        }
    </style>
</head>
<body>
    <!-- <p class="edb" id="edb">Equipments</p> -->
    <section class="myblogs" id='imageContainer'>
        
    </section>
    <div id="toolbar">
        <p id="zoom-controls">
            <button id="zoom-in">ZM+</button>
        </p>
        <p id="zoom-controls">
            <button id="zoom-out">ZM-</button>
        </p>
        <p><button class="add-button" id="addCanvas">Canvas</button></p>
        <p><button id="penButton">Dot&nbspPen</button></p>
        <p><button id="eraserButton">Eraser</button></p>
        <p><span>Pen Color</span><input type="color" id="penColor" value="#007bff"/></p>
        <p><span>Pen Size</span><input type="number" id="penSize" value="5" min="1" max="20" /></p>
        <p><span>Eraser Size</span><input type="number" id="eraserSize" value="20" min="1" max="50" /></p>
        <p><button class="add-button" id="addTextbox">Text&nbspBox</button></p>
        <p>
            <span>Font Family</span>
            <select id="fontStyle" aria-label="Font Style">
                <option value="Arial">Arial</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Courier New">Courier New</option>
                <option value="Verdana">Verdana</option>
            </select>
        </p>
        
        <p>
            <span>Font Style</span>
            <select id="fontWeight" aria-label="Font Weight">
                <option value="normal">Normal</option>
                <option value="bold">Bold</option>
                <option value="bolder">Bolder</option>
                <option value="lighter">Lighter</option>
            </select>
        </p>

        <p>
            <span>Italic</span>
            <select id="italic" aria-label="Font Italic">
                <option value="normal">Normal</option>
                <option value="italic">Italicize</option>
            </select>
        </p>
    
        <p><span>Font Color</span><input type="color" id="fontColor" value="#007bff" aria-label="Font Color"/></p>
        <p><span>Background Color</span><input type="color" id="bgColor" value="#007bff" aria-label="BG Color"/></p>
        <p><span>Font Size</span><input type="number" id="fontSize" value="16" min="8" max="100" aria-label="Font Size" /></p>
        <p><button id="clearScreen" class="add-button">Clear</button></p>
        <p><button id="duplicateElement" class="add-button">Duplicate</button></p>
        <p>
            <span>Shapes</span>
            <select id="shapeType" class="add-button">
                <option value="rectangle">Rectangle</option>
                <option value="circle">Circle</option>
                <option value="triangle">Trapezium</option>
                <option value="polygon">Pentagon</option>
                <option value="line">Line</option>
                <!-- <option value="curve">Curve</option> -->
            </select>
        </p>
        <p><span>Shape Color</span><input type="color" id="shapeColor" value="#007bff" class="add-button" /></p>
        <p><span>Border Color</span><input type="color" id="borderColor" value="#007bff" class="add-button" /></p>
        <p><span>Border Width</span><input type="number" id="borderWidth" value="2" min="0" max="10" class="add-button" /></p>
        <p><button id="addShape" class="add-button">Insert&nbspShape</button></p>
        <p><span>Image</span><input type="file" id="imageUpload" class="upload-button" accept="image/*" value="Image"/></p>
        <p><span>Video</span><input type="file" id="videoUpload" class="upload-button" accept="video/*" value="Video"/></p>
        <p><button class="add-button" id="download-pdf">Export</button></p>
        <p><button id="publishbtn">Publish</button></p>
    </div>
    <div class="search-bar">
        <input type="search" id="searchInput" placeholder="Search here: :key [ Ctrl+F ]" 
               style="width: 300px; padding: 10px; font-size: 16px; border: solid 1px grey;" 
               oninput="searchText()">
    </div>
    <p class="headings">My Canvas</p>
    <div id="container"></div>
    <!-- <div class="back edb">
        <a href="blog.php">View All Posts</a>
    </div> -->
    <!-- <p class="edb edb2">Save Draft</p> -->
    <script>
        let currentIndex = 0; // Track which match is currently highlighted
        let matches = []; // Store all found matches
        document.querySelector('.search-bar').classList.add('newblock');
        document.querySelector('.newblock').style.display = 'block';

        window.onkeydown = (e) => {
            if (e.ctrlKey && e.key === "f") {
                e.preventDefault(); // Prevent the default browser search behavior

                // Toggle the display of the search bar
                const searchBar = document.querySelector('.search-bar');
                if (searchBar.classList.contains('newblock')) {
                    searchBar.style.display = searchBar.style.display === 'none' ? 'block' : 'none';
                } else {
                    searchBar.classList.add('newblock');
                    searchBar.style.display = 'block';
                }
            }
        };

        // window.onkeydown=(e)=>{
        //     if (e.ctrlkey && e.key==='d'){
        //         e.preventDefault();
        //         document.querySelector('.search-bar').style.display='none';
        //     }
        // }

        function searchText() {
            const searchInput = document.getElementById("searchInput").value.trim();
            const textOutputs = document.querySelectorAll(".text-output");

            // Reset matches and highlights
            matches = [];
            currentIndex = 0;
            textOutputs.forEach(output => {
                const originalText = output.textContent;
                if (!searchInput) {
                    output.innerHTML = originalText; // Reset to original text if input is empty
                    return;
                }
                // Highlight matches and collect their positions
                const regex = new RegExp(searchInput.replace(/[!@#%&=_.*+?^${}()|[\]\\]/g, "\\$&"), "gi"); // Escape special characters in the input
                const highlightedText = originalText.replace(regex, match => {
                    matches.push({ element: output, match }); // Store match and its element
                    return `<span class="highlight">${match}</span>`;
                });
                output.innerHTML = highlightedText;
            });

            // Scroll to the first match if available
            if (matches.length > 0) {
                scrollToMatch(matches[currentIndex]);
                window.scrollBy({
                    top: -300,
                    left: 0
                });
                document.querySelector('.myblogs').scrollBy({
                    top: 0,
                    left: 0
                });
            }
        }

        function scrollToMatch(match) {
            const { element } = match;
            element.scrollIntoView({ behavior: "auto", block: "center" });
        }

        document.getElementById("publishbtn").addEventListener("click", () => {
            const content = document.getElementById("container");

            html2canvas(content).then(canvas => {
                // Convert the canvas to a base64 image URL
                const imgData = canvas.toDataURL("image/png");

                // Send the image to the server
                fetch("craft.php", {
                    method: "POST",
                    body: JSON.stringify({ image: imgData }),
                    headers: { "Content-Type": "application/json" }
                })
                .then(response => {
                    // Log the raw response to check the returned data
                    return response.text();})
                .then(data => {
                    if (data.success) {
                       console.log("Image saved successfully!");
                    } else {
                        console.log("Failed to save image!");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    console.log("Error occurred while saving image!");
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.5/dist/tesseract.min.js"></script>
    <script>
        const imageContainer = document.getElementById("imageContainer");

        // Fetch images from the server
        async function fetchImages() {
            try {
                const response = await fetch("?fetch_images=true");
                const images = await response.json();
                return images;
            } catch (error) {
                console.error("Error fetching images:", error);
                return [];
            }
        }

        // Display images and their extracted text
        async function displayImagesAndExtractText() {
            const images = await fetchImages();
            for (const image of images) {
                // Create a container for the image and extracted text
                const box = document.createElement("div");
                box.className = "image-box";

                // Create the image element
                const img = document.createElement("img");
                img.src = image;
                img.alt = "Uploaded Image";

                // Create the text output element
                const textOutput = document.createElement("d");
                textOutput.className = "text-output";
                textOutput.textContent = "Extracting text...";

                const imginfo = document.createElement("dfn");
                imginfo.className = "imginfo";
                imginfo.innerHTML = `<?php echo "Posted at-'. $time;
                                             <button class='dbtn' data-action='delete' data-id='" . $rowid . "'><i class='fa-solid fa-trash-can fa-xl'></i></button>
                                             <button class='ebtn' data-action='download' data-id='" . $rowid . "'><i class='fa-solid fa-download fa-xl'></i></button>";
                                        ?>
                                        `;
                // imginfo.style.color='white';

                // Append image and text to the box
                box.appendChild(img);
                box.appendChild(textOutput);
                box.appendChild(imginfo);
                imageContainer.appendChild(box);

                // Extract text using Tesseract.js
                try {
                    const result = await Tesseract.recognize(image, "eng", {
                        logger: (m) => console.log(m), // Progress logging
                    });
                    textOutput.textContent = result.data.text || "No text found.";
                } catch (error) {
                    console.error("Error processing image:", error);
                    textOutput.textContent = "Error extracting text.";
                }
            }
        }

        // Load and process images on page load
        displayImagesAndExtractText();
    </script>
    <script>
        document.querySelectorAll('.dbtn').forEach((btn) => {
            btn.addEventListener('click', () => {
                const postId = btn.dataset.id;
                if (confirm('Are you sure you want to delete this image?')) {
                    fetch('deletecraft.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: postId }),
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            alert(data.message);
                            if (data.success) location.reload();
                        });
                }
            });
        });

        
    </script>
    <script>
        const container = document.getElementById('container');
        const addTextboxButton = document.getElementById('addTextbox');
        const addCanvasButton = document.getElementById('addCanvas');
        const imageUpload = document.getElementById('imageUpload');
        const videoUpload = document.getElementById('videoUpload');
        const penButton = document.getElementById('penButton');
        const eraserButton = document.getElementById('eraserButton');
        const penColor = document.getElementById('penColor');
        const penSize = document.getElementById('penSize');
        const eraserSize = document.getElementById('eraserSize');
        let textCounter = 0;
        let imgCounter = 0;
        let videoCounter = 0;
        let canvasCounter = 0;
        let drawingMode = 'pen'; // Default mode is pen
        let drawing = false;
        let ctx;
        let currentPenColor = '#000000';
        let currentPenSize = 5;
        let currentEraserSize = 20;

        addTextboxButton.addEventListener('click', () => {
            createDraggableTextarea();
        });

        addCanvasButton.addEventListener('click', () => {
            createDraggableCanvas();
        });

        imageUpload.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                createDraggableImage(URL.createObjectURL(file));
            }
        });

        videoUpload.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                createDraggableVideo(URL.createObjectURL(file));
            }
        });

        penButton.addEventListener('click', () => {
            drawingMode = 'pen';
        });

        eraserButton.addEventListener('click', () => {
            drawingMode = 'eraser';
        });

        penColor.addEventListener('input', (e) => {
            currentPenColor = e.target.value;
        });

        penSize.addEventListener('input', (e) => {
            currentPenSize = parseInt(e.target.value, 10);
        });

        eraserSize.addEventListener('input', (e) => {
            currentEraserSize = parseInt(e.target.value, 10);
        });

        function createDraggableTextarea() {
            textCounter++;
            const draggableContainer = document.createElement('div');
            draggableContainer.classList.add('draggable-container');
            draggableContainer.id = `draggableContainer${textCounter}`;
            draggableContainer.style.left = '50px';
            draggableContainer.style.top = '50px';

            const rotateHandle = document.createElement('div');
            rotateHandle.classList.add('rotate-handle');
            rotateHandle.id = `rotateHandle${textCounter}`;
            rotateHandle.innerText = 'R';

            const deleteButton = document.createElement('div');
            deleteButton.classList.add('delete-button');
            deleteButton.id = `deleteButton${textCounter}`;
            deleteButton.innerText = 'X';

            const moveButton = document.createElement('div');
            moveButton.classList.add('move-button');
            moveButton.id = `moveButton${textCounter}`;
            moveButton.innerText = 'M';

            const textarea = document.createElement('div');
            textarea.classList.add('draggable-textarea');
            textarea.id = `draggableText${textCounter}`;
            textarea.contentEditable=true;
            // textarea.placeholder = 'Triple-click to enable text selection!';

            draggableContainer.appendChild(rotateHandle);
            draggableContainer.appendChild(deleteButton);
            draggableContainer.appendChild(moveButton);
            draggableContainer.appendChild(textarea);
            container.appendChild(draggableContainer);

            addResizeHandle(draggableContainer, textarea, 'min-height');
            addDraggableFunctionality(draggableContainer, rotateHandle, deleteButton, moveButton, textarea);
        //     textarea.addEventListener("mousemove", () => {
        //     // Dynamically calculate new width based on height
        //     const newHeight = container.clientHeight;
        //     const newWidth = 300 + (200 - newHeight); // Adjust logic to suit your needs

        //     // Apply the new width
        //     textarea.style.width = `${newWidth}px`;
        // });
        }

        function createDraggableImage(imageSrc) {
            imgCounter++;
            const draggableContainer = document.createElement('div');
            draggableContainer.classList.add('draggable-container');
            draggableContainer.id = `draggableContainerImg${imgCounter}`;
            draggableContainer.style.left = '50px';
            draggableContainer.style.top = '50px';

            const rotateHandle = document.createElement('div');
            rotateHandle.classList.add('rotate-handle');
            rotateHandle.id = `rotateHandleImg${imgCounter}`;
            rotateHandle.innerText = 'R';

            const deleteButton = document.createElement('div');
            deleteButton.classList.add('delete-button');
            deleteButton.id = `deleteButtonImg${imgCounter}`;
            deleteButton.innerText = 'X';

            const moveButton = document.createElement('div');
            moveButton.classList.add('move-button');
            moveButton.id = `moveButtonImg${imgCounter}`;
            moveButton.innerText = 'M';

            const img = document.createElement('img');
            img.classList.add('draggable-img');
            img.id = `draggableImg${imgCounter}`;
            img.src = imageSrc;
            img.alt = 'Uploaded Image';

            draggableContainer.appendChild(rotateHandle);
            draggableContainer.appendChild(deleteButton);
            draggableContainer.appendChild(moveButton);
            draggableContainer.appendChild(img);
            container.appendChild(draggableContainer);

            addResizeHandle(draggableContainer, img, 'height');
            addDraggableFunctionality(draggableContainer, rotateHandle, deleteButton, moveButton, img);
        }
        document.addEventListener("DOMContentLoaded", () => {
            document.addEventListener("paste", (event) => {
                const items = event.clipboardData.items;

                for (const item of items) {
                    if (item.type.startsWith("image")) {
                        const file = item.getAsFile();
                        const reader = new FileReader();

                        reader.onload = (e) => {
                            // Pass the base64 image source to createDraggableImage
                            createDraggableImage(e.target.result);
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });
        });


        function createDraggableVideo(videoSrc) {
            videoCounter++;
            const draggableContainer = document.createElement('div');
            draggableContainer.classList.add('draggable-container');
            draggableContainer.id = `draggableContainerVideo${videoCounter}`;
            draggableContainer.style.left = '50px';
            draggableContainer.style.top = '50px';

            const rotateHandle = document.createElement('div');
            rotateHandle.classList.add('rotate-handle');
            rotateHandle.id = `rotateHandleVideo${videoCounter}`;
            rotateHandle.innerText = 'R';

            const deleteButton = document.createElement('div');
            deleteButton.classList.add('delete-button');
            deleteButton.id = `deleteButtonVideo${videoCounter}`;
            deleteButton.innerText = 'X';

            const moveButton = document.createElement('div');
            moveButton.classList.add('move-button');
            moveButton.id = `moveButtonVideo${videoCounter}`;
            moveButton.innerText = 'M';

            const video = document.createElement('video');
            video.classList.add('draggable-video');
            video.id = `draggableVideo${videoCounter}`;
            video.src = videoSrc;
            video.controls = true;
            video.alt = 'Uploaded Video';

            draggableContainer.appendChild(rotateHandle);
            draggableContainer.appendChild(deleteButton);
            draggableContainer.appendChild(moveButton);
            draggableContainer.appendChild(video);
            container.appendChild(draggableContainer);

            addResizeHandle(draggableContainer, video, 'height');
            addDraggableFunctionality(draggableContainer, rotateHandle, deleteButton, moveButton, video);
        }

        
        // let canvasCounter = 0;
        // let currentPenSize = 5;
        // let currentPenColor = 'black';
        // let currentEraserSize = 10;
        // let drawingMode = 'pen'; // Modes: 'pen' or 'eraser'

        function createDraggableCanvas() {
            canvasCounter++;
            const draggableContainer = document.createElement('div');
            draggableContainer.classList.add('draggable-container');
            draggableContainer.id = `draggableContainerCanvas${canvasCounter}`;
            draggableContainer.style.left = '50px';
            draggableContainer.style.top = '50px';

            const rotateHandle = document.createElement('div');
            rotateHandle.classList.add('rotate-handle');
            rotateHandle.innerText = 'R';

            const deleteButton = document.createElement('div');
            deleteButton.classList.add('delete-button');
            deleteButton.innerText = 'X';

            const moveButton = document.createElement('div');
            moveButton.classList.add('move-button');
            moveButton.innerText = 'M';

            const canvas = document.createElement('canvas');
            canvas.classList.add('draggable-canvas');
            canvas.width = 200;
            canvas.height = 200;
            canvas.dataset.canvasId = canvasCounter; // Add a unique identifier
            const ctx = canvas.getContext('2d');

            // Set initial canvas background to white
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            draggableContainer.appendChild(rotateHandle);
            draggableContainer.appendChild(deleteButton);
            draggableContainer.appendChild(moveButton);
            draggableContainer.appendChild(canvas);
            container.appendChild(draggableContainer);

            addResizeHandle(draggableContainer, canvas, 'height');
            addDraggableFunctionality(draggableContainer, rotateHandle, deleteButton, moveButton, canvas);

            // Attach event listeners for drawing
            canvas.addEventListener('mousedown', e => startDrawing(e, ctx));
            canvas.addEventListener('mousemove', e => draw(e, ctx));
            canvas.addEventListener('mouseup', () => stopDrawing(ctx));
            canvas.addEventListener('mouseout', () => stopDrawing(ctx));
        }

        function startDrawing(e, ctx) {
            const canvas = e.target;
            ctx.drawing = true;
            draw(e, ctx); // Trigger an initial draw in case the mouse is clicked and moved instantly
        }

        function stopDrawing(ctx) {
            ctx.drawing = false;
            ctx.beginPath(); // Reset the drawing path
        }

        function draw(e, ctx) {
            if (!ctx.drawing) return;

            const rect = e.target.getBoundingClientRect();
            const scaleX = e.target.width / rect.width; // Scale factor based on canvas size
            const scaleY = e.target.height / rect.height; // Scale factor based on canvas size

            const x = (e.clientX - rect.left) * scaleX;
            const y = (e.clientY - rect.top) * scaleY;

            if (drawingMode === 'pen') {
                ctx.lineWidth = currentPenSize;
                ctx.lineCap = 'round';
                ctx.strokeStyle = currentPenColor;
                ctx.lineTo(x, y);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(x, y);
            } else if (drawingMode === 'eraser') {
                ctx.clearRect(x - currentEraserSize / 2, y - currentEraserSize / 2, currentEraserSize, currentEraserSize);
            }
        }


        function addResizeHandle(draggableContainer, element, heightex) {
            const resizeHandle = document.createElement('div');
            resizeHandle.classList.add('resize-handle');
            draggableContainer.appendChild(resizeHandle);

            let isResizing = false;
            let initialWidth, initialHeight, initialX, initialY;

            resizeHandle.addEventListener('mousedown', (e) => {
                isResizing = true;
                initialWidth = element.offsetWidth;
                initialHeight = element.offsetHeight;
                initialX = e.clientX;
                initialY = e.clientY;
                e.preventDefault();
            });

            document.addEventListener('mousemove', (e) => {
                if (isResizing) {
                    const width = initialWidth + (e.clientX - initialX);
                    const height = initialHeight + (e.clientY - initialY);
                    element.style['width'] = `${width}px`;
                    element.style[heightex] = `${height}px`;
                    // document.querySelector('.draggable-canvas').style['height'] = `${height}px`;
                }
            });

            document.addEventListener('mouseup', () => {
                isResizing = false;
            });
        }

        function addDraggableFunctionality(draggableContainer, rotateHandle, deleteButton, moveButton, element) {
            let isDragging = false;
            let isRotating = false;
            let offsetX, offsetY;
            // let isDragging = false;
            // let offsetX = 0;
            // let offsetY = 0;
            let moveStep = 10; // Step size for arrow key movement
            let w = 90; // Initial width
            let h = 128; // Initial height
            let s = 1; // Initial scale
            const zoomStep = 1.05; // Increment/decrement for zoom

            // Mousedown event for dragging
            draggableContainer.addEventListener('mousedown', (e) => {
                if (e.target === moveButton) {
                    isDragging = true;
                    const rect = draggableContainer.getBoundingClientRect();
                    offsetX = (e.clientX - rect.left);
                    offsetY = (e.clientY - rect.top);
                }
            });

            // Mouseup event to stop dragging
            document.addEventListener('mouseup', () => {
                isDragging = false;
            });

            // Keydown event for arrow key movement
            document.addEventListener('keydown', (e) => {
                const containerRect = container.getBoundingClientRect();
                const draggableRect = draggableContainer.getBoundingClientRect();

                const adjustedMoveStep = moveStep*4 / (s);

                let left = draggableContainer.offsetLeft;
                let top = draggableContainer.offsetTop;

                // Adjust position based on arrow keys
                // switch (e.key) {
                //     case 'ArrowUp':
                //         top -= adjustedMoveStep;
                //         break;
                //     case 'ArrowDown':
                //         top += adjustedMoveStep;
                //         break;
                //     case 'ArrowLeft':
                //         left -= adjustedMoveStep;
                //         break;
                //     case 'ArrowRight':
                //         left += adjustedMoveStep;
                //         break;
                // }

                // Ensure movement stays within container bounds
                left = Math.max(0, Math.min(left, containerRect.width - draggableRect.width));
                top = Math.max(0, Math.min(top, containerRect.height - draggableRect.height));

                // Apply new position
                draggableContainer.style.left = `${left}px`;
                draggableContainer.style.top = `${top}px`;
            });


            // draggableContainer.addEventListener('mousedown', (e) => {
            //     if (e.target === moveButton) {
            //         isDragging = true;
            //         const rect = draggableContainer.getBoundingClientRect();
            //         offsetX = e.clientX - rect.left;
            //         offsetY = e.clientY - rect.top;
            //     }
            // });
            

            

            document.getElementById("zoom-in").addEventListener("click", () => {
                s *= zoomStep; // Increase scale
                applyZoom();
            });

            document.getElementById("zoom-out").addEventListener("click", () => {
                if (s > 0.2) { // Prevent scale from going too small
                    s /= zoomStep; // Decrease scale
                    applyZoom();
                }
            });

            function applyZoom() {
                container.style.transform = `scale(${s})`;
                container.style.transformOrigin = `top center`;
            }

            // Updated dragging and rotation logic
            document.addEventListener('mousemove', (e) => {
                if (isDragging) {
                    const containerRect = container.getBoundingClientRect();
                    let left = (e.clientX - offsetX - containerRect.left) / s; // Adjust for scaling
                    let top = (e.clientY - offsetY - containerRect.top) / s; // Adjust for scaling

                    // No restriction on movement
                    draggableContainer.style.left = `${left}px`;
                    draggableContainer.style.top = `${top}px`;
                }

                if (isRotating) {
                    const centerX =
                        draggableContainer.offsetLeft * s +
                        draggableContainer.offsetWidth / 2 / s;
                    const centerY =
                        draggableContainer.offsetTop * s +
                        draggableContainer.offsetHeight / 2 / s;

                    const angle = Math.atan2(e.clientY - centerY, e.clientX - centerX) * (180 / Math.PI);
                    draggableContainer.style.transform = `rotate(${angle}deg) scale(${s})`;
                }
            });


            document.addEventListener('mouseup', () => {
                isDragging = false;
                isRotating = false;
            });

            rotateHandle.addEventListener('mousedown', () => {
                isRotating = true;
            });

            deleteButton.addEventListener('click', () => {
                draggableContainer.remove();
            });
        }
        // Clear Screen Feature
        const clearScreenButton = document.getElementById('clearScreen');
        clearScreenButton.addEventListener('click', () => {
            container.innerHTML = ''; // Removes all elements inside the container
        });

        // Duplicate Element Feature
        const duplicateButton = document.getElementById('duplicateElement');
        let selectedElement = null;

        // Event listener for selecting an element to duplicate
        container.addEventListener('click', (e) => {
            if (e.target.closest('.draggable-container')) {
                selectedElement = e.target.closest('.draggable-container');
                selectedElement.style.outline = '2px solid #007bff'; // Highlight selected element
                setTimeout(() => {
                    selectedElement.style.outline = 'none'; // Remove highlight
                }, 500);
            }
        });

        // Event listener for duplicating the selected element
        duplicateButton.addEventListener('click', () => {
            if (selectedElement) {
                const duplicate = selectedElement.cloneNode(true); // Clone the selected element
                duplicate.id = `${selectedElement.id}_duplicate`; // Assign a unique ID to the duplicate
                duplicate.style.left = `${parseInt(selectedElement.style.left) + 20}px`; // Offset position
                duplicate.style.top = `${parseInt(selectedElement.style.top) + 20}px`;

                container.appendChild(duplicate); // Add duplicate to container

                // Reapply event listeners for dragging, rotating, etc.
                const rotateHandle = duplicate.querySelector('.rotate-handle');
                const deleteButton = duplicate.querySelector('.delete-button');
                const moveButton = duplicate.querySelector('.move-button');
                const resizableElement = duplicate.querySelector('.draggable-textarea, .draggable-img, .draggable-video, .draggable-canvas');

                addResizeHandle(duplicate, resizableElement, 'height');
                addDraggableFunctionality(duplicate, rotateHandle, deleteButton, moveButton, resizableElement);
            } else {
                alert('Select an element to duplicate!');
            }
        });
        // Elements for shape customization
        const shapeType = document.getElementById('shapeType');
        const shapeColor = document.getElementById('shapeColor');
        const borderColor = document.getElementById('borderColor');
        const borderWidth = document.getElementById('borderWidth');
        const addShapeButton = document.getElementById('addShape');

        // Event listener to add shape
        addShapeButton.addEventListener('click', () => {
            createDraggableShape(
                shapeType.value,
                shapeColor.value,
                borderColor.value,
                parseInt(borderWidth.value, 10)
            );
        });

        // Function to create draggable shapes
        // Function to create draggable shapes
        function createDraggableShape(type, fillColor, borderColor, borderWidth) {
            const shapeContainer = document.createElement('div');
            shapeContainer.classList.add('draggable-container');
            shapeContainer.style.left = '50px';
            shapeContainer.style.top = '50px';

            const rotateHandle = document.createElement('div');
            rotateHandle.classList.add('rotate-handle');
            rotateHandle.innerText = 'R';

            const deleteButton = document.createElement('div');
            deleteButton.classList.add('delete-button');
            deleteButton.innerText = 'X';

            const moveButton = document.createElement('div');
            moveButton.classList.add('move-button');
            moveButton.innerText = 'M';

            const shape = document.createElement('div');
            shape.classList.add('draggable-shape');

            // Style for different shape types
            switch (type) {
                case 'rectangle':
                    shape.style.backgroundColor = fillColor;
                    shape.style.border = `${borderWidth}px solid ${borderColor}`;
                    shape.style.width = '100px';
                    shape.style.height = '50px';
                    break;
                case 'circle':
                    shape.style.backgroundColor = fillColor;
                    shape.style.border = `${borderWidth}px solid ${borderColor}`;
                    shape.style.width = '75px';
                    shape.style.height = '75px';
                    shape.style.borderRadius = '50%';
                    break;
                case 'triangle':
                    shape.style.width = '0';
                    shape.style.height = '0';
                    shape.style.borderLeft = '50px solid transparent';
                    shape.style.borderRight = '50px solid transparent';
                    shape.style.borderBottom = `100px solid ${fillColor}`;
                    shape.style.backgroundColor = 'transparent';
                    break;
                case 'polygon':
                    shape.style.width = '150px';
                    shape.style.height = '150px';
                    shape.style.backgroundColor = fillColor;
                    shape.style.clipPath = 'polygon(50% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%)';
                    shape.style.border = `${borderWidth}px solid ${borderColor}`;
                    break;
                case 'line':
                    shape.style.width = '200px';
                    shape.style.height = `${borderWidth}px`;
                    shape.style.backgroundColor = borderColor;
                    break;
                case 'curve':
                    createCurveShape(shape, borderColor, borderWidth); // Custom function for curve
                    break;
            }

            // Add child elements for control handles
            shapeContainer.appendChild(rotateHandle);
            shapeContainer.appendChild(deleteButton);
            shapeContainer.appendChild(moveButton);

            if (type !== 'curve') {
                shapeContainer.appendChild(shape);
            }

            container.appendChild(shapeContainer);

            // Add functionality
            if (type !== 'curve') {
                addResizeHandle(shapeContainer, shape, 'height');
            }
            addDraggableFunctionality(shapeContainer, rotateHandle, deleteButton, moveButton, shape);
        }

        // Function to create a curve with selectable vertices
        function createCurveShape(parent, color, width) {
            const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svg.style.width = '300px';
            svg.style.height = '300px';

            const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('d', 'M 50 50 Q 150 20, 250 50 T 350 50');
            path.setAttribute('stroke', color);
            path.setAttribute('stroke-width', width);
            path.setAttribute('fill', 'none');
            svg.appendChild(path);

            // Add vertices
            const points = [
                { x: 50, y: 50 },
                { x: 150, y: 20 },
                { x: 250, y: 50 },
                { x: 350, y: 50 },
            ];

            points.forEach((point) => {
                const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                circle.setAttribute('cx', point.x);
                circle.setAttribute('cy', point.y);
                circle.setAttribute('r', '5');
                circle.setAttribute('fill', 'red');
                circle.style.cursor = 'pointer';
                svg.appendChild(circle);

                // Add drag functionality to vertices
                circle.addEventListener('mousedown', (e) => {
                    const onMouseMove = (moveEvent) => {
                        const dx = moveEvent.clientX - e.clientX;
                        const dy = moveEvent.clientY - e.clientY;
                        const newX = point.x + dx;
                        const newY = point.y + dy;

                        circle.setAttribute('cx', newX);
                        circle.setAttribute('cy', newY);
                        point.x = newX;
                        point.y = newY;

                        // Update path
                        const newD = `M ${points[0].x} ${points[0].y} Q ${points[1].x} ${points[1].y}, ${points[2].x} ${points[2].y} T ${points[3].x} ${points[3].y}`;
                        path.setAttribute('d', newD);
                    };

                    document.addEventListener('mousemove', onMouseMove);
                    document.addEventListener('mouseup', () => {
                        document.removeEventListener('mousemove', onMouseMove);
                    }, { once: true });
                });
            });

            parent.appendChild(svg);
        }
        document.getElementById("download-pdf").addEventListener("click", function () {
        const content = document.getElementById("container");
  
        // Use html2canvas to render the content as an image
        html2canvas(content).then(canvas => {
          const imgData = canvas.toDataURL("image/png");
          const pdf = new jspdf.jsPDF();
          
          // Calculate the dimensions for the PDF
          const imgWidth = 210; // A4 width in mm
          const pageHeight = 297; // A4 height in mm
          const imgHeight = (canvas.height * imgWidth) / canvas.width;
          let heightLeft = imgHeight;
          let position = 0;
  
          // Add the image to the PDF and handle multiple pages
          pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
          heightLeft -= pageHeight;
  
          while (heightLeft > 0) {
            position = heightLeft - imgHeight; // Move to the next page
            pdf.addPage();
            pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
          }
  
          // Save the PDF
          pdf.save("converted.pdf");
        });
      });
    </script>
    <script>
        const fontStyle = document.getElementById('fontStyle');
        const italic = document.getElementById('italic');
        const fontWeight = document.getElementById('fontWeight');
        const fontColor = document.getElementById('fontColor');
        const bgColor = document.getElementById('bgColor');
        const fontSize = document.getElementById('fontSize');
    
        let activeTextarea = null; // Variable to keep track of the active textarea
    
        // Add a click listener to all textareas
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('draggable-textarea')) {
                activeTextarea = e.target; // Set the clicked textarea as active
                updateControlsFromActiveTextarea(); // Update the controls based on the active textarea's styles
            }
        });
    
        // Event listeners for style changes
        fontStyle.addEventListener('change', updateTextboxStyles);
        fontWeight.addEventListener('change', updateTextboxStyles);
        italic.addEventListener('change', updateTextboxStyles);
        fontColor.addEventListener('input', updateTextboxStyles);
        bgColor.addEventListener('input', updateTextboxStyles);
        fontSize.addEventListener('input', updateTextboxStyles);
    
        function updateTextboxStyles() {
            if (!activeTextarea) return; // Do nothing if no active textarea
    
            const selectedStyle = fontStyle.value;
            const selectedWeight = fontWeight.value;
            const selectedItalic = italic.value;
            const selectedColor = fontColor.value;
            const selectedbgcol = bgColor.value;
            const selectedSize = fontSize.value;
    
            // Apply styles only to the active textarea
            activeTextarea.style.fontFamily = selectedStyle;
            activeTextarea.style.fontStyle = selectedItalic;
            activeTextarea.style.fontWeight = selectedWeight;
            activeTextarea.style.color = selectedColor;
            activeTextarea.style.backgroundColor = selectedbgcol;
            activeTextarea.style.fontSize = `${selectedSize}px`;
        }
    
        function updateControlsFromActiveTextarea() {
            if (!activeTextarea) return;
    
            // Update control values to match the styles of the active textarea
            fontStyle.value = activeTextarea.style.fontFamily || 'default';
            italic.value = activeTextarea.style.fontStyle || 'normal';
            fontWeight.value = activeTextarea.style.fontWeight || 'normal';
            fontColor.value = activeTextarea.style.color || '#000000';
            bgColor.value = activeTextarea.style.backgroundColor || '#ffffff';
            fontSize.value = parseInt(activeTextarea.style.fontSize, 10) || 16;
        }
    </script>
    
    <noscript>
        let w = 90; // Initial scale value
        let h = 128;
        let s = 1;
        const zoomStep = 1.05; // Increment/decrement for zoom
        // const container = document.getElementById("container");

        document.getElementById("zoom-in").addEventListener("click", () => {
            w *= zoomStep; // Increase scale
            h *= zoomStep;
            s += .05;
            applyZoom();
        });

        document.getElementById("zoom-out").addEventListener("click", () => {
            if (w > 21) {
                w /= zoomStep; // Decrease scale, but don't go negative
                h /= zoomStep;
                s -= .05;
                applyZoom();
            }
        });

        function applyZoom() {
            // container.style.width = `${w}vw`;
            // container.style.height = `${h}vw`;
            container.style.transform = `scale(${s})`;
            container.style.transformOrigin = `top center`;
        }

    </noscript>
</body>
</html>
