{extends file='layout.tpl'}
{block name="content"}
    <h1 class="text-center mb-4">Battle Results</h1>

    <div class="row mb-4">
        <!-- Fighter 1 Card -->
        <div class="col-md-5">
            <div class="card h-100 {if $battle->getFighter1()->getHealth() <= 0}border-danger{elseif $battle->getFighter2()->getHealth() <= 0}border-success{else}border-warning{/if}">
                <div class="card-header bg-primary text-white">
                    <h3>{$battle->getFighter1()->getName()} - {$battle->getFighter1()->getRole()}</h3>
                </div>
                <div class="card-body">
                    <div class="progress mb-3" role="progressbar" aria-label="Health">
                        <div class="progress-bar bg-danger" style="width: {($battle->getFighter1()->getHealth() / $battle->getFighter1OriginalHealth()) * 100}%"></div>
                    </div>
                    <p><strong>Health:</strong> {$battle->getFighter1()->getHealth()}/{$battle->getFighter1OriginalHealth()}</p>
                    <p><strong>Attack:</strong> {$battle->getFighter1()->getAttack()}</p>
                    <p><strong>Defense:</strong> {$battle->getFighter1()->getDefense()}</p>
                    <p><strong>Range:</strong> {$battle->getFighter1()->getRange()}</p>
                    {if $battle->getFighter1()->getRole() == 'Warrior'}
                        <p><strong>Rage:</strong> {$battle->getFighter1()->getRage()}</p>
                    {/if}
                    {if $battle->getFighter1()->getRole() == 'Mage'}
                        <p><strong>Mana:</strong> {$battle->getFighter1()->getMana()}</p>
                    {/if}
                    {if $battle->getFighter1()->getRole() == 'Rogue'}
                        <p><strong>Energy:</strong> {$battle->getFighter1()->getEnergy()}</p>
                    {/if}
                    {if $battle->getFighter1()->getRole() == 'Healer'}
                        <p><strong>Spirit:</strong> {$battle->getFighter1()->getSpirit()}</p>
                    {/if}
                    {if $battle->getFighter1()->getRole() == 'Tank'}
                        <p><strong>Shield:</strong> {$battle->getFighter1()->getShield()}</p>
                    {/if}
                </div>
                <div class="card-footer {if $battle->getFighter1()->getHealth() <= 0}bg-danger text-white{elseif $battle->getFighter2()->getHealth() <= 0}bg-success text-white{else}bg-warning{/if}">
                    {if $battle->getFighter1()->getHealth() <= 0}
                        <strong>DEFEATED</strong>
                    {elseif $battle->getFighter2()->getHealth() <= 0}
                        <strong>VICTORY</strong>
                    {else}
                        <strong>FIGHTING</strong>
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
            <div class="card h-100 {if $battle->getFighter2()->getHealth() <= 0}border-danger{elseif $battle->getFighter1()->getHealth() <= 0}border-success{else}border-warning{/if}">
                <div class="card-header bg-primary text-white">
                    <h3>{$battle->getFighter2()->getName()} - {$battle->getFighter2()->getRole()}</h3>
                </div>
                <div class="card-body">
                    <div class="progress mb-3" role="progressbar" aria-label="Health">
                        <div class="progress-bar bg-danger" style="width: {($battle->getFighter2()->getHealth() / $battle->getFighter2OriginalHealth()) * 100}%"></div>
                    </div>
                    <p><strong>Health:</strong> {$battle->getFighter2()->getHealth()}/{$battle->getFighter2OriginalHealth()}</p>
                    <p><strong>Attack:</strong> {$battle->getFighter2()->getAttack()}</p>
                    <p><strong>Defense:</strong> {$battle->getFighter2()->getDefense()}</p>
                    <p><strong>Range:</strong> {$battle->getFighter2()->getRange()}</p>
                    {if $battle->getFighter2()->getRole() == 'Warrior'}
                        <p><strong>Rage:</strong> {$battle->getFighter2()->getRage()}</p>
                    {/if}
                    {if $battle->getFighter2()->getRole() == 'Mage'}
                        <p><strong>Mana:</strong> {$battle->getFighter2()->getMana()}</p>
                    {/if}
                    {if $battle->getFighter2()->getRole() == 'Rogue'}
                        <p><strong>Energy:</strong> {$battle->getFighter2()->getEnergy()}</p>
                    {/if}
                    {if $battle->getFighter2()->getRole() == 'Healer'}
                        <p><strong>Spirit:</strong> {$battle->getFighter2()->getSpirit()}</p>
                    {/if}
                    {if $battle->getFighter2()->getRole() == 'Tank'}
                        <p><strong>Shield:</strong> {$battle->getFighter2()->getShield()}</p>
                    {/if}
                </div>
                <div class="card-footer {if $battle->getFighter2()->getHealth() <= 0}bg-danger text-white{elseif $battle->getFighter1()->getHealth() <= 0}bg-success text-white{else}bg-warning{/if}">
                    {if $battle->getFighter2()->getHealth() <= 0}
                        <strong>DEFEATED</strong>
                    {elseif $battle->getFighter1()->getHealth() <= 0}
                        <strong>VICTORY</strong>
                    {else}
                        <strong>FIGHTING</strong>
                    {/if}
                </div>
            </div>
        </div>
    </div>

    <!-- Battle Functions -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white text-center">
            <h3>Attack Selection</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Fighter 1 Attack Selection -->
                <div class="col-md-5">
                    <h4 class="text-center">{$battle->getFighter1()->getName()}</h4>
                    <form method="post" action="index.php?page=battleRound">
                        <div class="form-group">
                            <label for="fighter1Attack">Choose Attack:</label>
                            <select name="fighter1Attack" id="fighter1Attack" class="form-control">
                                <option value="normal">Normal Attack</option>
                                {foreach from=$battle->getFighter1()->getSpecialAttacks() item=attack}
                                    <option value="{$attack}">{$attack}</option>
                                {/foreach}
                            </select>
                        </div>
                </div>

                <!-- Fight Round or Reset Button -->
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    {if $battle->getFighter1()->getHealth() > 0 && $battle->getFighter2()->getHealth() > 0}
                        <button type="submit" class="btn btn-success btn-lg">Fight Round</button>
                    {else}
                        <a href="index.php?page=resetHealth" class="btn btn-danger btn-lg">Reset Battle</a>
                    {/if}
                </div>

                <!-- Fighter 2 Attack Selection -->
                <div class="col-md-5">
                    <h4 class="text-center">{$battle->getFighter2()->getName()}</h4>
                    <div class="form-group">
                        <label for="fighter2Attack">Choose Attack:</label>
                        <select name="fighter2Attack" id="fighter2Attack" class="form-control">
                            <option value="normal">Normal Attack</option>
                            {foreach from=$battle->getFighter2()->getSpecialAttacks() item=attack}
                                <option value="{$attack}">{$attack}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Battle Log -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Battle Log</h3>
                </div>
                <div class="card-body bg-light">
                    <div class="battle-log">
                        <ul>
                            {foreach from=$battle->getBattleLog() item=logEntry}
                                {if $logEntry != ""}
                                    <li>{$logEntry}</li>
                                {else}
                                    <li style="list-style-type: none;">&nbsp;</li> <!-- Blank line without bullet point -->
                                {/if}
                            {/foreach}
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=battleForm" class="btn btn-primary">New Battle</a>
                    <a href="index.php?page=listCharacters" class="btn btn-secondary">Character List</a>
                </div>
            </div>
        </div>
    </div>
{/block}