{extends file='layout.tpl'}
{block name="content"}
    <h1>Database Connection Test</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h3>Connection Test Result</h3>
        </div>
        <div class="card-body">
            <p class="card-text">{$message}</p>

            {if $message == 'Database connection successful!'}
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Database connection is working properly.
                </div>
                <p class="text-muted">You can now proceed with database operations.</p>
            {else}
                <div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> There's an issue with the database connection.
                </div>
                <p class="text-muted">Please check your .env file configuration and make sure your database server is running.</p>
            {/if}
        </div>
    </div>

    <div class="mt-3">
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
{/block}