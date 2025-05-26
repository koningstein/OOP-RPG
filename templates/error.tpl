{extends file='layout.tpl'}
{block name="content"}
    <div class="container mt-5">
        <!-- Error Alert -->
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p>{$error}</p>
        </div>

        <!-- Navigation Buttons -->
        <div class="mt-3">
            <a href="javascript:history.back()" class="btn btn-secondary">Go Back</a>
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
{/block}