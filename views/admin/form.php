<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2><?= empty($_GET['id']) ? 'Admin Create' : 'Admin Edit' ?> </h2>
        <form method="POST" enctype="multipart/form-data" class="col-6">
            <?php if (isset($admin->id)) : ?>
                <div class="form-group">
                    <label>ID</label>: <?= $admin->id ?>
                </div>
            <?php endif ?>
            <div class="form-group">
                <label>Avatar *</label><br>
                <?php if (isset($admin->avatar)) : ?>
                    <img style="width: 100px;" src="<?= $admin->avatar ?>"><br>
                    <input type="hidden" name="old_avatar" value="<?= $admin->avatar ?>">
                <?php endif ?>
                <input type="file" class="form-control-file" name="avatar" <?= isset($admin->avatar) ? '' : 'required' ?> >
            </div>
            <div class="form-group">
                <label>Name *</label>
                <input type="text" class="form-control" name="name" value="<?= isset($admin->name) ? $admin->name : '' ?>" required>

            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" class="form-control" name="email" value="<?= isset($admin->email) ? $admin->email : '' ?>" required>
            </div>
            <div class="form-group ">
                <label>Password *</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group ">
                <label>Password Verify *</label>
                <input type="password" class="form-control" name="password_verify" required>
            </div>
            <div class="form-group ">
                <label>Role *</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role_type" value='1' <?= isset($admin->role_type) && $admin->role_type == 1 ? 'checked' : '' ?> required>
                    <label class="form-check-label"><?= $this->role_options["super admin"] ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role_type" value='2' <?= isset($admin->role_type) && $admin->role_type == 2 ? 'checked' : '' ?> required>
                    <label class="form-check-label"><?= $this->role_options["admin"] ?></label>
                </div>
            </div>
            <div class="row">
                <button type="reset" class="btn btn-secondary col-2">Reset</button>
                <div class="col-8"></div>
                <button type="submit" class="btn btn-primary col-2">Save</button>
            </div>
        </form>
    </div>
</div>