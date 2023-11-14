<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussions Page</title>
  
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        nav ul li {
            margin: 0 20px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .discussion {
            display: flex;
            border: 1px solid #ccc;
            background-color: #fff;
            margin-bottom: 20px;
            padding: 10px;
        }

        .discussion img {
            max-width: 100px;
            margin-right: 20px;
        }

        .discussion-content {
            flex: 1;
        }

        h2 {
            margin-top: 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>


    <div class="container">
        <h1>Discussions Page</h1>

        <div class="discussion">
            <img src="book1.jpg" alt="Book 1">
            <div class="discussion-content">
                <h2>Discussion Title 1</h2>
                <p><strong>Book:</strong> Book 1</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac quam vel odio condimentum imperdiet vel at ligula...</p>
            </div>
        </div>

        <div class="discussion">
            <img src="book2.jfif" alt="Book 2">
            <div class="discussion-content">
                <h2>Discussion Title 2</h2>
                <p><strong>Book:</strong> Book 2</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac quam vel odio condimentum imperdiet vel at ligula...</p>
            </div>
        </div>

        <!-- Repeat similar discussion blocks for other discussions -->

        <div class="pagination">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <!-- Add more pagination links as needed -->
        </div>
    </div>

    <footer>
        <!-- Add footer content and links here -->
    </footer>
</body>
</html>
