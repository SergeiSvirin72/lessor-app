<?php

namespace App\Console\Commands;

use App\Gateways\BillGateway;
use Illuminate\Console\Command;

class CreateBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает счета для аренды с истекающим сроком.';

    /**
     * Execute the console command.
     *
     * @param BillGateway $billGateway
     * @return void
     */
    public function handle(BillGateway $billGateway)
    {
        $billGateway->createForExpired();
    }
}
