<div class=" d-flex items-center justify-between bg-primary py-2 px-2 mb-2 rounded-lg gap-2 col-12">
	<div class="d-flex items-center col-6">
		<select class="sortBar-select">
			<option selected value="">Sắp xếp</option>
			<option <?php echo isset($_GET['order']) && $_GET['order'] === "asc" ? "selected" :"" ?> value="asc">Sắp xếp tăng dần</option>
			<option <?php echo isset($_GET['order']) && $_GET['order'] === "desc" ? "selected" :"" ?>  value="desc">Sắp xếp giảm dần</option>
		</select>
	</div>
	<form action="" class="col-6 ml-auto search d-flex justify-content-end items-center">
		<input type="text" name="q" class="w-50" placeholder="Seach for...">
		<button class="ml-3 "><i class="fa-solid fa-magnifying-glass"></i></button>
	</form>
</div>
<style>
	.sortBar-select,.sortBar-col,.search input,.search button {
		padding: 5px 10px;
		border-radius: 8px;
		border: none;
		outline: none;
		font-size: 16px;
		display: inline-block;
	}
</style>