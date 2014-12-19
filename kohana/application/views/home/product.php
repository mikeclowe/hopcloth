<center><a href="/home/"><h1>HopCloth</h1></a></center>

<div class="row navbar home">
	<ul class="twelve columns">
		<li><a href="/home/">Home</a></li>
		<li><a href="/home/cart">Cart</a></li>
		<li><a href="/home/">Idk</a></li>
	</ul>	
</div>
		
		
<div class="row">
	<div class="six columns tile">		
		<img src="<?php echo $product->image;?>"/>
	</div>
			
	<div class="six columns tile">
		<h4><?php echo $product->title; ?></h4>
		<p>option test</p>
		<p>option 2</p>
		<p>option 3</p>
		<p>option 4</p>
		<div class="medium default btn icon-right icon-basket"><a href="/home/cart/">Add to Cart</a></div>
	</div>
</div>	
		

<style>	
	.six.columns.tile img {
		height: 400px;
		float: right;
	}
	.six.columns.tile {
		margin-top: 50px;
	}
	.row.navbar.home {
		margin-top: 50px;
	}
	.twelve.columns {
		height: 25px;
	}

</style>
	