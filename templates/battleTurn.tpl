{extends file="layout.tpl"}

{block name="content"}
<h2>Interactive Battle</h2>

<div class="row">
    <div class="col-md-6">
        <h3>{$character1->getName()} ({$character1->getRole()})</h3>
        <p>Health: {$character1->getHealth()}</p>
        <div class="health-bar">
            <div style="width: {($character1->getHealth() / $character1OriginalHealth) * 100}%;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <h3>{$character2->getName()} ({$character2->getRole()})</h3>
        <p>Health: {$character2->getHealth()}</p>
        <div class="health-bar">
            <div style="width: {($character2->getHealth() / $character2OriginalHealth) * 100}%;"></div>
        </div>
    </div>
</div>

<h3>Battle Log</h3>
<ul>
    {foreach from=$battle->getBattleLog() item=logEntry}
        <li>{$logEntry}</li>
    {/foreach}
</ul>

<form method="post" action="index.php?page=nextBattleRound">
    <button type="submit" class="btn btn-primary" {if $character1->getHealth() <= 0 || $character2->getHealth() <= 0}disabled{/if}>Attack</button>
</form>

{if $character1->getHealth() <= 0 || $character2->getHealth() <= 0}
    <form method="post" action="index.php?page=resetHealth">
        <button type="submit" class="btn btn-success">Reset Health</button>
    </form>
{/if}

{if $character1->getHealth() <= 0}
    <h3>{$character2->getName()} wins!</h3>
{elseif $character2->getHealth() <= 0}
    <h3>{$character1->getName()} wins!</h3>
{/if}
{/block}