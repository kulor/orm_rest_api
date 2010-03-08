<html>
<head>
<title>CodeIgniter ORM REST Server</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

fieldset{
	border:1px solid #ccc;
	margin:20px 0;
	padding:20px;
}
table{
	width:100%;
}
table, td, th{
	font-size:12px;
	border:1px solid #f1f1f1;
	border-collapse:collapse;
}
th{
	text-transform:capitalize;
}
td, th{
	padding:5px;
	text-align:center;
}
.row{
	font-size:12px;
	padding:5px 0;
}
.row label{
	float:left;
	clear:none;
	width:7em;
	vertical-align:middle;
}
.row input{
	padding:3px;
	vertical-align:middle;
}
</style>
</head>
<body>

<h1>CodeIgniter <acronym title="Object-relational mapping">ORM</acronym> <acronym title="Representational State Transfer">REST</acronym> Server</h1>
	<fieldset>
		<legend>Data summary</legend>
		<table>
			<?php
			if($items->exists()){
				echo '<thead>';
				echo '<tr>';
				foreach($items->fields as $field){
					echo '<th>' . $field . '</th>';
				}
				echo '<th>Resonse formats</th>';
				echo '<th>Delete</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				foreach ($items->all as $item){
					echo '<tr>';
					foreach($items->fields as $field){
						echo '<td>' . $item->$field . '</td>';
					}
					?>
					<td>
					<a href="<?php echo site_url('api/item/id/' .$item->id . '/format/xml');?>">XML</a>,
					<a href="<?php echo site_url('api/item/id/' .$item->id . '/format/rawxml');?>">Raw XML</a>,
					<a href="<?php echo site_url('api/item/id/' .$item->id . '/format/csv');?>">CSV</a>,
					<a href="<?php echo site_url('api/item/id/' .$item->id . '/format/json');?>">JSON</a>,
					<a href="<?php echo site_url('api/item/id/' .$item->id . '/format/php');?>">PHP</a>,
					<a href="<?php echo site_url('api/item/id/' .$item->id . '/format/serialize');?>">PHP serialized</a>
					</td>
					<td>
						<form action="<?php echo site_url('api/item');?>" method="post">
							<input type="hidden" name="REQUEST_METHOD" value="delete">
							<input type="hidden" name="format" value="json">
							<input name="id" type="hidden" value="<?php echo $item->id; ?>" />
							<label for="format<?php echo $item->id; ?>">Response:</label>
							<select name="format" id="format<?php echo $item->id; ?>">
								<option value="json">JSON</option>';
								<option value="xml">XML</option>';
								<option value="php">PHP</option>';
							</select>
							<!-- <input id="id" name="id" value="1" /> -->
							<button type="submit">Delete item</button>
						</form>
					</td>
					<?php
					echo '</tr>';
				}
				echo '</tbody>';
			} else {
				echo '<p>No items currently stored</p>';
			}
			?>
		</table>
	</fieldset>
	
	<fieldset>
		<legend>Get items</legend>
		<ul>
			<li><a href="<?php echo site_url('api/items');?>">Default</a></li>
			<li><a href="<?php echo site_url('api/items/format/xml');?>">XML</a></li>
			<li><a href="<?php echo site_url('api/items/format/rawxml');?>">Raw XML</a></li>
			<li><a href="<?php echo site_url('api/items/format/csv');?>">CSV</a></li>
			<li><a href="<?php echo site_url('api/items/format/json');?>">JSON</a></li>
			<li><a href="<?php echo site_url('api/items/format/php');?>">PHP</a></li>
			<li><a href="<?php echo site_url('api/items/format/serialize');?>">PHP serialized</a></li>
		</ul>
	</fieldset>

	<fieldset>
		<legend>Add an item</legend>
		<form action="<?php echo site_url('api/item');?>" method="post">
			<input type="hidden" name="REQUEST_METHOD" value="post">
			<div class="row"><label for="title">Title:</label><input id="title" name="title" value="Bobs your uncle" /></div>
			<div class="row"><label for="datetime">Datetime:</label><input id="datetime" name="datetime" value="05/03/10" /></div>
			<button type="submit">Add item</button>
		</form>
	</fieldset>

<p><br />Page rendered in {elapsed_time} seconds</p>

</body>
</html>