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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();

            // 1. user_id: Hangi kullanıcının bu aktiviteyi yaptığını tutar.
            // users tablosuna foreign key olarak bağlanması önerilir.
            // Değişiklik: Kullanıcı silindiğinde NULL değeri alması için 'nullable()' eklendi.
            // İlişki: Kullanıcı silindiğinde aktivite kaydının silinmesini engellemek için 'onDelete('cascade')' yerine 'onDelete('set null')' kullanıldı.
            $table->foreignId('user_id')
                  ->nullable() // Kullanıcı silindiğinde NULL kalabilmesi için
                  ->constrained('users')
                  ->onDelete('set null'); // Kullanıcı silinse bile aktivite kaydını korur

            // 2. url: Ziyaret edilen sayfanın tam URL'si
            $table->string('url', 2048);

            // 3. method: HTTP metodu (GET, POST, PUT, DELETE)
            $table->string('method', 10);

            // 4. ip_address: Kullanıcının IP adresi
            $table->string('ip_address', 45)->nullable(); // IPv6 için 45 karakter

            // 5. user_agent: Kullanıcının tarayıcı ve cihaz bilgisi
            // LogUserActivity.php dosyasında kullanılıyor.
            $table->text('user_agent')->nullable();

            // created_at ve updated_at sütunlarını ekler.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
