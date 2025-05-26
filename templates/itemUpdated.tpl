{extends file='layout.tpl'}
{block name="content"}
    <div class="container mt-5">
        <!-- Success Alert -->
        <div class="alert alert-success" role="alert">
            Item has been successfully updated!
        </div>

        <!-- Updated Item Details Card -->
        <div class="card">
            <div class="card-header">
                Updated Item Details
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
            <a href="index.php?page=listItems" class="btn btn-primary">Back to Item List</a>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
{/block}