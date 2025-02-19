<ul class="pagination">
	<?php if(isset($data['pagination']) && $data['pagination'] > 1): ?>
		<?php $pagination = $data['pagination'] ?>
		<?php for($i = 1; $i <= $pagination; $i++):?>
			<li class="pagination-item" >
				<a data-id="<?php echo $i ?>"  class="pagination-link 
				<?php echo isset($_GET['page']) && +$_GET['page'] === $i ? "pagination-active" : ""?>"><?php echo $i ?></a>
			</li>
		<?php endfor; ?>
	<?php endif; ?>
</ul>
<style>

	.pagination {
		text-align: center;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100%;
		margin: 40px 0 60px 0; 
		gap: 10px;
	}

	.pagination-link {
		height: 40px;
		width: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
		border-radius: 8px;
		border: 1px solid #ccc;
		color: black;
		transition: all 0.3s linear;
		text-decoration: none;
	}
	.pagination-active,
	.pagination-link:hover{
		background-color: #4e73df;
		color: white;
		border-color:#4e73df ;

	}
</style>
