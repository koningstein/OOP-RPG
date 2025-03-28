{extends file='layout.tpl'}
{block name="content"}
    <h1>Character Created</h1>

    <div class="alert alert-success" role="alert">
        The character has been successfully created!
    </div>

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
        </div>
    </div>

    <a href="index.php" class="btn btn-primary">Back to Home</a>
{/block}