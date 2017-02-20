<?php
use App\Models\Zuimei\UserRole;
?>
        <div class="panel-body">
        <form action="<?= url('menu/postquery') ?>" method="post" id="query_form">
        	<input type="hidden" name="tableColumns"   value="<?= implode(',', $columns)?>">
            <div class="form-group pull-in clearfix">
            	<?php
            	$cnt=0;
            	?>
                <?php foreach ($columns as $k=> $v): ?>
                <?php 
                
                if(in_array($v, array('operator','create_time','update_time')))
                {
                    $cnt=0;
                    continue;
                }
                if(isset(UserRole::$fieldsMap[$v])) {       //Fields Map
                    $v1=UserRole::$fieldsMap[$v]['name'];   //Fields Name
                    $desc=UserRole::$fieldsMap[$v]['desc']; //Fields Desc
                }
                ?>
                <?php if ($cnt%4 == 0 && $cnt != 0) {?>
                </div><div class="form-group pull-in clearfix"><?php } ?>
                <?php if ($v == "username"):                    //Judge Pid.?>			
                <div class="col-sm-3">
                <label><?= $v1 ?></label>
                <div class="">
                  <button data-toggle="dropdown" class="col-md-12 form-control btn btn-sm btn-default dropdown-toggle">
                    <span class="dropdown-label"><?= $desc ?></span>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-select">
                    <?php foreach ($usernameMap as $v2): ?>
                    <li class="">
                      <input type="radio" name="<?= $v ?>" value="<?= $v2['username'] ?>">
                      <a href="#"><?= "{$v2['username']}" ?></a>
                    </li>
                	<?php endforeach; ?>
                  </ul>
                  </div>
                </div>                
                <?php elseif ($v == "role_id"):                //Judge Role_id.?>			
                <div class="col-sm-3">
                <label><?= $v1 ?></label>
                <div class="">
                  <button data-toggle="dropdown" class="col-md-12 form-control btn btn-sm btn-default dropdown-toggle">
                    <span class="dropdown-label"><?= $desc ?></span>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-select">
                    <?php foreach ($roleMap as $v2): ?>
                    <li class="">
                      <input type="radio" name="<?= $v ?>" value="<?= $v2['id'] ?>">
                      <a href="#"><?= "{$v2['name']}" ?></a>
                    </li>
                	<?php endforeach; ?>
                  </ul>
                  </div>
                </div>
                <?php elseif (in_array($v, array('id'))): ?>
                <?php $cnt--; ?>
                <div class="col-sm-3" style="display:none;">
                    <label><?= $v1 ?></label>
                    <input class="form-control parsley-validated" name="<?= $v ?>" placeholder="<?= $desc ?>" data-required="true" id="pwd">
                </div>
                <?php else : ?>
            	<div class="col-sm-3">
                    <label><?= $v1 ?></label>
                    <input class="form-control parsley-validated" name="<?= $v ?>" placeholder="<?= $desc ?>" data-required="true" id="pwd">
                </div>
                <?php endif; ?>
                <?php $cnt++; ?>
                <?php endforeach; ?>
          </div>
        </form>
        </div>
        <footer class="panel-footer text-left bg-light lter">
            <button type="submit" class="btn btn-info btn-s-xs querySbtn">查询</button>
            <button type="submit" class="btn btn-info btn-s-xs newSbtn">新建</button>
        </footer>
