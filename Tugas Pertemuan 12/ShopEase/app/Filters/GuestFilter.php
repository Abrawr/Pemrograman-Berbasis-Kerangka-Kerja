<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('is_logged_in')) {
            $role = (string) session()->get('user_role');
            $dest = match ($role) {
                'admin'    => site_url('admin/dashboard'),
                'operator' => site_url('operator/dashboard'),
                default    => site_url('account'),
            };

            return redirect()->to($dest);
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
