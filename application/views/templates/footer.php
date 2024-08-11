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

<!-- JavaScript -->
<script src="<?= base_url('js/javascript.js') ?>"></script>
<script src="<?= base_url('js/calculator.js') ?>"></script>
<!-- jQuery -->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
