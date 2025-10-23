<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'pgsql') {
            // Change user_id to varchar for Postgres
            DB::statement("ALTER TABLE oauth_access_tokens ALTER COLUMN user_id TYPE varchar USING user_id::varchar;");
            // Ensure index exists
            DB::statement("CREATE INDEX IF NOT EXISTS oauth_access_tokens_user_id_index ON oauth_access_tokens (user_id);");
        } else {
            // MySQL / SQLite
            // For MySQL
            DB::statement("ALTER TABLE oauth_access_tokens MODIFY COLUMN user_id varchar(36) NULL;");
            // Create index if not exists (MySQL does not support IF NOT EXISTS for CREATE INDEX)
            // So we try to create and ignore errors
            try {
                DB::statement("CREATE INDEX oauth_access_tokens_user_id_index ON oauth_access_tokens (user_id);");
            } catch (\Throwable $e) {
                // ignore if index exists
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'pgsql') {
            // Try to cast back to bigint; only safe if values are numeric
            DB::statement("ALTER TABLE oauth_access_tokens ALTER COLUMN user_id TYPE bigint USING (CASE WHEN user_id ~ '^[0-9]+' THEN user_id::bigint ELSE NULL END);");
        } else {
            // MySQL
            try {
                DB::statement("ALTER TABLE oauth_access_tokens MODIFY COLUMN user_id bigint UNSIGNED NULL;");
            } catch (\Throwable $e) {
                // ignore
            }
        }
    }
};
