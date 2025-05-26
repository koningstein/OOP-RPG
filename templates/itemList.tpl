{extends file='layout.tpl'}
{block name="content"}
<div class="container mt-5">
    <h1>Item List</h1>
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
    <div class="mt-3">
        <a href="index.php?page=createItem" class="btn btn-primary">Create New Item</a>
    </div>
    <p class="mt-3">Total Items: {$items|@count}</p>
</div>
{/block}