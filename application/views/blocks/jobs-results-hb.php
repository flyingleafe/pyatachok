<script id='result-template' type='text/x-handlebars-template'>
    {{#if results}}
        <table class='results'>
            <thead>
                <tr>
                    <th>Работодатель</th>
                    <th>Телефон</th>
                    <th>Тип работы</th>
                    <th>Стоимость</th>
                    <th>Подробнее</th>
                </tr>
            </thead>
            <tbody>
                {{#each results}}
                    <tr class='job'>
                        <td ><span>{{ attributes.name }}</span></td>
                        <td><span>{{ attributes.phone }}</span></td>
                        <td>{{ relationships.jobtype.attributes.name }}</td>
                        <td>{{ attributes.price }} руб./час</td>
                        <td><a href="/jobs/view/{{ attributes.id }}">Подробнее</a></td>
                    </tr>
                {{/each}}
            </tbody>
        </table>
    {{else}}
        No results found...
    {{/if}}
</script>