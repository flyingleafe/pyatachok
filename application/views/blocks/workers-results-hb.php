<script id='result-template' type='text/x-handlebars-template' xmlns="http://www.w3.org/1999/html">
    {{#if results}}
        <table class='results'>
            <thead>
                <tr>
                    <th></th>
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
                        <td class='avatar'>
                            {{#if  attributes.avatar_url}}}
                                <img src='<?php echo  USER::getSmallAvatar() ?>{{attributes.id}}<?='.jpg'?>'/>
                                {{else}}
                                '<?php echo USER::getAnon()?>'
                            {{/if}}
                        </td>
                        <td class='worker_name'><span><a href="workers/profile/{{attributes.id}}">{{ attributes.name }}</a></span></td>
                        <td class='worker_phone'><span>{{ attributes.phone }}</span></td>


                        {{#if ../has_jobtype}}
                            <td class='worker_cost'>{{ attributes.cost }} руб./час</td>
                            <td class='worker_choose'><input type='checkbox' value='{{ attributes.user_id }}' {{#if_chosen attributes.user_id}}checked{{/if_chosen}}></td>
                        {{else}}
                            <td class='worker_choose'><input type='checkbox' value='{{ attributes.id }}' {{#if_chosen attributes.id}}checked{{/if_chosen}}></td>
                        {{/if}}
                    </tr>
                {{/each}}
            </tbody>
        </table>
    {{else}}
        <span class="results-not-found">Никого не найдено. Попробуйте изменить параметры поиска.</span>
    {{/if}}
</script>