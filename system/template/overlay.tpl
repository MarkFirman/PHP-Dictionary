<!-- Overlay -->
<div class="overlay hide" id="search_overlay">
	<a href="javascript:void(0)" class="closebtn" onclick="closeSearch();">&times;</a>
	<div class="search_container">
		<form action="./index.php" method="POST" name="search_form">
			<input type="text" placeholder="Search for a word" name="search" class="search_textbox" /> 
			<input type="text" value="search" name="page" style="display:none;" />
			<input type="submit" value="Submit" hidden />
			<div class="search_button"onclick="document.forms['search_form'].submit();">Search</div>
		</form>
	</div>
</div>
