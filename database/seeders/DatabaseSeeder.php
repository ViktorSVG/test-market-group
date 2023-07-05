<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // cerate roles
        $roles = [
            'employee' => ['name' => 'Сотрудник', 'description' => 'Рядовой сотрудник компании'],
            'employer' => ['name' => 'Руководитель', 'description' => 'Руководитель компании']
        ];
        array_walk($roles, static function(&$row){
            $row = new Models\Roles($row);
            $row->save();
        });
        // create positions
        $positions = [
            'employee' => 'Сотрудник',
            'employer' => 'Директор',
            'accountant' => 'Бухгалтер',
        ];
        array_walk($positions, static function (&$position){
            $position = new Models\Positions(['name' => $position]);
            $position->save();
        });
        // create users
        $users = [
            [ 'roles_id' => 'employee', 'positions_id'=>'employee', 'name' => 'Иванов И. И.',  'email' => 'user@company.com',   'password' => bcrypt('user@company.com'),   'date_of_employment' => (new \DateTime())->sub(new \DateInterval('P5M'))->format('Y-m-d')],
            [ 'roles_id' => 'employee', 'positions_id'=>'employee', 'name' => 'Ключиков И. Н.','email' => 'user-1@company.com', 'password' => bcrypt('user-1@company.com'), 'date_of_employment' => (new \DateTime())->sub(new \DateInterval('P3Y5M'))->format('Y-m-d')],
            [ 'roles_id' => 'employee', 'positions_id'=>'accountant', 'name' => 'Копейкина С. А.','email' => 'user-2@company.com', 'password' => bcrypt('user-2@company.com'), 'date_of_employment' => (new \DateTime())->sub(new \DateInterval('P2Y5M'))->format('Y-m-d'),
                'vacation' => [
                    [
                        'date_from' => (new \DateTime())->sub(new \DateInterval('P3M'))->format('Y-m-d'),
                        'date_to' => (new \DateTime())->sub(new \DateInterval('P3M'))->add(new \DateInterval('P10D'))->format('Y-m-d')
                    ],
                    [
                        'date_from' => (new \DateTime())->sub(new \DateInterval('P1M'))->format('Y-m-d'),
                        'date_to' => (new \DateTime())->sub(new \DateInterval('P1M'))->add(new \DateInterval('P8D'))->format('Y-m-d')
                    ]
                ]
            ],
            [ 'roles_id' => 'employee', 'positions_id'=>'employee', 'name' => 'Синицын В. И.','email' => 'user-3@company.com', 'password' => bcrypt('user-3@company.com'), 'date_of_employment' => (new \DateTime())->sub(new \DateInterval('P1Y2M'))->format('Y-m-d'),
                'vacation' => [[
                    'date_from' => (new \DateTime())->sub(new \DateInterval('P2M'))->format('Y-m-d'),
                    'date_to' => (new \DateTime())->sub(new \DateInterval('P2M'))->add(new \DateInterval('P21D'))->format('Y-m-d')
                ]]
            ],
            [ 'roles_id' => 'employee', 'positions_id'=>'employee', 'name' => 'Кукушкин Е. И.','email' => 'user-4@company.com', 'password' => bcrypt('user-4@company.com'), 'date_of_employment' => (new \DateTime())->sub(new \DateInterval('P9M'))->format('Y-m-d'),
                'vacation' => [[
                    'date_from' => (new \DateTime())->sub(new \DateInterval('P1M'))->format('Y-m-d'),
                    'date_to' => (new \DateTime())->sub(new \DateInterval('P1M'))->add(new \DateInterval('P14D'))->format('Y-m-d')
                ]]
            ],
            [ 'roles_id' => 'employee', 'positions_id'=>'employee', 'name' => 'Сидоров С. А.','email' => 'user-5@company.com', 'password' => bcrypt('user-5@company.com'), 'date_of_employment' => (new \DateTime())->sub(new \DateInterval('P1Y8M'))->format('Y-m-d'),
                'vacation' => [[
                    'date_from' => (new \DateTime())->format('Y-m-d'),
                    'date_to' => (new \DateTime())->add(new \DateInterval('P21D'))->format('Y-m-d')
                ]]
            ],
            [ 'roles_id' => 'employer', 'positions_id'=>'employer', 'name' => 'Кузьмин А. В.','email' => 'manager@company.com', 'password' => bcrypt('manager@company.com'), 'date_of_employment' => (new \DateTime())->sub(new \DateInterval('P3Y'))->format('Y-m-d')],
        ];
        array_walk($users, static function($user, $k) use ($roles, $positions){
            $vacations = null;
            if (array_key_exists('vacation', $user)) {
                $vacations = $user['vacation'];
                unset($user['vacation']);
            }
            $user['roles_id'] = $roles[$user['roles_id']]->id;
            $user['positions_id'] = $positions[$user['positions_id']]->id;
            $user = new Models\User($user);
            $user->save();
            if (!$vacations) return;
            foreach ($vacations as $vacation) {
                $vacation['users_id'] = $user->id;
                $vacation['approved'] = (bool)($k % 2);
                (new Models\Vacation($vacation))->save();
            }
        });
        $permissions = [
            'employee' => [
                'app.index',
                'app.vacation.save',
                'app.vacation.drop',
            ],
            'employer' => [
                'app.index',
                'app.vacation.save',
                'app.vacation.drop',
                'app.vacation.approve',
            ]
        ];
        array_walk($permissions, static function($actionNames, $roleKey) use ($roles) {
            $roleId = $roles[$roleKey]->id;
            array_walk($actionNames, static function($actionName) use ($roleId) {
                (new Models\Permissions([
                    'roles_id' => $roleId,
                    'action_name' => $actionName,
                    'access' => true
                ]))->save();
            });
        });
    }
}
