<?php
include "../../../../model/connection.php";

if (isset($_POST['submit'])) {
	try {
		$stmt = $conn->prepare("UPDATE products SET name = :name, price = :price, category = :category WHERE product_id = :id");
		$stmt->bindParam(':name', $_POST['name']);
		$stmt->bindParam(':price', $_POST['price']);
		$stmt->bindParam(':category', $_POST['category']);
		$stmt->bindParam(':id', $_POST['id']);

		$stmt->execute();

		
		header("Location: ../ui-product.php");
		exit(); 
	} catch (Exception $e) {
		echo "Error updating product: " . $e->getMessage();
	}
} else {
	
	if (isset($_GET['id'])) {
		try {
			$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :id");
			$stmt->bindParam(':id', $_GET['id']);
			$stmt->execute();
			$product = $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			echo "Error fetching product details: " . $e->getMessage();
		}
	} else {
		echo "Product ID is missing.";
		
	}
}


$conn = null;
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modernize Free</title>
	<link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo.png" />
	<link rel="stylesheet" href="../../assets/css/styles.min.css" />
	<link rel="stylesheet" href="../../assets/css/table.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
		
		<aside class="left-sidebar">
			
			<div>
				<div class="brand-logo d-flex align-items-center justify-content-between">
					<a href="index.php" class="text-nowrap logo-img">
						<img src="../assets/images/logos/logo.png" width="150" alt="" />
					</a>
					<div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
						<i class="ti ti-x fs-8"></i>
					</div>
				</div>

				<!-- Sidebar -->
				<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
					<ul id="sidebarnav">
						<li class="nav-small-cap">
							<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
							<span class="hide-menu">Home</span>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link" href="index.php" aria-expanded="false">
								<span>
									<i class="ti ti-layout-dashboard"></i>
								</span>
								<span class="hide-menu">Dashboard</span>
							</a>
						</li>

						<li class="nav-small-cap">
							<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
	
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="ui-product.php" aria-expanded="false">
								<span>
									<i class="fa-solid fa-store"></i>
								</span>
								<span class="hide-menu">Product</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="ui-savep.php" aria-expanded="false">
								<span>
									<i class="fa-solid fa-image"></i>
								</span>
								<span class="hide-menu">Save Photo</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="ui-customize.php" aria-expanded="false">
								<span>
									<i class="ti ti-cards"></i>
								</span>
								<span class="hide-menu">Customize</span>
							</a>
						</li>

						<li class="nav-small-cap">
							<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
							<span class="hide-menu">AUTH</span>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="controls/logout.php" aria-expanded="false">
								<span>
									<i class="ti ti-login"></i>
								</span>
								<span class="hide-menu">Logout</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="authentication-register.php" aria-expanded="false">
								<span>
									<i class="ti ti-user-plus"></i>
								</span>
								<span class="hide-menu">Register</span>
							</a>
						</li>

				</nav>
				
			</div>
			
		</aside>
		

		<div class="body-wrapper">
		
			<div class="container-fluid">
				<div class="container-fluid">
					<div class="card">
						<div class="card-body">
							<a href="../ui-product.php"><button class="btn btn-primary w-30 py-8 fs-4 mb-4 rounded-2" value="submit"> Cancel Edit </button></a>
							<h5 class="card-title fw-semibold mb-4">Edit this Product </h5>

							<div class="card">
								<div class="card-body p-4">

									<form action="edit_product.php" method="post">
										<input type="hidden" name="id" value="<?php echo isset($product['product_id']) ? htmlspecialchars($product['product_id']) : ''; ?>">

										<label for="name">Product Name:</label>
										<input class="w-30 py-10 fs-4 mb-4 rounded-2" type="text" name="name" id="name" value="<?php echo isset($product['name']) ? htmlspecialchars($product['name']) : ''; ?>" required><br><br>

										<label for="price">Price:</label>
										<input class="w-30 py-10 fs-4 mb-4 rounded-2" type="number" step="0.01" name="price" id="price" value="<?php echo isset($product['price']) ? htmlspecialchars($product['price']) : ''; ?>" required><br><br>


										<label for="category">Category:</label>
										<select class="w-30 py-8 fs-4 mb-4 rounded-2" name="category" id="category" required>
											<option value="gaming" <?php if (isset($product['category']) && $product['category'] == 'gaming') echo 'selected'; ?>>Gaming</option>
											<option value="normal" <?php if (isset($product['category']) && $product['category'] == 'normal') echo 'selected'; ?>>Normal</option>
										</select><br><br>

										<button type="submit" class="btn btn-primary w-30 py-8 fs-4 mb-4 rounded-2" name="submit">Update Product</button>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/js/sidebarmenu.js"></script>
	<script src="../../assets/js/app.min.js"></script>
	<script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>