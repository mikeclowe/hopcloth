<center><h1>HopCloth</h1></center>

<div class="row">
	
	<?php foreach($products as $p){ ?>

	<div class = "four columns tile">		
		<a href="/home/product/<?php echo $p->slug;?>">
			<img src = "<?php echo $p->image;?>"/></a>	
		<p><?php echo $p->title;?></p>
	</div>
	
	<?php } ?>
	
</div>
	
<style>
	.four.columns:nth-child(3n+1) {
		margin-left: 0;	
	}
	.tile {
		height: 375px;
		text-align: center;
	}
	.tile img {
		height: 300px;
	}
	.tile p {
		font-size: small;
	}
</style>





