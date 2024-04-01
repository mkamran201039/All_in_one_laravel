
<!-- delete.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        /* CSS styles for the form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: red;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: red;
        }
    </style>
</head>
<body>

    <form id="deleteForm">
        @csrf <!-- Add CSRF token for Laravel -->
        <h2>Delete User</h2>
        <label for="userId">Enter User ID:</label>
        <input type="text" id="userId" name="userId" required>
        <button type="submit">Delete</button>
    </form>

    <script>
        document.getElementById('deleteForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const userId = document.getElementById('userId').value;

            // Send a DELETE request to the API endpoint with the user ID
            fetch(`http://localhost:8000/api/products/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for Laravel
                },
            })
            .then(response => {
                if (response.status === 404) {
                    throw new Error(`User with ID ${userId} not found`);
                }
                if (!response.ok) {
                    throw new Error('Failed to delete user');
                }
                alert('User deleted successfully');
               
                window.location.href = '/delete'; // Redirect to homepage
            })
            .catch(error => {
                console.error('Error deleting user:', error.message);
                alert(error.message);
            });
        });
    </script>
</body>
</html>
