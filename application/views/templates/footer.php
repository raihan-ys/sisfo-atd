<footer class="main-footer" style="background-color: purple; <?php if ($current_user == true) echo 'text-align: center' ?>">
  <?php if ($current_user == FALSE) : ?>
  <font color="white">Developed with ❤ by </font>
  <a target="_blank" title="Website resmi ATD" href="https://amiktridharmapku.ac.id">
    <b class="text-white">AMIK "TRI DHARMA"</b>
  </a>
  <div class="float-right d-none d-sm-inline-block">
    <font color="white">Powered by </font>
    <a target="_blank" title="Website resmi ATD" href="https://institutazzuhra.ac.id/">
      <b class="text-white">AZ-ZUHRA GROUP</b>
    </a>
  </div>
  <?php else : ?>
  <font color="white">
    &copy; <?= date('Y') ?> <b>Sisfo ATD v.1.0.0</b>
  </font>
  <?php endif ?>
</footer>

<!-- jQuery -->
<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
<!-- Custom JS -->
<script src="<?= base_url('js/javascript.js') ?>"></script>
<!-- AdminLTE app -->
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js') ?>"></script>
