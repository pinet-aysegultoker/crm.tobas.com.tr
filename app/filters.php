<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/auth/login');
		}
	} else {
        function repairSerializeString($value)
        {

            $regex = '/s:([0-9]+):"(.*?)"/';

            return preg_replace_callback(
                $regex, function($match) {
                return "s:".mb_strlen($match[2]).":\"".$match[2]."\"";
            },
                $value
            );
        }
        $auth_user_group_id = Auth::user()->group_id;
        $auth_user_permissions = UserGroup::where('id',$auth_user_group_id)->pluck('permissions');
        if ($auth_user_permissions !== '*') {

            $auth_user_permissions_array = unserialize(repairSerializeString(UserGroup::where('id',$auth_user_group_id)->pluck('permissions')));
            if (!in_array(Route::currentRouteName(), $auth_user_permissions_array)) {
                return Redirect::back()->withError('Bu bölüme erişim yetkiniz yoktur!');
            }
        }
    }

});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check())
    {
        return Redirect::to('/');
    }

});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
