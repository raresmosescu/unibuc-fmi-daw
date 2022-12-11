<?php include("models/product.php"); ?>

	<main>
		<h1 class="text-center">Book Store Unibuc FMI DAW</h1>  

		<section style="background-color: #eee;">
			<div class="container py-5">
				
					
						<?php 
						$i = 0;

						foreach ($products as $product) {
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
								echo "	<button type='button' onclick='addToCart()' class='btn btn-primary flex-fill me-1' data-mdb-ripple-color='dark'>";
								echo "		Add to card";
								echo "	</button>";
								echo "	<button type='button' onclick='buyNow()' class='btn btn-danger flex-fill ms-1 ml-2'>Buy now</button>";
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