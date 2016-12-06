<body>
	<div class="container">
		<div class="row">
			<div class="column" id="title">
				<h1>Minori's 2016 Somewhat Secret Santa</h1>
				<?php
				print "<h4>Hi ".$person_info->name."</h4>";
				?>
			</div>
		</div>
		<div class="row">
    		<div class="column" id="yourlist">
    			<h2>Here is your Christmas list</h2>
				<ul class="gift-list">
					<?php
					foreach ($my_gifts as $my_gift) {
						print "<li><a href=".$my_gift->url.">".$my_gift->name."</a>".form_open(base_url($person_info->public_id))."<input type=\"hidden\" name=\"id\" value=\"".$my_gift->id."\" /><input type=\"hidden\" name=\"type\" value=\"remove\" /><input type=\"submit\" name=\"submit\" class=\"remove-gift\" value=\"x\" /></form></li>";
					}
					?>
				</ul>
				<h2>Add items to your list</h2>
				<?php print validation_errors(); ?>
				<?php print form_open(base_url($person_info->public_id)); ?>
				    <label for="title">Name</label>
				    <textarea rows="1" cols="20" name="name"></textarea>
			    	<label for="text">URL (optional)</label>
			    	<textarea rows="1" cols="20" name="url"></textarea>
					<input type="hidden" name="owner" value="<?php print $person_info->public_id ?>" />
					<input type="hidden" name="type" value="add" />
			    	<input type="submit" name="submit" value="Add item" class="button-primary" />
				</form>
    		</div>
    		<div class="column" id="theirlist">
    			<?php
				if ($person_info->shopping_for != NULL) {
					print "<h2>Shopping For ".$shopping_for->name."</h2>";
					print "<ul>";
					foreach ($shopping_for_gifts as $gift) {
						print "<li><a href=".$gift->url.">".$gift->name."</a></li>";
					}
					print "</ul>";
				} else {
					print "<h2>Your shopping for</h2>";
					print "Tap the button to find out who you're shopping for.";
					print form_open(base_url($person_info->public_id))."<input type=\"hidden\" name=\"id\" value=\"".$person_info->public_id."\" /><input type=\"hidden\" name=\"type\" value=\"spin\" /><input type=\"submit\" name=\"submit\" value=\"Find Out\" class=\"button-primary\" /></form>";
				}
			?>
    		</div>
  		</div>
	</div>
</body>
</html>