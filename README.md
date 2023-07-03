
## Тестовое задание
Нужно сделать простую систему.
Есть рядовой сотрудник, который может
- ввести начало и конец отпуска;
- посмотреть какие даты отпусков у других сотрудников.
- скорректировать свои даты.
  
Есть Руководитель, который может так же посмотреть какие даты ввели сотрудники. И поставить признак, что данные по отпуску конкретного сотрудника зафиксированы.
  После этого сотрудник не может скорректировать свои даты.

## Системные требования

- PHP 7.4
- Laravel 8
- MySql 8

## Начальные данные

Роли
- employee => Сотрудник
- employer => Руководитель
- 
Пользователи
<table>
    <thead>
        <tr>
            <th>Роль</th>
            <th>Имя</th>
            <th>Логин</th>
            <th>Пароль</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>employee</td>
            <td>Иванов И. И.</td>
            <td>user@company.com</td>
            <td>user@company.com</td>
        </tr>
        <tr>
            <td>employee</td>
            <td>Ключиков И. Н.</td>
            <td>user-1@company.com</td>
            <td>user-1@company.com</td>
        </tr>
        <tr>
            <td>employee</td>
            <td>Копейкина С. А.</td>
            <td>user-2@company.com</td>
            <td>user-2@company.com</td>
        </tr>
        <tr>
            <td>employee</td>
            <td>Синицын В. И.</td>
            <td>user-3@company.com</td>
            <td>user-3@company.com</td>
        </tr>
        <tr>
            <td>employee</td>
            <td>Кукушкин Е. И.</td>
            <td>user-4@company.com</td>
            <td>user-4@company.com</td>
        </tr>
        <tr>
            <td>employee</td>
            <td>Сидоров С. А.</td>
            <td>user-5@company.com</td>
            <td>user-5@company.com</td>
        </tr>
        <tr>
            <td>employer</td>
            <td>Кузьмин А. В.</td>
            <td>manager@company.com</td>
            <td>manager@company.com</td>
        </tr>
    </tbody>
</table>
