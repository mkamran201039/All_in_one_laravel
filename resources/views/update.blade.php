<!-- update.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Resource</title>
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
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form id="updateForm">
        @csrf <!-- Add CSRF token for Laravel -->
        <h2>Update Resource</h2>
        <label for="resourceId">Enter Resource ID:</label>
        <input type="text" id="resourceId" name="resourceId" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        <button type="submit">Update</button>
    </form>

    <script>
        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const resourceId = document.getElementById('resourceId').value;
            const name = document.getElementById('name').value;
            const price = document.getElementById('price').value;
            const location = document.getElementById('location').value;

            // Send a PUT request to the API endpoint with the resource data
            fetch(`/api/products/${resourceId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for Laravel
                },
                body: JSON.stringify({
                    name: name,
                    price: price,
                    location: location
                })
            })
            .then(response => {
                if (response.status === 404) {
                    throw new Error('Resource not found');
                }
                if (response.status === 200) {
                    alert('Resource updated successfully');
                    
                }
                //throw new Error('Failed to update resourceeee');
                
                // Optionally, redirect to another page after successful update
                window.location.href = '/update'; // Redirect to homepage
            })
            .catch(error => {
                console.error('Error updating resource:', error.message);
                alert(error.message);
            });
        });
    </script>
</body>
</html>
