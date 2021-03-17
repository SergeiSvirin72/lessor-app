<?php

namespace App\Console\Commands;

use App\Gateways\BillGateway;
use Illuminate\Console\Command;

class WriteoffAmount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amount:writeoff';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Оплачивает акты, создает балансы и продляет аренду, если у арендатора достаточно средств.';

    /**
     * Execute the console command.
     *
     * @param BillGateway $actGateway
     * @return void
     */
    public function handle(BillGateway $actGateway)
    {
        $actGateway->payAll();
    }
}
