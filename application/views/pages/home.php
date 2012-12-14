
<div class="page-header">
	<h1>Nearby Venues</h1>
</div>

<div class="span8">
	<?php echo $map['html']; ?>
</div>

<div class="span4">
	<table id="venue_table" class="table table-bordered table-striped">
		<tr>
			<th>Venue Name</th>
		</tr>
	</table>
</div>

<div style="display:none;" id="infoHTML">
	<h5 id="name"></h5>
	<div id="venue-rating">
		<i class="icon-star-empty venue-star-1"></i>
		<i class="icon-star-empty venue-star-2"></i>
		<i class="icon-star-empty venue-star-3"></i>
		<i class="icon-star-empty venue-star-4"></i>
		<i class="icon-star-empty venue-star-5"></i>
	</div>
	<p id="shows"></p>
	<div id="band-rating">
		<i class="icon-star-empty band-star-1"></i>
		<i class="icon-star-empty band-star-2"></i>
		<i class="icon-star-empty band-star-3"></i>
		<i class="icon-star-empty band-star-4"></i>
		<i class="icon-star-empty band-star-5"></i>
	</div>

</div>
