<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php if(@$list) {
	foreach ($list as $row) {
?>

<li class="nav-item">

		<li class="nav-item">
			<a href="<?=$row->id?>" class="nav-link">
				<?=html_escape($row->icon)?>
				<p>
					<?=$row->name?>
				</p>
			</a>
		</li>

</li>
<?php
	}
}
?>
