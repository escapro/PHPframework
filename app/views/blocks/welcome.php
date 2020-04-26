<h1><?= $title; ?></h1>
<br>
<hr>
<?php
    echo $page_title;
    echo "<br>";
?>
<form action="/post" method="POST">
    <input type="input" name="q">
    <?= csrf_field(); ?>
    <input type="submit">
</form>
<br>
<hr>