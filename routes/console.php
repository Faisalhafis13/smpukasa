<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create-user', function (): int {
    $name = trim((string) $this->ask('Nama administrator'));
    $email = Str::lower(trim((string) $this->ask('Email administrator')));

    $validator = Validator::make(
        ['name' => $name, 'email' => $email],
        [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ],
    );

    if ($validator->fails()) {
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }

        return 1;
    }

    $password = (string) $this->secret('Password administrator (minimal 12 karakter)');

    if (strlen($password) < 12) {
        $this->error('Password harus memiliki minimal 12 karakter.');

        return 1;
    }

    $confirmation = (string) $this->secret('Ulangi password');

    if (! hash_equals($password, $confirmation)) {
        $this->error('Konfirmasi password tidak cocok.');

        return 1;
    }

    User::create([
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ]);

    $this->info("Akun administrator {$email} berhasil dibuat.");

    return 0;
})->purpose('Create an administrator account with an interactively entered password');
