{extends file='layout.tpl'}
{block name="content"}
    <h1>Item List</h1>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2>All Items</h2>
        </div>
        <div class="card-body">
            {if empty($items)}
                <div class="alert alert-info">
                    No items found in the database.
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
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
                <p class="mt-3">Total items: <strong>{count($items)}</strong></p>
            {/if}
        </div>
        <div class="card-footer">
            <a href="index.php?page=createItem" class="btn btn-primary">Create New Item</a>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
{/block}>
