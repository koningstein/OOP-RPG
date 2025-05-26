{extends file='layout.tpl'}
{block name="content"}
    <div class="container mt-5">
        <h1>Item List</h1>

        <!-- Filter Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2>Filters</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php">
                    <input type="hidden" name="page" value="listItems">
                    {if $filters.type}
                        <input type="hidden" name="type" value="{$filters.type}">
                    {/if}
                    <div class="mb-3">
                        <label for="id" class="form-label">Item ID</label>
                        <input type="number" class="form-control" id="id" name="id" value="{$filters.id|default:''}" placeholder="Exact ID">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{$filters.name|default:''}" placeholder="Partial Name">
                    </div>
                    <div class="mb-3">
                        <label for="minValue" class="form-label">Minimum Value</label>
                        <input type="number" class="form-control" id="minValue" name="minValue" value="{$filters.minValue|default:''}" placeholder="Minimum Value">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="index.php?page=listItems" class="btn btn-secondary">Clear All Filters</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Type Filter Buttons -->
        <div class="mb-4">
            <a href="index.php?page=listItems" class="btn btn-outline-primary {if !$filters.type}active{/if}">All Items</a>
            <a href="index.php?page=listItems&type=weapon" class="btn btn-outline-primary {if $filters.type == 'weapon'}active{/if}">Weapons</a>
            <a href="index.php?page=listItems&type=armor" class="btn btn-outline-primary {if $filters.type == 'armor'}active{/if}">Armor</a>
            <a href="index.php?page=listItems&type=consumable" class="btn btn-outline-primary {if $filters.type == 'consumable'}active{/if}">Consumables</a>
            <a href="index.php?page=listItems&type=misc" class="btn btn-outline-primary {if $filters.type == 'misc'}active{/if}">Misc</a>
        </div>

        <!-- Active Filters Header -->
        <div class="mb-4">
            <h3>
                {if $filters.type}

                {else}
                    Showing All Items
                {/if}
            </h3>
            <div>
                {if $filters.id}
                    <span class="badge bg-info">ID: {$filters.id}</span>
                {/if}
                {if $filters.name}
                    <span class="badge bg-info">Name: "{$filters.name}"</span>
                {/if}
                {if $filters.minValue}
                    <span class="badge bg-info">Min Value: {$filters.minValue}</span>
                {/if}
            </div>
        </div>

        <!-- Item List Table -->
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
        <p class="mt-3">Total Items: {$items|@count}</p>
    </div>
{/block}