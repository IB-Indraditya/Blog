<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algolia-Powered Search Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f8f9fa;
        }
        .search-container {
            margin-top: 50px;
            width: 90%;
            max-width: 600px;
            position: relative;
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
            list-style: none;
        }
        .suggestions li:hover {
            background-color: #f1f1f1;
        }
        .results {
            margin-top: 30px;
            width: 90%;
            max-width: 600px;
        }
        .result-item {
            background: white;
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="search-container">
        <input type="search" id="searchInput" placeholder="Search for items, articles, or products..." />
        <ul class="suggestions" id="suggestions" style="display: none;"></ul>
    </div>

    <div class="results" id="results">
        <!-- Results will appear here -->
    </div>

    <!-- Algolia CDN -->
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch/dist/algoliasearch-lite.umd.min.js"></script>

    <script>
        // Initialize Algolia
        const client = algoliasearch('QJ68UNRY3Z', '0cd252b338286d32c9b5a73443bc743a'); // Replace with your credentials
        const index = client.initIndex('blog'); // Replace with your index name

        const searchInput = document.getElementById("searchInput");
        const suggestions = document.getElementById("suggestions");
        const results = document.getElementById("results");

        // Handle input event for search
        searchInput.addEventListener("input", async (e) => {
            const query = e.target.value.trim();
            if (query.length === 0) {
                suggestions.style.display = "none";
                results.innerHTML = "<p>Start typing to search...</p>";
                return;
            }

            try {
                // Fetch results from Algolia
                const searchResults = await index.search(query, {
                    hitsPerPage: 5 // Customize number of suggestions
                });

                // Display suggestions
                if (searchResults.hits.length > 0) {
                    suggestions.innerHTML = searchResults.hits
                        .map(hit => `<li data-id="${hit.objectID}">${hit.title || hit.name}</li>`)
                        .join("");
                    suggestions.style.display = "block";
                } else {
                    suggestions.style.display = "none";
                }

                // Add click event to suggestions
                document.querySelectorAll(".suggestions li").forEach(li => {
                    li.addEventListener("click", () => {
                        searchInput.value = li.textContent;
                        suggestions.style.display = "none";
                        displayResults([searchResults.hits.find(hit => hit.objectID === li.dataset.id)]);
                    });
                });
            } catch (error) {
                console.error("Search error:", error);
            }
        });

        // Display results in the main area
        function displayResults(hits) {
            if (!hits || hits.length === 0) {
                results.innerHTML = "<p>No results found.</p>";
                return;
            }

            results.innerHTML = hits
                .map(hit => `<div class="result-item">${hit.title || hit.name} (${hit.type || 'unknown'})</div>`)
                .join("");
        }

        // Hide suggestions when clicking outside
        document.addEventListener("click", (e) => {
            if (!e.target.closest("#searchInput") && !e.target.closest("#suggestions")) {
                suggestions.style.display = "none";
            }
        });
    </script>
</body>
</html>
