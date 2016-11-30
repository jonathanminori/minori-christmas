<body>
	<div class="container">
		<div class="row">
			<div class="one-third column">
				<h1>2016 Secret Santa</h1>
				<?php
				print "<h4>Hello ".$person_info->name."</h4>";
				?>
			</div>
    		<div class="one-third column">
    			<h3>Your List</h3>
    			<?php print validation_errors(); ?>
				<?php print form_open(base_url($person_info->public_id)); ?>
				    <label for="title">Name</label>
				    <input type="input" name="name" /><br />

			    	<label for="text">URL (optional)</label>
			    	<input type="input" name="url" /><br />

					<input type="hidden" name="owner" value="<?php print $person_info->public_id ?>" />
					<input type="hidden" name="type" value="add" />
			    	<input type="submit" name="submit" value="Add item" class="button-primary" />
				</form>
				<ul>
					<?php
					foreach ($my_gifts as $my_gift) {
						print "<li><a href=".$my_gift->url.">".$my_gift->name."</a>".form_open(base_url($person_info->public_id))."<input type=\"hidden\" name=\"id\" value=\"".$my_gift->id."\" /><input type=\"hidden\" name=\"type\" value=\"remove\" /><input type=\"submit\" name=\"submit\" value=\"Remove\" /></form></li>";
					}
					?>
				</ul>
    		</div>
    		<div class="one-third column">
    			<?php
				if ($person_info->shopping_for != NULL) {
					print "<h3>Shopping For ".$shopping_for->name."</h3>";
					print "<ul>";
					foreach ($shopping_for_gifts as $gift) {
						print "<li><a href=".$gift->url.">".$gift->name."</a></li>";
					}
					print "</ul>";
				} else {
					print "<h3>Find out who you're shopping for.</h3>";
					print "Tap the button below to see who you'll be secret Santa to.";
					print form_open(base_url($person_info->public_id))."<input type=\"hidden\" name=\"id\" value=\"".$person_info->public_id."\" /><input type=\"hidden\" name=\"type\" value=\"spin\" /><input type=\"submit\" name=\"submit\" value=\"Spin\" class=\"button-primary\" /></form>";
				}
			?>
    		</div>
  		</div>
	</div>
</body>
</html>