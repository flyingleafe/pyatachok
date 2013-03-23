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
                        <td class='worker_choose'><input type='checkbox'/ ></td>
                    </tr>
                {{/each}}
            </tbody>
        </table>
    {{else}}
        No results found...
    {{/if}}
</script>