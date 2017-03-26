<?php
use App\Models\BaseModel;

$title = '';
$image = '';
$video = '';
$tag   = '';
$category_id = '';
?>
@include('zuimei.layout.header')
@include('web.layout.toolbar')
@include('web.layout.leftbar')
		<section id="content">
          <section class="vbox">
            <section class="scrollable wrapper-lg">
              <div class="row">
                <div class="col-sm-9">
        		<div class="blog-post">
            	  <?php foreach ($records as $k => $v): ?>
            	  <?php 
            	    $title = $v->title;
            	    $image = $v->vimg;
            	    $video = $v->video;
            	    $tag = $v->tag;
            	    $category_id = $v->category_id;
            	  ?>
                  	<div class="post-item">
                  	<?php if (!$v->video): ?>
                        <?php if ($v->image): ?>
                        <div class="post-media">
                        <img src="<?= $v->image ?>" class="img-full">
                        </div>
                        <?php endif; ?>
                    <?php else:?>
                        <!-- video player -->
                        <div id="jp_container_1">
                          <div class="jp-type-single pos-rlt">
                            <div id="jplayer_1" class="jp-jplayer jp-video"></div>
                            <div class="jp-gui">
                              <div class="jp-video-play">
                                <a class="fa fa-5x text-white fa-play-circle"></a>
                              </div>
                              <div class="jp-interface bg-info padder">
                                <div class="jp-controls">
                                  <div>
                                    <a class="jp-play"><i class="icon-control-play i-2x"></i></a>
                                    <a class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
                                  </div>
                                  <div class="jp-progress">
                                    <div class="jp-seek-bar dker">
                                      <div class="jp-play-bar dk">
                                      </div>
                                      <div class="jp-title text-lt">
                                        <ul>
                                          <li></li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="hidden-xs hidden-sm jp-current-time text-xs text-muted"></div>
                                  <div class="hidden-xs hidden-sm jp-duration text-xs text-muted"></div>
                                  <div class="hidden-xs hidden-sm">
                                    <a class="jp-mute" title="mute"><i class="icon-volume-2"></i></a>
                                    <a class="jp-unmute hid" title="unmute"><i class="icon-volume-off"></i></a>
                                  </div>
                                  <div class="hidden-xs hidden-sm jp-volume">
                                    <div class="jp-volume-bar dk">
                                      <div class="jp-volume-bar-value lter"></div>
                                    </div>
                                  </div>
                                  <div>
                                    <a class="jp-full-screen" title="full screen"><i class="fa fa-expand"></i></a>
                                    <a class="jp-restore-screen" title="restore screen"><i class="fa fa-compress text-lt"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                            <div class="jp-no-solution hide">
                              <span>Update Required</span>
                              To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                            </div>
                          </div>
                        </div>
                        <!-- / video player -->
                    <?php endif;?>
        
                        <div class="caption wrapper-lg">
                          <h2 class="post-title"><a href="#"><?= $v->title ?></a></h2>
                        <div class="post-sum">
                          <p><?= $v->content ?></p>
                        </div>
                        
                        <div class="line line-lg"></div>
                        <div class="text-muted">
                          <i class="fa fa-clock-o icon-muted"></i> 
                          <?= BaseModel::humanTimeDiffFormat(strtotime($v->create_time)); ?>
                        </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                  </div>
                          
                  <div style="display:none;" class='row'>
                     	<input type="hidden" id="currentPage"  value="<?= $page ?>">
                     	<input type="hidden" id="rowsPerPage"  value="<?= $pageSize ?>">
                     	<input type="hidden" id="totalPages"   value="<?= $totalPages ?>">
                     	<input type="hidden" id="totalRows"    value="<?= $total ?>">
                     	<input type="hidden" id="requestUrl"   value="<?= url("web/index") ?>">
                     	<input type="hidden" id="categoryId"   value="<?= $category_id ?>">
                     	<input type="hidden" id="tag"   	   value="<?= $tag ?>">
						<input type="hidden" id="type"         value="<?= $outerParams['type'] ?>">
                     	<input type="hidden" id="tableColumns" value="<?= base64_encode(implode(',', $columns)) ?>">
                   </div>
                   
                    <div class="row">
                        <div class="col-sm-4 hidden-xs">
                         </div>
                        <div class="col-sm-4 text-right text-center-xs" id="id_pagination"></div>
                    </div>
                    
                  	<h4 class="m-t-lg m-b">Leave a comment</h4>
                    <!-- 来必力City版安装代码 -->
                    <div id="lv-container" data-id="city" data-uid="MTAyMC8yNzg4MS80NDU4">
                    	<script type="text/javascript">
                       (function(d, s) {
                           var j, e = d.getElementsByTagName(s)[0];
                    
                           if (typeof LivereTower === 'function') { return; }
                    
                           j = d.createElement(s);
                           j.src = 'https://cdn-city.livere.com/js/embed.dist.js';
                           j.async = true;
                    
                           e.parentNode.insertBefore(j, e);
                       })(document, 'script');
                    	</script>
                    </div>
                    <!-- City版安装代码已完成 -->
                </div>

                <div class="col-sm-3">
                  <h5 class="font-bold">分类</h5>
                  <ul class="list-group category-c">
                  </ul>
				  
				  <h5 class="font-bold">标签</h5>
                  <div class="tags m-b-lg l-h-2x tag-c">
                  </div>
                  
                  <h5 class="font-bold">最近文章</h5>
                  <div class='recent-art-c'>
                  </div>
                </div>
              </div>
            </section>
          </section>

          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
<script>
$(function(){
// video
$("#jplayer_1").jPlayer({
  ready: function () {
    $(this).jPlayer("setMedia", {
      title:  "<?= $title ?>",
      //m4v:  "http://flatfull.com/themes/assets/video/big_buck_bunny_trailer.m4v",
      //ogv:  "http://flatfull.com/themes/assets/video/big_buck_bunny_trailer.ogv",
      webmv:  "<?= $video ?>",
      poster: "<?= $image ?>"
    });
  },
  swfPath: "js",
  supplied: "webmv, ogv, m4v",
  size: {
    width: "100%",
    height: "auto",
    cssClass: "jp-video-360p"
  },
  globalVolume: true,
  smoothPlayBar: true,
  keyEnabled: true
});

// Category
var categoryParams = [];
categoryParams.push({"name":"category_id","value":"<?= $category_id ?>"});
$.ajax({
    "url": "<?= url("web/category") ?>",
    "type": "get",
    "data": categoryParams,
    "dataType" : "html",
    "error" : function (jqXHR, 
            textStatus, errorThrown) {
        console.log(jqXHR);
    },
    "success" : function (data) {
        $(".category-c").html(data);
    }
});

// Tag
var tagParams = [];
tagParams.push({"name":"tag","value":"<?= $tag ?>"});
$.ajax({
    "url": "<?= url("web/tag") ?>",
    "type": "get",
    "data": tagParams,
    "dataType" : "html",
    "error" : function (jqXHR, 
            textStatus, errorThrown) {
        console.log(jqXHR);
    },
    "success" : function (data) {
        $(".tag-c").html(data);
    }
});

// Recent Post
$.ajax({
    "url": "<?= url("web/recent") ?>",
    "type": "get",
    "dataType" : "html",
    "error" : function (jqXHR, 
            textStatus, errorThrown) {
        console.log(jqXHR);
    },
    "success" : function (data) {
        $(".recent-art-c").html(data);
    }
});

})
</script>
@include('web.layout.footer')
        