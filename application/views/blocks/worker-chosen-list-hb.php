<script id="chosen-template" type="text/x-handlebars-template">
    <h1>Выбранные рабочие</h1>
    {{#if chosen}}
        <table class='chosen_list'>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
              </tr>
            </thead>
            <tbody>
                {{#each chosen}}
                    <tr class='chosen_worker'>
                        <td class='avatar'>
                            {{#if  attributes.avatar_url}}}
                            <img src='<?php echo  USER::getSmallAvatar() ?>{{attributes.id}}<?='.jpg'?>'/>
                            {{else}}
                            '<?php echo USER::getAnon()?>'
                            {{/if}}
                        </td>
                        <td class='chosen_name'><span><a href="workers/profile/{{attributes.id}}">{{ attributes.name }}</a></span></td>
                        <!--td class='chosen_phone'><span>{{ attributes.phone }}</span></td-->
                        <td class='chosen_remove'><a href="#" title="Убрать" data-id="{{ attributes.id }}">X</a></td>
                    </tr>
                {{/each}}
            </tbody>
        </table>
        {{#if_not_hiring}}
            <a href="workers/hire" class="red-button">Нанять</a>
        {{else}}
            <a href="/workers" class="red-button">Вернуться к поиску</a>
        {{/if_not_hiring}}
    {{else}}
        <span>Вы еще не выбрали ни одного рабочего</span>
    {{/if}}
</script>
<div id="chosenWorkersContainer" class="choose_workers"></div>