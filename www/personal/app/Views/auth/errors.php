<?php if ($validation->getError('login')): ?>
    <div class="invalid-feedback">
        <?= $validation->getError('login') ?>
    </div>
<?php endif; ?>

<?php if ($validation->getError('pass')): ?>
    <div class="invalid-feedback">
        <?= $validation->getError('pass') ?>
    </div>
<?php endif; ?>
