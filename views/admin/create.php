<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Admin Create</h2>
        <?php var_dump($admin)?>
        <form method="POST" enctype="multipart/form-data" class="col-6">
            <div class="form-group">
                <label>Avatar *</label>
                <input type="file" class="form-control-file" name="avatar"  required>
            </div>
            <div class="form-group">
                <label>Name *</label>
                <input type="text" class="form-control" name="name" value="<?= $admin[0]->name?>" required>

            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" class="form-control" name="email" required>
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
                    <input class="form-check-input" type="radio" name="role_type" value=1 required>
                    <label class="form-check-label"><?= $this->role_options["super admin"]?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role_type" value=2 accept="" required>
                    <label class="form-check-label"><?= $this->role_options["admin"]?></label>
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