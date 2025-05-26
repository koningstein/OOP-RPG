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

                        <!-- Attack and Defense Bonus Fields -->
                        <div id="attackDefenseFields" style="display: none;">
                            <div class="mb-3">
                                <label for="attackBonus" class="form-label" id="attackLabel">Attack Bonus</label>
                                <input type="number" class="form-control" id="attackBonus" name="attackBonus" min="0" value="0">
                            </div>
                            <div class="mb-3">
                                <label for="defenseBonus" class="form-label" id="defenseLabel">Defense Bonus</label>
                                <input type="number" class="form-control" id="defenseBonus" name="defenseBonus" min="0" value="0">
                            </div>
                        </div>

                        <!-- Health Bonus Field -->
                        <div id="healthField" style="display: none;">
                            <div class="mb-3">
                                <label for="healthBonus" class="form-label">Health Bonus</label>
                                <input type="number" class="form-control" id="healthBonus" name="healthBonus" min="0" value="0">
                            </div>
                        </div>

                        <!-- Special Effect Field -->
                        <div id="specialEffectField" style="display: none;">
                            <div class="mb-3">
                                <label for="specialEffect" class="form-label">Special Effect</label>
                                <input type="text" class="form-control" id="specialEffect" name="specialEffect">
                            </div>
                        </div>

                        <!-- Miscellaneous Note -->
                        <div id="miscNote" class="alert alert-warning" style="display: none;">
                            Mystery item - effects unknown.
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

    <script>
        function toggleItemFields() {
            var type = document.getElementById('type').value;

            // Attack and Defense bonus for weapon, armor, and consumable
            document.getElementById('attackDefenseFields').style.display =
                (type === 'weapon' || type === 'armor' || type === 'consumable') ? 'block' : 'none';

            // Health bonus only for consumable
            document.getElementById('healthField').style.display =
                (type === 'consumable') ? 'block' : 'none';

            // Special effect only for consumable
            document.getElementById('specialEffectField').style.display =
                (type === 'consumable') ? 'block' : 'none';

            // Misc warning
            document.getElementById('miscNote').style.display =
                (type === 'misc') ? 'block' : 'none';

            // Update labels based on type
            if (type === 'consumable') {
                document.getElementById('attackLabel').textContent = 'Temporary Attack Boost';
                document.getElementById('defenseLabel').textContent = 'Temporary Defense Boost';
            } else {
                document.getElementById('attackLabel').textContent = 'Attack Bonus';
                document.getElementById('defenseLabel').textContent = 'Defense Bonus';
            }
        }

        document.getElementById('type').addEventListener('change', toggleItemFields);
        toggleItemFields(); // Initial call
    </script>
{/block}