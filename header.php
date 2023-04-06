<html>
    <head>
        <title>Pizza Database Portal</title>
        <link href="bootstrap.min.css" rel="stylesheet"/>
        <script src="bootstrap.bundle.js" rel="stylesheet"></script>
    </head>
    <body>

        <ul class = "nav">
            <li class = "nav-item"><a class = "nav-link" href="index.php">Pizza Home</a></li>

            <li class = "nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle = "dropdown"
                href="#" role="button" arai-expanded="false">Data Import</a>

                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="pizza_data_import.php">Import Person/Pizza/Data</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Import Other Data 1</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Import Other Data 2</a>
                    </li>

                </ul>
            </li>

            <li class = "nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle = "dropdown"
                href="#" role="button" arai-expanded="false">Data Reports</a>

                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="pizza_data_report.php">Person/Pizza Report</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Other Report 1</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Other Report 2</a>
                    </li>

                </ul>
            </li>
        </ul>

<div class="container">