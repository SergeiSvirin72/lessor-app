<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call([
//            UserSeeder::class,
//            TeamSeeder::class,
//            TenantSeeder::class,
//            ContactSeeder::class,
////            ContractSeeder::class,
//            TeamUserSeeder::class,
//            EstateSeeder::class,
//            FloorSeeder::class,
//            RoomSeeder::class,
//            RequisiteSeeder::class,
//            ContractRoomSeeder::class,
//            BillSeeder::class,
//            BalanceSeeder::class,
//            ImageSeeder::class,
//            AttachmentSeeder::class,
//        ]);

        $team = \App\Models\Team::factory()->create();
        $user = \App\Models\User::create([
            'name' => 'Sergei Svirin',
            'email' => 'Darkraver2017@yandex.ru',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'team_id' => $team->id
        ]);
        $user->teams()->attach($team->id, ['role' => 1]);
        Auth::login($user);

        $estate = \App\Models\Estate::factory()->create(['team_id' => $team->id]);
        $floor = \App\Models\Floor::factory()->create(['name' => 'Floor 1', 'estate_id' => $estate->id]);
        $room_1 = \App\Models\Room::factory()->create(['name' => 'Room 1', 'floor_id' => $floor->id]);
        $room_2 = \App\Models\Room::factory()->create(['name' => 'Room 2', 'floor_id' => $floor->id]);
        $room_3 = \App\Models\Room::factory()->create(['name' => 'Room 3', 'floor_id' => $floor->id]);
        $room_4 = \App\Models\Room::factory()->create(['name' => 'Room 4', 'floor_id' => $floor->id]);
        $room_5 = \App\Models\Room::factory()->create(['name' => 'Room 5', 'floor_id' => $floor->id]);
        $room_6 = \App\Models\Room::factory()->create(['name' => 'Room 6', 'floor_id' => $floor->id]);

        $tenant_1 = \App\Models\Tenant::factory()->create(['team_id' => $team->id, 'short_name' => 'Tenant 1']);
        $contact_1 = \App\Models\Contact::factory()->create(['tenant_id' => $tenant_1->id]);
        $tenant_2 = \App\Models\Tenant::factory()->create(['team_id' => $team->id, 'short_name' => 'Tenant 2']);
        $contact_2 = \App\Models\Contact::factory()->create(['tenant_id' => $tenant_2->id]);
        $tenant_3 = \App\Models\Tenant::factory()->create(['team_id' => $team->id, 'short_name' => 'Tenant 3']);
        $contact_3 = \App\Models\Contact::factory()->create(['tenant_id' => $tenant_3->id]);

        $contract_1 = \App\Models\Contract::factory()->create(['number' => 'Contract 1']);
        $contract_2 = \App\Models\Contract::factory()->create(['number' => 'Contract 2']);
        $contract_3 = \App\Models\Contract::factory()->create(['number' => 'Contract 3']);
        $contract_4 = \App\Models\Contract::factory()->create(['number' => 'Contract 4']);
        $tenant_1->contracts()->attach([$contract_1->id, $contract_2->id, $contract_3->id, $contract_4->id]);
        $tenant_2->contracts()->attach([$contract_3->id, $contract_4->id]);
        $tenant_3->contracts()->attach([$contract_4->id]);

        $requisite = \App\Models\Requisite::factory()->create(['team_id' => $team->id]);

        $contractRoom_1 = \App\Models\ContractRoom::factory()->create([
            'contract_id' => $contract_1->id,
            'room_id' => $room_1->id
        ]);
        $contractRoom_2 = \App\Models\ContractRoom::factory()->create([
            'contract_id' => $contract_2->id,
            'room_id' => $room_2->id
        ]);
        $contractRoom_3 = \App\Models\ContractRoom::factory()->create([
            'contract_id' => $contract_2->id,
            'room_id' => $room_3->id,
            'price_square_foot' => 0,
        ]);
        $contractRoom_4 = \App\Models\ContractRoom::factory()->create([
            'contract_id' => $contract_3->id,
            'room_id' => $room_4->id,
        ]);
        $contractRoom_5 = \App\Models\ContractRoom::factory()->create([
            'contract_id' => $contract_4->id,
            'room_id' => $room_5->id
        ]);
        $contractRoom_6 = \App\Models\ContractRoom::factory()->create([
            'contract_id' => $contract_4->id,
            'room_id' => $room_6->id,
            'price_square_foot' => 0,
        ]);
    }
}
