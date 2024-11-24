<?php 

   include_once('config.php');

    if (empty($_SESSION['username'])) {
          header("Location: login.php");
    }
   
    $sql = "SELECT * FROM login";
    $selectUsers = $conn->prepare($sql);
    $selectUsers->execute();

    $users_data = $selectUsers->fetchAll();
    

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="images/hyperxfavicon.jpg">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kalnia">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Afacad">
	<link rel="stylesheet" href="CSS/style2.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"
>
<link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Shop</title>
	<style>
		.modal {
  display: none; 
  position: fixed; 
  z-index: 1000; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgba(0, 0, 0, 0.5); 
}


.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px;
  position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%); 

}


.close {
  color: #888;
  float: right;
  font-size: 28px;
  font-weight: bold;
  width: 30px;
  height: 40px;

}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
  
}
	</style>

</head>
<body>
    <section id="section-1">
		<div class="header">
			<header>
				<a href="project.php"><img src="images/hyperx.png" width="200px" height="100px"></a>
				<div class="hamburger">
					<div class="line"></div>
					<div class="line"></div>
					<div class="line"></div>
				</div>
				<nav>
					<ul>
					    <li id="usernameDB"><a href="dashboard.php"> <?php echo "Hello There ".$_SESSION['username']; ?> </a></li>
					    <div id="verline"></div>
						<li><a href="project.php">Home</a></li>
						<!-- <li><a href="products.php">Products</a></li> -->
						<li class="active"><a href="shop.php">Shop</a></li>
						<li><a href="#section-footer">About</a></li>
                        <li><a href="logout.php">Logout</a></li>
						<li><a href="#section-footer">Contact</a>
                        
							<ul class="dropdown">
								<li><a href="https://www.facebook.com/hyperxcommunity" target="_blank"><i class='bx bxl-facebook-circle' style='color:#316ff6'></i> Facebook</a></li>
								<li><a href="https://www.instagram.com/hyperx/" target="_blank"><i class='bx bxl-instagram '></i> Instagram</a></li>
								<li><a href="https://twitter.com/HyperX" target="_blank"><i class='bx bxl-twitter bx-tada' style='color:#1da1f2'></i> Twitter</a></li>
								<li><a href="https://www.youtube.com/@hyperx" target="_blank"><i class='bx bxl-youtube' style='color:#ff0000'  ></i> Youtube</a></li>
						</li>

						</ul>
					</ul>
				</nav>
			</div>
			
			</header>
			<script>
				hamburger = document.querySelector(".hamburger")
				hamburger.onclick = function() {
					nav = document.querySelector("nav");
					nav.classList.toggle("active");
				}
	
	
			</script>

	</section>

    <section id="shopList">
	<!--<div class="container">
<div class="shopping">
		<i class='bx bx-cart'></i>
		<span class="quantity">0</span>
</div>
<div class="list"></div>
</div>
      <div class="card">
		<h1>Card</h1>
		<ul class="listCard"></ul>
		<div class="checkOut">
			<div class="total">0</div>
			<div class="closeShopping">Close</div>
		</div>
	  </div>  
	-->
		  
     <div class="buyShop" name="buyProduct">

           <div class="product-box">

			<img src="images/hyperxcloud2red.webp" width="300px" height="300px" class="product-image">
			<h3 class="product-name">HyperX Cloud Red II Headset</h3>
			<button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			<h3 class="price">&euro; 99.99</h3>
			<div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
		   </div>
        
        </div>

		<div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxcloud2.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Cloud Silver II Headset</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 99.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxcontroller.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Xbox Controller</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 69.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxheadsetnew.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Cloud II Headset</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 99.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxkeyboard.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Keyboard</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 149.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxmic.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Gaming Mic</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 129.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxmonitor.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Gaming Monitor</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 259.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxmouse.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Black Mouse</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 69.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxnewkeyboard.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Keyboard</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 159.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		 <div class="buyShop" name="buyProduct">

			<div class="product-box">
 
			 <img src="images/hyperxnewmouse.webp" width="300px" height="300px" class="product-image">
			 <h3 class="product-name">HyperX Red Mouse</h3>
			 <button id="buybtn"><img class="img-shop" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAe1JREFUWEftlz0yhEEQhp+twikESEgkLoBE6gokZE5AoTiBjARHkEpwAYmExE+VU6CKfdV8W1OzO9Mzsz+1wXYimJ7uZ/vt6f60GDNrjRkPEyBLkbBCh8GFa+DdCjLI8xDot0fwI+B4kElTsXKAdH8buBoFVEqyubZcWw7iHljPAFoDVp3fA6B7RZZ6ZQK6a1dGf2XzGf2kHpTEsiqprWd/6VUpJ8HQgSSBqtSYVaWhAwnkzZPNau6RAPlJwubuNSZKXnWXr9VDzQW/Sr5stUDR15gL5De35pGkk9UC+fc0TjrjIRcot7lzesj30VpSxTuWCxQ2d2wE5AAlR0kJkKa2gsn0y1TqcPFaQBqy6sfGuvKXAOWMAAsoKZcSlAKlRoDiWbvMnGmlQDX7rZHHl6urmaMapqaaOyvdb01IS85/v9IKNbL4+63Z7tZv8f2iO7EGKGxuCyQ8j8pVWyHd88tfCpT8jKmtUPiicqE+rE/hfoByIYr8+gE6d0v2FdgDbiOZN4AzYMFN+t0UYS2Qv0YU/wVYiiR6Bha9s+RHXi3QPnDiJfkGZiJAX8C0d3YAnMaqVAu0DDy2A0+5wBdATApJu+P8foAV4GnQQIonqE3g03o57j+XWeAmBdPPHCp6OSXOtZKV5CjynQBZ5foDkI1sJb53g8kAAAAASUVORK5CYII="/> Add to Cart</button>
			 <h3 class="price">&euro; 59.99</h3>
			 <div><img src="images/heart.png" width="40px" height="40px" class="heart-icon"></div>
			</div>
		 
		 </div>

		

		 <div id="myModal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<div id="checkoutInfo">
					
				</div>
			</div>
		</div>  


	


		

		




    </section>



	


















	<section id="section-footer" class="footer">
		<div class="footer-content">
			<img src="images/hyperx.png">
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
	        <p>&copy; 2024 HyperX. All rights reserved.</p>
			
			<div class="icons">
				<a href="https://www.facebook.com/hyperxcommunity" target="_blank"><i class='bx bxl-facebook-circle'></i></a>
				<a href="https://www.instagram.com/hyperx/" target="_blank"><i class='bx bxl-instagram-alt' ></i></a>
				<a href="https://twitter.com/HyperX" target="_blank"><i class='bx bxl-twitter' ></i></a>
				<a href="https://www.youtube.com/@hyperx" target="_blank"><i class='bx bxl-youtube' ></i></a>
			</div>
		</div>
	
		<div class="footer-content">
			<h4>Main</h4>
			<li><a href="project.php">Home</a></li>
			<li><a href="products.php">Products</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="#">Contact</a></li>
		</div>
	
		<div class="footer-content">
			<h4>Products</h4>
			<li><a href="shop.php">HyperX Mouse</a></li>
			<li><a href="shop.php">HyperX Keyboard</a></li>
			<li><a href="shop.php">HyperX Headset</a></li>
			<li><a href="shop.php">HyperX Monitor</a></li>
		</div>
	
		<div class="footer-content">
			<h4>Login</h4>
			<li><a href="login.php">Log in</a></li>
			
		</div>
	
		

		
	</section>
	
	
	
	
	
	
	<div class="chat-box" id="chat-box">
		<div class="chat-icon" onclick="toggleChat()">
		  <img src="images/chatbox.webp" alt="Chat Icon">
		</div>
		<div class="chat-window" id="chat-window">
		  <div class="header">Welcome to our support center! Do you need assistance with anything? Our team is here to help you resolve any issues or answer any questions you may have. Feel free to reach out to us and we'll do our best to assist you promptly. Your satisfaction is our top priority!</div>
		  
		  <div class="email-info">
			<input type="email" id="email" placeholder="Your Email" required>
		  </div>
		  <div class="problem-box">
			<textarea id="message" placeholder="Describe your problem here..." required></textarea>
		  </div>
		  <button onclick="sendMessage()" id="sendbtn">Send</button>
		</div>
	  </div>



	  
    
</body>

<script src="main.js"></script>
<script src="main2.js"></script>
</html>