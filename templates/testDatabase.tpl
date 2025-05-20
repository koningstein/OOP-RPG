{extends file='layout.tpl'}
{block name="content"}
    <div class="card mt-5">
        <div class="card-header {if $message|lower contains 'success'}bg-success text-white{else}bg-danger text-white{/if}">
            <h5 class="card-title">Database Test Result</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{$message}</p>
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
{/block}