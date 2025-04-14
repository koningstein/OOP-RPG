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
            {if $character->getRole() == 'Rogue' && $character->getEnergy() !== null}
                <p class="card-text"><strong>Energy:</strong> {$character->getEnergy()}</p>
            {/if}
            {if $character->getRole() == 'Healer' && $character->getSpirit() !== null}
                <p class="card-text"><strong>Spirit:</strong> {$character->getSpirit()}</p>
            {/if}
            {if $character->getRole() == 'Tank' && $character->getShield() !== null}
                <p class="card-text"><strong>Shield:</strong> {$character->getShield()}</p>
            {/if}
            <p class="card-text"><strong>Summary:</strong> {$character->getSummary()}</p>

        </div>
    </div>

    <a href="index.php" class="btn btn-primary">Back to Home</a>
{/block}