@extends('layouts.master')

@section('content')
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li><a href="products.html">Barang</a> <span class="divider">/</span></li>
    <li class="active">{{$product->category}}</li>
    </ul>
	<div class="row">
			<div id="gallery" class="span3">
            <a href="{{url('/storage/'.$product->image)}}" title="Fujifilm FinePix S2950 Digital Camera">
				<img src="{{url('/storage/'.$product->image)}}" style="width:100%" alt="{{$product->name}}"/>
            </a>
			</div>
			<div class="span6">
				<h3>{{$product->name}}</h3>
				<hr class="soft"/>
				<div id="form-group">
				<form class="form-horizontal qtyFrm" action="/products/{{$product->id}}" method="POST">
					{{ csrf_field() }}
				  <div class="control-group">
					<label class="control-label"><span>Rp {{$product->price}}</span></label>
					<div class="controls">
					
					<div class="input-append pull-left">
					<input class="span1" name="quantity" style="max-width:34px" placeholder="0" value="0" id="popoa" size="16" type="number">
                    <button class="btn" type="button" onclick="decrementQuantity()">
                    <i class="icon-minus"></i></button>
                    <button class="btn" type="button" onclick="incrementQuantity()">
					<i class="icon-plus"></i></button>
				</div>
					@guest
					<a href="/product_summary" type="submit" class="btn btn-large btn-primary pull-right"> Tambahkan ke Keranjang <i class=" icon-shopping-cart"></i></a>
					@else
					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
					<input type="hidden" name="inventory_id" value="{{$product->id}}"/>
					<button type="submit" class="btn btn-large btn-primary pull-right re-stock"> Tambahkan ke Keranjang <i class=" icon-shopping-cart"></i></button>
					@endguest
					  
					</div>
				  </div>
				</form>
				</div>

				<hr class="soft"/>
				<h4 id="product-stock">{{$product->stock}} item dalam stock</h4>
				<hr class="soft clr"/>
				<p>{{$product->detail}}</p>
			</div>
    </div>
	</div>
	<script>
		function decrementQuantity()
    	{
			var dec = document.getElementById("popoa").value;
			if (dec <= 0)
				dec = 0;
			else
				dec--;
			document.getElementById("popoa").value = dec;
    	}

		function incrementQuantity()
		{
			var plus = document.getElementById("popoa").value;
			plus++;
			document.getElementById("popoa").value = plus;
		}
	</script>
</div>
@include('layouts.error')
</div>
</div>
<!-- MainBody End ============================= -->
@endsection
