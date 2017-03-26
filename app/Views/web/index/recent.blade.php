<?php
use App\Models\BaseModel;
?>
                    <!-- module: recent article -->
                    <?php foreach ($recentArticles as $k=> $v): ?>
                    <article class="media">
                    <?php if ($v->image): ?>
                      <a class="pull-left thumb thumb-wrapper m-t-xs">
                        <img src="<?= $v->image ?>">
                      </a>
                    <?php endif; ?>
                      <div class="media-body">                        
                        <a href="#" class="article-link font-semibold"  data-articleid="<?= $v->id ?>"><?= $v->title ?></a>
                        <div class="text-xs block m-t-xs">
                        	<?php if ($v->tag) : ?>
                            <i class="fa fa-tag icon-muted"></i>
                        	<a href="#"><?= $v->tag ?></a>
                        	<?php endif; ?>
                        	
                        	<i class="fa fa-clock-o icon-muted"></i>
                        	<?= BaseModel::humanTimeDiffFormat(strtotime($v->create_time)); ?>
                        </div>
                      </div>
                    </article>
                    <div class="line"></div>
                    <?php endforeach; ?>