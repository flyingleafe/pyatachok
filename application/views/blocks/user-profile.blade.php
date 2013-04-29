
@if($user)
<table class="info">
    <tr>
        <th colspan="2">Информация о пользователе</th>
    </tr>
    <tr>
        <td>Номер телефона:</td>
        <td>{{ $user->phone;}}</td>
    </tr>
    <tr>
        <td>Имя и фамилия:</td>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <td>Пол:</td>
        <td>{{ $user->getGender() }}</td>
    </tr>
    <tr>
        <td>Возраст:</td>
        <td>{{ $user->age }} лет</td>
    </tr>
    <tr>
        <td>На сайте:</td>
        <td>с {{ $user->getCreatedAt()}} </td>
    </tr>
</table>
@endif