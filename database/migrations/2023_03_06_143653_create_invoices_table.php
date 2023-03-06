<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text("address_from")->nullable();
            $table->text("city_from")->nullable();
            $table->text("post_code_from")->nullable();
            $table->text("country_from")->nullable();
            $table->text("client_name")->nullable();
            $table->text("client_email")->nullable();
            $table->text("address_to")->nullable();
            $table->text("city_to")->nullable();
            $table->text("post_code_to")->nullable();
            $table->text("country_to")->nullable();
            $table->date("invoice_date");
            $table->text("payment_terms")->nullable();
            $table->text("project_description")->nullable();
            $table->text("status")->nullable();
            $table->longText("items");
            $table->text("key")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
