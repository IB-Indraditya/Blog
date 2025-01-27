<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url('https://png.pngtree.com/background/20220716/original/pngtree-background-design-of-blue-technology-annual-meeting-picture-image_1631257.jpg');;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top;
        }
        h1{
            text-align: center;
            color: springgreen;
            position: fixed;
            top:30%;
            transform: translateY(-70%);
            font-size: 50px;
        }
        .search-container {
            /* margin-top: 50px; */
            width: 100%;
            max-width: 600px;
            position: fixed;
            top:50%;
            transform: translateY(-50%);
        }
        input[type="search"] {
            width: 100%;
            padding: 12px 40px 12px 16px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 25px;
            outline: none;
            box-shadow: none;
            transition: border-color 0.3s;
        }
        input[type="search"]:focus {
            border-color: #007bff;
        }
        .suggestions {
            position: absolute;
            top: 48px;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }
        .suggestions li {
            padding: 10px 16px;
            cursor: pointer;
            list-style: upper-alpha;
        }
        .suggestions li:hover {
            background-color: #f1f1f1;
        }
        .filters {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .filters button {
            padding: 10px 16px;
            font-size: 14px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        .filters button:hover {
            background-color: #0056b3;
        }
        .results {
            margin-top: 30px;
            width: 90%;
            max-width: 600px;
            text-align: center;
            color: white;
        }
        .result-item {
            background: white;
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        a {
            text-decoration: none;
            color: #0056b3;
        }
        a:hover {
            text-decoration: underline;
        }
        .usp{
            color: white;
            font-size: 20px;
            position: fixed;
            bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Blog Search Page</h1>
    <div class="search-container">
        <input type="search" id="searchInput" placeholder="Search for blog, services, or features..." />
        <ul class="suggestions" id="suggestions" style="display: none;"></ul>
        <div class="results" id="results">
            <!-- Results will appear here -->
        </div>
    </div>
    <a class="usp" href="database.php"><div>Blog Users</div></a>


    <!-- <div class="filters">
        <button data-filter="all">All</button>
        <button data-filter="articles">Articles</button>
        <button data-filter="products">Products</button>
    </div> -->

    

    <script>
        // Updated data without types
        const data = [
            { id: 1, title: "Write Contents", url: "writepad.php" },
            { id: 2, title: "Blog", url: "index.php" },
            { id: 3, title: "Log In Page", url: "login.php#logpg" },
            { id: 4, title: "Sign Up Page", url: "signup.php" },
            { id: 5, title: "Dashboard", url: "writepad.php" },
            { id: 6, title: "Create New Account", url: "signup.php" },
            { id: 7, title: "Register", url: "signup.php" },
            { id: 8, title: "Image to Text", url: "ocr.php" },
            { id: 9, title: "Home Page", url: "index.php" },
            { id: 10, title: "Contact", url: "index.php" },
            { id: 11, title: "OCR Tool", url: "ocr.php" },
            { id: 12, title: "Create Blog", url: "dashboard.php" },
            { id: 13, title: "About Blog", url: "index.php#aboutblog" },
            { id: 14, title: "Categories", url: "index.php#categoriessec" },
            { id: 15, title: "Pricing", url: "index.php#bpricing" },
            { id: 16, title: "Benefits", url: "index.php#bbn" },
            { id: 17, title: "Read Blog", url: "blog.php" },
            { id: 18, title: "Search for a name", url: "database.php" },
            { id: 19, title: "Blog Users", url: "database.php" },
            { id: 20, title: "Search Peoples", url: "database.php" },
            { id: 21, title: "Contacts", url: "index.php#contactsec" },
            { id: 22, title: "Give Feedback", url: "index.php#contactsec" },
        ];
    
        const searchInput = document.getElementById("searchInput");
        const suggestions = document.getElementById("suggestions");
        const results = document.getElementById("results");
    
        // Display suggestions as the user types
        searchInput.addEventListener("input", () => {
            const query = searchInput.value.toLowerCase();
            if (!query) {
                suggestions.style.display = "none";
                return;
            }
    
            const filteredData = data
                .filter(item => item.title.toLowerCase().includes(query))
                .slice(0, 6); // Limit suggestions to 5
    
            if (filteredData.length === 0) {
                suggestions.style.display = "none";
                results.innerHTML = "<p>No results found.</p>";
                return;
            }
    
            suggestions.innerHTML = filteredData
                .map(item => `<li data-url="${item.url}">${item.title}</li>`)
                .join("");
            suggestions.style.display = "block";
    
            // Add click event to suggestions
            document.querySelectorAll(".suggestions li").forEach(li => {
                li.addEventListener("click", () => {
                    const url = li.dataset.url;
                    window.location.href = url; // Redirect to the specific page
                });
            });
        });
    
        // Hide suggestions when clicking outside
        document.addEventListener("click", (e) => {
            if (!e.target.matches("#searchInput")) {
                suggestions.style.display = "none";
            }
        });
    
        // Display results based on the search query
        function displayResults(query = "") {
            const filteredData = data.filter(item => item.title.toLowerCase().includes(query.toLowerCase()));
    
            if (filteredData.length === 0) {
                results.innerHTML = "<p>No results found.</p>";
                return;
            }
    
            results.innerHTML = filteredData
                .map(item => `<div class="result-item"><a href="${item.url}" target="_self">${item.title}</a></div>`)
                .join("");
        }
    </script>
    

    <!-- <script>
        // Base URL of a third-party API (e.g., JSONPlaceholder for demonstration)
        const apiUrl = "https://jsonplaceholder.typicode.com/posts"; // Replace this with your actual API URL
    
        let data = []; // This will hold the data fetched from the API
    
        // Function to fetch data from API
        async function fetchData() {
            try {
                const response = await fetch(apiUrl);
                if (!response.ok) throw new Error("Failed to fetch data");
    
                // Process the response as JSON
                const apiData = await response.json();
    
                // Map the API data to match the required format
                data = apiData.map(item => ({
                    id: item.id,
                    type: item.id % 2 === 0 ? "article" : "product", // Example logic for type
                    title: item.title
                }));
    
                console.log("Fetched data:", data); // Debug log to verify data
                displayResults(); // Display results after fetching
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }
    
        // Call fetchData when the page loads
        document.addEventListener("DOMContentLoaded", fetchData);
    
        // Display results dynamically
        function displayResults(query = "") {
            const filteredData = data.filter(item => {
                const matchesQuery = item.title.toLowerCase().includes(query.toLowerCase());
                return matchesQuery;
            });
    
            const results = document.getElementById("results");
            if (filteredData.length === 0) {
                results.innerHTML = "<p>No results found.</p>";
                return;
            }
    
            results.innerHTML = filteredData
                .map(item => `<div class="result-item">${item.title} (${item.type})</div>`)
                .join("");
        }
    
        // Example: Attach `displayResults` to a search input's event listener
        document.getElementById("searchInput").addEventListener("input", (e) => {
            displayResults(e.target.value);
        });
    </script> -->
    
</body>
</html>
