<nav class="main-header navbar navbar-expand" style="background: crimson">

  <!-- left navbar links -->
  <ul class="navbar-nav">

    <!-- pushmenu button -->
    <li>
      <a class="nav-link text-white" id="btn-sidebar" role="button" title="show or hide the sidebar's content" data-widget="pushmenu" href="#">
        <i class="fas fa-bars"></i>
      </a>
    </li>

    <!-- home button -->
    <li>
      <a class="nav-btn nav-link text-white font-weight-bold" role="button" title="Go to homepage" href="<?= site_url() ?>">
        <i class="fas fa-home"></i> Home
      </a>
    </li>

    <!-- article button -->
    <li>
      <a class="nav-btn nav-link text-white font-weight-bold" role="button" title="See our published articles" href="<?= site_url('article') ?>">
        <i class="fas fa-book"></i> Artikel
      </a>
    </li>

    <!-- calculator button -->
    <li>
      <a class="nav-btn nav-link text-white font-weight-bold" role="button" title="My Calculator!" href="<?= site_url('page/calculator') ?>">
        <i class="fas fa-calculator"></i> Calculator
      </a>
    </li>

    <!-- contact button -->
    <li>
      <a class="nav-btn nav-link text-white font-weight-bold" role="button" title="Send a message to us!" href="<?= site_url('page/contact') ?>">
        <i class="fas fa-comment text-teal"></i> Contact
      </a>
    </li>
    
  </ul>
  <!-- /. Left navbar links -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- login button -->
    <?php if ($current_user === false) : ?>
      <?php if ($title !== 'Login') : ?>
        <li>
          <a class="nav-link btn bg-lime font-weight-bold" role="button" title="Login if you're an administrator" href="<?= site_url('auth/login') ?>">
            <i class="fas fa-key"></i> Login
          </a>
        </li>
        &nbsp &nbsp
        <?php endif ?>
      <?php endif ?>

    <!-- background video button -->
    <li>
      <button class="btn btn-info img-circle" id="btn-background" title="Play or pause the video at the background">
        <i class="fas fa-pause"></i>
      </button>
    </li>&nbsp
  </ul>
  <!-- /. Right navbar links -->

</nav>
