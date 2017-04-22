<header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
  <?php if(isset($_COOKIE["leftBarOpen"]) && $_COOKIE["leftBarOpen"] == 'open'): ?>
  <div class="navbar-header aside bg-info">
  <?php else: ?>
  <div class="navbar-header aside bg-info nav-xs">
  <?php endif;?>
    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
      <i class="icon-list"></i>
    </a>
    <a href="index.html" class="navbar-brand text-lt">
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
          <button type="submit" class="btn btn-sm bg-white btn-icon rounded">
            <i class="fa fa-search"></i>
          </button>
        </span>
        <input type="text" class="form-control input-sm no-border rounded" placeholder="Search songs, albums..."></div>
    </div>
  </form>
  <div class="navbar-right ">
    <ul class="nav navbar-nav m-n hidden-xs nav-user user">
      <li class="hidden-xs">
        <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">
          <i class="icon-bell"></i>
          <span class="badge badge-sm up bg-danger count">2</span></a>
        <section class="dropdown-menu aside-xl animated fadeInUp">
          <section class="panel bg-white">
            <div class="panel-heading b-light bg-light">
              <strong>You have
                <span class="count">2</span>notifications</strong></div>
            <div class="list-group list-group-alt">
              <a href="#" class="media list-group-item">
                <span class="pull-left thumb-sm">
                  <img src="/public/template/amazing/images/a0.png" alt="..." class="img-circle"></span>
                <span class="media-body block m-b-none">Use awesome animate.css
                  <br>
                  <small class="text-muted">10 minutes ago</small></span>
              </a>
              <a href="#" class="media list-group-item">
                <span class="media-body block m-b-none">1.0 initial released
                  <br>
                  <small class="text-muted">1 hour ago</small></span>
              </a>
            </div>
            <div class="panel-footer text-sm">
              <a href="#" class="pull-right">
                <i class="fa fa-cog"></i>
              </a>
              <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a></div>
          </section>
        </section>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
          <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
            <img src="/public/template/amazing/images/a0.png" alt="..."></span>John.Smith
          <b class="caret"></b></a>
        <ul class="dropdown-menu animated fadeInRight">
          <li>
            <span class="arrow top"></span>
            <a href="#">Settings</a></li>
          <li>
            <a href="profile.html">Profile</a></li>
          <li>
            <a href="#">
              <span class="badge bg-danger pull-right">3</span>Notifications</a></li>
          <li>
            <a href="docs.html">Help</a></li>
          <li class="divider"></li>
          <li>
            <a href="<?= url('admin/logout') ?>">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</header>