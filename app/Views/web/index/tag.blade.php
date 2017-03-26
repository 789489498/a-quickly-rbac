                    <!-- module: tag -->
                    <a href="<?= url('web/index') ?>" class="label bg-info" data-tag="">全部</a>
                    <?php foreach ($tag as $k=> $v) : ?>
                    <?php (isset($params['tag']) && ($v->tag == $params['tag'])) ? $bg='bg-success' : $bg='bg-info'; ?>
                    <a href="#" class="label <?= $bg ?>" data-tag="<?= $v->tag ?>"><?= $v->tag ?></a>
                    <?php endforeach; ?>
                    