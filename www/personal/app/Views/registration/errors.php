<?php if ($validation->getError('login')): ?>
    <div class="invalid-feedback">
        <?= $validation->getError('login') ?>
    </div>
<?php endif; ?>

<?php if ($validation->getError('email')): ?>
    <div class="invalid-feedback">
        <?= $validation->getError('email') ?>
    </div>
<?php endif; ?>

<?php if ($validation->getError('pass')): ?>
    <div class="invalid-feedback">
        <?= $validation->getError('pass') ?>
    </div>
<?php endif; ?>

<?php if ($validation->getError('pass2')): ?>
    <div class="invalid-feedback">
        <?= $validation->getError('pass2') ?>
    </div>
<?php endif; ?>
