<?php
use App\Models\Product\Article;
?>
        <div class="panel-body">
        <form action="<?= url('article/postquery') ?>" method="post" id="query_form">
        	<input type="hidden" name="tableColumns"   value="<?= implode(',', $columns)?>">
            <div class="form-group pull-in clearfix">
            	<?php
            	//Menu Map
            	$cnt=0;
            	$categoryCollect = Article::getFiledDistinct("id,category_name");
            	$categoryMap = Article::format2Array($categoryCollect,'id','category_name');
            	?>
                <?php foreach ($columns as $k=> $v): ?>
                <?php 
                
                if(in_array($v, array('operator','create_time','update_time','content')))
                {
                    continue;
                }
                if(isset(Article::$fieldsMap[$v])) {       //Fields Map
                    $v1=Article::$fieldsMap[$v]['name'];   //Fields Name
                    $desc=Article::$fieldsMap[$v]['desc']; //Fields Desc
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
          
          <div class="form-group pull-in clearfix">
          	<div class="">
                <label class="col-sm-3">详情信息</label>
                <div class="col-sm-12">

                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">

                          <div class="btn-group">

                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>

                              <ul class="dropdown-menu">

                              </ul>

                          </div>

                          <div class="btn-group">

                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>

                              <ul class="dropdown-menu">

                              <li><a data-edit="fontSize 5" style="font-size:24px">Huge</a></li>

                              <li><a data-edit="fontSize 3" style="font-size:18px">Normal</a></li>

                              <li><a data-edit="fontSize 1" style="font-size:14px">Small</a></li>

                              </ul>

                          </div>

                          <div class="btn-group">

                            <a class="btn btn-default btn-sm" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>

                          </div>

                          <div class="btn-group">

                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>

                          </div>

                          <div class="btn-group">

                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>

                          </div>

                          <div class="btn-group">

                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>

                            <div class="dropdown-menu">

                              <div class="input-group m-l-xs m-r-xs">

                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink"/>

                                <div class="input-group-btn">

                                  <button class="btn btn-default btn-sm" type="button">Add</button>

                                </div>

                              </div>

                            </div>

                            <a class="btn btn-default btn-sm" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>

                          </div>

                          

                          <div class="btn-group hidden">

                            <a class="btn btn-default btn-sm" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>

                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />

                          </div>

                          <div class="btn-group">

                            <a class="btn btn-default btn-sm" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>

                            <a class="btn btn-default btn-sm" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>

                          </div>

                        </div>

                        <div id="editor" class="form-control wysiwyg_content" placeholder="Go ahead" style="overflow:scroll;height:200px;max-height:500px">
                        <? if(!empty($fillData[0]->content)) echo base64_decode($fillData[0]->content); ?>
                        </div>
				</div>
          	</div>
		  </div>
        </form>
        </div>
        <footer class="panel-footer text-left bg-light lter">
            <button type="submit" class="btn btn-info btn-s-xs querySbtn">查询</button>
            <button type="submit" class="btn btn-info btn-s-xs newSbtn">新建</button>
            <button type="submit" class="btn btn-info btn-s-xs updateSbtn">更新</button>
        </footer>
