<?php

namespace App\Middleware;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\Middlewares\MiddlewareInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthMiddlewareAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Lakukan pengecekan autentikasi di sini
        if (!session()->get('logged_in')) {
            return redirect()->to('/login/adminIndex'); // Arahkan pengguna ke halaman login jika belum login
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosongkan jika Anda tidak memerlukan logika setelah request selesai.
    }
}
