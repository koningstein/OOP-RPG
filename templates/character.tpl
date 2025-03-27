{extends file='layout.tpl'}
{block name="content"}
    <h1>Character Information</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>{$eldrin->getName()}</h2>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Role:</strong> {$eldrin->getRole()}</p>
                    <p class="card-text"><strong>Health:</strong> {$eldrin->getHealth()}</p>
                    <p class="card-text"><strong>Attack:</strong> {$eldrin->getAttack()}</p>
                    <p class="card-text"><strong>Defense:</strong> {$eldrin->getDefense()}</p>
                    <p class="card-text"><strong>Range:</strong> {$eldrin->getRange()}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>{$thorgrim->getName()}</h2>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Role:</strong> {$thorgrim->getRole()}</p>
                    <p class="card-text"><strong>Health:</strong> {$thorgrim->getHealth()}</p>
                    <p class="card-text"><strong>Attack:</strong> {$thorgrim->getAttack()}</p>
                    <p class="card-text"><strong>Defense:</strong> {$thorgrim->getDefense()}</p>
                    <p class="card-text"><strong>Range:</strong> {$thorgrim->getRange()}</p>
                </div>
            </div>
        </div>
    </div>
{/block}