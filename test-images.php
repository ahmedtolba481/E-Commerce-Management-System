<?php include'config/database.php' ;
$selectall ="select * from products";
$result=mysqli_query($conn,$selectall);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Image Test</title>
</head>

<body>

<h1>Image Test</h1>

<h2>Products</h2>

<img src="admin/assets/images/products/<?php echo mysqli_fetch_assoc($result)['image']; ?>" width="200">
<img src="admin/assets/images/products/galaxy-s24.jpg" width="200">
<img src="admin/assets/images/products/macbook-air.jpg" width="200">
<img src="admin/assets/images/products/lenovo-ideapad.jpg" width="200">
<img src="admin/assets/images/products/airpods.jpg" width="200">
<img src="admin/assets/images/products/sony-wh1000xm5.jpg" width="200">


<h2>Categories</h2>

<img src="admin/assets/images/categories/phones.jpg" width="200">
<img src="admin/assets/images/categories/laptops.jpg" width="200">
<img src="admin/assets/images/categories/accessories.jpg" width="200">
<img src="admin/assets/images/categories/headphones.jpg" width="200">


<h2>Brands</h2>

<img src="admin/assets/images/brands/apple.png" width="150">
<img src="admin/assets/images/brands/samsung.png" width="150">
<img src="admin/assets/images/brands/lenovo.png" width="150">
<img src="admin/assets/images/brands/sony.png" width="150">


<h2>Team</h2>

<img src="admin/assets/images/team/ahmed.jpg" width="150">
<img src="admin/assets/images/team/sara.jpg" width="150">
<img src="admin/assets/images/team/mohamed.jpg" width="150">
<img src="admin/assets/images/team/nour.jpg" width="150">
<img src="admin/assets/images/team/omar.jpg" width="150">


<h2>Partners</h2>

<img src="admin/assets/images/partners/partner1.png" width="150">
<img src="admin/assets/images/partners/partner2.png" width="150">
<img src="admin/assets/images/partners/partner3.png" width="150">
<img src="admin/assets/images/partners/partner4.png" width="150">
<img src="admin/assets/images/partners/partner5.png" width="150">


<h2>Slider</h2>

<img src="admin/assets/images/slider/slide1.jpg" width="300">
<img src="admin/assets/images/slider/slide2.jpg" width="300">
<img src="admin/assets/images/slider/slide3.jpg" width="300">
<img src="admin/assets/images/slider/slide4.jpg" width="300">

</body>
</html>
