{extends file='layout.tpl'}
{block name="content"}
    <h1>Character List</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Health</th>
                <th>Defense</th>
                <th>Range</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$characters item=character}
                <tr>
                    <td>{$character->getName()}</td>
                    <td>{$character->getRole()}</td>
                    <td>{$character->getHealth()}</td>
                    <td>{$character->getDefense()}</td>
                    <td>{$character->getRange()}</td>
                    <td></td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{/block}