<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private ?string $role;
    private string $package;

    public function __construct() {
        $this->role = detect_role();
        if ( empty( $this->role)) {
            $this->package = '';
        } else {
            $camel          = Str::camel($this->role);
            $camel[0]       = strtoupper($camel[0]);
            $this->package  = $camel;
        }
    }

    /**
     * ロールに応じてルーティングの名前を変換
     */
    public function route($route): string
    {
        if ( empty( $this->role)) {
            return $route;
        }
        return $this->role . '.' . $route;
    }

    /**
     * ロールに応じたリソース名に変換
     * @param mixed $path
     * @return string
     */
    public function resource($path): string
    {
        if ( empty( $this->role)) {
            return $path;
        }
        return $this->package . '/' . $path;
    }

    /**
     * ロールに応じたモデルクラスの名前を取得する
     */
    public function modelName()
    {
        if (empty($this->role)) {
            return User::class;
        }
        return '\\App\\Models\\' . $this->package;
    }

}
