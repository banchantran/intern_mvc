<div class="py-4">
    <div class="border border-primary">
        <form method="GET" class="p-4">
            <input type="hidden" name="controller" value="admin">
            <input type="hidden" name="action" value="search_user">
            <div class="form-group pb-3 col-6">
                <label>Email *</label>
                <input type="email" class="form-control " name="email" required>
            </div>
            <div class="form-group pb-3 col-6">
                <label>Name *</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="row">
                <button type="reset" class="btn btn-secondary col-1">Reset</button>
                <div class="col-10"></div>
                <button type="search" class="btn btn-primary col-1">Search</button>
            </div>
        </form>
    </div>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Avatar</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) :
            ?>
                <?php foreach ($data as $value) : ?>
                    <tr>
                        <th scope="row"><?= $value->id ?></th>
                        <td>
                            <img style="width: 50px;" src="<?= $value->avatar; ?>">
                        </td>
                        <td><?= $value->name ?></td>
                        <td><?= $value->email ?></td>
                        <td><?= $value->status == 1 ? 'Active' : 'Banned' ?></td>
                        <td>
                            <a href="/?controller=admin&action=create&id=<?= $value->id; ?>">Edit</a><br>
                            <a onclick="return Del('<?= $value->name; ?>')" href="/?controller=admin&action=delete_user&id=<?= $value->id; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td>No results found</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>