{extends file='layout.tpl'}
{block name="content"}
    <h1>Battle Arena</h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Choose Characters for Battle</h2>
                </div>
                <div class="card-body">
                    <form action="index.php?page=startBattle" method="POST">
                        <div class="mb-3">
                            <label for="character1" class="form-label">Choose Character 1:</label>
                            <select class="form-select" id="character1" name="character1" required>
                                {foreach from=$characters item=character}
                                    <option value="{$character->getName()}">{$character->getName()} ({$character->getRole()})</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="character2" class="form-label">Choose Character 2:</label>
                            <select class="form-select" id="character2" name="character2" required>
                                {foreach from=$characters item=character}
                                    <option value="{$character->getName()}">{$character->getName()} ({$character->getRole()})</option>
                                {/foreach}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Start Battle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}