{extends file='layout.tpl'}
{block name="content"}
    <h1>Create Item</h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Create Item</h2>
                </div>
                <div class="card-body">
                    <form action="index.php?page=saveItem" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Item Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">-- Select Type --</option>
                                <option value="weapon">Weapon</option>
                                <option value="armor">Armor</option>
                                <option value="consumable">Consumable</option>
                                <option value="misc">Miscellaneous</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label">Value (in gold)</label>
                            <input type="number" class="form-control" id="value" name="value" step="0.01" min="0" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Create Item</button>
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}