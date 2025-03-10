<?php

use App\Enum\FieldEnum;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('transactions', function (Blueprint $table) {
			$table->id();

			$table->foreignIdFor(Wallet::class, FieldEnum::walletId->value)
				->nullable()
				->constrained()
				->nullOnDelete();

			$table->unsignedTinyInteger(FieldEnum::type->value);
			$table->boolean(FieldEnum::isIncome->value)->default(true);
			$table->bigInteger(FieldEnum::amount->value)->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('transactions');
	}
};
