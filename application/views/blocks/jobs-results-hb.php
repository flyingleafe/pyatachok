<script id='result-template' type='text/x-handlebars-template'>
    {{#if results}}
        <table class='results'>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Стоимость</th>
                    <th>Подробнее</th>
                </tr>
            </thead>
            <tbody>
                {{#each results}}
                    <tr class='job'>
                        <td ><span>{{ attributes.name }}</span></td>
                        <td><span>{{ attributes.phone }}</span></td>
                        <td>{{ attributes.price }} руб./час</td>
                    </tr>
                {{/each}}
            </tbody>
        </table>
    {{else}}
        No results found...
    {{/if}}
</script>