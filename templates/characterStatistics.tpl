{extends file='layout.tpl'}
{block name="content"}
    <h1 class="text-center mb-4">Character Statistics</h1>

    <!-- Total Characters Card -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3>Total Characters</h3>
        </div>
        <div class="card-body">
            <h2 class="display-4 text-center">{$totalCharacters}</h2>
        </div>
    </div>

    <div class="row">
        <!-- Character Types Card -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h3>Character Types</h3>
                </div>
                <div class="card-body">
                    <h4>All Character Types:</h4>
                    <ul class="list-group">
                        {foreach from=$characterTypes item=type}
                            <li class="list-group-item">{$type}</li>
                        {/foreach}
                    </ul>

                    <h4 class="mt-4">Count by Type:</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Character Type</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$typeCounts key=type item=count}
                                <tr>
                                    <td>{$type}</td>
                                    <td>{$count}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Character Names Card -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h3>Character Names</h3>
                </div>
                <div class="card-body">
                    <h4>All Character Names:</h4>
                    <ul class="list-group">
                        {foreach from=$existingNames item=name}
                            <li class="list-group-item">{$name}</li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="index.php" class="btn btn-primary">Back to Home</a>
        <a href="index.php?page=listCharacters" class="btn btn-secondary">Character List</a>
    </div>
{/block}
