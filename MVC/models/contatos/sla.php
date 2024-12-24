<!DOCTYPE html>
<html>
<head>
    <title>Pagination in PHP</title>
</head>
<body>
    <?php
        $conn = mysqli_connect('localhost', 'root', '');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            mysqli_select_db($conn, 'Pagination');
        }

        $limit = 5;

        $getQuery = "SELECT * FROM Countries";

        $result = mysqli_query($conn, $getQuery);
        $total_rows = mysqli_num_rows($result);

        $total_pages = ceil($total_rows / $limit);

        if (!isset($_GET['page'])) {
            $page_number = 1;
        } else {
            $page_number = $_GET['page'];
        }

        $initial_page = ($page_number - 1) * $limit;

        $getQuery = "SELECT * FROM Countries LIMIT $initial_page, $limit";
        $result = mysqli_query($conn, $getQuery);

        while ($row = mysqli_fetch_array($result)) {
            echo $row['ID'] . ' ' . $row['Country'] . '<br>';
        }

        for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
            echo '<a href="index.php?page=' . $page_number . '">' . $page_number . ' </a>';
        }
    ?>
</body>
</html>
