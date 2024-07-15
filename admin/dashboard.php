<?php 
session_start();
if($_SESSION['role']==="admin" ){
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo  $_SESSION['username'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="users/edit.php?user_id=<?php echo $_SESSION['id'] ?>">Edit
                            Profile</a>
                        <a class="dropdown-item" href="../authentication/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <h2 class="sidebar-heading">Admin Panel</h2>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('usersItemList')">
                                <H5>Users</H5>
                            </button>
                            <ul class="item-list" id="usersItemList" style="display: none;">
                                <li><a class="dropdown-item" href="users/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="users/display_all.php">View all </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('categoriesItemList')">
                                <H5>Categories</H5>
                            </button>
                            <ul class="item-list" id="categoriesItemList" style="display: none;">
                                <li><a class="dropdown-item" href="categories/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="categories/display_all.php">View all </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('productsItemList')">
                                <H5>Products</H5>
                            </button>
                            <ul class="item-list" id="productsItemList" style="display: none;">
                                <li><a class="dropdown-item" href="products/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="products/display_all.php">View all </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('ordersItemList')">
                                <H5>Orders</H5>
                            </button>
                            <ul class="item-list" id="ordersItemList" style="display: none;">
                                <li><a class="dropdown-item" href="orders/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="orders/display_all.php">View all </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('orderItemsItemList')">
                                <H5>Order
                                    Items</H5>
                            </button>
                            <ul class="item-list" id="orderItemsItemList" style="display: none;">
                                <li><a class="dropdown-item" href="order_items/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="order_items/display_all.php">View all </a></li>
                            </ul>

                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('cartsItemsItemList')">
                                <H5>Carts</H5>
                            </button>
                            <ul class="item-list" id="cartsItemsItemList" style="display: none;">
                                <li><a class="dropdown-item" href="carts/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="carts/display_all.php">View all </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">
                    <!-- Placeholder for content -->
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    function toggleItemList(itemListId) {
        var itemList = document.getElementById(itemListId);
        if (itemList.style.display === "none") {
            itemList.style.display = "block";
        } else {
            itemList.style.display = "none";
        }
    }
    </script>
</body>

</html>

<?php 
}else{
    header("Location: ../forbidden_page.php");
    }
?>