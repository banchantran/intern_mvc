<h1>Hello home user</h1>

<a href="/?controller=user&action=logout">Logout</a>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>My profile</h2>
        <form method="POST" enctype="multipart/form-data" class="col-6">

            <div class="form-group">
                <label>ID</label>: <?= isset($user->id) ? $user->id : '' ?>
            </div>

            <div class="form-group">
                <label>Avatar *</label><br>
                <img style="width: 100px;" src="<?= $user->avatar ?>"><br>
            </div>
            <div class="form-group">
                <label>Name *</label>
                <input type="text" class="form-control" name="name" value="<?= isset($user->name) ? $user->name : '' ?>" required>

            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" class="form-control" name="email" value="<?= isset($user->email) ? $user->email : '' ?>" required>
            </div>
        </form>
    </div>
</div>