{extends file='layout.tpl'}
{block name="content"}
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Update Item
            </div>
            <div class="card-body">
                <form action="index.php?page=saveItemUpdate" method="POST">
                    <input type="hidden" name="id" value="{$item->getId()}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{$item->getName()}" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="weapon" {if $item->getType() == 'weapon'}selected{/if}>Weapon</option>
                            <option value="armor" {if $item->getType() == 'armor'}selected{/if}>Armor</option>
                            <option value="consumable" {if $item->getType() == 'consumable'}selected{/if}>Consumable</option>
                            <option value="misc" {if $item->getType() == 'misc'}selected{/if}>Misc</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input type="number" class="form-control" id="value" name="value" step="0.01" min="0" value="{$item->getValue()}" required>
                    </div>

                    {if $item->getType() == 'weapon' || $item->getType() == 'armor' || $item->getType() == 'consumable'}
                        <div class="mb-3">
                            <label for="attackBonus" class="form-label">
                                {if $item->getType() == 'consumable'}Temporary Attack Boost{else}Attack Bonus{/if}
                            </label>
                            <input type="number" class="form-control" name="attackBonus" value="{$item->getAttackBonus()}" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="defenseBonus" class="form-label">
                                {if $item->getType() == 'consumable'}Temporary Defense Boost{else}Defense Bonus{/if}
                            </label>
                            <input type="number" class="form-control" name="defenseBonus" value="{$item->getDefenseBonus()}" min="0">
                        </div>
                    {/if}

                    {if $item->getType() == 'consumable'}
                        <div class="mb-3">
                            <label for="healthBonus" class="form-label">Health Bonus</label>
                            <input type="number" class="form-control" name="healthBonus" value="{$item->getHealthBonus()}" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="specialEffect" class="form-label">Special Effect</label>
                            <input type="text" class="form-control" name="specialEffect" value="{$item->getSpecialEffect()}">
                        </div>
                    {/if}

                    {if $item->getType() == 'misc'}
                        <div class="alert alert-warning">
                            <strong>Mystery Item:</strong> Effects are random and cannot be edited. Only name, type and value can be changed.
                        </div>
                    {/if}

                    <button type="submit" class="btn btn-primary">Update Item</button>
                    <a href="index.php?page=listItems" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
{/block}