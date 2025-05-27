{extends file='layout.tpl'}
{block name="content"}
    <h1>Item List</h1>

    <!-- Combined Filter Section -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h3>Filter Items</h3>
        </div>
        <div class="card-body">
            <!-- Type Filter Buttons -->
            <div class="mb-4">
                <h4>Filter by Type:</h4>
                <div class="btn-group" role="group">
                    <a href="index.php?page=listItems{if isset($minValue)}&minValue={$minValue}{/if}{if isset($selectedId)}&id={$selectedId}{/if}{if isset($searchName)}&name={$searchName}{/if}" class="btn btn-outline-primary {if !isset($selectedType)}active{/if}">All Items</a>
                    <a href="index.php?page=listItems&type=weapon{if isset($minValue)}&minValue={$minValue}{/if}{if isset($selectedId)}&id={$selectedId}{/if}{if isset($searchName)}&name={$searchName}{/if}" class="btn btn-outline-primary {if $selectedType == 'weapon'}active{/if}">Weapons</a>
                    <a href="index.php?page=listItems&type=armor{if isset($minValue)}&minValue={$minValue}{/if}{if isset($selectedId)}&id={$selectedId}{/if}{if isset($searchName)}&name={$searchName}{/if}" class="btn btn-outline-primary {if $selectedType == 'armor'}active{/if}">Armor</a>
                    <a href="index.php?page=listItems&type=consumable{if isset($minValue)}&minValue={$minValue}{/if}{if isset($selectedId)}&id={$selectedId}{/if}{if isset($searchName)}&name={$searchName}{/if}" class="btn btn-outline-primary {if $selectedType == 'consumable'}active{/if}">Consumables</a>
                    <a href="index.php?page=listItems&type=misc{if isset($minValue)}&minValue={$minValue}{/if}{if isset($selectedId)}&id={$selectedId}{/if}{if isset($searchName)}&name={$searchName}{/if}" class="btn btn-outline-primary {if $selectedType == 'misc'}active{/if}">Misc</a>
                </div>
            </div>

            <!-- Other Filters Form -->
            <form action="index.php" method="GET">
                <input type="hidden" name="page" value="listItems">
                {if isset($selectedType)}
                    <input type="hidden" name="type" value="{$selectedType}">
                {/if}

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="minValue" class="form-label">Minimum Value:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="minValue" name="minValue" min="0" step="0.01" value="{$minValue|default:''}">
                            <span class="input-group-text">gold</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="id" class="form-label">Item ID:</label>
                        <input type="number" class="form-control" id="id" name="id" min="1" value="{$selectedId|default:''}">
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name Contains:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{$searchName|default:''}">
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="index.php?page=listItems" class="btn btn-secondary">Clear All Filters</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Items List -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2>
                {if isset($selectedType) || isset($minValue) || isset($selectedId) || isset($searchName)}
                    Filtered Items
                {else}
                    All Items
                {/if}
            </h2>
            {if isset($selectedType) || isset($minValue) || isset($selectedId) || isset($searchName)}
                <div class="mt-2 text-white">
                    <small>
                        Filters applied:
                        {if isset($selectedType)}<span class="badge bg-info">Type: {$selectedType}</span>{/if}
                        {if isset($minValue)}<span class="badge bg-info">Min Value: {$minValue} gold</span>{/if}
                        {if isset($selectedId)}<span class="badge bg-info">ID: {$selectedId}</span>{/if}
                        {if isset($searchName)}<span class="badge bg-info">Name: "{$searchName}"</span>{/if}
                    </small>
                </div>
            {/if}
        </div>
        <div class="card-body">
            {if empty($items)}
                <div class="alert alert-info">
                    No items found matching your criteria.
                </div>
            {else}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Effects</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        {foreach from=$items item=item}
                            <tr>
                                <td>{$item->getId()}</td>
                                <td>{$item->getName()}</td>
                                <td>{$item->getType()}</td>
                                <td>{$item->getValue()} gold</td>
                                <td>
                                    {if $item->getType() == 'weapon'}
                                        {if $item->getAttackBonus() > 0}Attack +{$item->getAttackBonus()}{/if}
                                        {if $item->getDefenceBonus() > 0}, Defense +{$item->getDefenceBonus()}{/if}
                                    {elseif $item->getType() == 'armor'}
                                        {if $item->getDefenceBonus() > 0}Defense +{$item->getDefenceBonus()}{/if}
                                        {if $item->getAttackBonus() > 0}, Attack +{$item->getAttackBonus()}{/if}
                                    {elseif $item->getType() == 'consumable'}
                                        {if $item->getAttackBonus() > 0}Attack +{$item->getAttackBonus()}{/if}
                                        {if $item->getDefenceBonus() > 0}, Defense +{$item->getDefenceBonus()}{/if}
                                        {if $item->getHealthBonus() > 0}, Health +{$item->getHealthBonus()}{/if}
                                        {if $item->getSpecialEffect() != ''}, Special: {$item->getSpecialEffect()}{/if}
                                    {elseif $item->getType() == 'misc'}
                                        Mystery Item ?
                                    {/if}
                                </td>
                                <td>
                                    <a href="index.php?page=updateItem&id={$item->getId()}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="index.php?page=deleteItem&id={$item->getId()}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        {/foreach}

                    </tbody>
                </table>
                <p class="mt-3">Total items displayed: <strong>{$itemCount|default:count($items)}</strong></p>
            {/if}
        </div>
        <div class="card-footer">
            <a href="index.php?page=createItem" class="btn btn-primary">Create New Item</a>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
{/block}