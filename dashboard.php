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
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to Dashboard ".$_SESSION['username']; ?></a>
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
              Dashboard
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
            <a class="nav-link active" aria-current="page" href="addProducts.php">
              <span data-feather="home"></span>
              Add New Products
            </a>
          </li>
       
          
        </ul>
        <?php }else {?>
          <li class="nav-item">
              <a class="nav-link" href="project.php">
               
                Home
              </a>
            </li>
          <li class="nav-item">
          <a class="nav-link" href="editUsers.php">
            <span ></span>
            Edit Profile
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

    <?php if ($_SESSION['isadmin'] == 'true') { ?>

      <h2>Users</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Surname</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Update</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users_data as $user_data) { ?>

               <tr>
                <td><?php echo $user_data['id']; ?></td>
                <td><?php echo $user_data['name']; ?></td>
                <td><?php echo $user_data['surname']; ?></td>
                <td><?php echo $user_data['username']; ?></td>
                <td><?php echo $user_data['email']; ?></td>
        
                <td> <button class="btn btn-warning"><a href="updateUsers.php?id=<?= $user_data['id'];?>" style="text-decoration:none; color:white; font-weight:bold;">Update</a> </button> </td>
           
                <td> <button class="btn btn-danger"><a href="deleteUsers.php?id=<?= $user_data['id'];?>" style="text-decoration:none; color:white; font-weight:bold;">Delete</a> </button></td>
              </tr>
              
           <?php  } ?>
           
            
          </tbody>
        </table>
      </div>
     <?php  } else {
        

    } ?>
    </main>
  </div>
</div>

	<script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>


 </body>
 </html>