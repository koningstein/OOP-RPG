{extends file='layout.tpl'}
{block name="content"}
    <h1>Create Character</h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Create a New Character</h2>
                </div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="Warrior">Warrior</option>
                                <option value="Mage">Mage</option>
                                <option value="Rogue">Rogue</option>
                                <option value="Healer">Healer</option>
                                <option value="Tank">Tank</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="health" class="form-label">Health</label>
                            <input type="number" class="form-control" id="health" name="health" min="50" max="200" value="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="attack" class="form-label">Attack</label>
                            <input type="number" class="form-control" id="attack" name="attack" min="10" max="50" value="25" required>
                        </div>
                        <div class="mb-3">
                            <label for="defense" class="form-label">Defense</label>
                            <input type="number" class="form-control" id="defense" name="defense" min="5" max="30" value="10" required>
                        </div>
                        <div class="mb-3">
                            <label for="range" class="form-label">Range</label>
                            <input type="number" class="form-control" id="range" name="range" min="1" max="10" value="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Character</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}