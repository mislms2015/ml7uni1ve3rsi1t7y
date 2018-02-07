<?php
use yii\widgets\Breadcrumbs;
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->

<section class="content-header">
<h1>
<?php // echo $this->title ?>
<?php // echo $this->title = 'My App' ?>
<!-- small> Description </small -->
</h1>
<?= Breadcrumbs::widget([
'links'=>isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ])
?>
</section>

<!-- Main content -->
<section class="content">
<?= $content?>
</section> <!-- /.content -->
</div> <!-- /.content-wrapper -->