{extends file='layout.tpl'}
{block name="content"}
    <h1>Error</h1>

    <div class="alert alert-danger" role="alert">
        <strong>Error:</strong> {$error|escape}
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </div>
{/block}