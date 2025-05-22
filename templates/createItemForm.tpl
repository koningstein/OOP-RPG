{extends file='layout.tpl'}
{block name="content"}
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Create Item
        </div>
        <div class="card-body">
            <form action="index.php?page=saveItem" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="weapon">Weapon</option>
                        <option value="armor">Armor</option>
                        <option value="consumable">Consumable</option>
                        <option value="misc">Misc</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="value" class="form-label">Value</label>
                    <input type="number" class="form-control" id="value" name="value" step="0.01" min="0" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Item</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
{/block}