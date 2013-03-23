<script id="chosen-template" type="text/x-handlebars-template">
    <h1>Выбранные рабочие</h1>
    {{#if chosen}}
        <table class='chosen_list'>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Выбрать</th>
                </tr>
            </thead>
            <tbody>
                {{#each chosen}}
                    <tr class='chosen_worker'>
                        <td class='chosen_name'><span>{{ attributes.name }}</span></td>
                        <td class='chosen_phone'><span>{{ attributes.phone }}</span></td>
                        <td class='chosen_remove'><a href="#" title="Убрать">X</a></td>
                    </tr>
                {{/each}}
            </tbody>
        </table>
        <a href="#" class="employ-button">Нанять</a>
    {{else}}
        <span>Вы еще не выбрали ни одного рабочего</span>
    {{/if}}
</script>
<div id="chosenWorkersContainer"></div>