<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE GetBranchCustomerGenderCount()
            BEGIN
                SELECT
                    branch_id,
                    COUNT(*) AS total_customer_count,
                    SUM(CASE WHEN gender = "M" THEN 1 ELSE 0 END) AS total_male_customer_count,
                    SUM(CASE WHEN gender = "F" THEN 1 ELSE 0 END) AS total_female_customer_count
                FROM customers
                GROUP BY branch_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetBranchCustomerGenderCount');
    }
};
