<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Mail\ImportCompletedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class ImportCustomersJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filePath = public_path('customers.csv');
        $handle = fopen($filePath, 'r');
        $header = fgetcsv($handle);

        $batchSize = 1000;
        $customers = [];

        while (($row = fgetcsv($handle)) !== false) {

            $customers[] = [
                'branch_id' => $row[0],
                'first_name' => $row[1],
                'last_name' => $row[2],
                'email' => $row[3],
                'phone' => $row[4],
                'gender' => $row[5],
                'created_at' => now(),
                'updated_at' => now(),
            ];


            if (count($customers) >= $batchSize) {
                Customer::insert($customers);
                $customers = [];
            }
        }

        if (!empty($customers)) {
            Customer::insert($customers);
        }

        fclose($handle);


        Mail::to('admin@akaarit.com')->later(now()->addSeconds(30), new ImportCompletedMail());
    }
}
