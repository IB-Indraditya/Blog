<?php
    $conn=new mysqli('localhost', 'root', '', 'registration_db');
    $sql="SELECT COUNT(*) FROM blogregister";
    $res=$conn->query($sql);
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            margin: 0;
            padding: 0;
            scrollbar-width: thin;
            scrollbar-color: darkslateblue transparent;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: rgb(3, 0, 23);
            background: url('https://png.pngtree.com/background/20220716/original/pngtree-background-design-of-blue-technology-annual-meeting-picture-image_1631257.jpg'), rgb(1, 37, 37);;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top;
            height: 100vh;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }
        .searchbar{
            display: flex;
            align-items: center;
            flex-direction: column;
            width: 50%;
            height: 200px;
        }
        h1{
            font-size: 50px;
            text-align: center;
            color: springgreen;
            margin-bottom: 40px;
        }
        input{
            min-width: 280px;
            width: 100%;
            padding: 15px 40px;
            font-size: 20px;
            border: none;
            border-radius: 100px;
            color: darkslategray;
        }
        input:focus{
            outline: none;
        }
        #results{
            background-color: rgba(255, 255, 255, .85);
            margin-top: 40px;
            min-width: 280px;
            width: 100%;
            border-radius: 5px;
            padding: 10px 0;
            min-height: 200px;
            height: auto;
            max-height: 600px;
            overflow-y: auto;
            display: none;
            scrollbar-color: rgb(9 194 105 / var(--tw-bg-opacity, 1)) transparent;
        }
        #results p{
            margin: 0 5px;
            padding: 10px;
            cursor: pointer;
            border: solid 5px transparent;
            border-radius: 5px;
        }
        #results p:hover{
            background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            color: white;
        }
        #total-count{
            color: white;
            margin-bottom: 30px;
        }
    </style>
    <title>Search Users</title>
    <script>
        function searchDatabase() {
            const searchQuery = document.getElementById('search').value; // Get the input value
            const xhr = new XMLHttpRequest();

            xhr.open('POST', 'searchuser.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            // Update the results dynamically
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('results').innerHTML = xhr.responseText;
                }
            };

            xhr.send('query=' + encodeURIComponent(searchQuery));
        }
    </script>
</head>
<body>
    <h1>User Search Page</h1>
    <span id="total-count">User Count</span>
    <section class="searchbar">
        <input type="search" id="search" onkeyup="searchDatabase()" placeholder="Search for a name...">
        <div id="results"></div>
    </section>
    <script>
        document.querySelector('input').oninput=()=>{
            if (document.querySelector('input').value.length===0){
                document.querySelector('#results').style.display='none';
            }
            else {
                document.querySelector('#results').style.display='block';
            }
        }
    </script>
</body>
</html>
<?php
if ($res->num_rows>0){
    while($data=$res->fetch_assoc()){
        $totalCount=$data['COUNT(*)'];
        echo "<script>document.querySelector('span').textContent = 'Registered Users- 0000" . $totalCount . "';</script>";
    }
}
?>