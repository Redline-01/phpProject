<?php

    include_once("config.php");
  
    $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id'];

    $sql = "SELECT * FROM login WHERE id=:id";

    $selectUser = $conn->prepare($sql);

    $selectUser->bindParam(":id", $id);

    $selectUser->execute();
    
    $user_data = $selectUser->fetch();

    

?>



<!DOCTYPE html>
 <html>
 <head>
 	<title>Dashboard</title>
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 	 <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
  	<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
	<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
	<meta name="theme-color" content="#7952b3">
 </head>
 <body>
 
 
 <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to dashboard ".$_SESSION['username']; ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
           <?php if ($_SESSION['isadmin'] == 'true') { ?>
            <li class="nav-item">
              <a class="nav-link" href="project.php">
                <span data-feather="file"></span>
                Home
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">
              <span data-feather="home"></span>
              Edit Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="ordersList.php">
              <span data-feather="home"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="messagesDashboard.php">
              <span data-feather="home"></span>
              Client Messages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="editProducts.php">
              <span data-feather="home"></span>
              Add/Edit Products
            </a>
          </li>
       
          
        </ul>
        <?php }else  {?>
          <li class="nav-item">
              <a class="nav-link" href="project.php">
               
                Home
              </a>
            </li>
          <li class="nav-item">
          <a class="nav-link" href="updateUsers.php">
            <span></span>
            Edit Profile
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ordersList.php">
            <span data-feather="home"></span>
            Your Orders
          </a>
        </li>
        </ul>
      <?php
      } ?>

        
      </div>
    </nav>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
      </div>

    

      <h2>Edit user's details</h2>
      <div class="table-responsive">
        
      <?php  if ($_SESSION['isadmin'] == 'true') {?>
        <form action="editUsers.php" method="POST">
    
        <div class="form-floating">
          <input type="number" class="form-control" id="floatingInput" placeholder="ID" name="id" value="<?php echo  $user_data['id'] ?>">
          <label for="floatingInput">ID</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name" value="<?php echo  $user_data['name'] ?>">
          <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Surname" name="surname" value="<?php echo  $user_data['surname'] ?>">
          <label for="floatingInput">Surname</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" value="<?php echo  $user_data['username'] ?>">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="Email" name="email" value="<?php echo  $user_data['email'] ?>">
          <label for="floatingInput">Email</label>
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Change</button>
      </form>
      <?php } else{
        $user_data = [
          'id' => $_SESSION['id'],
          'name' => $_SESSION['name'],
          'surname' => $_SESSION['surname'],
          'username' => $_SESSION['username'],
          'email' => $_SESSION['email']
      ]; ?>
        <form action="editUsers.php" method="POST">
    
        <div class="form-floating">
          <input type="number" class="form-control" id="floatingInput" placeholder="ID" name="id" value="<?php echo  $user_data['id'] ?>">
          <label for="floatingInput">ID</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name" value="<?php echo  $user_data['name'] ?>">
          <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Surname" name="surname" value="<?php echo  $user_data['surname'] ?>">
          <label for="floatingInput">Surname</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" value="<?php echo  $user_data['username'] ?>">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="Email" name="email" value="<?php echo  $user_data['email'] ?>">
          <label for="floatingInput">Email</label>
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Change</button>
      </form>




        <?php } ?>


      </div>
    </main>
  </div>
</div>

	<script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>


 </body>
 </html>  
