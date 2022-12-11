<?php 

include("data/database.php");
$query = "SELECT * FROM product";
$products = mysqli_query($conn, $query);

// include("../../models/product.php");

?>

	<main>
		<h1 class="text-center">Book Store Unibuc FMI DAW</h1>  

		<section style="background-color: #eee;">
			<div class="container py-5">
				
					
						<?php 
						$i = 0;

						while ($product = mysqli_fetch_array($products)) {
							if ($i % 3 == 0) {
									echo "<div class='row'>";
								}
								echo "<div class='col-md-12 col-lg-4 mb-4 mb-lg-0'>";
								echo "<div class='card'>";
	            	echo "<img src='" . $product['img'] . "' class='card-img-top' alt='Book' />";
								echo "<div class='card-body'>";
								echo "<div class='d-flex justify-content-between mb-3'>";
								echo "	<h5 class='mb-0'>" . $product['name'] . "</h5>";
								echo "	<h5 class='text-dark mb-0'>$" . $product['price'] . "</h5>";
								echo "</div>";
								echo "<div class='d-flex flex-row'>";
								echo "<form action='/unibuc-fmi-daw/controllers/add_to_cart.php' method='POST'>";
								echo "<input type='hidden' name='id' value=" . $product['id'] . ">";
								echo "<input type='hidden' name='name' value='" . $product['name'] . "'>";
								echo "<input type='hidden' name='quantity' value='1'>";
								echo "<input type='hidden' name='price' value=" . $product['price'] . ">";
								echo "<input class='btn btn-warning flex-fill me-1' data-mdb-ripple-color='dark' type='submit' value='Add to Cart'>";
								echo "</form>";
								echo "</div>";
								echo "</div>";
								echo "</div>";
								echo "</div>";
								if ($i % 3 == 2) {
										echo "</div>";
										
								}

								$i++;

						}

						echo "</div>";
					
						?>
					</div>
				</div>
			</div>
		</section>
	</main>