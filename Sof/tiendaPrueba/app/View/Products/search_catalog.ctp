<?php

	if(sizeof($products) < 1) {
		echo "No hay productos que mostrar";
	}
	else {
		echo $this->CatalogGenerator->formatProducts($products);
	}

?>