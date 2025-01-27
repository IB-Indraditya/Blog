<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            padding: 10px;
            width:95%;
            max-width: 1600px;
            min-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            border-radius: 10px;
            padding: 10px;
            border: solid 1px lightgrey;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 10px;
        }

        .table b, .table p {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            border-radius: 5px;
            background-color: #fff;
        }

        .table b {
            background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1)) !important;1;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }

        .editable[contenteditable="true"] {
            background-color: #f1f5ff;
            border: 1px solid #007bff;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .action-buttons button {
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            color: #fff;
            transition: 0.3s;
            width: 100%;
        }
        h1{
            color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
        }

        .edit-btn {
            background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
        }

        .edit-btn:hover {
            background-color: rgb(9 164 105 / var(--tw-bg-opacity, 1));
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #a71d2a;
        }

        @media screen and (max-width: 768px) {
            .table {
                grid-template-columns: repeat(2, 1fr);
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>USER DATABASE</h1>
        <?php
        $con = new mysqli('localhost', 'root', '', 'registration_db');

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql2 = 'SELECT * FROM blogregister';
        $res2 = $con->query($sql2);

        if ($res2->num_rows > 0) {
            echo "<section class='table'>";
            echo '<b>Name</b>';
            echo '<b>Email</b>';
            echo '<b>Password</b>';
            echo '<b>Active</b>';
            echo '<b>Actions</b>';
            echo '</section>';

            while ($row = $res2->fetch_assoc()) {
                echo "<section class='table' data-id='" . $row['id'] . "'>";
                echo '<p class="editable" data-column="fullname">' . htmlspecialchars($row['fullname']) . '</p>';
                echo '<p class="editable" data-column="email">' . htmlspecialchars($row['email']) . '</p>';
                echo '<p class="editable" data-column="cpassword">' . htmlspecialchars($row['cpassword']) . '</p>';
                echo '<p class="editable" data-column="activation_token">' . htmlspecialchars($row['activation_token']) . '</p>';
                echo '<div class="action-buttons">';
                echo '<button class="edit-btn">Edit</button>';
                echo '<button class="delete-btn">Delete</button>';
                echo '</div>';
                echo '</section>';
            }
        } else {
            echo "<p>No users found.</p>";
        }

        $con->close();
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle edit mode
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', (e) => {
                    const section = button.closest('.table');
                    const editables = section.querySelectorAll('.editable');
                    const isEditing = button.textContent === "Save";

                    editables.forEach(field => {
                        field.contentEditable = !isEditing; // Toggle contentEditable
                        field.style.backgroundColor = isEditing ? "#fff" : "#f1f5ff"; // Change background color
                    });

                    if (isEditing) {
                        // Save changes
                        const id = section.dataset.id;
                        const data = {};
                        editables.forEach(field => {
                            data[field.dataset.column] = field.textContent.trim();
                        });

                        fetch('updateuser.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id, ...data })
                        })
                        .then(response => response.text())
                        .then(result => {
                            alert(result);
                        })
                        .catch(error => console.error('Error:', error));
                    }

                    button.textContent = isEditing ? "Edit" : "Save"; // Toggle button text
                });
            });

            // Delete user
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const section = button.closest('.table');
                    const id = section.dataset.id;

                    if (confirm('Are you sure you want to delete this user?')) {
                        fetch('deleteuser.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id })
                        })
                        .then(response => response.text())
                        .then(result => {
                            alert(result);
                            section.remove(); // Remove the row from the UI
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
</body>
</html>
