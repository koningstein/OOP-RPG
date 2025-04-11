{extends file='layout.tpl'}
{block name="content"}
    <h1 class="text-center mb-4">Battle Results</h1>

    <div class="row mb-4">
        <!-- Fighter 1 Card -->
        <div class="col-md-5">
            <div class="card h-100 {if $character1->getHealth() <= 0}border-danger{elseif $character2->getHealth() <= 0}border-success{else}border-warning{/if}">
                <div class="card-header bg-primary text-white">
                    <h3>{$character1->getName()} - {$character1->getRole()}</h3>
                </div>
                <div class="card-body">
                    <div class="progress mb-3" role="progressbar" aria-label="Health">
                        <div class="progress-bar bg-danger" style="width: {($character1->getHealth() / $character1OriginalHealth) * 100}%"></div>
                    </div>
                    <p><strong>Health:</strong> {$character1->getHealth()}/{$character1OriginalHealth}</p>
                    <p><strong>Attack:</strong> {$character1->getAttack()}</p>
                    <p><strong>Defense:</strong> {$character1->getDefense()}</p>
                    <p><strong>Range:</strong> {$character1->getRange()}</p>
                    {if $character1->getRole() == 'Warrior'}
                        {if isset($character1->getRage)}
                            <p><strong>Rage:</strong> {$character1->getRage()}</p>
                        {/if}
                    {/if}
                    {if $character1->getRole() == 'Mage'}
                        {if isset($character1->getMana)}
                            <p><strong>Mana:</strong> {$character1->getMana()}</p>
                        {/if}
                    {/if}
                    {if $character1->getRole() == 'Rogue'}
                        {if isset($character1->getEnergy)}
                            <p><strong>Energy:</strong> {$character1->getEnergy()}</p>
                        {/if}
                    {/if}
                    {if $character1->getRole() == 'Healer'}
                        {if isset($character1->getSpirit)}
                            <p><strong>Spirit:</strong> {$character1->getSpirit()}</p>
                        {/if}
                    {/if}
                </div>
                <div class="card-footer {if $character1->getHealth() <= 0}bg-danger text-white{elseif $character2->getHealth() <= 0}bg-success text-white{else}bg-warning{/if}">
                    {if $character1->getHealth() <= 0}
                        <strong>DEFEATED</strong>
                    {elseif $character2->getHealth() <= 0}
                        <strong>VICTORY</strong>
                    {else}
                        <strong>DRAW</strong>
                    {/if}
                </div>
            </div>
        </div>

        <!-- VS Banner -->
        <div class="col-md-2 d-flex justify-content-center align-items-center">
            <div class="text-center">
                <h2 class="display-4">VS</h2>
            </div>
        </div>

        <!-- Fighter 2 Card -->
        <div class="col-md-5">
            <div class="card h-100 {if $character2->getHealth() <= 0}border-danger{elseif $character1->getHealth() <= 0}border-success{else}border-warning{/if}">
                <div class="card-header bg-primary text-white">
                    <h3>{$character2->getName()} - {$character2->getRole()}</h3>
                </div>
                <div class="card-body">
                    <div class="progress mb-3" role="progressbar" aria-label="Health">
                        <div class="progress-bar bg-danger" style="width: {($character2->getHealth() / $character2OriginalHealth) * 100}%"></div>
                    </div>
                    <p><strong>Health:</strong> {$character2->getHealth()}/{$character2OriginalHealth}</p>
                    <p><strong>Attack:</strong> {$character2->getAttack()}</p>
                    <p><strong>Defense:</strong> {$character2->getDefense()}</p>
                    <p><strong>Range:</strong> {$character2->getRange()}</p>
                    {if $character2->getRole() == 'Warrior'}
                        {if isset($character2->getRage)}
                            <p><strong>Rage:</strong> {$character2->getRage()}</p>
                        {/if}
                    {/if}
                    {if $character2->getRole() == 'Mage'}
                        {if isset($character2->getMana)}
                            <p><strong>Mana:</strong> {$character2->getMana()}</p>
                        {/if}
                    {/if}
                    {if $character2->getRole() == 'Rogue'}
                        {if isset($character2->getEnergy)}
                            <p><strong>Energy:</strong> {$character2->getEnergy()}</p>
                        {/if}
                    {/if}
                    {if $character2->getRole() == 'Healer'}
                        {if isset($character2->getSpirit)}
                            <p><strong>Spirit:</strong> {$character2->getSpirit()}</p>
                        {/if}
                    {/if}
                </div>
                <div class="card-footer {if $character2->getHealth() <= 0}bg-danger text-white{elseif $character1->getHealth() <= 0}bg-success text-white{else}bg-warning{/if}">
                    {if $character2->getHealth() <= 0}
                        <strong>DEFEATED</strong>
                    {elseif $character1->getHealth() <= 0}
                        <strong>VICTORY</strong>
                    {else}
                        <strong>DRAW</strong>
                    {/if}
                </div>
            </div>
        </div>
    </div>

    <!-- Battle Log -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Battle Log</h3>
                </div>
                <div class="card-body bg-light">
                    <div class="battle-log">
                        <div class="battle-log">
                            {$battle->getBattleLog()}
                        </div>

                        <style>
                            .battle-log {
                                background-color: #f8f9fa;
                                border: 1px solid #dee2e6;
                                border-radius: 4px;
                                padding: 1rem;
                                font-family: monospace;
                                font-size: 0.9rem;
                                color: #212529;
                                line-height: 1.5;
                            }
                        </style>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=battleForm" class="btn btn-primary">New Battle</a>
                    <a href="index.php?page=listCharacters" class="btn btn-secondary">Character List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden section for future team battles -->
    <div class="row mt-4" style="display: none">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Team Battle Results</h3>
                </div>
                <div class="card-body">
                    <!-- Structure for team battle display (2v2 or 3v3) - hidden for now -->
                    <div class="row">
                        <div class="col-md-5">
                            <h4>Team 1</h4>
                            <!-- Here will be team members -->
                        </div>
                        <div class="col-md-2 text-center">
                            <h2>VS</h2>
                        </div>
                        <div class="col-md-5">
                            <h4>Team 2</h4>
                            <!-- Here will be team members -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}