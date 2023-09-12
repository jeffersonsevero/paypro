<?php

namespace App\Http\Controllers\Auth;

use App\Actions\RegisterUserAction;
use App\Exceptions\ErrorOnCreateCustomerException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Asaas\Entities\{Customer, Payment};
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, DB, Hash};
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'cpf'      => ['required', 'string', 'min:11', 'max:14', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        try {

            (new RegisterUserAction($request->all()))->handle();

            return redirect(RouteServiceProvider::HOME);
        } catch(ErrorOnCreateCustomerException $exception) {
            toastr()->error($exception->getMessage());

            return redirect()->back();
        }
		catch(Exception $e){
			logger()->critical($e->getMessage());
		}

    }
}
