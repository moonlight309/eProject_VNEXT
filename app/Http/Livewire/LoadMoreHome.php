<?php

namespace App\Http\Livewire;

use App\Enums\UserRoleEnum;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\WithPagination;

class LoadMoreHome extends Component
{
    public $pageNumberNews = 2;
    public $pageNumberProduct = 2;
    public $pageNumberUser = 2;

    use WithPagination;

    public function render()
    {
        $role = UserRoleEnum::getRoleByValue(auth()->user()->role);

        View::share('role', $role);

        $topTenNews = News::orderBy('id', 'DESC')
            ->paginate($this->pageNumberNews);
        $topTenProducts = Product::orderBy('id', 'DESC')
            ->paginate($this->pageNumberProduct);
        $topTenUsers = User::orderBy('id', 'DESC')
            ->paginate($this->pageNumberUser);

        return view('home', [
            'topTenNews' => $topTenNews,
            'topTenProducts' => $topTenProducts,
            'topTenUsers' => $topTenUsers,
        ])
            ->layout('layout.master');
    }

    public function loadMoreNews()
    {
        $this->pageNumberNews += 8;
    }

    public function loadLessNews()
    {
        $this->pageNumberNews -= 8;
    }

    public function loadMoreProduct()
    {
        $this->pageNumberProduct += 8;
    }

    public function loadLessProduct()
    {
        $this->pageNumberProduct -= 8;
    }

    public function loadMoreUser()
    {
        $this->pageNumberUser += 8;
    }

    public function loadLessUser()
    {
        $this->pageNumberUser -= 8;
    }
}
