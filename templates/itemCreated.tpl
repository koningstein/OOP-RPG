{extends file='layout.tpl'}
{block name="content"}
<div class="container mt-5">
    <!-- Success Alert -->
    <div class="alert alert-success" role="alert">
        Item successfully created!
    </div>

    <!-- Item Details Card -->
    <div class="card">
        <div class="card-header">
            Item Details
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {$item->getId()}</p>
            <p><strong>Name:</strong> {$item->getName()}</p>
            <p><strong>Type:</strong> {$item->getType()}</p>
            <p><strong>Value:</strong> {$item->getValue()} gold</p>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="mt-3">
        <a href="index.php?page=createItem" class="btn btn-primary">Create Another Item</a>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </div>
</div>
{/block}