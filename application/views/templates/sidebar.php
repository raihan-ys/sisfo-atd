<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: dodgerblue">

  <!-- Logo -->
  <a target="_blank" title="Website resmi Sisfo ATD" href="https://sisfo.amiktridharmapku.ac.id" class="brand-link">
    <img src="<?= base_url('assets/images/atd-logo.png') ?>" width="60" alt="Logo ATD" class="img-circle elevation-3">
    <span class="font-weight-bold text-white">&nbsp Sisfo ATD</span>
  </a>

  <div class="sidebar">

    <!-- user panel -->
    <?php if ($current_user == true) : ?>
    <a href="<?= site_url('admin/setting') ?>" title="Aministrator's Settings">
      <div class="user-panel mt-3 pb-3 mb-2 d-flex">

        <!-- user avatar -->
        <div class="image">
          <img class="img-circle elevation-2 avatar-preview" width="50" src="<?= $current_user->avatar ? base_url('uploads/user-avatar/'.$current_user->avatar) : base_url('assets/images/user.png') ?>" alt="<?= htmlentities($current_user->name, true) ?>">
        </div>

        <!-- username --> 
        <div class="text-white info">
          <b><?= htmlentities($current_user->name) ?></b><br>  
          <small>
            <i class="nav-icon fas fa-envelope"></i> <?= htmlentities($current_user->email) ?>
          </small>
        </div>

      </div>
    </a>
    <?php endif ?>

    <!-- sidebar menu -->
    <nav class="mt-2">

      <!-- data accordion -->
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        
        <!-- guest-only items -->
        <?php if ($current_user == false) : ?>
          
        <!-- e-campus menu -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon text-white fas fa-school"></i>
            <p class="font-weight-bold">E-Campus <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview bg-primary">

            <!-- file download -->
            <li class="nav-item">
              <a class="nav-link" title="Materi perkuliahan yang dapat di-unduh" href="#">
                <i class="nav-icon fas fa-file text-white"></i>
                <p>Download File</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- /.e-campus menu -->

        <!-- pendaftaran menu -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <img class="nav-icon" src="<?= base_url('assets/images/googleforms-logo.png') ?>" alt="Google form logo">
            <p class="font-weight-bold">Pendaftaran <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview bg-primary">
            <!-- mahasiswa -->
            <li class="nav-item">
              <a class="nav-link" title="Pendaftaran mahasiswa melalui google form" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSdn3tOMHIv-w5n1kJUpN-kKRlIPF1BYcebEdg97A0XjiApbyQ/viewform?pli=1">
                <i class="nav-icon fas fa-circle" style="font-size: 10px;"></i>
                <p>Mahasiswa Baru</p>
              </a>
            </li>
            <!-- marketer -->
            <li class="nav-item">
              <a class="nav-link" title="Pendaftaran affiliate marketer melalui google form" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSeonJjeVBB7or82wdfwFF-DyjvfMkSAlaPCrEe5F0_3LSqYaA/viewform?usp=send_form">
                <i class="nav-icon fas fa-circle" style="font-size: 10px;"></i>
                <p>Affiliate Marketer</p> 
              </a>
            </li>
            <!-- dosen -->
            <li class="nav-item">
              <a class="nav-link" title="Pendaftaran dosen melalui google form" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSd13nSYiRV5QwsdEgPXVh7OLBSOzy0X1iWpqz3yaz6o0g1r1g/closedform">
                <i class="fas fa-circle nav-icon" style="font-size: 10px;"></i>
                <p>Lowongan Dosen</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- /.pendaftaran -->
        <?php endif ?>
        <!-- /.guest-only items -->

        <!-- admin-only items -->
        <?php if($current_user == true) : ?>
        
        <!-- dashboard -->
        <li class="nav-item">
          <a class="nav-link <?php if ($meta['title'] === 'Dashboard') echo 'active'?>" title="Admin's dashboard" href="<?= site_url('admin/dashboard') ?>">
            <i class="nav-icon text-white fas fa-desktop"></i>
            <p class="font-weight-bold">Dashboard</p>
          </a>
        </li>

        <!-- mahasiswa menu -->
        <li class="nav-item <?php if ($meta['title'] === 'Mahasiswa') echo 'menu-open' ?>">
          <a class="nav-link <?php if ($meta['title'] === 'Mahasiswa') echo 'active' ?>" title="Student's menu" href="#">
            <i class="nav-icon text-white fas fa-users"></i>
            <p class="font-weight-bold">Mahasiswa <i class="right fas fa-angle-left"></i></p>
                
            <!-- flashdata -->
            <?php if ($this->session->flashdata('mahasiswa_saved')) : ?>
            <br>
            <b class="text-lime">
              <i class="fas fa-check"></i> 
              <?= $this->session->flashdata('mahasiswa_saved') ?>
            </b>

            <?php elseif ($this->session->flashdata('mahasiswa_updated')) : ?>
            <br>
            <b class="text-lime">
              <i class="fas fa-pen"></i>
              <?= $this->session->flashdata('mahasiswa_updated') ?>
            </b>

            <?php elseif ($this->session->flashdata('mahasiswa_deleted')) : ?>
            <br>
            <b class="text-lime">
              <i class="fas fa-trash"></i>
              <?= $this->session->flashdata('mahasiswa_deleted') ?>
            </b>

            <?php elseif ($this->session->flashdata('mahasiswa_truncated')) : ?> 
            <br>
            <b class="text-lime">
              <i class="fas fa-fire"></i> 
              <?= $this->session->flashdata('mahasiswa_truncated') ?>
            </b>
            <?php endif ?>
            <!-- /.flashdata -->

          </a>

          <ul class="nav nav-treeview bg-info">

            <!-- list -->
            <li class="nav-item">
              <a title="Students List" href="<?= site_url('admin/akademik/mahasiswa') ?>" class="nav-link">
                <i class="nav-icon text-white fas fa-table"></i>
                <p>Daftar Mahasiswa</p>
              </a>
            </li>
                    
            <!-- add -->
            <li class="nav-item">
              <a title="Add new Student" href="<?= base_url('admin/akademik/mahasiswa/add') ?>" class="nav-link">
                <i class="nav-icon text-white fas fa-plus"></i>
                <p>Tambah Data</p>
              </a>
            </li>
            
          </ul>
        </li>
        <!-- /.mahasiswa menu -->

        <!-- post menu -->
        <li class="nav-item <?php if ($meta['title'] === 'Posts') echo 'menu-open' ?>">

          <a class="nav-link <?php if ($meta['title'] === 'Posts') echo 'active' ?>" title="Manage our articles" href="#">
            <i class="nav-icon text-white fa fa-object-group"></i>
            <p class="font-weight-bold">Posts <i class="right fas fa-angle-left"></i></p>

            <!-- flashdata -->
            <?php if ($this->session->flashdata('post_saved')) : ?>
            
            <br>
            <b class="text-lime">
              <i class="fas fa-check"></i> 
              <?= $this->session->flashdata('post_saved') ?>
            </b>

            <?php elseif ($this->session->flashdata('post_updated')) : ?>
            <br>
            <b class="text-lime">
              <i class="fas fa-pen"></i>
              <?= $this->session->flashdata('post_updated') ?>
            </b>

            <?php elseif ($this->session->flashdata('post_deleted')) : ?>
            <br>
            <b class="text-lime">
              <i class="fas fa-trash"></i>
              <?= $this->session->flashdata('post_deleted') ?>
            </b>

            <?php elseif ($this->session->flashdata('post_truncated')) : ?> 
            <br>
            <b class="text-lime">
              <i class="fas fa-fire"></i> 
              <?= $this->session->flashdata('post_truncated') ?>
            </b>
            <?php endif ?>
            <!-- /.flashdata -->
          </a>

          <ul class="nav nav-treeview bg-info">

            <!-- post list -->
            <li class="nav-item">
              <a class="nav-link" title="View our created articles" href="<?= site_url('admin/akademik/post') ?>">
                <i class="nav-icon text-white fas fa-list"></i>
                <p>Post List</p>
              </a>
            </li>

            <!-- post add -->
            <li class="nav-item">
              <a class="nav-link" title="Create new article" href="<?= base_url('admin/akademik/post/add') ?>">
                <i class="nav-icon text-white fas fa-edit"></i>
                <p>Create Post</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- /.post menu -->

        <!-- payroll menu -->
        <li class="nav-item <?php if ($meta['title'] === 'Jabatan' || $meta['title'] === 'Karyawan' ||  $meta['title'] === 'Penggajian') echo 'menu-open' ?>">
          <a class="nav-link <?php if ($meta['title'] === 'Jabatan' || $meta['title'] === 'Karyawan' ||  $meta['title'] === 'Penggajian') echo 'active' ?>"  title="Payroll System" href="#">
            <i class="nav-icon text-white fas fa-database"></i>
            <p class="font-weight-bold">Payroll <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview bg-info">
            <!-- jabatan -->
            <li class="nav-item">
              <a class="nav-link" title="Jabatan di ATD" href="<?= site_url('admin/payroll/jabatan') ?>">
                <i class="nav-icon text-white fas fa-laptop"></i>
                <p>Jabatan</p>
              </a>
            </li>
            <!-- karyawan -->
            <li class="nav-item">
              <a class="nav-link" title="Data SDM" href="<?= site_url('admin/payroll/karyawan') ?>">
                <p>🧑🏻‍💼 Karyawan</p>
              </a>
            </li>
            <!-- Penggajian -->
            <li class="nav-item">
              <a class="nav-link" title="Payroll" href="<?= site_url('admin/payroll/gaji') ?>">
                <p>💸 Penggajian (Coming soon)</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- /.payroll menu -->

        <!-- feedback -->
        <li class="nav-item">
          <a class="nav-link <?php if ($meta['title'] === 'Feedback') echo 'active' ?>" title="See messages" href="<?= site_url('admin/akademik/feedback') ?>">
            <i class="nav-icon text-white fas fa-comments"></i>
            <p class="font-weight-bold">Feedbacks</p>
            <!-- flashdata -->
            <?php if ($this->session->flashdata('feedback_deleted')) : ?>
            <br>
            <b class="text-lime">
              <i class="fas fa-trash"></i> 
              <?= $this->session->flashdata('feedback_deleted') ?>
            </b>
            <?php elseif ($this->session->flashdata('feedback_truncated')) : ?> 
            <br>
            <b class="text-lime">
              <i class="fas fa-fire"></i> 
              <?= $this->session->flashdata('feedback_truncated') ?>
            </b>
            <?php endif ?>
          </a>
        </li>
        <!-- /.feedback -->

        <!-- logout -->
        <li class="nav-item">
          <a class="nav-link" title="You have to login again if you logout!" href="<?= base_url('auth/logout') ?>" onclick="return confirm('⚠ Anda yakin ingin logout?')">
            <i class="text-danger nav-icon fas fa-power-off"></i>
            <p class="text-danger font-weight-bold">Logout</p>
          </a>
        </li>
        <?php endif ?>
        <!-- /.admin-only items -->
      </ul>
      <!-- /.data accordion -->
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar container -->
</aside>
 