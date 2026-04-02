<?php
/** @var Throwable $exception */
$this->title = 'Error';
?>
<div class="site-error">
    <h1><?= htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8') ?></h1>
    <p><?= htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8') ?></p>
</div>
