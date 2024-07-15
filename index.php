<?php 
    include 'header.php';
    include 'dbconnection.php';

        
        $query="SELECT * FROM categories";
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
           $Categories = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($Categories as $category){
        ?>

<!-- fashion section start -->
<div class="fashion_section">

    <?php
        
        if (isset($_SESSION['error'])) { 
            ?>
    <div class="alert alert-danger" role="alert">
        <p> <?php echo $_SESSION['error']; ?></p>
    </div>
    <?php
             }
        unset($_SESSION['error']);
      

if (isset($_SESSION['success'])) { 
            ?>
    <div class="alert alert-success" role="alert">
        <p> <?php echo $_SESSION['success']; ?></p>
    </div>
    <?php
             }
        unset($_SESSION['success']);
      ?>



    <div id="main_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="container">
                    <h1 class="fashion_taital" id="<?php echo $category['name'] ?>" style="margin:15px">
                        <?php echo $category['name'] ?></h1>

                    <div class="fashion_section_2">
                        <div class="row">
                            <?php 
                          $current_category_id = $category['id'];
                           $query="SELECT * FROM products where category_id='$current_category_id'";
                           $result=$conn->query($query);
                           if ($result->num_rows > 0) {
                               $Products= $result->fetch_all(MYSQLI_ASSOC);
                            foreach($Products as $Product){
                            ?>
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text"><?php echo $Product['name'] ?></h4>
                                    <p class="price_text">Price <span
                                            style="color: #262626;"><?php echo $Product['price'] ?></span></p>
                                    <div class="tshirt_img"><img src="admin/products/<?php echo $Product['img'] ?>">
                                        <h2 class="shirt_text"><?php echo $Product['description'] ?></h2>
                                    </div>

                                    <div class="btn_main">

                                        <form action="admin/carts/add.php" method="post">

                                            <div class="form-group">
                                                <label for="name">Enter Quantity :</label>
                                                <input type="number" name="quantity" value="1" min="1"
                                                    max="<?php echo $Product['quantity'] ?>">
                                            </div>

                                            <input type="hidden" name="product_id" value="<?php echo $Product['id'] ?>">
                                            <button type="submit" class="btn btn-primary">Buy Now</button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <?php  
                            } 
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>
</div>
<?php 
            }
        }
    ?>

<!-- fashion section end -->




<!-- footer section start -->
<?php 
    include 'footer.php';
    ?>