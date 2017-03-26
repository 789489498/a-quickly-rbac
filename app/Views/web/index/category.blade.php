					<!-- module: category -->
					<li class="list-group-item">
                      <a href="<?= url('web/index') ?>" data-categoryid="">
                        <span class="badge pull-right"></span>
                        	全部
                      </a>
                    </li>
					<?php foreach ($articleCategory as $k=> $v): ?>
					<?php (isset($params['category_id']) && ($v->category_id == $params['category_id'])) ? $bg='bg-success' : $bg='bg-info'; ?>
					<li class="list-group-item">
                      <a href="#" data-categoryid="<?= $v->category_id ?>">
                        <span class="badge <?= $bg ?> pull-right"><?= $v->cnt ?></span>
                        <?= $categoryMap[$v->category_id]['category_name'] ?>
                      </a>
                    </li>
					<?php endforeach;?>