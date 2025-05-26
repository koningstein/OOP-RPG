{extends file='layout.tpl'}
{block name="content"}
    <h1>Delete Item</h1>

    <div class="alert alert-danger" role="alert">
        <strong>Warning!</strong> You are about to permanently delete this item. This action cannot be undone.
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4 border-danger">
                <div class="card-header bg-danger text-white">
                    <h2>Item to be deleted</h2>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{$item->getId()}</td>
                        </tr>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{$item->getName()}</td>
                        </tr>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td>{$item->getType()}</td>
                        </tr>
                        <tr>
                            <td><strong>Value:</strong></td>
                            <td>{$item->getValue()} gold</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <form action="index.php?page=deleteItemConfirmed" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="{$item->getId()}">
                        <button type="submit" class="btn btn-danger">Yes, Delete Item</button>
                    </form>
                    <a href="index.php?page=listItems" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
{/block}