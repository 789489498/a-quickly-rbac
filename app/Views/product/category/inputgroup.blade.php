<?php
use App\Models\Product\Category;
?>
        <div class="panel-body">
        <form action="<?= url('category/postquery') ?>" method="post" id="query_form">
        	<input type="hidden" name="tableColumns"   value="<?= implode(',', $columns)?>">
            <div class="form-group pull-in clearfix">
            	<?php
            	//Menu Map
            	$cnt=0;
            	$categoryCollect = Category::getFiledDistinct("id,category_name");
            	$categoryMap = Category::format2Array($categoryCollect,'id','category_name');
            	?>
                <?php foreach ($columns as $k=> $v): ?>
                <?php 
                
                if(in_array($v, array('operator','create_time','update_time')))
                {
                    $cnt=0;
                    continue;
                }
                if(isset(Category::$fieldsMap[$v])) {       //Fields Map
                    $v1=Category::$fieldsMap[$v]['name'];   //Fields Name
                    $desc=Category::$fieldsMap[$v]['desc']; //Fields Desc
                    $v3="";
                    if (isset($fillData[0]->$v)) {      //Fill Data(from update)
                        $v3=$fillData[0]->$v;
                    }
                }
                ?>
                <?php if ($cnt%4 == 0 && $cnt != 0) {?>
                </div><div class="form-group pull-in clearfix"><?php } ?>
                <?php if ($v == "category_pid"):        //Judge Pid.?>			
                <div class="col-sm-3">
                <label><?= $v1 ?></label>
                <div class="">
                  <button data-toggle="dropdown" class="col-md-12 form-control btn btn-sm btn-default dropdown-toggle">
                    <span class="dropdown-label"><?= $desc ?></span>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-select">
                  	<?php if($v3 == 0) :?>
                  	<li class="active">
                      <input type="radio" name="<?= $v ?>" value="0">
                      <a href="#">顶级菜单:0</a>
                    </li>
                    <?php elseif ($v3 !== ""): ?>
                    <li class="active">
                      <input type="radio" name="<?= $v ?>" value="<?= $v3 ?>">
                      <a href="#"><?= "{$v3}:{$categoryMap[$v3]}" ?></a>
                    </li>
                    <?php endif; ?>
                    <?php foreach ($categoryCollect as $v2): ?>
                    <li class="">
                      <input type="radio" name="<?= $v ?>" value="<?= $v2->id ?>">
                      <a href="#"><?= "{$v2->category_name}:{$v2->id}" ?></a>
                    </li>
                	<?php endforeach; ?>
                	<li class="">
                      <input type="radio" name="<?= $v ?>" value="0">
                      <a href="#">顶级菜单:0</a>
                    </li>
                  </ul>
                  </div>
                </div>
                <?php elseif ($v == "type"): ?>
                <div class="col-sm-3">
                <label><?= $v1 ?></label>
                <div class="">
                  <button data-toggle="dropdown" class="col-md-12 form-control btn btn-sm btn-default dropdown-toggle">
                    <span class="dropdown-label"><?= $desc ?></span>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-select">
                  	<?php if($v3 == 1) :?>
                  	<li class="active">
                      <input type="radio" name="<?= $v ?>" value="1">
                      <a href="#">文章:1</a>
                    </li>
                    <?php elseif($v3 == 2): ?>
                  	<li class="active">
                      <input type="radio" name="<?= $v ?>" value="2">
                      <a href="#">商品:2</a>
                    </li>
                    <?php endif; ?>
                  	<li>
                      <input type="radio" name="<?= $v ?>" value="2">
                      <a href="#">商品:2</a>
                    </li>
                    <li>
                      <input type="radio" name="<?= $v ?>" value="1">
                      <a href="#">文章:1</a>
                    </li>
                  </ul>
                  </div>
                </div>
                <?php elseif(in_array($v, array('id'))) : ?>
                <?php $cnt--; ?>
            	<div class="col-sm-3" style="display:none;">
                    <label><?= $v1 ?></label>
                    <input class="form-control parsley-validated" name="<?= $v ?>" placeholder="<?= $desc ?>" value="<?= $v3 ?>" data-required="true" id="pwd">
                </div>
                <?php else : ?>
            	<div class="col-sm-3">
                    <label><?= $v1 ?></label>
                    <input class="form-control parsley-validated" name="<?= $v ?>" placeholder="<?= $desc ?>" value="<?= $v3 ?>" data-required="true" id="pwd">
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
            <button type="submit" class="btn btn-info btn-s-xs updateSbtn">更新</button>
        </footer>
