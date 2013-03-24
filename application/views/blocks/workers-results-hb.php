<script id='result-template' type='text/x-handlebars-template'>
    {{#if results}}
        <table class='results'>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Телефон</th>
                    {{#if has_jobtype}}
                        <th>Стоимость</th>
                    {{/if}}
                    <th>Выбрать</th>
                </tr>
            </thead>
            <tbody>
                {{#each results}}
                    <tr class='worker'>
                        <td class='worker_name'><span>{{ attributes.name }}</span></td>
                        <td class='worker_phone'><span>{{ attributes.phone }}</span></td>
                        {{#if ../has_jobtype}}
                            <td class='worker_cost'>{{ attributes.cost }} руб./час</td>
                        {{/if}}
                        <td class='worker_choose'><input type='checkbox' value='{{ attributes.id }}' {{#if_chosen attributes.id}}checked{{/if_chosen}}></td>
                    </tr>
                {{/each}}
            </tbody>
        </table>
    {{else}}
        <span class="results-not-found">Никого не найдено. Попробуйте изменить параметры поиска.</span>
    {{/if}}
</script>