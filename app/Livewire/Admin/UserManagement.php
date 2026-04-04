<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $role = 'all';

    #[Url(as: 'verification')]
    public string $verification = 'all';

    public function mount(): void
    {
        $this->normalizeFilters();
    }

    public function applyFilters(): void
    {
        $this->normalizeFilters();
        $this->resetPage();
    }

    private function normalizeFilters(): void
    {
        if (! in_array($this->role, ['all', 'admin', 'customer'], true)) {
            $this->role = 'all';
        }

        if (! in_array($this->verification, ['all', 'verified', 'unverified'], true)) {
            $this->verification = 'all';
        }
    }

    public function render()
    {
        $users = User::query()
            ->when(trim($this->search) !== '', function ($query) {
                $keyword = trim($this->search);
                $query->where(function ($nested) use ($keyword) {
                    $nested->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                });
            })
            ->when($this->role !== 'all', function ($query) {
                $query->where('role', $this->role);
            })
            ->when($this->verification !== 'all', function ($query) {
                if ($this->verification === 'verified') {
                    $query->whereNotNull('email_verified_at');
                } else {
                    $query->whereNull('email_verified_at');
                }
            })
            ->latest()
            ->paginate(10)
            ->onEachSide(1);

        $userPayload = $users->getCollection()
            ->map(function (User $user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role ?? 'customer',
                    'verification_status' => $user->email_verified_at ? 'verified' : 'unverified',
                ];
            })
            ->values();

        $counts = [
            'all' => (int) User::query()->count(),
            'admin' => (int) User::query()->where('role', 'admin')->count(),
            'customer' => (int) User::query()->where('role', 'customer')->count(),
            'verified' => (int) User::query()->whereNotNull('email_verified_at')->count(),
        ];

        return view('livewire.admin.user-management', [
            'users' => $users,
            'userPayload' => $userPayload,
            'counts' => $counts,
        ]);
    }
}

