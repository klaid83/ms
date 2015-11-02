<?php

namespace ModT\View\Helper;

use Zend\View\Helper\AbstractHelper;

class MenuCountryHelper extends AbstractHelper
{
	public function __invoke($menu)
	{
		if (is_array($menu))
		{
			?>
			<div class="row">
				<div class="col-md-11">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Страны</h3>
						</div>
						<div class="panel-body">
							<?php
							echo '<ul>';
							foreach($menu['menu_data'] as $k=>$v)
							{
								echo '<li>'
									. '<a href="/directory/' . $k . '" >'
									. $v
									. '</a>'
									. '</li>';
							}
							echo '</ul>';
							?>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
	}
}