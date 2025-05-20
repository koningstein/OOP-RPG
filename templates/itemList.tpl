{extends file='layout.tpl'}
{block name="content"}
    <h1>Item List</h1>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h3>Filter Items</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Filter by Type:</h4>
                    <div class="btn-group mb-3" role="group">
                        <a href="index.php?page=listItems" class="btn btn-outline-primary {if !isset($selectedType)}active{/if}">All Items</a>
                        <a href="index.php?page=listItemsByType&type=weapon" class="btn btn-outline-primary {if $selectedType == 'weapon'}active{/if}">Weapons</a>
                        <a href="index.php?page=listItemsByType&type=armor" class="btn btn-outline-primary {if $selectedType == 'armor'}active{/if}">Armor</a>
                        <a href="index.php?page=listItemsByType&type=consumable" class="btn btn-outline-primary {if $selectedType == 'consumable'}active{/if}">Consumables</a>
                        <a href="index.php?page=listItemsByType&type=misc" class="btn btn-outline-primary {if $selectedType == 'misc'}active{/if}">Misc</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Filter by Value:</h4>
                    <form action="index.php" method="GET" class="form-inline mb-3">
                        <input type="hidden" name="page" value="listExpensiveItems">
                        <div class="input-group">
                            <span class="input-group-text">Min Value:</span>
                            <input type="number" name="minValue" class="form-control" min="0" step="0.01" value="{$minValue|default:0}" required>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Items List -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2>
                {if isset($selectedType)}
                    {$selectedType|capitalize} Items
                {elseif isset($minValue)}
                    Items Worth {$minValue} Gold or More
                {else}
                    All Items
                {/if}
            </h2>
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
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$items item=item}
                        <tr>
                            <td>{$item->getId()}</td>
                            <td>{$item->getName()}</td>
                            <td>{$item->getType()}</td>
                            <td>{$item->getValue()} gold</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
                <p class="mt-3">Total items displayed: <strong>{count($items)}</strong></p>
            {/if}
        </div>
        <div class="card-footer">
            <a href="index.php?page=createItem" class="btn btn-primary">Create New Item</a>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
{/block}