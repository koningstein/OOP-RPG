{extends file='layout.tpl'}
{block name="content"}
    <h1>Item Created Successfully</h1>

    <div class="alert alert-success" role="alert">
        <strong>Success!</strong> The item has been successfully created and saved to the database.
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Item Details</h2>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{$item->getId()}</td>
                        </tr>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{$item->getName()}</td>
                        </tr>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td>{$item->getType()}</td>
                        </tr>
                        <tr>
                            <td><strong>Value:</strong></td>
                            <td>{$item->getValue()} gold</td>
                        </tr>
                        {if $item->getType() != 'misc'}
                            {if $item->getAttackBonus() > 0}
                            <tr>
                                <td><strong>Attack Bonus:</strong></td>
                                <td>{$item->getAttackBonus()}</td>
                            </tr>
                            {/if}
                            {if $item->getDefenceBonus() > 0}
                            <tr>
                                <td><strong>Defense Bonus:</strong></td>
                                <td>{$item->getDefenceBonus()}</td>
                            </tr>
                            {/if}
                            {if $item->getType() == 'consumable' && $item->getHealthBonus() > 0}
                            <tr>
                                <td><strong>Health Bonus:</strong></td>
                                <td>{$item->getHealthBonus()}</td>
                            </tr>
                            {/if}
                            {if $item->getType() == 'consumable' && $item->getSpecialEffect() != ''}
                            <tr>
                                <td><strong>Special Effect:</strong></td>
                                <td>{$item->getSpecialEffect()}</td>
                            </tr>
                            {/if}
                        {else}
                        <tr>
                            <td colspan="2" class="text-warning">Mystery item - effects unknown until used</td>
                        </tr>
                        {/if}
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="index.php?page=createItem" class="btn btn-primary">Create Another Item</a>
                        <a href="index.php" class="btn btn-secondary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}