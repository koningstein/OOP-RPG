{extends file='layout.tpl'}
{block name="content"}
    <h1>Character Information</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>{$character->getName()}</h2>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Role:</strong> {$character->getRole()}</p>
                    <p class="card-text"><strong>Health:</strong> {$character->getHealth()}</p>
                    <p class="card-text"><strong>Attack:</strong> {$character->getAttack()}</p>
                    <p class="card-text"><strong>Defense:</strong> {$character->getDefense()}</p>
                    <p class="card-text"><strong>Range:</strong> {$character->getRange()}</p>
                    {if $character->getRole() == 'Warrior' && $character->getRage() !== null}
                        <p class="card-text"><strong>Rage:</strong> {$character->getRage()}</p>
                    {/if}
                    {if $character->getRole() == 'Mage' && $character->getMana() !== null}
                        <p class="card-text"><strong>Mana:</strong> {$character->getMana()}</p>
                    {/if}
                    {if $character->getRole() == 'Roque' && $character->getEnergy() !== null}
                        <p class="card-text"><strong>Energy:</strong> {$character->getEnergy()}</p>
                    {/if}
                    {if $character->getRole() == 'Healer' && $character->getSpirit() !== null}
                        <p class="card-text"><strong>Spirit:</strong> {$character->getSpirit()}</p>
                    {/if}
                    {if $character->getRole() == 'Tank'}
                        <p class="card-text"><strong>Shield Durability:</strong>  {$character->getShield()}</p>
                    {/if}
                    <div class="character-summary">
                        <h3>Character Summary</h3>
                        <p>{$character->getSummary()}</p>
                    </div>
                    <form method="post" action="index.php?page=resetCharacterHealth">
                        <input type="hidden" name="name" value="{$character->getName()}">
                        <button type="submit" class="btn btn-warning">Reset Health to 100</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}