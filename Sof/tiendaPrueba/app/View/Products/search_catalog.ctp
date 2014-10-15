
<div style="padding: 5px 5px; font-size: 10px">
	<div style="width: 400px; height: 40px;">
		<span>Search by attribute </span><select field="attr"><option>id</option><option>name</option><option>price</option><option>quantity</option><option>rating</option></select>
	</div>
	<div style="width: 400px; height: 40px;">
		<span>Within values </span><input field="lesserthan" type="text" style="width: 80px; height: 13px; vertical-align: bottom;"/><span> and </span><input field="greaterthan" type="text" style="width: 80px; height: 13px; vertical-align: bottom;"/>
	</div>
	<div style="width: 400px; height: 40px;">
		<span>Order by </span><input field="orderby" type="text" style="width: 80px; height: 13px; vertical-align: bottom;"/> <span>in direction </span><select field="direction"><option>ASC</option><option>DESC</option></select>
	</div>
	<div style="width: 400px; height: 40px;">
		<input type="button" value="search"/>
	</div>
	
</div>

<?php

	if(sizeof($products) < 1) {
		echo "No hay productos que mostrar";
	}
	else {
		echo $this->CatalogGenerator->formatProducts($products);
	}

?>

<script type="text/javascript">
	
	$("input[value='search']").click(function(){
		var opts = 	"/" + 
						  $("select[field='attr']").val() + 
					"/" + $("input[field='lesserthan']").val() + 
					"/" + $("input[field='greaterthan']").val() + 
					"/" + $("input[field='orderby']").val() + 
					"/" + $("select[field='direction']").val();
		var url = "<?php echo $this->html->url('/', true); ?>" + "/Products/searchCatalog" + opts;
		window.location.href = url;
	});

</script>