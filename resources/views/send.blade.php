<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        /* Define CSS styles inline */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th style="background-color: #f2f2f2; border: 1px solid #dddddd; text-align: left; padding: 8px;">Name</th>
            <th style="background-color: #f2f2f2; border: 1px solid #dddddd; text-align: left; padding: 8px;">Phone</th>
            <th style="background-color: #f2f2f2; border: 1px solid #dddddd; text-align: left; padding: 8px;">Address</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $name }}</td>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $phone }}</td>
            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $address }}</td>
        </tr>
    </tbody>
</table>

</body>
</html>
