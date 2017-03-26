<header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
  <?php if(isset($_COOKIE["leftBarOpen"]) && $_COOKIE["leftBarOpen"] == 'open'): ?>
  <div class="navbar-header aside bg-info">
  <?php else: ?>
  <div class="navbar-header aside bg-info nav-xs">
  <?php endif;?>
    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
      <i class="icon-list"></i>
    </a>
    <a href="<?= url('web/index') ?>" class="navbar-brand text-lt">
      <i class="icon-earphones"></i>
      <img src="/public/template/amazing/images/logo.png" alt="." class="hide">
      <span class="hidden-nav-xs m-l-sm">Musik</span></a>
    <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
      <i class="icon-settings"></i>
    </a>
  </div>
  <ul class="nav navbar-nav hidden-xs leftbar_switch">
    <li>
      <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
        <?php if(isset($_COOKIE["leftBarOpen"]) && $_COOKIE["leftBarOpen"] == 'open'): ?>
        <i class="fa fa-indent text-active"></i>
        <i class="fa fa-dedent text"></i>
        <?php elseif(isset($_COOKIE["leftBarOpen"]) && $_COOKIE["leftBarOpen"] == 'close'): ?>
        <i class="fa fa-indent text"></i>
        <i class="fa fa-dedent text-active"></i>
        <?php else: ?>
        <i class="fa fa-indent text"></i>
        <i class="fa fa-dedent text-active"></i>
        <?php endif; ?>
      </a>
    </li>
  </ul>
  <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-btn">
          <button type="submit" class="search_sbtn btn btn-sm bg-white btn-icon rounded">
            <i class="fa fa-search"></i>
          </button>
        </span>
        <input type="text" value="<?php if(!empty($queryParams['title'])) echo $queryParams['title']; ?>" class="search_input form-control input-sm no-border rounded" placeholder="Search title...">
       </div>
    </div>
  </form>
</header>